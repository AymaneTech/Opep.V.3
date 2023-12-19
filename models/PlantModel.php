<?php

class Plant
{
    private $plantId;
    private $plantName;
    private $plantDesc;
    private $plantPrice;
    private $plantImage;
    private $categoryFk;

    public function __construct()
    {
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) $this->$property = $value;
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) return $this->$property;
    }

    public function createPlant()
    {
        $stmt = Connection->prepare("INSERT INTO plant (plantName, plantDesc, plantPrice, plantImage, categoryId) VALUES (:plantName, :plantDesc, :plantPrice, :plantImage, :categoryFk)");
        $stmt->bindParam(':plantName', $this->plantName);
        $stmt->bindParam(':plantDesc', $this->plantDesc);
        $stmt->bindParam(':plantPrice', $this->plantPrice);
        $stmt->bindParam(':plantImage', $this->plantImage);
        $stmt->bindParam(':categoryFk', $this->categoryFk);

        $stmt->execute();
    }

    public function updatePlant($plantId, $plantName, $plantDesc, $plantPrice)
    {
        $this->plantId = $plantId;
        $this->plantName = $plantName;
        $this->plantDesc = $plantDesc;
        $this->plantPrice = $plantPrice;
//        $this->plantImage = $plantImage;

        $stmt = Connection->prepare("update plant set plantName = :plantName, plantDesc = :plantDesc, plantPrice = :plantPrice where plantId = :plantId;");
        $stmt->bindParam(':plantId', $this->plantId);
        $stmt->bindParam(':plantName', $this->plantName);
        $stmt->bindParam(':plantDesc', $this->plantDesc);
        $stmt->bindParam(':plantPrice', $this->plantPrice);
//        $stmt->bindParam(':plantImage', $this->plantImage);
        $stmt->execute();
    }

    public function deletePlant($plantId)
    {
        $stmt = Connection->prepare("delete from plant where plantId = :plantId");
        $stmt->bindParam(":plantId", $plantId);
        $stmt->execute();
    }

    public function showAllPlant()
    {
        $stmt = Connection->query("SELECT * FROM plant  ;");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function showByCategory($categoryId)
    {
        $stmt = Connection->prepare("SELECT * FROM plant where categoryId = :categoryId");
        $stmt->bindParam(':categoryId', $categoryId);
        $stmt->execute();
//        print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function searchByName($value)
    {
        $stmt = Connection->prepare("SELECT * FROM plant where plantName like :value");
        $valueWithWildcards = '%' . $value . '%';
        $stmt->bindParam(':value', $valueWithWildcards);;
        $stmt->execute();
        return $stmt->fetchALl(PDO::FETCH_ASSOC);
    }
}
