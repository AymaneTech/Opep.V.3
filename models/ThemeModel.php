<?php

class Theme
{
    private $themeId;
    private $themeName;
    private $themeDesc;
    private $themeImage;

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) $this->$property = $value;
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) return $this->$property;
    }

    public function createTheme()
    {
        $stmt = Connection->prepare("INSERT INTO theme (themeName, themeDesc, themeImage) VALUES (:themeName, :themeDesc, :themeImage);");
        $stmt->bindParam(':themeName', $this->themeName);
        $stmt->bindParam(':themeDesc', $this->themeDesc);
        $stmt->bindParam(':themeImage', $this->themeImage);

        $stmt->execute();
    }

    public function updateTheme()
    {
        $stmt = Connection->prepare("update theme set themeName = :themeName, themeDesc = :themeDesc, themeImage = :themeImage where themeId = :themeId;");
        $stmt->bindParam(':themeId', $this->themeId);
        $stmt->bindParam(':themeName', $this->themeName);
        $stmt->bindParam(':themeDesc', $this->themeDesc);
        $stmt->bindParam(':themeImage', $this->themeImage);
        $stmt->execute();
    }
    public function deleteTheme($themeId)
    {
        $stmt = Connection->prepare("delete from theme where themeId = :themeId");
        $stmt->bindParam(":themeId", $themeId);
        $stmt->execute();
    }
    public function showAllThemes()
    {
        $stmt = Connection->query("SELECT * FROM theme;");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
