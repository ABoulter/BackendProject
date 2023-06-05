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

    public function getAllEntities()
    {

        $query = "SELECT * FROM entities";


        $result = $this->db->prepare($query);
        $result->execute();

        return $result->fetchAll();
    }

    public function createEntity($entityData)
    {



        $query = $this->db->prepare("SELECT COUNT(*) as count FROM entities WHERE name = :name");
        $query->bindValue(':name', $entityData['name']);
        $query->execute();
        $nameExists = $query->fetch()['count'];

        if ($nameExists) {
            return false;
        }


        $query = $this->db->prepare("INSERT INTO entities (name, thumbnail, preview, categoryId) 
                  VALUES (:name, :thumbnail, :preview, :categoryId)");
        $query->bindValue(':name', $entityData['name']);
        $query->bindValue(':thumbnail', $entityData['thumbnail']);
        $query->bindValue(':preview', $entityData['preview']);
        $query->bindValue(':categoryId', $entityData['categoryId']);

        $query->execute();


        return $this->db->lastInsertId();
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

    public function getMoviesByCategory($categoryId)
    {

        $query = $this->db->prepare("SELECT * 
                                     FROM entities 
                                     WHERE categoryId = ? AND isMovie = 1");
        $query->execute([$categoryId]);
        return $query->fetchAll();
    }
    public function getTVShowsByCategory($categoryId)
    {
        $query = $this->db->prepare("SELECT * 
                                     FROM entities 
                                     WHERE categoryId = ? AND isMovie = 0");
        $query->execute([$categoryId]);
        return $query->fetchAll();
    }


    public function getRandomTVShowId()
    {
        $query = $this->db->prepare("SELECT entities.*, videos.id AS videoId
                                 FROM entities 
                                 JOIN videos ON entities.id = videos.entityId 
                                 LEFT JOIN videoProgress ON videos.id = videoProgress.videoId
                                 WHERE entities.isMovie = 0 
                                 AND videos.season = 1 
                                 AND videos.episode = 1 
                                 AND videoProgress.id IS NULL
                                 ORDER BY RAND() 
                                 LIMIT 1");
        $query->execute();
        return $query->fetch();
    }

    public function searchEntities($searchTerm)
    {
        $query = $this->db->prepare("SELECT * FROM entities WHERE name LIKE CONCAT('%', ?, '%')");
        $query->execute([$searchTerm]);

        $results = $query->fetchAll();
        return $results;
    }
}