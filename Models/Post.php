<?php

namespace App\Models;

use App\Helpers\Slugger;
use App\Trait\EntityDateTrait;
use App\Interface\EntityInterface;
use App\Repository\PostRepository;
use App\Repository\PostsTagsRepository;

class Post extends PostRepository implements EntityInterface
{
    use EntityDateTrait;

    protected  $id = null; 
    protected  $title; 
    protected  $content; 
    protected  $chapo; 
    protected  $author; 
    protected  $slug;

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
    
    public function getChapo(): ?string
    {
        return $this->chapo;
    }
    public function setChapo(?string $chapo): void
    {
        $this->chapo = $chapo;
    }

    public function getAuthor(): int
    {
        return $this->author;
    }
    public function setAuthor(int $author): void
    {
        $this->author = $author;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }
    public function setSlug(string $slug): void
    {
        $this->slug = Slugger::sluggify($slug);
    }

    public function getTags():array
    {
        return (new PostsTagsRepository())->findBy(['post' => $this->getId()]);
    }
}