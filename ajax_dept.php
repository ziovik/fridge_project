<?php
   include('config/db.php');


    if(isset($_POST['deptId']))
    {
        $query = $con->query("SELECT * FROM tbl_departments WHERE id = ".$_POST['deptId']." ");
         //Count total number of rows
        $rowCount = $query->num_rows;

        //Display dept list
        if($rowCount > 0){
          
            while($row = $query->fetch_assoc()){
                echo $row['name'];
            }
        }else{
            echo '';
        }

    }