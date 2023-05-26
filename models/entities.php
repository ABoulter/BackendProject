<?php

require_once("base.php");

class Entities extends Base
{



    public function getEntities($categoryId)
    {

        $query = $this->db->prepare("SELECT * FROM entities WHERE categoryId = ? LIMIT 25");
        $query->execute([$categoryId]);
        return $query->fetchAll();
    }


    public function getRandomEntity()
    {
        $query = $this->db->prepare("SELECT * FROM entities ORDER BY RAND() LIMIT 1");
        $query->execute();
        return $query->fetch();
    }

    public function getEntityById($id)
    {
        $query = $this->db->prepare("SELECT * FROM entities WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch();
    }
}