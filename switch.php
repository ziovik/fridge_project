<?php
include "lib/session.php";
Session::init();

include "lib/database_query.php";
// autoload classes
spl_autoload_register(function ($class){
    include_once "classes/".$class.".php   ";
});
$db      = new database_query();
$user      = new user();

$userId = Session::get("userId");
if($userId == false){
    
    echo "<script>window.open('index.php','_self')</script>";
}else{


?>
<!DOCTYPE html>

<html lang="rus">

<head>
<title>Fridges</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<link href="layout/styles/modal.css" rel="stylesheet" type="text/css" media="all">
<style type="text/css">
  .pick {
    cursor: pointer;
  }
</style>
</head>
<body id="top">

<div class="wrapper row3">
  <main class="hoc container clear"> 
    <h4 style="text-align: center;">User:
      <?php 
            $userId = Session::get("userId");
            
            // echo  $userId;
            $Users = $user->getuserById($userId);
            if($Users)
            {
              $row = $Users->fetch_assoc();
             echo  $userName =''. $row['name'];            
             
            }else
            {
              echo 'no in';
            }
            
              
         ?>
    </h4>
    <a href="fridges.php" class="btn" id="btn_ingresar">Back</a>
     <a href="?userId" class="btn" id="btn_ingresar" style="float: right;">Logout</a>
    <?php
      if(isset($_GET['userId'])){
          $userId = Session::get("userId");         
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
        <h6 class="heading"> 

          <?php 
            if(isset($_GET['fridgeId']))
            {
             $fridgeId = $_GET['fridgeId'];
             //echo "<script>alert($fridgeId)</script>";
             $fridge = $user->getFridgeNameById($fridgeId);
             if($fridge)
              {
                $row = $fridge->fetch_assoc();
               echo  $fridgeName = $row['name'];            
               
              }else
              {
                echo 'no in';
              }
            }
         ?>
        </h6>
       
      </div>
      <div >
        <div style="text-align: center; "  >
          <label class="switch">
            <input type="checkbox" name="switch" value="0" id="switch"  onclick="switch_power()">
            <span class="slider round"></span>
          </label>
        </div>
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



</body>
</html>
<?php } ?>