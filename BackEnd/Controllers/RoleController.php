<?php

include_once dirname(dirname(__FILE__)) .'../Utilities/DBConnection.php';
include_once dirname(dirname(__FILE__)) .'/Controllers/Response.php';
include_once dirname(dirname(__FILE__)) .'/Models/Role.php';
include_once dirname(dirname(__FILE__)) .'/Logs/Logger.php';

class RoleController{

    private $conn;
    private $logger;

    public function __construct() {
        
        $db = new DBConnect();
        $this->conn = $db->connect();
        
        $this->logger = new Logger('RoleController');

        date_default_timezone_set("Asia/Kolkata");
    }


    public function createRole($role, $user){

        try {
        

            $date = new DateTime();
            $date = $date->format("y:m:d h:i:s");
    
            $query = "INSERT INTO `ROLE` (Name, User, CreatedDate, ModifiedDate, CreatedBy, ModifiedBy) VALUES (?, ?, ?, ?, ?, ?)";
            
            $statement = $this->conn->prepare($query);
            $statement->bind_param("sissii", $role->Name, $role->User, $date, $date, $user, $user);
            
            if($statement->execute()){
                
                $res = new Response('Success','Record Inserted successfully');

                return json_encode($res);
                
            }else{

                $res = new Response('Error','Failed to insert record');

                $this->logger->msg('createRole','Error','Failed to insert record');

                return json_encode($res);
            }
            
            
        } catch (Exception $e) {

            $res = new Response('Error',$e->getMessage());

            $this->logger->msg('createRole','Error',$e->getMessage());

            return json_encode($res);
        }

    }


    public function getRoleList($userId){

        try {
    
            $query = "SELECT * FROM `ROLE` WHERE User = ? ";

            $statement = $this->conn->prepare($query);
            $statement->bind_param("i",$userId);
            $statement->execute();
            // echo $statement->num_rows();
            $result = $statement->get_result();
            $row = $result->fetch_all(MYSQLI_ASSOC);

            if(count($row)){

                $res = new Response('Success','Record Fetch Successfully !', $row);

                $this->logger->msg('getRoleList','Success','Record Fetch Successfully !');
                
                return json_encode($res);
            }else{
                
                $res = new Response('Warning','No Record Found !', $row);

                $this->logger->msg('getRoleList','Warning','No Record Found !');

                return json_encode($res);
            }


        } catch (Exception $e) {

            $res = new Response('Error',$e->getMessage());

            $this->logger->msg('getRoleList','Error',$e->getMessage());

            return json_encode($res);
            
        }
        
    }

    public function getRoleById($Id){

        try {
    
            $query = "SELECT * FROM `ROLE` WHERE Id = ? ";

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

            $this->logger->msg('getRoleById','Error',$e->getMessage());

            return json_encode($res);
            
        }

    }
    
    public function updateRole($role, $user){

        try {

            $date = new DateTime();
            $date = $date->format("y:m:d h:i:s");
    
            $query = "UPDATE `ROLE` SET Name= ?, User= ?, ModifiedDate = ?, ModifiedBy = ? WHERE Id= ?";

            $statement = $this->conn->prepare($query);

            $statement->bind_param("sisii",$role->Name, $role->User, $date, $user, $role->Id);
            
            if($statement->execute()){

                $res = new Response('Success','Record Updated Successfully !');
                return json_encode($res);
                

            }else{
                
                $res = new Response('Warning','Please Enter Valid User Id !');
                return json_encode($res);
            }


        } catch (Exception $e) {

            $res = new Response('Error',$e->getMessage());

            $this->logger->msg('updateRole','Error',$e->getMessage());

            return json_encode($res);
            
        }

    }
    
    public function deleteRole($Id){

        try {

            $query = "DELETE FROM `ROLE` WHERE Id= ?";

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

            $this->logger->msg('deleteRole','Error',$e->getMessage());

            return json_encode($res);
            
        }
    }    

}


// $u = new RoleController();
// echo $u->getRoleById(4);