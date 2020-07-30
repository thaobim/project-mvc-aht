<?php

namespace Mvc\Core;

interface ResourceModelInterFace{
    
    public function _init($table,$id,$model);
 
    public function save($model);

    public function update($model);

    public function delete($model);
}