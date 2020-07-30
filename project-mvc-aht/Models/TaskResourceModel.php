<?php

namespace Mvc\Models;

use Mvc\Core\ResourceModel;
use Mvc\Models\Task;

class TaskResourceModel extends ResourceModel{
    public function __construct(){
        $this->_init("tasks","",new Task());
    }

}