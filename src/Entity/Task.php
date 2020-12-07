<?php

namespace App\Entity;

class Task
{
    private $id;
    private $owner;
    private $task;
    private $status;

    // Get all data relating to a task
    public function getTodoId(): ?int
    {
        return $this->id;
    }

    public function getTodoOwner(): ?string
    {
        return $this->owner;
    }

    public function getTodoTask(): ?string
    {
        return $this->task;
    }

    public function getTodoStatus(): ?string
    {
        return $this->status;
    }


    // Set all data relating to a task
    public function setTodoOwner(string $owner): self
    {
        $this->owner = $owner;
        return $this;
    }

    public function setTodoTask(string $task): self
    {
        $this->task = $task;
        return $this;
    }

    public function setTodoStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }
}
