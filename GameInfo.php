<?php
    require("dataBase.php");
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
  <head>
    <meta charset="utf-8" />
    <title>gameInfo</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Free HTML Templates" name="keywords" />
    <meta content="Free HTML Templates" name="description" />

    <!-- Favicon -->
    <link href="images/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap"
      rel="stylesheet"
    />

    <!-- Font Awesome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
      rel="stylesheet"
    />

    <!-- Flaticon Font -->
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
  </head>

  <body>
    <!-- Navbar Start -->
    <div class="container-fluid bg-light position-relative shadow">
      <nav
        class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 px-lg-5"
      >
        <a
          href=""
          class="navbar-brand font-weight-bold text-secondary"
          style="font-size: 50px"
        >
        <img src="images/logo.png" width="60" height="60" alt="">
          <span class="text-primary">BoardGames</span>
        </a>
        <button
          type="button"
          class="navbar-toggler"
          data-toggle="collapse"
          data-target="#navbarCollapse"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="collapse navbar-collapse justify-content-between"
          id="navbarCollapse"
        >
        <div class="navbar-nav font-weight-bold mx-auto py-0">
            <a href="index.php" class="nav-item nav-link">Home</a>
            <a href="GameInfo.php" class="nav-item nav-link active">桌遊總覽</a>
            <a href="MenuInfo.php" class="nav-item nav-link">菜單</a>
            <a href="CusInfo.php" class="nav-item nav-link">顧客資訊</a>
          </div>
          
        </div>
      </nav>
    </div>
    <!-- Navbar End -->

    <!-- Header Start -->
    <div class="container-fluid bg-primary mb-5">
      <div
        class="d-flex flex-column align-items-center justify-content-center"
        style="min-height: 400px"
      >
        <h3 class="display-3 font-weight-bold text-white">BoardGames</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0"><a class="text-white" href="">Home</a></p>
          <p class="m-0 px-2">/</p>
          <p class="m-0">gameInfo</p>
        </div>
      </div>
    </div>
    <!-- Header End -->
    <div class="card-body text-center"><form action="" method="post">
                桌遊名稱:
                <input type=text name=name>
                遊玩人數: 
                <input type=text name=pnum>
                <!--作者: 
                <input type=text name=author>-->
                桌遊類型:
                <select name=type>
                    <option></option>
                    <?php
                    $SQL="SELECT DISTINCT Category FROM types";
                    if($result=mysqli_query($link,$SQL)){
                        while($row=mysqli_fetch_assoc($result)){
                            echo "<option>";
                            echo $row['Category'];
                            echo "</option>";
                        }
                    }
                    ?>
                </select>
                <input type="submit" value="查尋" class="btn btn-primary">
    </form></div>
    <!-- Class Start -->
    <div class="container-fluid pt-5">
      <div class="container">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">BoardGames Information</span>
          </p>
          <h1 class="mb-4">桌遊總覽</h1>
        </div>
        <div class="text-center pb-2"><a href="GameUpdate.php" class="btn btn-primary px-4">新增桌遊</a></div>
        <?php
        if(!empty($_POST["name"])){
            $nameStr="b.GName like '%".$_POST['name']."%'";
        }else{
            $nameStr=NULL;
        }
        if(!empty($_POST["pnum"])){
            $pubStr="b.PNum_min <= ".$_POST['pnum']." AND b.PNum_max >= ".$_POST['pnum'];
        }else{
            $pubStr=NULL;
        }
        if(!empty($_POST["type"])){
            $tyStr="t.Category LIKE '%".$_POST['type']."%'";
        }else{
            $tyStr=NULL;
        }

        if(isset($nameStr)){
            $str=$nameStr;
        }
        if(isset($str)){
            if(isset($pubStr)){
                $str=$str." AND ".$pubStr;
            }
        }else{
            $str=$pubStr;
        }
        /*if(isset($str)){
            if(isset($authStr)){
                $str=$str." AND ".$authStr;
            }
        }else{
            $str=$authStr;
        }*/
        if(isset($str)){
            if(isset($tyStr)){
                $str=$str." AND ".$tyStr;
            }
        }else{
            $str=$tyStr;
        }
        if(isset($str)){
            //echo "aaa";
            $str="WHERE ".$str." AND c.Gid=b.Gid AND c.TNumber=t.TNumber ORDER BY b.Gid";
        }else{
            $str="WHERE c.Gid=b.Gid AND c.TNumber=t.TNumber ORDER BY b.Gid";
        }
        $SQL="SELECT * FROM game_classification c,types t,board_game b $str";
        if($result=mysqli_query($link,$SQL)){
            $temp_gid=NULL;
            while($row=mysqli_fetch_assoc($result)){
                if($row['Gid']==$temp_gid){
                    continue;
                    //echo "#".$row['Category'];
                }else{
?>
        <div class="row">
            
          <div class="col-lg-12 mb-5">
            <div class="card border-0 bg-light shadow-sm pb-2">
            <div class="card-body text-center"><?php echo "<img style='width:300px;' src='images/".$row['GPhoto']."' align='middle'>";?></div>
              <!--<img class="card-img-top mb-2" src="img/class-1.jpg" alt="" />-->
              <div class="card-body text-center">
                <h4 class="card-title"><?php echo $row['GName'];?></h4>
                <p class="card-text">
                <?php echo $row['GInfo'];?>
                </p>
              <h5 class="card-title">Rule</h5>
                <p class="card-text">
                <?php echo $row['GRule'];?>
                </p>
              </div>
              <div class="card-footer bg-transparent py-4 px-5">
                <div class="row border-bottom">
                  <div class="col-6 py-1 text-right border-right">
                    <strong>遊玩人數</strong>
                  </div>
                  <div class="col-6 py-1"><?php echo $row['PNum_min'];?> - <?php echo $row['PNum_max'];?> 人</div>
                </div>
                <div class="row border-bottom">
                  <div class="col-6 py-1 text-right border-right">
                    <strong>遊玩時長</strong>
                  </div>
                  <div class="col-6 py-1"><?php echo $row['GTime'];?> minutes</div>
                </div>
                <div class="row border-bottom">
                  <div class="col-6 py-1 text-right border-right">
                    <strong>遊戲難度</strong>
                  </div>
                  <div class="col-6 py-1"><?php echo $row['Rating'];?> 顆星</div>
                </div>
                <div class="row">
                  <div class="col-6 py-1 text-right border-right">
                    <strong>類型</strong>
                  </div>
                  <div class="col-6 py-1">#<?php echo $row['Category'];?></div>
                </div>
              </div>
              <a href="Game_del.php?Gid=<?php echo $row['Gid'];?>" class="btn btn-primary px-4 mx-auto mb-4">刪除</a>
            </div>      
          </div>
          <?php
                    }
                    $temp_gid=$row['Gid'];
                }
            }
            ?>    
      </div>
    </div>
    
    <!-- Class End -->
    
    <!-- Footer Start -->
    <div
      class="container-fluid bg-secondary text-white mt-5 py-5 px-sm-3 px-md-5"
    >
     
      <div
        class="container-fluid pt-5"
        style="border-top: 1px solid rgba(23, 162, 184, 0.2) ;"
      >

          <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
          Designed by
          <a class="text-primary font-weight-bold" href="https://htmlcodex.com"
            >HTML Codex</a
          >
          <br />Distributed By:
          <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
        </p>
      </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary p-3 back-to-top"
      ><i class="fa fa-angle-double-up"></i
    ></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
  </body>
</html>
