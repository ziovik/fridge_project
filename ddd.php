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
  #clc_close{
    color: #fff;
    background: #000;

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
        <h6 class="heading">Плиточник "Убой"</h6>
       <?php
        date_default_timezone_set('Europe/Moscow');
        $dt = date('Y-m-d H:i:s');
        $date = substr($dt, 0, -9);
        $time = substr($dt, -8);
        echo '<p>date:'.$date.'</p>';
        echo '<p>Time:'.$time.'</p>';
//       echo  $dt2 = date('Y-m-d H:i:s',strtotime('+2 hour +30 minutes',strtotime($dt)));

      ?>
       <input style="border: none;color: green" type="text" id="process"  class="form-control" value="" readonly/>
      </div>

     <!--  <?php if ($status == 1){ ?>  disabled <?php   } ?> -->
     <div id="gallery">
        <figure>
          <?php
          if(isset($_GET['deptId'])){
            $deptId = $_GET['deptId'];
            $query = "SELECT * FROM tbl_department_fridges WHERE dept_id = '$deptId' ";
            $run = mysqli_query($con, $query);
            $count = mysqli_num_rows($run);

            if($count >= 1){
              while ($row_dept = mysqli_fetch_assoc($run)){
                ?>
                <div class="wrapper">
                  <div class="fridges folder one_quarter first " >
                    <img src="images\demo\fridge.png">
                    <div class="centered"><?php echo $row_dept['name'] ?></div> 
                  </div>
                  <div class="times three_quarter">
                    <div class="form_controller">
                     
                        <table>
                          <tr>
                            <form method="post" action="">
                              <td>
                                <div class="modal-body">
                                  <div class="input-group">
                                    <div class=" one_third first">
                                       <input type="hidden" name="check" id="check"  />
                                       <input type="text" name="begin_time1" class="form-control" value="" readonly/>
                                    </div>
                                    <div class=" one_third" style="text-align: center;">
                                      <input onclick="fridge('<?php echo $row_dept['id'] ?>')"   class="btn"  type="submit" name="submit1" value="Go" style="width: 50px;"  />
                                       
                                    </div>
                                    <div class=" one_third">
                                      <input type="text" name="end_time1" class="form-control" value="" readonly/>
                                    </div>
                                  </div>
                                </div>
                              </td>
                            </form>
                            <form method="post" action="">
                              <td>
                                <div class="modal-body">
                                  <div class="input-group">
                                    <div class=" one_third first">
                                       <input type="text" name="begin_time2" class="form-control" value="" readonly/>
                                    </div>
                                    <div class=" one_third" style="text-align: center;">
                                      <input  class="btn addMore"  type="submit" name="submit2" value="Go" style="width: 50px;"  />
                                       
                                    </div>
                                    <div class=" one_third">
                                      <input type="text" name="end_time2" class="form-control" value="" readonly/>
                                    </div>
                                  </div>
                                </div>
                              </td>
                            </form>
                          </tr>
                        </table>
                      
                    </div>
                    <div class="database_info"></div>
                  </div>
                </div>
                <br><hr><br>
                <?php
              }
            }
          }
          ?>
          
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
  $(document).ready(function(){
    $(".addMore").attr("disabled", "disabled");

   function fridge(fridgeId){
     $('#check').val(fridgeId);

    console.log(fridgeId);
    
   }
  });

 
</script>
</body>
</html>

<?php } ?>



