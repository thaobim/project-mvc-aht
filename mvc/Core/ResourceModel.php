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

        $props = $model->getProperties();
        
        if ($id) {
            $sql = "UPDATE $this->table SET ";
            unset($props['id']);
            if(count($props) > 0 ){
                $i = 0;
                foreach($props as $key => $prop){
                    if($i == count($props) - 1){
                        $sql .= "$key =:$key ";
                    }else{
                        $sql .= "$key =:$key ,";
                    }
                    $i++;
                }
                $sql .= "WHERE id = :id";
            }

            $req = Database::getBdd()->prepare($sql);
            return $req->execute([
                'title' => $title,
                'description' => $description,
                'updated_at' => date("Y-m-d h:i:s"),
                'created_at' => $this->getCreatedAt($id),
                'id' => $id
            ]);
        } else {
            $sql = "INSERT INTO $this->table ";
            if(count($props) > 0 ){
                $valueField = "(";
                $labelField = "(";
                $i = 0;
                foreach($props as $key => $prop){
                    if($key !== "id"){
                        if($i == count($props) - 1){
                            $labelField .= $key.")";
                            $valueField .= ":".$key.")";
                        }else{
                            $labelField .= $key.", ";
                            $valueField .= ":".$key.", ";
                        }
                    }
                    $i++;
                }
                $sql .= $labelField ." VALUES ". $valueField;
            }
            $req = Database::getBdd()->prepare($sql);
            return $req->execute([
                'title' => $title,
                'description' => $description,
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => NULL
            ]);
        }
    }

    public function delete($model)
    {
        $id = $model->getID();

        if($id){
            $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
            $req = Database::getBdd()->prepare($sql);
            return $req->execute([
                'id' => $id
            ]);
        }
    }

    public function getCreatedAt($id){
        $sql =  "SELECT created_at FROM $this->table WHERE id = $id";

        $req = Database::getBdd()->prepare($sql);

        if($req->execute()) return $req->fetch()['created_at'];
    }

    public function getAll(){
        $sql =  "SELECT * FROM $this->table";

        $req = Database::getBdd()->prepare($sql);

        if($req->execute()) 
        return $req->fetchAll();
    }

    public function findID($id){
        $sql =  "SELECT * FROM $this->table WHERE id = $id";

        $req = Database::getBdd()->prepare($sql);

        if($req->execute()){
            return  $req->fetch();
        }
    }
}
