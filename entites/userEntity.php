<?php


class userEntity {
    public $Name;
    public $Username;
    public $Email;
    public $Password;
    public $Admin;
    
    function __construct($Name,$Username,$Email,$Password, $Admin ) {
        $this->Name = $Name;
        $this->Username=$Username;
        $this->Email = $Email;
        $this->Password = $Password;
        $this->Admin = $Admin;
    }
    
}
