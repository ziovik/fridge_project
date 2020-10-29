<?php
include('config/db.php');
session_start();


if (isset($_SESSION['login'])) {
    $query = "SELECT * FROM fridge_power ORDER BY fridge_id, begin_time1";
    $run = mysqli_query($con, $sql);
    if ($run) {
        $row = mysqli_fetch_assoc($run);
        $id = $row['action_id'];

    }
}

if (isset($_SESSION['login']) && isset($_POST['fridgeId']) && isset($_POST['type'])) {


    $fridge_id = $_POST['fridgeId'];
    $userId = $_SESSION['login'];
    $type = $_POST['type'];

    date_default_timezone_set('Europe/Moscow');
    $dt = date('Y-m-d H:i:s');


    $status = 0;

    if ($type == "INSERT") {
        // $time1 = substr($dt, -8);
        $time1 = $dt;
        $dt2 = date('Y-m-d H:i:s', strtotime('+2 hour +30 minutes', strtotime($dt)));
        // $time2 = substr($dt2, -8);
        $time2 = $dt2;
        $query = "INSERT INTO fridge_power (user_id, fridge_id, status, begin_time1, end_time1, datetime_compare) 
                   VALUES ($userId, $fridge_id, $status, '$time1', '$time2' , '$dt')";

        $run = mysqli_query($con, $query);
        if ($run) {
            $sql = "SELECT id from fridge_power where user_id = '$userId' and  fridge_id = '$fridge_id' and begin_time1= '$time1' and end_time1 ='$time2' and datetime_compare = '$dt' ";
            $run1 = mysqli_query($con, $sql);
            if ($run1) {
                $row = mysqli_fetch_assoc($run1);
                $id = $row['id'];

                $query1 = "INSERT INTO fridge_unique (action_id, user_id, fridge_id) 
                          VALUES ($id, $userId, $fridge_id)";
                $run2 = mysqli_query($con, $query1);

            }
        }


    } else {
        $dt = date('Y-m-d H:i:s');
        $time1 = $dt;
        $dt2 = date('Y-m-d H:i:s', strtotime('+40 minutes', strtotime($dt)));
        $time2 = $dt2;

        $sql = "SELECT action_id from fridge_unique where user_id = '$userId' and  fridge_id = '$fridge_id' ";
        $run = mysqli_query($con, $sql);
        if ($run) {
            $row = mysqli_fetch_assoc($run);
            $id = $row['action_id'];

            $query = "UPDATE fridge_power SET begin_time2 = '$time1', end_time2 = '$time2' , status = 1
                    WHERE user_id = $userId AND fridge_id = $fridge_id and id = $id";
            $run1 = mysqli_query($con, $query);

            if ($run1) {
                $sql_delete = "DELETE FROM fridge_unique where action_id = $id and user_id = '$userId' and  fridge_id = '$fridge_id'";
                mysqli_query($con, $sql_delete);
            }
        }
    }


    printf("%s\n", "INSERT" . $fridge_id);

    echo "Yellow";

}

