<?php

include_once dirname(dirname(__FILE__)) .'/Controllers/Response.php';
include_once dirname(dirname(__FILE__)) .'/Models/User.php';
include_once dirname(dirname(__FILE__)) .'/Logs/Logger.php';

class AuthController{

    private $conn;
    private $logger;

    public function __construct($conn) {

        $this->conn = $conn;
        
        $this->logger = new Logger('AuthController');

        date_default_timezone_set("Asia/Kolkata");
    }

    public function doLogin($email, $pass){

        try {
    
            $query = "SELECT Id, Email, Password FROM `USER` WHERE Email = ? ";

            $statement = $this->conn->prepare($query);
            $statement->bind_param("s",$email);
            
            $statement->execute();

            $result = $statement->get_result();
            $row = $result->fetch_array(MYSQLI_ASSOC);

            if($row){

                if($row['Password'] == $pass){

                    $res = new Response('Success','Authentication Successfully !', $row);
                    return json_encode($res);

                }else{

                    $res = new Response('Warning','Please Enter Valid Password !');
                    return json_encode($res);
                }


            }else{
                
                $res = new Response('Warning','Please Enter Valid Email Address !');
                return json_encode($res);
            }


        } catch (Exception $e) {

            $res = new Response('Error',$e->getMessage());

            $this->logger->msg('doLogin','Error',$e->getMessage());

            return json_encode($res);
            
        }

    }

    public static function doLogout(){

        AuthController::deleteSession();

    }

    public static function createSession($var, $val){
    
        if(session_status() == PHP_SESSION_ACTIVE){

            $_SESSION[$var] = $val;

            $res = new Response('Success','Session Created Successfully !', $_SESSION[$var]);
            return json_encode($res);
            
        }else{
            
            $res = new Response('Warning','No Session Started !');
            return json_encode($res);

        }        

    }

    public static function deleteSession(){

        session_unset();
        session_destroy();

    }

    public static function getSession($var){
        if(session_status() == PHP_SESSION_ACTIVE){

            if(isset($_SESSION[$var])){

                $res = new Response('Success','Session Get Successfully !', $_SESSION[$var]);
                return json_encode($res);
                
            }else{
                $res = new Response('Warning','No '.$var.' Found In Session !', $_SESSION[$var]);
                return json_encode($res);
                
            }
        }else{
            
            $res = new Response('Warning','No Session Started !');
            return json_encode($res);
        }

        

    }

}