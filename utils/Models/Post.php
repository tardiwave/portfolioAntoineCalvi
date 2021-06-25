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

    private $image;

    private $imageExtension;

    private $oldImage;

    private $oldImageExtension;

    private $pendingUpload;

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

    public function getImage()
    {
        return $this->image;
    }
    public function getImageArr(): array
    {
        $imageArr = explode(",", $this->image);
        if(strlen($this->image) === 0){
            return [];
        }else{
            return $imageArr;
        }
    }
    public function getImageStr(): string
    {
        return $this->image;
    }
    public function removeImage($imageToDelete): string
    {
        $images = $this->getImageArr();
        foreach($images as $key => $image){
            if($image === $imageToDelete){
                unset($images[$key]);
            }
        }
        $this->image = implode(',',$images);
        return $this->image;
    }
    public function getImageStrWE(): array
    {
        $images = [];
        foreach($this->getImageStr() as $image){
            $images[] = 'large_' . $image;
            // $image = $image . '_' . $size . '.' . $this->imageExtension;
        }
        return $images;
    }

    // public function getImagesWE(string $size): ?string
    // {
    //     $result = $this->image . '_' . $size . '.' . $this->imageExtension;
    //     return $result;
    // }

    // public function setImage($image): self
    // {
    //     if(!empty($this->image)){
    //         $this->oldImage = $this->image;
    //         $this->oldImageExtension = $this->imageExtension;
    //     }
    //     $this->pendingUpload = true;
    //     if(is_array($image) && !empty($image['tmp_name'])){
    //         $this->image = $image;
    //     }
    //     if(is_string($image) && !empty($image)){
    //         $this->image = $image;
    //     }
    //     return $this;
    // }

    public function setImage($image): self
    {
        if(is_string($image) && !empty($image)){
            if(!empty($this->image) && $this->image != ""){
                $this->image = $this->image . ',' .$image;
            }else{
                $this->image = $image;
            }
        }
        return $this;
    }
    public function setAllImages($image): self
    {
        if(is_string($image) && !empty($image)){
            $this->image = $image;
        }
        return $this;
    }
    public function setImageStr($image): self
    {
        if(is_string($image) && !empty($image)){
            $this->images = explode(",", $image);
        }
        return $this;
    }
    public function setImageExtension($imageExtension): self
    {
        $this->imageExtension = $imageExtension;
        return $this;
    }

    public function getImageExtension(): ?string
    {
        return $this->imageExtension;
    }

    // public function getOldImage(): ?string
    // {
    //     return $this->oldImage;
    // }

    // public function getOldImageExtension(): ?string
    // {
    //     return $this->oldImageExtension;
    // }

    public function shouldUpload(): bool
    {
        return $this->pendingUpload;
    }

}