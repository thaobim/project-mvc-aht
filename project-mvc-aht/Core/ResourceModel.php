<?php

namespace Mvc\Core;

use Mvc\Core\ResourceModelInterFace;
use Mvc\Config\Database;

class ResourceModel implements ResourceModelInterFace
{

    private $table;
    private $id;
    private $model;

    public function _init($table, $id, $model)
    {
        $this->table = $table;
        $this->id = $id;
        $this->model = $model;
    }

    public function save($model)
    {
        $id = $model->getID();
        $title = $model->getTitle();
        $description = $model->getDescription();
        $created_at = $model->getCreatedAt();
        $updated_at = $model->getUpdatedAt();

        var_dump($id);
        if ($id) {
            $sql = "UPDATE " . $this->table . " SET title = :title, description = :description , created_at = :created_at, updated_at = :updated_at WHERE id = :id";
            $req = Database::getBdd()->prepare($sql);
            return $req->execute([
                'title' => $title,
                'description' => $description,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
                'id' => $id
            ]);
        } else {
            $sql = "INSERT INTO " . $this->table . " (title, description, created_at, updated_at) VALUES (:title, :description, :created_at, :updated_at)";
            $req = Database::getBdd()->prepare($sql);
            return $req->execute([
                'title' => $title,
                'description' => $description,
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ]);
        }
    }

    public function update($model)
    {
    }

    public function delete($model)
    {

    }

    public function getAll($model){
        
    }
}
