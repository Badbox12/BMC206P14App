<?php
include('functions.php');
$result = array("success"=>0,"errors"=>0);
if(isset($_POST['UserNameLogin']) && isset($_POST['UserPasswordLogin'])){
    $user = $_POST['UserNameLogin'];
    $pwd = md5($_POST['UserPasswordLogin']);
    $path = "http://localhost:4055/BACKEND/images/";
    //create an object of class functions
    $func = new functions();

    // call the method login 
    $login = $func->login_user($user,$pwd);
    if($login != false){
        $row = mysqli_fetch_array($login);
        $result['success'] = 1 ;
        $result['msg_success'] = "Logged in user successfully" ;
        $result['UserIDLogin'] = $row[0] ;
        $result['UserNameLogin'] = $row[1];
        $result['UserPwdLogin'] = $row[2];
        $result['UserFullName'] = $row[3];
        $result['UserTypeLogin'] = $row[4];
        $result['UserEmailLogin'] = $row[5];
        $result['UserImageLogin'] = base64_encode(file_get_contents($path.$row[6])) ;
        print json_encode($result);
    }else {
        $result["errors"] = 2;
        $result["msg_errors"] ="Failed to login the user";
        print json_encode($result);
    }
}else {
    $result["errors"] = 1;
    $result["msg_errors"] ="Access denied ...";
    print json_encode($result);
}


?>