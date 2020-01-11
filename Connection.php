<?php

class Connection{
    private $host = "localhost";
    private $username = "wp_eatery";
    private $password = "password";
    private $database = "wp_eatery";
    private $link;

    public function __construct(){
        $this->link = new mysqli($this->host, $this->username, $this->password, $this->database);
    
        if ($this->link->error){
            die($this->link->error);
        }
    }

    public function getLink(){
        return $this->link;
    }

    public function execute($query)
    {
        return $this->link->query($query);
    }

}

    

