<?php
    include('config/db.php');
    session_start();
   

     if(isset($_SESSION['login']) && isset($_POST['submit1']) && isset($_GET['deptId']))
    {

        $fridge_id = $_POST['fridge_id'];
        $userId = $_SESSION['login'];
        $deptId = $_GET['deptId'];

        date_default_timezone_set('Europe/Moscow');
        $dt = date('Y-m-d H:i:s');
        $time1 = substr($dt,  -8);

        $dt2 = date('Y-m-d H:i:s',strtotime('+2 hour +30 minutes',strtotime($dt)));
        $time2 = substr($dt2,  -8);


        
        $status1 = 0;
        

        $query = "INSERT INTO fridge_power (user_id, fridge_id, status1, begin_time1, end_time1, datetime_compare) 
                   values ($userId, $fridge_id, $status1, '$time1', '$time2' , '$dt')";    
        $run = mysqli_query($con, $query); 
        if($run){
            $sql = "SELECT * FROM fridge_power 
                    WHERE fridge_id = '$fridge_id' and user_id = '$userId' and datetime_compare = '$dt'  ORDER BY begin_time1 DESC LIMIT 1";
            $result = mysqli_query($con, $sql);
            $count = mysqli_num_rows($result);
            if($count >= 1){
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['id'];
                     echo "<script>window.open('uboi.php?login=$userId&deptId=$deptId&id=$id','_self')</script>";
                }
            }
           
            // echo "<script>window.history.go(-1);</script>";
        }else{
           
        }
         

    }

      if(isset($_SESSION['login']) && isset($_POST['submit2'])  && isset($_GET['deptId']) && isset($_POST['id']))
    {

        $fridge_id = $_POST['fridge_id'];
        $userId = $_SESSION['login'];
        $deptId = $_GET['deptId'];
        $id = $_POST['id'];

        date_default_timezone_set('Europe/Moscow');
        $dt = date('Y-m-d H:i:s');
        $time1 = substr($dt,  -8);

        $dt2 = date('Y-m-d H:i:s',strtotime('+40 minutes',strtotime($dt)));
        $time2 = substr($dt2,  -8);


        
        $status2 = 1;
        

        $query = "UPDATE fridge_power SET 
                              user_id = '$userId',
                              fridge_id = '$fridge_id',
                              status2 = '$status2',
                              begin_time2 = '$time1',
                              end_time2 = '$time2'
                    where id = '$id' AND fridge_id = '$fridge_id' and user_id = '$userId'
                  ";    
        $run = mysqli_query($con, $query); 
        if($run){
            echo "<script>window.open('uboi.php?login=$userId&deptId=$deptId','_self')</script>";
        }else{
           
        }
         

    }
?>