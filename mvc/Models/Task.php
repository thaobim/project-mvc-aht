<?php

namespace Mvc\Models;

use Mvc\Core\Model;

use Mvc\Config\Database;

class Task extends Model
{
    protected $id;
    protected $title;
    protected $description;
    protected $updated_at;
    protected $created_at;

    public function __construct()
    {
        
    }

    public function getID(){
        return $this->id;
    }

    public function setID($id){
        $this->id = $id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
    }
    
    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getCreatedAt(){
        return $this->created_at;
    }

    public function setCreatedAt(){
        $this->created_at = date("Y-m-d h:i:s");
    }

    public function getUpdatedAt(){
        return $this->updated_at;
    }

    public function setUpdatedAt(){
        $this->updated_at = date("Y-m-d h:i:s");
    }

}
