<?php
include '../models/ThemeModel.php';

class ThemeController{
    private $themeModel;

    public function __construct(){
        $this->themeModel = new Theme();
    }
    public function __set($property, $value){
        if(property_exists($this, $property)) $this->$property = $value;
    }
    public function __get($property) {
        return $this->$property;
    }
    public function createTheme($themeName, $themeDesc, $themeImage){
        $this->themeModel->__set("themeName", $themeName);
        $this->themeModel->__set("themeDesc", $themeDesc);
        $this->themeModel->__set("themeImage", $themeImage);
        if(!$this->emptyInput()){
            header('Location: ../public/admin/theme.php?msg=empty input');
            exit();
        }
        $this->themeModel->createTheme();
    }
    public function updateTheme($themeId, $themeName, $themeDesc){
        $this->themeModel->__set("themeId", $themeId);
        $this->themeModel->__set("themeName", $themeName);
        $this->themeModel->__set("themeDesc", $themeDesc);

        if(!$this->emptyInput()){ header('Location: ../public/admin/theme.php?error=emptyInput'); exit();}
        $this->themeModel->updateTheme($themeId, $themeName, $themeDesc);
    }
    public function deleteTheme($themeId){
        $this->themeModel->__set("themeId", $themeId);
        $this->themeModel->deleteTheme($themeId);
    }
    public function emptyInput()
    {
        if (empty($this->themeModel->__get("themeName")) || empty($this->themeModel->__get("themeDesc"))) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}