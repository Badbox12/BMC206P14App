<?php
include ('functions.php');
$result = array("success"=>0,"error"=>0);
if(isset($_POST['UserNameReg']) && isset($_POST['UserPassReg'])){
    $name = $_POST['UserNameReg'];
    $password = md5($_POST['UserPassReg']);
    $fullname = $_POST['UserFullName'];


    $fields = array("UserName","UserPassword","FullName");
    $values = array($name, $password, $fullname);

    // create an object of class functions
    $func = new functions();

    // call the method of class functions
    $insert = $func->insert_data("tblusers",$fields,$values);
    if($insert == true) {
        $result["success"] = 1;
        $result["msg_success"] = "Register user successfully...";
        print json_encode($result);
    }else{
        $result["error"] = 2;
        $result["msg_errors"] = "Failed to register the user. ";
        print json_encode($result);

    }
}else{
    $result["error"] = 1;
        $result["msg_errors"] = "Access Denied. ";
        print json_encode($result);

}


?>