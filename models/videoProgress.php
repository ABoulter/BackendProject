<?php
require_once("base.php");

class VideoProgress extends Base
{
    public function addVideoProgress($data)
    {
        if (isset($data["videoId"]) && isset($data["userId"])) {
            $query = $this->db->prepare("SELECT * FROM videoProgress
                                     WHERE userId = ? AND videoId = ?");
            $query->execute([$data["userId"], $data["videoId"]]);

            if ($query->rowCount() == 0) {
                $query = $this->db->prepare("INSERT INTO videoProgress (userId, videoId) 
                                         SELECT users.id, ? FROM users WHERE users.id = ?");
                $query->execute([$data["videoId"], $data["userId"]]);
            }

        } else {
            http_response_code(400);
            return json_encode(array("message" => "No videoId or userId passed into file"));

        }
    }

    public function updateVideoProgress($data)
    {
        if (isset($data["videoId"]) && isset($data["userId"]) && isset($data["progress"])) {
            $query = $this->db->prepare("UPDATE videoProgress
                                         INNER JOIN users ON videoProgress.userId = users.id
                                         SET videoProgress.progress = ?,
                                             videoProgress.dateModified = NOW()
                                         WHERE users.id = ? AND videoProgress.videoId = ?");
            $query->execute([$data["progress"], $data["userId"], $data["videoId"]]);
        } else {
            http_response_code(400);
            return json_encode(array("message" => "No videoId or userId passed into file"));
        }
    }

    public function updateFinished($data)
    {

        if (isset($data["videoId"]) && isset($data["userId"])) {
            $query = $this->db->prepare("UPDATE videoProgress
                                         INNER JOIN users ON videoProgress.userId = users.id
                                         SET videoProgress.isFinished = 1, videoProgress.progress = 0
                                         WHERE users.id = ? AND videoProgress.videoId = ?");
            $query->execute([$data["userId"], $data["videoId"]]);


        } else {
            http_response_code(400);
            return json_encode(array("message" => "No videoId or userId passed into file"));
        }


    }


    public function isInProgress($userId)
    {
        $query = $this->db->prepare("SELECT COUNT(*) FROM videoProgress WHERE userId = ?");
        $query->execute([$userId]);

        $rowCount = $query->fetchColumn();

        return $rowCount > 0;
    }

    public function hasSeen($userId)
    {
        $query = $this->db->prepare("SELECT videoId FROM videoProgress WHERE userId = ? AND isFinished = 1");
        $query->execute([$userId]);

        $result = $query->fetchAll(PDO::FETCH_COLUMN);
        return $result;
    }




}