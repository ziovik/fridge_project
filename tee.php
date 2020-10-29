<?php
include ("inc/db.php");

//Include database configuration file


if(isset($_POST["country_id"]) && !empty($_POST["country_id"])){
    //Get all state (region) data
    $query = $con->query("SELECT * FROM states WHERE country_id = ".$_POST['country_id']." AND status = 1 ORDER BY state_name ASC");

    //Count total number of rows
    $rowCount = $query->num_rows;

    //Display states list
    if($rowCount > 0){
        echo '<option value="">Выберите регион</option>';
        while($row = $query->fetch_assoc()){
            echo '<option value="'.$row['state_id'].'">'.$row['state_name'].'</option>';
        }
    }else{
        echo '<option value="">Региона нет</option>';
    }
}

if(isset($_POST["state_id"]) && !empty($_POST["state_id"])){
    //Get all city data
    $query = $con->query("SELECT 
                                    * 
                                 FROM
                                    cities  c
                                    
                                  WHERE state_id = ".$_POST['state_id']." AND status = 1 ORDER BY city_name ASC");

    //Count total number of rows
    $rowCount = $query->num_rows;

    $cities = array();

    //Display cities list
    if($rowCount > 0){
        array_push($cities, '<option value="" disabled selected>Выберите город</option>');
//        echo '<option value="" disabled selected>Выберите город</option>';
        while($row = $query->fetch_assoc()){
            array_push($cities, '<option value="' . $row['city_id'] . '">' . $row['city_name'] . '</option>');
//            echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
        }
    }else{
        array_push($cities, '<option value="">Города нет</option>');
//        echo '<option value="">Города нет</option>';
    }

    //Get all area  data
    $query1 = $con->query("SELECT * FROM areas WHERE state_id = ".$_POST['state_id']." AND status = 1 ORDER BY area_name ASC");

    //Count total number of rows
    $rowCount1 = $query1->num_rows;


    $areas = array();

    //Display cities list
    if($rowCount1 > 0){
        array_push($areas, '<option value="" disabled selected>Выберите Район</option>');
//        echo '<option value="" disabled selected>Выберите Район</option>';
        while($row1 = $query1->fetch_assoc()){
            array_push($areas, '<option value="' . $row1['area_id'] . '">' . $row1['area_name'] . '</option>');
//            echo '<option value="'.$row1['area_id'].'">'.$row1['area_name'].'</option>';
        }
    }else{
        array_push($areas, '<option value="">Района нет</option>');
//        echo '<option value="">Района нет</option>';
    }

    $result = array("cities" => $cities, "areas" => $areas);
    echo json_encode($result);

}

if(isset($_POST["city_id"]) && !empty($_POST["city_id"])){
    //город
    $city_id_p = $_POST["city_id"];
    $query = $con->query("SELECT 
                                    c2.country_id,
                                    c.state_id
                                   
                                 
                                 FROM
                                    cities c 
                                    join states s on c.state_id = s.state_id
                                    join countries c2 on s.country_id = c2.country_id
                                                                   
                                  WHERE c.city_id = ".$_POST['city_id']." ");
    $rowCount1 = $query->num_rows;

    if($rowCount1 > 0) {
        $row = $query->fetch_assoc();
        $state_id_c = $row['state_id'];
        $country_id_c = $row['country_id'];

        $query = $con->query("SELECT * FROM cities ORDER BY city_name ASC");
        $rowCount2 = $query->num_rows;
        $city = array();
        if ($rowCount2 > 0) {
            while ($row_c = $query->fetch_assoc()) {
                $city_id = $row_c['city_id'];
                $city_name = $row_c['city_name'];

                array_push($city, '<option value="' . $city_id . '" ' . ($city_id == $city_id_p ? 'selected="selected"' : '') . '>' . $city_name . '</option>');
            }
        }
        //нас. пункт village
        $query = $con->query("SELECT * FROM villages WHERE city_id = '$city_id_p' ");
        $rowCount10 = $query->num_rows;
        $village = array();
        if ($rowCount10 > 0) {
            while ($row_v = $query->fetch_assoc()) {
                $village_id = $row_v['punkt_id'];
                $village_name = $row_v['village_name'];

                array_push($village, '<option value="' . $village_id . '" >' . $village_name . '</option>');
            }
        }

        //street
        $query = $con->query("SELECT * FROM streets WHERE city_id = '$city_id_p' ORDER BY street_name ASC");
        $rowCount11 = $query->num_rows;
        $street = array();
        if ($rowCount11 > 0) {
            while ($row_st = $query->fetch_assoc()) {
                $street_id = $row_st['street_id_rec'];
                $street_name = $row_st['street_name'];
                $street_index = $row_st['street_index'];

                array_push($street, '<option value="' . $street_id . '" >' . $street_name . ',  ' . $street_index . ' </option>');
            }
        }

        //регион
        $query = $con->query("SELECT  * FROM states ORDER BY state_name ASC");
        $rowCount3 = $query->num_rows;
        $state = array();
        if ($rowCount3 > 0) {
            while ($row_s = $query->fetch_assoc()) {
                $state_id = $row_s['state_id'];
                $state_name = $row_s['state_name'];
                array_push($state, '<option value="' . $state_id . '" ' . ($state_id == $state_id_c ? 'selected="selected"' : '') . '>' . $state_name . '</option>');

            }
        }

        // страна
        $query = $con->query("SELECT  * FROM countries WHERE country_id = '$country_id_c' ORDER BY country_name ASC ");
        $rowCount4 = $query->num_rows;
        $country = array();
        if ($rowCount4 > 0) {
            while ($row_ci = $query->fetch_assoc()) {
                $country_id = $row_ci['country_id'];
                $country_name = $row_ci['country_name'];
                array_push($country, '<option value="' . $country_id . '" ' . ($country_id == $country_id_c ? 'selected="selected"' : '') . '>' . $country_name . '</option>');
            }
        }
    }

    $result = array("city" => $city, "village" => $village, "street" => $street, "state" => $state, "country"=> $country);
    echo json_encode($result);

}

if(isset($_POST["area_id"]) && !empty($_POST["area_id"])){
    $area_id_p = $_POST["area_id"];
    $query = $con->query("SELECT 
                                    s.state_id,
                                    c2.country_id
                                 FROM 
                                    areas  a
                                    join states s on a.state_id = s.state_id
                                    join countries c2 on s.country_id = c2.country_id       
                                  WHERE a.area_id = ".$_POST['area_id']." ");
//Count total number of rows
    $rowCount = $query->num_rows;
    if($rowCount > 0){
        $row = $query->fetch_assoc();
        $state_id_a = $row['state_id'];
        $country_id_a = $row['country_id'];

        $query = $con->query("SELECT * FROM  areas ORDER BY area_name ASC ");
        $rowCount1 = $query->num_rows;
        $area = array();
        if($rowCount1 > 0){
            while($row_a = $query->fetch_assoc()){
                $area_id = $row_a['area_id'];
                $area_name = $row_a['area_name'];
                array_push($area, '<option value="' . $area_id . '" ' . ($area_id == $area_id_p ? 'selected="selected"' : '') . '>' . $area_name . '</option>');
            }
        }


        //нас. пункт village
        $query = $con->query("SELECT * FROM villages WHERE area_id = '$area_id_p' ");
        $rowCount10 = $query->num_rows;
        $village = array();
        if ($rowCount10 > 0) {
            while ($row_v = $query->fetch_assoc()) {
                $village_id = $row_v['punkt_id'];
                $village_name = $row_v['village_name'];

                array_push($village, '<option value="' . $village_id . '" >' . $village_name . '</option>');
            }
        }

        //street
        $query = $con->query("SELECT * FROM streets WHERE area_id = '$area_id_p' ");
        $rowCount11 = $query->num_rows;
        $street = array();
        if ($rowCount11 > 0) {
            while ($row_st = $query->fetch_assoc()) {
                $street_id = $row_st['street_id_rec'];
                $street_name = $row_st['street_name'];
                $street_index = $row_st['street_index'];
                array_push($street, '<option value="' . $street_id . '" >' . $street_name . ',  ' . $street_index . ' </option>');
            }
        }

        //        state(region)
        $query = $con->query("SELECT * FROM states ORDER BY state_name ASC ");
        $rowCount2 = $query->num_rows;
        $state = array();
        if($rowCount2 > 0){
            while($row_s = $query->fetch_assoc()){
                $state_id = $row_s['state_id'];
                $state_name = $row_s['state_name'];
                array_push($state, '<option value="' . $state_id . '" ' . ($state_id == $state_id_a ? 'selected="selected"' : '') . '>' . $state_name . '</option>');
            }
        }
        //        country
        $query = $con->query("SELECT * FROM countries WHERE country_id = '$country_id_a' ORDER BY country_name ASC");
        $rowCount3 = $query->num_rows;
        $country = array();
        if($rowCount3 > 0){
            while($row_country = $query->fetch_assoc()){
                $country_id = $row_country['country_id'];
                $country_name = $row_country['country_name'];
                array_push($country, '<option value="' . $country_id . '" ' . ($country_id == $country_id_a ? 'selected="selected"' : '') . '>' . $country_name . '</option>');
            }
        }
    }
    $result = array("area" => $area, "village" => $village, "street" => $street, "state" => $state, "country"=> $country);
    echo json_encode($result);

}

//village
if(isset($_POST["village_id"]) && !empty($_POST["village_id"])){
    $village_id_p = $_POST["village_id"];
    //Get all street data
    $query = $con->query("SELECT * FROM streets WHERE village_id = ".$_POST['village_id']." AND status = 1 ORDER BY street_name ASC");

    //Count total number of rows
    $rowCount = $query->num_rows;

    //Display states list
    if($rowCount > 0){
        echo '<option disabled value="">Выберите Ул.</option>';
        while($row = $query->fetch_assoc()){
            echo '<option value="'.$row['street_id_rec'].'">'.$row['street_name'].'</option>';
        }
    }else{
        echo '<option value="">Улиц нет.</option>';
    }

}
 var fridgeId = $('#fridge1').val();
      $.ajax
      ({
          type: 'POST',
          url: 'ajax_fridge.php',
          data:{fridgeId:fridgeId},
          success:function(data)
          {
            var time1 = JSON.parse(data).time1;
            var time2 = JSON.parse(data).time2;
           $("#process").val(data);
           $("#begin_time1").append(time1);
           $("#begin_time2").append(time2);
          }
        });
    