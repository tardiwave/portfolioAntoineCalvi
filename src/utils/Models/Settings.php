<?php

namespace App\Models;
class Settings {

    private $id;

    private $perPage;

    private $imageGap;

    private $mailJetPublicKey;

    private $mailJetPrivateKey;

    private $googleAnalyticsKey;

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

    public function getMailJetPublicKey(): ?string
    {
        return $this->mailJetPublicKey;
    }

    public function setMailJetPublicKey(string $mailJetPublicKey): self
    {
        $this->mailJetPublicKey = $mailJetPublicKey;
        return $this;
    }

    public function getMailJetPrivateKey(): ?string
    {
        return $this->mailJetPrivateKey;
    }

    public function setMailJetPrivateKey(string $mailJetPrivateKey): self
    {
        $this->mailJetPrivateKey = $mailJetPrivateKey;
        return $this;
    }

    public function getGoogleAnalyticsKey(): ?string
    {
        return $this->googleAnalyticsKey;
    }

    public function setGoogleAnalyticsKey(string $googleAnalyticsKey): self
    {
        $this->googleAnalyticsKey = $googleAnalyticsKey;
        return $this;
    }

}