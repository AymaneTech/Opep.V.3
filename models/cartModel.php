<?php
class cart {
    private $cartId;
    private $userId;
    public function __construct(){

    }
    public function createCart($userId){
        $stmt = Connection->prepare("INSERT INTO cart (userId) values (:userId)");
        $stmt->bindParam(':userId',$userId);
        $stmt->execute();
    }
    public function retrieveUserCart($userId){
        $stmt = Connection->prepare("SELECT cartId FROM cart where userId = :userId;");
        $stmt->bindParam(':userId',$userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}