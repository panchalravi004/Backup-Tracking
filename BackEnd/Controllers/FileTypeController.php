<?php

include_once dirname(dirname(__FILE__)) .'/Controllers/Response.php';
include_once dirname(dirname(__FILE__)) .'/Models/FileType.php';
include_once dirname(dirname(__FILE__)) .'/Logs/Logger.php';

class FileTypeController{

    private $conn;
    private $logger;

    public function __construct($conn) {
        
        $this->conn = $conn;
        
        $this->logger = new Logger('FileTypeController');

        date_default_timezone_set("Asia/Kolkata");
    }


    public function createFileType($fileType, $user){

        try {
        

            $date = new DateTime();
            $date = $date->format("y:m:d h:i:s");
    
            $query = "INSERT INTO `FILE_TYPE` (Name, User, CreatedDate, ModifiedDate, CreatedBy, ModifiedBy) VALUES (?, ?, ?, ?, ?, ?)";
            
            $statement = $this->conn->prepare($query);
            $statement->bind_param("sissii", $fileType->Name, $fileType->User, $date, $date, $user, $user);
            
            if($statement->execute()){
                
                $res = new Response('Success','Record Inserted successfully');

                return json_encode($res);
                
            }else{

                $res = new Response('Error','Failed to insert record');

                $this->logger->msg('createFileType','Error','Failed to insert record');

                return json_encode($res);
            }
            
            
        } catch (Exception $e) {

            $res = new Response('Error',$e->getMessage());

            $this->logger->msg('createFileType','Error',$e->getMessage());

            return json_encode($res);
        }

    }


    public function getFileTypeList($userId){

        try {
    
            $query = "SELECT * FROM `FILE_TYPE` WHERE User = ? ";

            $statement = $this->conn->prepare($query);
            $statement->bind_param("i",$userId);
            $statement->execute();
            // echo $statement->num_rows();
            $result = $statement->get_result();
            $row = $result->fetch_all(MYSQLI_ASSOC);

            if(count($row)){

                $res = new Response('Success','Record Fetch Successfully !', $row);

                $this->logger->msg('getFileTypeList','Success','Record Fetch Successfully !');
                
                return json_encode($res);
            }else{
                
                $res = new Response('Warning','No Record Found !', $row);

                $this->logger->msg('getFileTypeList','Warning','No Record Found !');

                return json_encode($res);
            }


        } catch (Exception $e) {

            $res = new Response('Error',$e->getMessage());

            $this->logger->msg('getFileTypeList','Error',$e->getMessage());

            return json_encode($res);
            
        }
        
    }

    public function getFileTypeById($Id){

        try {
    
            $query = "SELECT * FROM `FILE_TYPE` WHERE Id = ? ";

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

            $this->logger->msg('getFileTypeById','Error',$e->getMessage());

            return json_encode($res);
            
        }

    }
    
    public function updateFileType($fileType, $user){

        try {

            $date = new DateTime();
            $date = $date->format("y:m:d h:i:s");
    
            $query = "UPDATE `FILE_TYPE` SET Name= ?, User= ?, ModifiedDate = ?, ModifiedBy = ? WHERE Id= ?";

            $statement = $this->conn->prepare($query);

            $statement->bind_param("sisii",$fileType->Name, $fileType->User, $date, $user, $fileType->Id);
            
            if($statement->execute()){

                $res = new Response('Success','Record Updated Successfully !');
                return json_encode($res);
                

            }else{
                
                $res = new Response('Warning','Please Enter Valid User Id !');
                return json_encode($res);
            }


        } catch (Exception $e) {

            $res = new Response('Error',$e->getMessage());

            $this->logger->msg('updateFileType','Error',$e->getMessage());

            return json_encode($res);
            
        }

    }
    
    public function deleteFileType($Id){

        try {

            $query = "DELETE FROM `FILE_TYPE` WHERE Id= ?";

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

            $this->logger->msg('deleteFileType','Error',$e->getMessage());

            return json_encode($res);
            
        }
    }    

}


// $u = new FileTypeController();
// echo $u->createFileType(4);