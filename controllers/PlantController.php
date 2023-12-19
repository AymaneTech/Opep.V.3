<?php
include '../models/PlantModel.php';

class PlantController{
    private $plantModel;

    public function __construct(){
        $this->plantModel = new Plant();
    }
    public function __set($property, $value){
        if(property_exists($this, $property)) $this->$property = $value;
    }
    public function __get($property) {
        return $this->$property;
    }
    public function createPlant($plantName, $plantDesc, $plantPrice, $plantImage, $categoryFk){
        $this->plantModel->__set("plantName", $plantName);
        $this->plantModel->__set("plantDesc", $plantDesc);
        $this->plantModel->__set("plantPrice", $plantPrice);
        $this->plantModel->__set("plantImage", $plantImage);
        $this->plantModel->__set("categoryFk", $categoryFk);

        if(!$this->emptyInput()){
            header('Location: ../public/admin/plant.php?msg=empty');
            exit();
        }
        $this->plantModel->createPlant();
    }
    public function updatePlant($plantId, $plantName, $plantDesc, $plantPrice){
        $this->plantModel->__set("plantId", $plantId);
        $this->plantModel->__set("plantName", $plantName);
        $this->plantModel->__set("plantDesc", $plantDesc);
        $this->plantModel->__set("plantPrice", $plantPrice);

        if(!$this->emptyInput()){ header('Location: ../public/admin/category.php?error=emptyInput'); exit();}
        $this->plantModel->updatePlant($plantId, $plantName, $plantDesc, $plantPrice);
    }
    public function deletePlant($plantId){
        $this->plantModel->__set("plantId", $plantId);
        $this->plantModel->deletePlant($plantId);
    }
    public function emptyInput()
    {
        if (empty($this->plantModel->__get("plantName")) || empty($this->plantModel->__get("plantDesc")) || empty($this->plantModel->__get("plantPrice")) || empty($this->plantModel->__get("plantImage")) || empty($this->plantModel->__get("categoryFk"))) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

}