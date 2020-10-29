<?php 
  session_start();
  include_once("config/db.php");
 
 
  if(isset($_POST['submit'])){
      $password = $_POST['password'];
      $login = $_POST['login'];

      $deptId = $_POST['value'];
      $query = "

               SELECT 
                     name 
                    ,login  
                FROM tbl_users 
              
                where login = '$login' and password = '$password' ";

       
      $stmt = mysqli_query( $con, $query );
      $count = mysqli_num_rows($stmt);

      
      if($count >= 1){
        while( $row =mysqli_fetch_assoc($stmt)){
          $name = $row['name'];
          $login = $row['login'];
          
          $_SESSION['login'] = $login;

          if($deptId == 1){
            echo "<script>window.open('uboi.php?login=".$login."&deptId=1', '_self')</script>";
          }elseif($deptId == 2){
            echo "<script>window.open('golov.php?login=".$login."&deptId=2', '_self')</script>";
          }

        }
        
      }
  }
?>

<!DOCTYPE html>

<html lang="rus">

<head>
<title>APK Project</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<link href="layout/styles/modal.css" rel="stylesheet" type="text/css" media="all">
<style type="text/css">
  .overview:hover{

  }
 
.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 18px;
  font-weight: bold;
  color: #fff;
  }
</style>
</head>
<body id="top">

<div class="wrapper row3">
  <main class="hoc container clear"> 
    
    <section>
      <div class="sectiontitle">
        <h6 class="heading">ЦЕХ </h6>
        <p>Цех инфо</p>
      </div>

      <!-- Modal -->
      <div class="modale" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-header">
         
            <a style="float: right;" href="#" class="btn-close closemodale" aria-hidden="true">&times;</a>
          </div> 
          <form action="" method="post">
            <div class="modal-body">
              <h2 style="text-align: center;">Login</h2>
                <input type="hidden" name="value" id="value" value=""  required>   
              <div >
                <label for="login">Login <span>*</span></label>
                 <input type="text" name="login" id="login" value=""  required>
               
              </div>
              <div >
                <label for="password">Password <span>*</span></label>
                <input type="password" name="password" id="password" value=""  required>
              </div>
              
              <div class="block clear">
                
              </div>
                  
            </div>       
            <div class="modal-footer">
              <div class=" one_half first">
                <input class="btn"  type="submit" name="submit" value="Submit Form">
                 &nbsp;
              </div>
              <div class=" one_half">
                <input class="btn" type="reset" name="reset" value="Reset Form">
              </div><br><br>

             <!--  <a href="#" class="btn" id="btn_ingresar">Login</a> -->
            </div>
          </form> 
        </div>
      </div>
      <!-- /Modal -->

      <ul class="nospace group overview">
        <li class="one_third">
          <figure style="cursor: pointer;"><a class="openmodale" data-value="1"  ><img src="images/demo/320x240.png" alt="" >
           
              <div class="centered" style="text-align: center;">
               <h6 class="heading">Плиточник "Убой"</h6>
             </div> 
            
          </figure>
        </li>
        <li class="one_third">
          <figure style="cursor: pointer;"><a class="openmodale" data-value="2" ><img src="images/demo/320x240.png" alt="">
            <div class="centered" style="text-align: center;">
              <h6 class="heading">Плиточник "Обвалка Голов"</h6>
            </div> 
           
          </figure>
        </li>
        
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
<script type="text/javascript">
  
$('.openmodale').click(function (e) {
         e.preventDefault();
         var values = $(this).attr('data-value') ;     
         // console.log(value)
         $('#value').val(values);

         $('.modale').addClass('opened');
         

    });
$('.closemodale').click(function (e) {
         e.preventDefault();
         $('.modale').removeClass('opened');
    });

</script>
</body>
</html>