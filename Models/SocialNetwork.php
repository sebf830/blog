<?php

namespace App\Models;

use App\Trait\EntityDateTrait;
use App\Interface\EntityInterface;
use App\Repository\SocialNetworkRepository;

class SocialNetwork extends SocialNetworkRepository implements EntityInterface
{
    protected  $id = null; 
    protected  $name; 
    protected  $link; 
    protected  $icon; 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(?string $name): void
    {
        $this->name = $name;
    }
  
    public function getLink(): ?string
    {
        return $this->link;
    }
    public function setLink(?string $link): void
    {
        $this->link = $link;
    }
    
    public function getIcon(): ?string
    {
        return $this->icon;
    }
    public function setIcon(?string $icon): void
    {
        $this->icon = $icon;
    }
}