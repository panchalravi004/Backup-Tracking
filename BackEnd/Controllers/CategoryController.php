<?php

include_once dirname(dirname(__FILE__)) .'/Controllers/Response.php';
include_once dirname(dirname(__FILE__)) .'/Models/BackupCategory.php';
include_once dirname(dirname(__FILE__)) .'/Logs/Logger.php';

class CategoryController{

    private $conn;
    private $logger;

    public function __construct($conn) {
        
        $this->conn = $conn;
        
        $this->logger = new Logger('CategoryController');

        date_default_timezone_set("Asia/Kolkata");
    }


    public function createCategory($category, $user){

        try {
        

            $date = new DateTime();
            $date = $date->format("y:m:d h:i:s");
    
            $query = "INSERT INTO `BACKUP_CATEGORY` (Name, User, CreatedDate, ModifiedDate, CreatedBy, ModifiedBy) VALUES (?, ?, ?, ?, ?, ?)";
            
            $statement = $this->conn->prepare($query);
            $statement->bind_param("sissii", $category->Name, $category->User, $date, $date, $user, $user);
            
            if($statement->execute()){
                
                $res = new Response('Success','Record Inserted successfully');

                return json_encode($res);
                
            }else{

                $res = new Response('Error','Failed to insert record');

                $this->logger->msg('createCategory','Error','Failed to insert record');

                return json_encode($res);
            }
            
            
        } catch (Exception $e) {

            $res = new Response('Error',$e->getMessage());

            $this->logger->msg('createCategory','Error',$e->getMessage());

            return json_encode($res);
        }

    }


    public function getCategoryList($userId){

        try {
    
            $query = "SELECT * FROM `BACKUP_CATEGORY` WHERE User = ? ";

            $statement = $this->conn->prepare($query);
            $statement->bind_param("i",$userId);
            $statement->execute();
            // echo $statement->num_rows();
            $result = $statement->get_result();
            $row = $result->fetch_all(MYSQLI_ASSOC);

            if(count($row)){

                $res = new Response('Success','Record Fetch Successfully !', $row);

                $this->logger->msg('getCategoryList','Success','Record Fetch Successfully !');
                
                return json_encode($res);
            }else{
                
                $res = new Response('Warning','No Record Found !', $row);

                $this->logger->msg('getCategoryList','Warning','No Record Found !');

                return json_encode($res);
            }


        } catch (Exception $e) {

            $res = new Response('Error',$e->getMessage());

            $this->logger->msg('getCategoryList','Error',$e->getMessage());

            return json_encode($res);
            
        }
        
    }

    public function getCategoryById($Id){

        try {
    
            $query = "SELECT * FROM `BACKUP_CATEGORY` WHERE Id = ? ";

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

            $this->logger->msg('getCategoryById','Error',$e->getMessage());

            return json_encode($res);
            
        }

    }
    
    public function updateCategory($category, $user){

        try {

            $date = new DateTime();
            $date = $date->format("y:m:d h:i:s");
    
            $query = "UPDATE `BACKUP_CATEGORY` SET Name= ?, User= ?, ModifiedDate = ?, ModifiedBy = ? WHERE Id= ?";

            $statement = $this->conn->prepare($query);

            $statement->bind_param("sisii",$category->Name, $category->User, $date, $user, $category->Id);
            
            if($statement->execute()){

                $res = new Response('Success','Record Updated Successfully !');
                return json_encode($res);
                

            }else{
                
                $res = new Response('Warning','Please Enter Valid User Id !');
                return json_encode($res);
            }


        } catch (Exception $e) {

            $res = new Response('Error',$e->getMessage());

            $this->logger->msg('updateCategory','Error',$e->getMessage());

            return json_encode($res);
            
        }

    }
    
    public function deleteCategory($Id){

        try {

            $query = "DELETE FROM `BACKUP_CATEGORY` WHERE Id= ?";

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

            $this->logger->msg('deleteCategory','Error',$e->getMessage());

            return json_encode($res);
            
        }
    }    

}


// $u = new CategoryController();
// echo $u->createCategory(4);