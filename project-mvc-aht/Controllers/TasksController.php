<?php

namespace Mvc\Controllers;

use Mvc\Models\Task;

use Mvc\Core\Controller;

use Mvc\Models\TaskRepository;

class TasksController extends Controller
{
    function index()
    {
        $newTask = new Task();
        $newTask->setID(2);
        $newTask->setTitle("Hello, Bim yêu!");
        $newTask->setDescription("Bu yêu Bim đang ngáp");
        $newTask->setCreatedAt(date("Y-m-d : h:i:s"));
        $newTask->setUpdatedAt(date("Y-m-d : h:i:s"));

        TaskRepository::add($newTask);

        $tasks = new Task();

        $d['tasks'] = $tasks->showAllTasks();
        $this->set($d);
        $this->render("index");
    }

    function create()
    {
        if (isset($_POST["title"]))
        {
            $task= new Task();

            if ($task->create($_POST["title"], $_POST["description"]))
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }

        $this->render("create");
    }

    function edit($id)
    {
        $task= new Task();

        $d["task"] = $task->showTask($id);

        if (isset($_POST["title"]))
        {
            if ($task->edit($id, $_POST["title"], $_POST["description"]))
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->set($d);
        $this->render("edit");
    }

    function delete($id)
    {
        $task = new Task();
        if ($task->delete($id))
        {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }
}
