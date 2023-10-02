<?php

class BackupCategory {

    public $Id;
    public $Name;
    public $User;
    public $CreatedDate;
    public $ModifiedDate;
    public $CreatedBy;
    public $ModifiedBy;

    function __construct($Id = '', $Name, $User) {
        $this->Id = $Id;
        $this->Name = $Name;
        $this->User = $User;

    }


}