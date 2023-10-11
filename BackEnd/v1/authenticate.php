<?php

    include_once dirname(dirname(__FILE__)) .'/Utilities/DBConnection.php';
    include_once dirname(dirname(__FILE__)) .'/Controllers/AuthController.php';
    include_once dirname(dirname(__FILE__)) .'/Controllers/Response.php';

    $res;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        
        $conn = DBConnect::connect();
        $auth = new AuthController($conn);

        if(isset($_POST['Email'])  && isset($_POST['Password'])){


            $res = $auth->doLogin($_POST['Email'], $_POST['Password']);

            echo $res;


        }else{

            $res = new Response('Error','Please Enter Valid Data !');
    
            echo json_encode($res);
        }


    }else{

        $res = new Response('Error','Invalid Request !');

        echo json_encode($res);

    }


