<?php

class Order {
    private $pivotFk;
    private $totalPrice;
    public function __construct (){

    }
    public function __set($property, $value){
        $this->$property = $value;
    }
    public function __get($property){
        return $this->$property;
    }
    public function makeOrder(){
        $stmt = Connection->prepare("INSERT INTO orders (pivotFk, totalPrice) values (:pivotFk, :totalPrice)");
        $stmt->bindParam(':pivotFk', $this->pivotFk);
        $stmt->bindParam(':totalPrice', $this->totalPrice);
        $stmt->execute();
    }

}