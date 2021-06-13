<?php

namespace App\Models;
use \DateTime;

class Category {

    private $id;

    private $name;

    private $slug;

    private $shortDescription;

    private $createdAt;

    private $postId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string 
    {
        return e($this->name);
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getSlug(): ?string 
    {
        return e($this->slug);
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getSDesc(): ?string 
    {
        return e((string)($this->shortDescription));
    }

    public function setSDesc(string $shortDescription): self 
    {
        $this->shortDescription = $shortDescription;
        return $this;
    }

    public function getDate(): ?DateTime 
    {
        return new \DateTime($this->createdAt);
    }

    public function setDate(string $createdAt): self 
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getPostId(): ?int 
    {
        return e($this->postId);
    }

}