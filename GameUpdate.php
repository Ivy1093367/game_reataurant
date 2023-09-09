<?php
require('dataBase.php');
?>
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
          <p class="m-0">gameUpdate</p>
        </div>
      </div>
    </div>
    <!-- Header End -->
    
    <!-- Class Start -->
    <div class="container-fluid pt-5">
      <div class="container">
      <p class="section-title px-5">
         <span class="px-2">BoardGames add</span>
        </p>
    <form action="" method="post">
        桌遊名稱:
        <input type=text name=name required="required">
        <br/>
        桌遊簡介(換行請打 <span style="font-size:20px;">\</span> ):
        <textarea name="ginfo" cols="33" rows="3" required="required" class="form-control" id="inputInfo"></textarea>
        <br/>
        遊戲時間:
        <input type="number" name=gtime min="0" placeholder="以分鐘為單位" required="required">
        <!--<input type=tel name=tel placeholder="以分鐘為單位" required="required">-->
        <br/>
        桌遊規則(換行請打 <span style="font-size:20px;">\</span> ):
        <textarea name="grule" cols="33" rows="3" required="required" class="form-control" id="inputInfo"></textarea>
        <br/>
        遊玩所需最少人數:
        <input type="number" name=min min="1" max="20" required="required">
        <br/>
        遊玩限制最多人數:
        <input type="number" name=max min="1" max="20" required="required">
        <br/>
        遊戲難度(最高5最低1):
        <input type="number" name=rating min="1" max="5" required="required">
        <br/>
        桌遊類型:
        <select name=gtype>
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
        <br/>
        <input type="submit" value="新增" class="btn btn-primary">
</form>
<br/>
<p></p>
<div class="text-center pb-2">
<p class="section-title px-5">
    <span class="px-2">BoardGames Infomation</span>
</p>
</div>
<?php
$SQL="SELECT * FROM board_game";
if($result=mysqli_query($link, $SQL)){
    echo "<table class='table caption-top table-hover'>";                        
    echo "<thead><tr><th>編號</th><th>桌遊名稱</th><th>桌遊簡介</th><th>遊玩時間</th><th>規則</th><th>人數下限</th><th>人數上限</th><th>難度</th></tr></thead><tbody>";
    while($row=mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>".$row['Gid']."</td>";
        echo "<td>".$row['GName']."</td>";
        echo "<td>";
        $str=str_replace("\\","<br/>",$row['GInfo']);
        echo "<text class='tooltips'>查看描述";
        echo "<span class='tooltiptexts'>";
        echo $str;
        echo "</span></text>";
        echo "</td>";
        echo "<td>".$row['GTime']."</td>";
        echo "<td>";
        $str=str_replace("\\","<br/>",$row['GRule']);
        echo "<text class='tooltips'>查看描述";
        echo "<span class='tooltiptexts'>";
        echo $str;
        echo "</span></text>";
        echo "</td>";
        echo "<td>".$row['PNum_min']."</td>";
        echo "<td>".$row['PNum_max']."</td>";
        echo "<td>".$row['Rating']."</td>";
        echo "<td><a href='Game_del.php?Gid=".$row['Gid']."'>刪除</a></td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}
?>
<style>
.tooltips {
    position: relative;
    border-bottom: 1px dotted black;
}

.tooltips .tooltiptexts {
    visibility: hidden;
    width: 300px;
    background-color: #4798B3;
    color: #fff;
    border-radius: 6px;

    position: absolute;
    z-index: 1;
}

.tooltips:hover .tooltiptexts {
    visibility: visible;
}
</style>
<?php
if(isset($_POST['name'])){
    $name=$_POST['name'];
    $ginfo=$_POST['ginfo'];
    $ginfo=str_replace("\\","\\\\",$ginfo);
    $gtime=$_POST['gtime'];
    $grule=$_POST['grule'];
    $grule=str_replace("\\","\\\\",$grule);
    $pmin=$_POST['min'];
    $pmax=$_POST['max'];
    $rating=$_POST['rating'];
    $gtype=$_POST['gtype'];
    $SQL="INSERT INTO board_game(GName, GInfo, GTime, GRule, PNum_min, PNum_max, Rating, GPhoto) VALUE ('$name', '$ginfo', '$gtime', '$grule', '$pmin', '$pmax', '$rating', 'board_game_default.png')";
    mysqli_query($link, $SQL);
    $SQL="SELECT DISTINCT b.Gid,t.TNumber FROM board_game b,types t WHERE b.GName='$name' AND t.Category='$gtype'";
    if($result=mysqli_query($link,$SQL)){
        while($row=mysqli_fetch_assoc($result)){
            $gid=$row["Gid"];
            $Tnum=$row["TNumber"];
        }
    }
    $SQL="INSERT INTO game_classification(Gid, TNumber) VALUE ('$gid', '$Tnum')";
    mysqli_query($link, $SQL);
    echo "<meta http-equiv='refresh' content='0;'>";
    //header('Location: Admin_users.php');
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


    