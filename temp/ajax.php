<?php
    include('config/db.php');
    session_start();
   

     if(isset($_SESSION['login']) && isset($_POST['fridgeId']) )
    {

        $fridge_id = $_POST['fridgeId'];
        $userId = $_SESSION['login'];

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
           //echo 'Updated';
            //  $result = array("time1" => $times1, "time2" => $time2);
            // echo json_encode($result);
        }else{
             echo 'Not Updated';
        }
         

    }
