<?php

class User{

    public $Id;
    public $FirstName;
    public $LastName;
    public $Email;
    public $Role;
    public $Parent;
    public $Permissions;
    public $Password;
    public $CreatedDate;
    public $ModifiedDate;
    public $CreatedBy;
    public $ModifiedBy;

    function __construct($Id = '',$FirstName, $LastName, $Email, $Role, $Parent, $Permissions, $Password){
        $this->Id = $Id;
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->Email = $Email;
        $this->Role = $Role;
        $this->Parent = $Parent;
        $this->Permissions = $Permissions;
        $this->Password = $Password;
    }
    
}