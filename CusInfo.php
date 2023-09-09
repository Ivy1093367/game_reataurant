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
    <title>CusInfo</title>
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
            <a href="GameInfo.php" class="nav-item nav-link">桌遊總覽</a>
            <a href="MenuInfo.php" class="nav-item nav-link">菜單</a>
            <a href="CusInfo.php" class="nav-item nav-link active">顧客資訊</a>
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
          <p class="m-0">CusInfo</p>
        </div>
      </div>
    </div>
    <!-- Header End -->
    
    <!-- Class Start -->
    <div class="container-fluid pt-5">
      <div class="container">
      <div class="text-center pb-2">
          <h1 class="mb-4">顧客資訊</h1>
        </div>
        <p class="section-title px-5">
            <span class="px-2">Customer add</span>
          </p>
    <form action="" method="post">
        同行人數:
        <input type="number" name=cnum min="1" max="200" required="required">
        <br/>
        遊玩時長(以小時計算):
        <input type="number" name=ctime min="1" required="required">
        <br/>
        總花費:
        <input type="number" name=ccost min="1" required="required">
        <br/>
        <input type="submit" value="新增" class="btn btn-primary">
</form>
<br/>
<p></p>
<div class="text-center pb-2">
<p class="section-title px-5">
    <span class="px-2">Customer Infomation</span>
</p>
</div>
<?php
$SQL="SELECT * FROM customer";
if($result=mysqli_query($link, $SQL)){
    echo "<table class='table caption-top table-hover'>";                        
    echo "<thead><tr><th>顧客編號</th><th>同行人數</th><th>遊玩時長</th><th>總花費</th><th></th></tr></thead><tbody>";
    while($row=mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>".$row['Cid']."</td>";
        echo "<td>".$row['CNum']."</td>";
        echo "<td>".$row['Hours']."</td>";
        echo "<td>".$row['Total_cost']."</td>";
        echo "<td><a href='Cus_del.php?Cid=".$row['Cid']."'>刪除</a></td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}
?>

<?php
if(isset($_POST['cnum'])){
    $cnum=$_POST['cnum'];
    $hours=$_POST['ctime'];
    $ccost=$_POST['ccost'];
    $SQL="INSERT INTO customer(CNum, Hours, Total_cost) VALUE ('$cnum', '$hours', '$ccost')";
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


    