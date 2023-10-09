<?php

include_once dirname(dirname(__FILE__)) .'/Controllers/Response.php';
include_once dirname(dirname(__FILE__)) .'/Models/Permissions.php';
include_once dirname(dirname(__FILE__)) .'/Logs/Logger.php';

class PermissionsController{

    private $conn;
    private $logger;

    public function __construct($conn) {
        
        $this->conn = $conn;
        
        $this->logger = new Logger('PermissionsController');

        date_default_timezone_set("Asia/Kolkata");
    }


    public function createPermission($permissions, $user){

        try {
        

            $date = new DateTime();
            $date = $date->format("y:m:d h:i:s");
    
            $query = "INSERT INTO `PERMISSIONS` (
            Title,
            User,
            FB_Create,
            FB_Update,
            FB_Read,
            FB_SoftDelete,
            FB_HardDelete,
            FT_Create,
            FT_Update,
            FT_Read,
            FT_SoftDelete,
            FT_HardDelete,
            CreatedDate,
            ModifiedDate,
            CreatedBy,
            ModifiedBy) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $statement = $this->conn->prepare($query);
            $statement->bind_param("siiiiiiiiiiissii",
                $permissions->Title,
                $permissions->User,
                $permissions->FB_Create,
                $permissions->FB_Update,
                $permissions->FB_Read,
                $permissions->FB_SoftDelete,
                $permissions->FB_HardDelete,
                $permissions->FT_Create,
                $permissions->FT_Update,
                $permissions->FT_Read,
                $permissions->FT_SoftDelete,
                $permissions->FT_HardDelete,
                $date,
                $date,
                $user,
                $user);
            
            if($statement->execute()){
                
                $res = new Response('Success','Record Inserted successfully');

                return json_encode($res);
                
            }else{

                $res = new Response('Error','Failed to insert record');

                $this->logger->msg('createPermission','Error','Failed to insert record');

                return json_encode($res);
            }
            
            
        } catch (Exception $e) {

            $res = new Response('Error',$e->getMessage());

            $this->logger->msg('createPermission','Error',$e->getMessage());

            return json_encode($res);
        }

    }


    public function getPermissionsList($userId){

        try {
    
            $query = "SELECT * FROM `PERMISSIONS` WHERE User = ? ";

            $statement = $this->conn->prepare($query);
            $statement->bind_param("i",$userId);
            $statement->execute();
            // echo $statement->num_rows();
            $result = $statement->get_result();
            $row = $result->fetch_all(MYSQLI_ASSOC);

            if(count($row)){

                $res = new Response('Success','Record Fetch Successfully !', $row);

                $this->logger->msg('getPermissionsList','Success','Record Fetch Successfully !');
                
                return json_encode($res);
            }else{
                
                $res = new Response('Warning','No Record Found !', $row);

                $this->logger->msg('getPermissionsList','Warning','No Record Found !');

                return json_encode($res);
            }


        } catch (Exception $e) {

            $res = new Response('Error',$e->getMessage());

            $this->logger->msg('getPermissionsList','Error',$e->getMessage());

            return json_encode($res);
            
        }
        
    }

    public function getPermissionsById($Id){

        try {
    
            $query = "SELECT * FROM `PERMISSIONS` WHERE Id = ? ";

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

            $this->logger->msg('getPermissionsById','Error',$e->getMessage());

            return json_encode($res);
            
        }

    }
    
    public function updatePermissions($permissions, $user){

        try {

            $date = new DateTime();
            $date = $date->format("y:m:d h:i:s");
    
            $query = "UPDATE `PERMISSIONS` SET 
            Title = ?,
            User = ?,
            FB_Create = ?,
            FB_Update = ?,
            FB_Read = ?,
            FB_SoftDelete = ?,
            FB_HardDelete = ?,
            FT_Create = ?,
            FT_Update = ?,
            FT_Read = ?,
            FT_SoftDelete = ?,
            FT_HardDelete = ?, 
            ModifiedDate = ?, 
            ModifiedBy = ? 
            WHERE Id= ?";

            $statement = $this->conn->prepare($query);

            $statement->bind_param("siiiiiiiiiiisii",
            $permissions->Title,
            $permissions->User,
            $permissions->FB_Create,
            $permissions->FB_Update,
            $permissions->FB_Read,
            $permissions->FB_SoftDelete,
            $permissions->FB_HardDelete,
            $permissions->FT_Create,
            $permissions->FT_Update,
            $permissions->FT_Read,
            $permissions->FT_SoftDelete,
            $permissions->FT_HardDelete,
            $date, 
            $user, 
            $permissions->Id);
            
            if($statement->execute()){

                $res = new Response('Success','Record Updated Successfully !');
                return json_encode($res);
                

            }else{
                
                $res = new Response('Warning','Please Enter Valid User Id !');
                return json_encode($res);
            }


        } catch (Exception $e) {

            $res = new Response('Error',$e->getMessage());

            $this->logger->msg('updatePermissions','Error',$e->getMessage());

            return json_encode($res);
            
        }

    }
    
    public function deletePermissions($Id){

        try {

            $query = "DELETE FROM `PERMISSIONS` WHERE Id= ?";

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

            $this->logger->msg('deletePermissions','Error',$e->getMessage());

            return json_encode($res);
            
        }
    }    

}


// $u = new PermissionsController();
// echo $u->getPermissionsById(4);