<?php

require_once("base.php");

class Videos extends Base
{

    public function getVideos($entityId, $season = null)
    {
        $query = "SELECT * FROM videos WHERE entityId = ?";
        $entity = [$entityId];

        if ($season !== 0) {
            $query .= " AND season = ?";
            $entity[] = $season;
        }

        $query = $this->db->prepare($query);
        $query->execute($entity);
        $videos = $query->fetchAll();

        return $videos;


    }

    public function getSeasons($entityId)
    {
        $query = $this->db->prepare("SELECT DISTINCT season FROM videos WHERE entityId = ?");
        $query->execute([$entityId]);
        $seasons = $query->fetchAll(PDO::FETCH_COLUMN);

        return $seasons;
    }


}