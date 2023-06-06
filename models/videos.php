<?php

require_once("base.php");

class Videos extends Base
{





    public function getVideos($entityId, $season = null)
    {
        $query = "SELECT * 
                FROM videos 
                WHERE entityId = ?";

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
        $query = $this->db->prepare("SELECT DISTINCT season 
                                    FROM videos 
                                    WHERE entityId = ?");

        $query->execute([$entityId]);
        $seasons = $query->fetchAll(PDO::FETCH_COLUMN);

        return $seasons;
    }


    public function getVideoById($id)
    {
        $query = $this->db->prepare("SELECT * 
                                    FROM videos WHERE id = ?");

        $query->execute([$id]);
        return $query->fetch();
    }

    public function incrementViews($id)
    {
        $query = $this->db->prepare("UPDATE videos 
                                    SET views=views+1 
                                    WHERE id = ?");

        $query->execute([$id]);
    }

    public function getUpNext($currentVideo)
    {
        $query = $this->db->prepare("SELECT *
                                    FROM videos 
                                    WHERE entityId = ? AND id != ?
                                    AND 
                                    (
                                        (season = ? AND episode > ?)
                                        OR season > ?
                                    )
                                    ORDER BY season, episode ASC
                                    LIMIT 1
                                   ");

        $query->execute([
            $currentVideo["entityId"], $currentVideo["id"],
            $currentVideo["season"], $currentVideo["episode"], $currentVideo["season"]
        ]);

        if ($query->rowCount() == 0) {
            $query = $this->db->prepare("SELECT video.*, entity.id, entity.name AS entityName
                                        FROM videos AS video
                                        INNER JOIN entities AS entity ON video.entityId = entity.id
                                        WHERE video.entityId <> ? AND video.season <= 1 and video.episode <= 1 
                                        ORDER BY RAND()
                                        LIMIT 1
                                       ");

            $query->execute([$currentVideo['entityId']]);

        }

        return $query->fetch();
    }

    public function getLastSeenVideo($userId)
    {
        $query = $this->db->prepare("SELECT videos.id AS videoId, videos.filePath, videos.entityId, videos.isMovie, videos.season, videos.episode, videos.title, videoProgress.isFinished
                                    FROM videos
                                    INNER JOIN videoProgress ON videos.id = videoProgress.videoId
                                    WHERE videoProgress.userId = ?
                                    ORDER BY videoProgress.dateModified DESC
                                    LIMIT 1");

        $query->execute([$userId]);

        return $query->fetch();
    }

    public function getFirstEpisodeId($entityId)
    {
        $query = $this->db->prepare("SELECT *
                                FROM videos
                                WHERE entityId = ?
                                ORDER BY season, episode
                                LIMIT 1");

        $query->execute([$entityId]);

        $result = $query->fetch();

        return $result;


    }

    public function getRandomMovieId()
    {
        $query = $this->db->prepare("SELECT videos.*, entities.id AS entityId
                                 FROM videos
                                 JOIN entities ON videos.entityId = entities.id
                                 LEFT JOIN videoProgress ON videos.id = videoProgress.videoId
                                 WHERE entities.isMovie = 1 AND videoProgress.id IS NULL
                                 ORDER BY RAND()
                                 LIMIT 1");
        $query->execute();
        return $query->fetch();
    }

    public function getRandomVideoId()
    {
        $query = $this->db->prepare("SELECT *
                                 FROM videos
                                 WHERE (episode = 1 AND season = 1) OR (episode = 0 AND season= 0)
                                 ORDER BY RAND()
                                 LIMIT 1");
        $query->execute();
        return $query->fetch();
    }

    public function getTotalViews()
    {
        $query = $this->db->prepare("SELECT SUM(views) 
                                    AS totalViews 
                                    FROM videos");

        $query->execute();

        $result = $query->fetch();
        $totalViews = $result['totalViews'];

        return $totalViews;
    }

    public function updateVideo($videoId, $videoData)
    {
        $query = $this->db->prepare("UPDATE videos 
                                    SET title = ?, description = ?, filepath = ?, season = ?, episode = ?, releaseDate = ? 
                                    WHERE id = ?");

        $title = $videoData['title'];
        $description = $videoData['description'];
        $filepath = $videoData['filepath'];
        $season = $videoData['season'];
        $episode = $videoData['episode'];
        $releaseDate = $videoData['releaseDate'];

        $query->execute([$title, $description, $filepath, $season, $episode, $releaseDate, $videoId]);
    }



    public function getTotalVideosCount()
    {
        $query = $this->db->prepare("SELECT COUNT(*) 
                                    AS total 
                                    FROM videos");
        $query->execute();

        $result = $query->fetch();
        return $result['total'];
    }

    public function createVideo($videoData)
    {

        $season = $videoData['season'];
        $episode = $videoData['episode'];
        $entityId = $videoData['entityId'];


        $query = $this->db->prepare("SELECT COUNT(*) 
                                    AS count 
                                    FROM videos 
                                    WHERE entityId = :entityId AND season = :season AND episode = :episode");

        $query->bindValue(':entityId', $entityId);
        $query->bindValue(':season', $season);
        $query->bindValue(':episode', $episode);
        $query->execute();
        $rowCount = $query->fetch()['count'];

        if ($videoData['isMovie']) {

            $query = $this->db->prepare("SELECT COUNT(*) 
                                        AS count 
                                        FROM videos 
                                        WHERE entityId = :entityId AND isMovie = 1");

            $query->bindValue(':entityId', $entityId);
            $query->execute();
            $rowCount += $query->fetch()['count'];
        }

        if ($rowCount > 0) {
            return false;
        }

        $query = $this->db->prepare("INSERT INTO videos 
                                    (title, description, filePath, isMovie, uploadDate, releaseDate, views, duration, season, episode, entityId) 
                                    VALUES (:title, :description, :filePath, :isMovie, :uploadDate, :releaseDate, :views, :duration, :season, :episode,  :entityId)");

        $query->bindValue(':title', $videoData['title']);
        $query->bindValue(':description', $videoData['description']);
        $query->bindValue(':filePath', $videoData['filePath']);
        $query->bindValue(':isMovie', $videoData['isMovie']);
        $query->bindValue(':uploadDate', $videoData['uploadDate']);
        $query->bindValue(':releaseDate', $videoData['releaseDate']);
        $query->bindValue(':views', $videoData['views']);
        $query->bindValue(':duration', $videoData['duration']);
        $query->bindValue(':season', $videoData['season']);
        $query->bindValue(':episode', $videoData['episode']);
        $query->bindValue(':entityId', $videoData['entityId']);
        $query->execute();

        return $this->db->lastInsertId();
    }


    public function removeVideo($videoId)
    {

        $query = "DELETE FROM videos 
                WHERE id = ?";

        $statement = $this->db->prepare($query);

        $statement->execute([$videoId]);
    }

    public function getPage($page, $perPage)
    {
        $offset = ($page - 1) * $perPage;

        $query = $this->db->prepare("SELECT * 
                                    FROM videos 
                                    ORDER BY releaseDate 
                                    DESC LIMIT ?, ?");

        $query->bindParam(1, $offset, PDO::PARAM_INT);
        $query->bindParam(2, $perPage, PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll();
    }


}