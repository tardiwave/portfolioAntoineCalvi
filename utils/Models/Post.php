<?php
namespace App\Models;
use \DateTime;
use App\Models\Category;

class Post {

    private $id;

    private $name;

    private $slug;

    private $shortDescription;

    private $content;

    private $createdAt;

    private $categories = [];

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

    public function getContent(): ?string
    {
        return e((string)($this->content));
    }

    public function setContent(string $content): ?self 
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return Category[]
     */
    public function getCategories(): array 
    {
        return $this->categories;
    }

    public function getCategoriesIds(): array 
    {
        $ids = [];
        foreach($this->categories as $category){
            $ids[] = $category->getId();
        }
        return $ids;
    }

    public function setCategories(array $categories): self 
    {
        $this->categories = $categories;
        
        return $this;
    }

    public function addCategory(Category $category): void 
    {
        $this->categories[] = $category;
    }

}