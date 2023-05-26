<?php

require_once("base.php");

class Categories extends Base
{
    public function getCategories()
    {
        $query = $this->db->prepare("SELECT * FROM categories");
        $query->execute();
        return $query->fetchAll();
    }




}