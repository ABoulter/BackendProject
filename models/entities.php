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

}