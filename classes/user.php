<?php
$filepath = realpath(dirname(__FILE__));

include_once ($filepath."/../lib/database_query.php");

?>
<?php

class User{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new database_query();

    }

    public function userSignIn($password, $login, $deptId){
        $password = mysqli_real_escape_string( $this->db->link, $password);
        $login = mysqli_real_escape_string( $this->db->link, $login);
        // check if not empty
        if( $login == "" || $password == "" ) {
            return $Message = "<span class='error' style='color: red;font-weight: bold !important;'>One or More Filed is empty!!!</span>";
        }
        //checking
        $query = "SELECT * FROM tbl_users WHERE login = '$login' AND password = '$password' ";
        $result = $this->db->select($query);



        // adding user to session
        if($result != false){
            // fetching
            $value = $result->fetch_assoc();
            //checking

            Session::set("userLogin", true);
            Session::set("userId", $value['id']);
            Session::set("userName", $value['name']);

          
   
            echo "<script>window.open('fridges.php?deptId=$deptId','_self')</script>";
            //echo "<script>window.open('test.php?deptId=$deptId','_self')</script>";
           
        }else{
            return   $Message = "<span class='error' style='color: red;font-weight: bold !important;'>Not Registered</span>";
        }

    }

    //get user by user Id
    public function getuserById($userId){
        
        $query = "SELECT * FROM tbl_users WHERE id = '$userId'";
        return $result = $this->db->select($query);
    }

    // get all  dept
    public function getDept(){

        $query = "SELECT * FROM tbl_departments";
        return $result = $this->db->select($query);
    }

    // get all fridge in a dept
     public function getDeptFridgesById($deptId){
        
        $query = "SELECT * FROM tbl_department_fridges WHERE dept_id = '$deptId'";
        return $result = $this->db->select($query);
    }
    
     // get  dept name
    public function getDeptNameById($deptId){

        $query = "SELECT * FROM tbl_departments WHERE id = '$deptId' ";
        return $result = $this->db->select($query);
    }

     // get  fridge status
    public function getFridgeById($fridgeId){

        $query = "SELECT * FROM user_fridge WHERE fridge_id = '$fridgeId' ORDER BY id DESC LIMIT 1 ";
        return $result = $this->db->select($query);
    }
    // fridge name
     public function getFridgeNameById($fridgeId){

        $query = "SELECT * FROM tbl_department_fridges WHERE id = '$fridgeId' ";
        return $result = $this->db->select($query);
    }
}
 