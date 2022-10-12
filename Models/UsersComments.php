<?php

namespace App\Models;

use App\Trait\EntityDateTrait;
use App\Interface\EntityInterface;
use App\Repository\UsersCommentsRepository;

class UsersComments extends UsersCommentsRepository implements EntityInterface
{
    use EntityDateTrait;

    protected  $id = null; 
    protected  $user; 
    protected  $comment; 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getUser(): ?int
    {
        return $this->user;
    }
    public function setUser(?int $user): void
    {
        $this->user = $user;
    }
  
    public function getComment(): ?string
    {
        return $this->comment;
    }
    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }
}