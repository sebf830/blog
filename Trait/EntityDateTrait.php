<?php
namespace App\Trait;

trait EntityDateTrait{
    
    protected $createdAt;
    protected $updatedAt;

    public function __construct(){
        $this->createdAt = (new \DateTime('now'))->format("Y-m-d h:i:s");
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?string $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?string $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}