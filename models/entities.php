<?php

require_once("base.php");

class Entities extends Base
{
    public function getHomePageContent()
    {
        $html = "<div class='previewCategories'>";
        $categories = $this->getCategories();

        foreach ($categories as $category) {
            $html .= $this->getCategoryHtml($category);
        }

        $html .= "</div>";


        $videoEntity = $this->getRandomEntity();

        return [
            'html' => $html,
            'videoEntity' => $videoEntity
        ];
    }

    private function getCategories()
    {
        $query = $this->db->prepare("SELECT * FROM categories");
        $query->execute();
        return $query->fetchAll();
    }

    private function getCategoryHtml($category)
    {
        $categoryId = $category["id"];
        $title = $category["name"];
        $entities = $this->getEntities($categoryId);

        if (empty($entities)) {
            return '';
        }

        $entitiesHtml = '';

        foreach ($entities as $entity) {
            $entitiesHtml .= $this->createPreviewCard($entity);
        }

        return "<div class='category'>
                       <h3>$title</h3>  
                    <div class='entities'>
                        $entitiesHtml
                    </div>
                </div>";
    }

    private function getEntities($categoryId)
    {

        $query = $this->db->prepare("SELECT * FROM entities WHERE categoryId = ? LIMIT 25");
        $query->execute([$categoryId]);
        return $query->fetchAll();
    }


    private function createPreviewCard($entity)
    {
        $id = $entity["id"];
        $thumbnail = $entity["thumbnail"];
        $name = $entity["name"];

        $thumbnailUrl = "http://localhost/" . $thumbnail;

        return "<a href='streamPage/$id'>
                    <div class='previewContainer small'>
                        <img src='$thumbnailUrl' title='$name' alt='$name'>
                    </div>
                </a>";
    }

    public function createPreviewVideo($entity)
    {

        $name = $entity["name"];
        $preview = $entity["preview"];
        $thumbnail = $entity["thumbnail"];

        $previewUrl = "http://localhost/" . $preview;
        $thumbnailUrl = "http://localhost/" . $thumbnail;


        return "<div class='previewContainer'>
                    <img src='$thumbnailUrl' class='previewImage' hidden>
                    <video autoplay muted class='previewVideo' onended='previewEnded()'>
                        <source src='$previewUrl' type='video/mp4'>
                    </video>
                <div class='previewOverlay'>
                    <div class='mainDetails'>
                        <h3>$name</h3>
                <div class='buttons'>
                    <button><i class='fas fa-play'></i></button>
                <button onclick='volumeToggle(this)'><i class='fas fa-volume-off'></i></button>
                </div>
                </div>
            </div>
        </div>
";
    }

    private function getRandomEntity()
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