<?php

class cartPivot
{
    private $cartId;
    private $plantId;

    public function __construct()
    {

    }

    public function insertIntoCart($plantId, $cartId)
    {
        try {
            $stmt = Connection->prepare("INSERT INTO cartplant (cartFk, plantFk) VALUES (:cartId, :plantId)");
            $stmt->bindParam(':cartId', $cartId);
            $stmt->bindParam(':plantId', $plantId);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Shiiiiiit " . $e->getMessage());
        }
    }

    public function retrieveCartPlants($userId)
    {
        $stmt = Connection->prepare("SELECT * FROM cart, plant, cartPlant
                                    WHERE cartPlant.cartFk = cart.cartId
                                      AND cartPlant.plantFk = plant.plantid
                                        AND cart.userId = :userId;");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function totalPrice($userId)
    {
        $stmt = Connection->prepare("SELECT sum(plantPrice) as total FROM cart, plant, cartPlant
                                    WHERE cartPlant.cartFk = cart.cartId
                                      AND cartPlant.plantFk = plant.plantid
                                        AND cart.userId = :userId;");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function deleteFromCart($pivotId){
        $stmt = Connection->prepare("DELETE FROM cartPlant where pivotId = :pivotId");
        $stmt->bindParam(':pivotId', $pivotId);
        $stmt->execute();
    }
}

