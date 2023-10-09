<?php

    include_once dirname(dirname(__FILE__)) .'/Utilities/DBConnection.php';
    include_once dirname(dirname(__FILE__)) .'/Controllers/UserController.php';
    include_once dirname(dirname(__FILE__)) .'/Controllers/Response.php';
    include_once dirname(dirname(__FILE__)) .'/Models/User.php';

    $res;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        
        $conn = DBConnect::connect();
        $userController = new UserController($conn);

        if(isset($_POST['FirstName'])  
        && isset($_POST['LastName'])  
        && isset($_POST['Email'])  
        && isset($_POST['Password'])  
        && isset($_POST['Role'])
        && isset($_POST['Parent'])
        && isset($_POST['Permissions'])){

            $user = new User(
                '',
                $_POST['FirstName'],
                $_POST['LastName'],
                $_POST['Email'],
                $_POST['Role'],
                $_POST['Parent'],
                $_POST['Permissions'],
                $_POST['Password']
            );

            $res = $userController->createUser($user);

            echo $res;


        }else{

            $res = new Response('Error','Please Enter Valid Data !');
    
            echo json_encode($res);
        }


    }else{

        $res = new Response('Error','Invalid Request !');

        echo json_encode($res);

    }


