<?php

namespace App\Models;
class Settings {

    private $id;

    private $perPage;

    private $imageGap;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getPerPage(): ?string
    {
        return $this->perPage;
    }

    public function setPerPage(string $perPage): self
    {
        $this->perPage = $perPage;
        return $this;
    }

    public function getImageGap(): ?string
    {
        return $this->imageGap;
    }

    public function setImageGap(string $imageGap): self
    {
        $this->imageGap = $imageGap;
        return $this;
    }

}