<?php
include '../models/CategoryModel.php';

class CategoryController{
    private $categoryModel;
    public function __construct(){
        $this->categoryModel = new Category();
    }
    public function createCategory($categoryName, $categoryDesc){

        $this->categoryModel->__set("categoryName",$categoryName);
        $this->categoryModel->__set("categoryDesc",$categoryDesc);

        if(!$this->emptyInput()){
            header('Location: ../public/admin/category.php?error=emptyInput');
            exit();
        }
        $this->categoryModel->createCategory($categoryName, $categoryDesc);
    }
    public function updateCategory($categoryName, $categoryDesc, $categoryId){
        $this->categoryModel->__set("categoryName",$categoryName);
        $this->categoryModel->__set("categoryDesc",$categoryDesc);
        $this->categoryModel->__set("categoryId",$categoryId);
        if(!$this->emptyInput()){
            header('Location: ../public/admin/category.php?error=emptyInput');
            exit();
        }
        $this->categoryModel->updateCategory($categoryName, $categoryDesc, $categoryId);
    }
    public function deleteCategory($categoryId){
        $this->categoryModel->__set("categoryId",$categoryId);
        $this->categoryModel->deleteCategory($categoryId);
    }
    public function emptyInput()
    {
        if (empty($this->categoryModel->__get("categoryName")) || empty($this->categoryModel->__get("categoryDesc"))) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

}