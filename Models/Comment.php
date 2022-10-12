<?php

namespace App\Models;

use App\Trait\EntityDateTrait;
use App\Interface\EntityInterface;
use App\Repository\CommentRepository;

class Comment extends CommentRepository implements EntityInterface
{
    use EntityDateTrait;

    protected  $id = null; 
    protected  $title; 
    protected  $content; 
    protected  $author; 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }
  
    public function getContent(): ?string
    {
        return $this->content;
    }
    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    public function getAuthor(): int
    {
        return $this->author;
    }
    public function setAuthor(int $author): void
    {
        $this->author = $author;
    }
}