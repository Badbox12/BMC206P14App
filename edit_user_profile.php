<?php 
    include('functions.php');
    $result = array("success" => 0, "errors" => 0);
    if(isset($_POST['FullNameUpdate']) && isset($_POST['UserNameUpdate'])){
        $id = $_POST['UserIdUpdate'];
        $fullname = $_POST['FullNameUpdate'];
        $username = $_POST['UserNameUpdate'];
        $email = $_POST['EmailUpdate'];
        $image = $_POST['ImageUpdate'];
        $image_name = $username.".jpg";
        if($image == "NoChange"){
            $fields = array("UserName", "FullName", "UserEmail");

            $values = array($username, $fullname, $email);  
        }else{
        $fields = array("UserName", "FullName", "UserEmail", "UserImage");

        $values = array($username, $fullname, $email, $image_name);
        }
        // create an objecet of class functions
        $func = new functions();
        // call the method show_data_by_condition()
        $old_name = $func->show_data_by_condition('tblusers','UserID',$id);
        // call the method update_data()
        $update = $func->update_data('tblusers', $fields, $values,'UserID',$id);
            if($update == true){
                if($image != "NoChange"){
                    if($old_name['UserImage'] != 'default.png'){
               
                    if(file_exists("images".$old_name['UserImage'])){
                        unlink("images".$old_name['UserImage']);
                    }
                }
                    file_put_contents("images/".$image_name, base64_decode($image));
                    $result['UserImageUpdate']=$image;
                }
            
            $result["success"] = 1;
            $result['msg_success'] = "Update user info successfully !!";
            $result['UserNameUpdate']=$username;
            $result['FullNameUpdate']=$fullname;
            $result['UserEmailUpdate']=$email;
            
            print json_encode($result);
            }else{
                $result["errors"] = 2;
                $result['msg_errors'] = "Faild to update user info";
                print json_encode($result);
            }

    }else {
        $result["errors"] = 1;
        $result['msg_errors'] = "Access denied...";
        print json_encode($result);
    }

?>