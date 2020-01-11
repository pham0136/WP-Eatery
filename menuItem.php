<?php

class menuItem {
    private $itemName;
    private $description;
    private $price;

    public function __construct($itemName,$description, $price){
        $this->itemName = $itemName;
        $this->description = $description;
        $this->price = $price;
    }

    public function setItemName($itemName){
        $this->itemName = $itemName;
    }

    public function getItemName(){
        return $this->itemName;
    }
    public function setDescription($description){
        $this->description = $description;
    }

    public function getDescription(){
        return $this->description;
    }
    public function setPrice($price){
        $this->itemName = $price;
    }

    public function getPrice(){
        return $this->price;
    }
}



?>