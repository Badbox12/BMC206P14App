<?php 
    include('functions.php');
    $result = array("success"=>0,"errors"=>0);
    if(isset($_POST['UserId']) && isset($_POST['NewPassword'])){
        $id = $_POST['UserId'];
        $password = $_POST['NewPassword'];

        $field = array("UserPassword");
        $value = array($password);
        // create an object of class functions
        $func = new functions();
        // call the method
        $update = $func->update_data('tblusers',$field, $value,'UserID',$id);
        if($update == true){
            $result["success"] = 2;
            $result["msg_success"] = "Your password has been changed. ";
            $result["UserPasswordUpdate"] = $password;
            print json_encode($result);
        }else{
            $result["errors"] = 1;
            $result["msg_errors"] = "Faild to change your password";
            print json_encode($result);
        }
    }else{
        $result["errors"] = 1;
        $result["msg_errors"] = "Access denied...";
        print json_encode($result);
    }


?>