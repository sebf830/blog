<?php

namespace App\Models;

use App\Trait\EntityDateTrait;
use App\Interface\EntityInterface;
use App\Repository\PostsTagsRepository;

class PostsTags extends PostsTagsRepository implements EntityInterface
{
    use EntityDateTrait;

    protected  $id = null; 
    protected  $post; 
    protected  $tag; 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getPost(): ?int
    {
        return $this->post;
    }
    public function setPost(?int $post): void
    {
        $this->post = $post;
    }
  
    public function getTag(): ?int
    {
        return $this->tag;
    }
    public function setTag(?int $tag): void
    {
        $this->tag = $tag;
    }
}