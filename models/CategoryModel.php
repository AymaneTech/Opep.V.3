<?php

class Category
{
    private $categoryId;
    private $categoryName;
    private $categoryDesc;

    public function __construct(){

    }
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function createCategory($categoryName, $categoryDesc)
    {
        $this->categoryName = $categoryName;
        $this->categoryDesc = $categoryDesc;

        $stmt = Connection->prepare("INSERT INTO category (categoryName, categoryDesc) VALUES (:categoryName, :categoryDesc)");
        $stmt->bindParam(':categoryName', $this->categoryName);
        $stmt->bindParam(':categoryDesc', $this->categoryDesc);

        $stmt->execute();
    }

    public function updateCategory($categoryName, $categoryDesc, $categoryId)
    {
        $this->categoryName = $categoryName;
        $this->categoryDesc = $categoryDesc;
        $this->categoryId = $categoryId;

        $stmt = Connection->prepare("update category set categoryName = :categoryName, categoryDesc = :categoryDesc where categoryId = :id;");
        $stmt->bindParam(':categoryName', $this->categoryName);
        $stmt->bindParam(':categoryDesc', $this->categoryDesc);
        $stmt->bindParam(':id', $this->categoryId);
        $stmt->execute();
    }
    public function deleteCategory($categoryId)
    {
        $stmt = Connection->prepare("delete from category where categoryId = :id");
        $stmt->bindParam(":id", $categoryId);
        $stmt->execute();
    }
    public function showAllCategories()
    {
        $stmt = Connection->query("SELECT * FROM category  ;");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
