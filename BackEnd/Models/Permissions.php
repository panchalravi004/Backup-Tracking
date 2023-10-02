<?php

class Permissions {

    public $Id;
    public $Title;
    public $User;
    public $FB_Create;
    public $FB_Update;
    public $FB_Read;
    public $FB_SoftDelete;
    public $FB_HardDelete;
    public $FT_Create;
    public $FT_Update;
    public $FT_Read;
    public $FT_SoftDelete;
    public $FT_HardDelete;
    public $CreatedDate;
    public $ModifiedDate;
    public $CreatedBy;
    public $ModifiedBy;

    function __construct($Id = '', $Title, $User, $FB_Create, $FB_Update, $FB_Read, $FB_SoftDelete, $FB_HardDelete, $FT_Create, $FT_Update, $FT_Read, $FT_SoftDelete, $FT_HardDelete) {
        $this->Id = $Id;
        $this->Title = $Title;
        $this->User = $User;
        $this->FB_Create = $FB_Create;
        $this->FB_Update = $FB_Update;
        $this->FB_Read = $FB_Read;
        $this->FB_SoftDelete = $FB_SoftDelete;
        $this->FB_HardDelete = $FB_HardDelete;
        $this->FT_Create = $FT_Create;
        $this->FT_Update = $FT_Update;
        $this->FT_Read = $FT_Read;
        $this->FT_SoftDelete = $FT_SoftDelete;
        $this->FT_HardDelete = $FT_HardDelete;

    }


}