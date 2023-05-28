<?php
require_once("base.php");

class Progress extends Base
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
}