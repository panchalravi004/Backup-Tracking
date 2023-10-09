<?php

include_once dirname(dirname(__FILE__)) .'/Controllers/Response.php';
include_once dirname(dirname(__FILE__)) .'/Models/User.php';
include_once dirname(dirname(__FILE__)) .'/Logs/Logger.php';

class UserController{

    private $conn;
    private $logger;

    public function __construct($conn) {
        
        $this->conn = $conn;
        
        $this->logger = new Logger('UserController');

        date_default_timezone_set("Asia/Kolkata");
    }


    public function createUser($user){

        try {
        

            $date = new DateTime();
            $date = $date->format("y:m:d h:i:s");
    
            $query = "INSERT INTO `USER` (FirstName, LastName, Email, Role, Parent, Permissions, Password, CreatedDate, ModifiedDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $statement = $this->conn->prepare($query);
            $statement->bind_param("sssiiisss", $user->FirstName, $user->LastName, $user->Email, $user->Role, $user->Parent, $user->Permissions, $user->Password, $date, $date);
            
            if($statement->execute()){
                
                $res = new Response('Success','Record Inserted successfully');

                return json_encode($res);
                
            }else{

                $res = new Response('Error','Failed to insert record');

                $this->logger->msg('createUser','Error','Failed to insert record');

                return json_encode($res);
            }
            
            
        } catch (Exception $e) {

            $res = new Response('Error',$e->getMessage());

            $this->logger->msg('createUser','Error',$e->getMessage());

            return json_encode($res);
        }

    }


    public function getUserList($parentId){

        try {
    
            $query = "SELECT * FROM `USER` WHERE Parent = ? ";

            $statement = $this->conn->prepare($query);
            $statement->bind_param("i",$parentId);
            $statement->execute();
            // echo $statement->num_rows();
            $result = $statement->get_result();
            $row = $result->fetch_all(MYSQLI_ASSOC);

            if(count($row)){

                $res = new Response('Success','Record Fetch Successfully !', $row);

                $this->logger->msg('getUserList','Success','Record Fetch Successfully !');
                
                return json_encode($res);
            }else{
                
                $res = new Response('Warning','No Record Found !', $row);

                $this->logger->msg('getUserList','Warning','No Record Found !');

                return json_encode($res);
            }


        } catch (Exception $e) {

            $res = new Response('Error',$e->getMessage());

            $this->logger->msg('getUserList','Error',$e->getMessage());

            return json_encode($res);
            
        }
        
    }

    public function getUserById($Id){

        try {
    
            $query = "SELECT * FROM `USER` WHERE Id = ? ";

            $statement = $this->conn->prepare($query);
            $statement->bind_param("i",$Id);
            
            $statement->execute();

            $result = $statement->get_result();
            $row = $result->fetch_all(MYSQLI_ASSOC);


            if(count($row)){

                $res = new Response('Success','Record Fetch Successfully !', $row);
                return json_encode($res);

            }else{
                
                $res = new Response('Warning','No Record Found !', $row);
                return json_encode($res);
            }


        } catch (Exception $e) {

            $res = new Response('Error',$e->getMessage());

            $this->logger->msg('getUserById','Error',$e->getMessage());

            return json_encode($res);
            
        }

    }
    
    public function authenticateUser($email, $pass){

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

            $this->logger->msg('authenticateUser','Error',$e->getMessage());

            return json_encode($res);
            
        }

    }
    
    public function updateUser($user){

        try {

            $date = new DateTime();
            $date = $date->format("y:m:d h:i:s");
    
            $query = "UPDATE `USER` SET FirstName= ?, LastName= ?, Email= ?, Role= ?, Parent= ?, Permissions= ?, Password= ?, ModifiedDate = ? WHERE Id= ?";

            $statement = $this->conn->prepare($query);

            $statement->bind_param("sssiiissi",$user->FirstName, $user->LastName, $user->Email, $user->Role, $user->Parent, $user->Permissions, $user->Password, $date, $user->Id);
            
            if($statement->execute()){

                $res = new Response('Success','Record Updated Successfully !');
                return json_encode($res);
                

            }else{
                
                $res = new Response('Warning','Please Enter Valid User Id !');
                return json_encode($res);
            }


        } catch (Exception $e) {

            $res = new Response('Error',$e->getMessage());

            $this->logger->msg('updateUser','Error',$e->getMessage());

            return json_encode($res);
            
        }

    }
    
    public function deleteUser($Id){

        try {

            $query = "DELETE FROM `USER` WHERE Id= ?";

            $statement = $this->conn->prepare($query);

            $statement->bind_param("i", $Id);
            
            if($statement->execute()){

                $res = new Response('Success','Record Deleted Successfully !');
                return json_encode($res);
                

            }else{
                
                $res = new Response('Warning','Faild To Delete Record !');
                return json_encode($res);
            }


        } catch (Exception $e) {

            $res = new Response('Error',$e->getMessage());

            $this->logger->msg('deleteUser','Error',$e->getMessage());

            return json_encode($res);
            
        }
    }    

}

// $u = new UserController();
// echo $u->getUserList(0);