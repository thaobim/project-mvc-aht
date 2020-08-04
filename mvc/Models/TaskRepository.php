<?php

namespace Mvc\Models;

use Mvc\Models\TaskResourceModel;

class TaskRepository{

    private $TaskResourceModel;

    public function __construct()
    {
        $this->TaskResourceModel = new TaskResourceModel();
    }

    public function add($model){
        
        return $this->TaskResourceModel->save($model);
    }

    public function update($model){
        
        return $this->TaskResourceModel->save($model);
    }

    public function get($id){
        
    }

    public function delete($model){
        return $this->TaskResourceModel->delete($model);
    }

    public function findID($id){
        return $this->TaskResourceModel->findID($id);
    }

    public function getAll(){
        return $this->TaskResourceModel->getAll();
    }
}