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
    <a href="index.php" class="btn" id="btn_ingresar">Back</a>
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
        
        
        <h6 class="heading">Fridges in 

          <?php 
            if(isset($_GET['deptId']))
            {
             $deptId = $_GET['deptId'];
             $dept = $user->getDeptNameById($deptId);
             if($dept)
              {
                $row = $dept->fetch_assoc();
               echo  $deptName =''. $row['name'];            
               
              }else
              {
                echo 'no in';
              }
            }
         ?>
        </h6>
       
      </div>

       <!-- Modal -->
      <div class="modale" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-header">
         
            <a style="float: right;" href="#" class="btn-close closemodale" aria-hidden="true">&times;</a>
          </div> 
         
          <div class="modal-body">
           
            <input type="hidden"   id="fridge1"  name="fridgeId"> 
            <h3><input style="border: none;text-align: center;" type="text"   id="fridge_name" >  </h3>   
            <input style="border: none;text-align: center;" type="hidden"     id="fridge_status" >  </h3>
              <input style="border: none;text-align: center;" type="text"     id="update" >  </h3>


            <div style="text-align: center; display: none;" id="off" >
              <label class="switch">
                <input type="checkbox" name="switch" value="0" id="switch"  onclick="switch_power()">
                <span class="slider round"></span>
              </label>
            </div>


             <div style="text-align: center;display: none;" id="on">
              <label class="switch">
                <input type="checkbox" name="switch" checked value="1" id="switch" onclick="switch_power()">
                <span class="slider round"></span>
              </label>
            </div>
            
            <div class="block clear">
              
            </div>
                
          </div>       
         <!--  <div class="modal-footer">
            <div style="text-align: center;">
              <input class="btn"  type="submit" name="submit" value="Submit Form">
               &nbsp;
            </div>
            <br><br>

          </div> -->
         
        </div>
      </div>
      <!-- /Modal --> 
      <ul class="nospace group overview" >
         <?php
          if(isset($_GET['deptId'])){
           $deptId = $_GET['deptId'];
           $fridges = $user->getDeptFridgesById($deptId);
           if($fridges){
               while ($row = $fridges->fetch_assoc()){
                $fridgesId = $row['id'];
                   ?>

                   <li class="one_third">
                    <figure  class="pick" style="text-align: center;" ><a href="switch.php?fridgeId=<?php echo $row['id'] ?>"><img  src="images/demo/fridge.png" alt=""></a>
                      <figcaption>
                        <h6 class="heading"><?php  echo $row['name'] ?> </h6>
                        <p>Fridge инфо</p>
                      </figcaption>
                    </figure>
                  </li>

          <?php
                }
              }
            }
          ?>
       
        
      </ul>
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