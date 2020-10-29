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
            <input style="border: none;text-align: center;" type="hidden"     id="fridge_status" > <br>  
            <input style="border: none;text-align: center;" type="text"     id="update" > 


            <div style="text-align: center;"  >
              <label class="switch">
                <input type="checkbox" name="switch"  id="switch"  onclick="switch_power()">
                <span class="slider round"></span>
              </label>
            </div>


            
            <div class="block clear">
              
            </div>
                
          </div>       
         
        </div>
      </div>
      <!-- /Modal --> 
      <div id="gallery">
        <figure>
         
          <ul class="nospace clear">
            <li class="one_quarter first folder">
              <a > 
               <img  src="images/demo/fridge.png" alt="">

              </a> <div class="centered">1</div> 
            </li>
            <li class="three_quarter">
              
           
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
  
$('.openmodale').click(function (e) {
         e.preventDefault();
         $('.modale').addClass('opened');
    });
$('.closemodale').click(function (e) {
         e.preventDefault();
         $('.modale').removeClass('opened');
    });
</script>

<script>
   function fridge(fridgeId){
     
    $('#fridge1').val(fridgeId);
    //console.log(fridgeId);
     var fridgeId = $('#fridge1').val();
      $.ajax
      ({
          type: 'POST',
          url: 'ajax_fridge.php',
          data:{fridgeId:fridgeId},
          success:function(data)
          {
             // var name = JSON.parse(data).name;
             // var status = JSON.parse(data).status;
            //console.log(data);
            // $("#fridge_name").empty();
            //     $.each(name, function(key, value){
            //         $("#fridge_name").append(value);
            //         $('#fridge_name').val(value);
            //     });
            // $("#fridge_status").empty();
            //     $.each(status, function(key, value){
            //         $("#fridge_status").append(value);
            //         $('#fridge_status').val(value);
            //     });
             $('#fridge_name').val(data);

          }
        });
      var fridgeId1 = $('#fridge1').val();
      $.ajax
      ({
          type: 'POST',
          url: 'ajax_fridge.php',
          data:{fridgeId1:fridgeId1},
          success:function(data)
          {
             
             
             if(data == 1){
             
             $('#switch').prop('checked', true);
            
             }else{
              $('#switch').prop('checked', false);
             
             }
             //$('#fridge_status').val(data);
             //console.log(data);
          }
        });

   }
   function switch_power(){
      //alert('hello');
       // var switch_power = $('#switch').val();
       //  alert(switch_power);
      if (document.getElementById('switch').checked) {
        var switch_power = 1;
            //alert(switch_power);
        } else {
            var switch_power = 0;
            //alert(switch_power);
        }
      var fridgeId2 = $('#fridge1').val();
      var userId = '<?php echo Session::get("userId") ?>';
      //  console.log(switch_power);
      //alert(userId);
       $.ajax
      ({
          type: 'POST',
          url: 'ajax_fridge.php',
          data:{switch_power:switch_power, fridgeId2:fridgeId2, userId:userId},
          success:function(data)
          {
              $('#update').val(data);
             

          }
        });
   }
</script>
</body>
</html>
<?php } ?>