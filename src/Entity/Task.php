<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TodoRepository")
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $owner;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $task;

    /**
     * @ORM\Column(type="string", length=255)
     */
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
