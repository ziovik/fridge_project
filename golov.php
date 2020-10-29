<?php
include_once("config/db.php");
 
  session_start();
  if(!isset($_SESSION['login'])){
    echo "<script>window.open('index.php', '_self')</script>";
  }else
  {


?>
<!DOCTYPE html>

<html lang="rus">

<head>
<title>Fridges</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<link href="layout/styles/modal.css" rel="stylesheet" type="text/css" media="all">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style type="text/css">
  .overview:hover{

  }
 .folder {
  position: relative;
  text-align: center;
  color: white;
}
.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 38px;
  font-weight: bold;
  color: #fff;
  }
  #clc{
    color: #fff;

  }
  #clc:hover{
    color: #000;
    
  }
</style>
</head>
<body id="top">

<div class="wrapper row3">
  <main class="hoc container clear"> 
    <p>Пользователь: 
      
      <?php
      if(isset($_GET['login'])){
         $login = $_GET['login'];
          $query = "

              SELECT 
                     name 
                    ,login as login 
                FROM tbl_users 
              
                where login = '$login'  ";
       $stmt = mysqli_query( $con, $query );
      $count = mysqli_num_rows($stmt);

      
      if($count >= 1){
        while( $row =mysqli_fetch_assoc($stmt)){
          echo $name = $row['name'];
            

          }
        }
      }
      ?>
    </p>
    <a href="index.php" class="btn" id="btn_ingresar">Back</a>
     <a href="?userId" class="btn" id="btn_ingresar" style="float: right;">Logout</a>
    <?php
      if(isset($_GET['userId'])){
                
          $_SESSION = array();

          if (ini_get("session.use_cookies")) {
              $params = session_get_cookie_params();
              setcookie(session_name(), '', time() - 42000,
                  $params["path"], $params["domain"],
                  $params["secure"], $params["httponly"]
              );
          }

          session_destroy();
          echo "<script>window.open('index.php','_self')</script>";
      }
    ?>
    <section>
      <div class="sectiontitle">
        <h6 class="heading">Плиточник "Оволка Голов"</h6>
       
      </div>

     
     <div id="gallery">
        <figure>
         
          <ul class="nospace clear">
            <li class="one_quarter first folder">
              <a > 
               <img  src="images/demo/fridge.png" alt="">

              </a> <div class="centered">1</div> 
            </li>
            <li class="three_quarter">
              <t
           
            </li>

          </ul>
            <br>
            <hr>
            <br>
          <ul class="nospace clear">
            <li class="one_quarter first folder">
              <a > 
               <img  src="images/demo/fridge.png" alt="">

              </a> <div class="centered">2</div> 
            </li>
            <li class="three_quarter">
             
                ddd
             
            </li>

          </ul>
        </figure>
      </div>
    </section>
   
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>




<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script type="text/javascript">

</script>
</body>
</html>

<?php } ?>