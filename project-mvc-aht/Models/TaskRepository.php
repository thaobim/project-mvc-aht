<?php

namespace Mvc\Models;

use Mvc\Models\TaskResourceModel;

class TaskRepository{
    public function add($model){
        $TaskResourceModel = new TaskResourceModel();
        echo "<pre>";
        $TaskResourceModel->save($model);
        echo "</pre>";

    }

    public function get($id){
        
    }

    public function delete($model){
        
    }


    public function getAll($model){
        
    }
}