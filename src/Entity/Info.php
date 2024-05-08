<?php

namespace App\Entity;

use App\Repository\InfoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InfoRepository::class)]
class Info
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $seedAt = null;

    #[ORM\Column(length: 255)]
    private ?string $action;

    #[ORM\ManyToOne(inversedBy: 'infos')]
    private ?User $user;

    #[ORM\ManyToOne(inversedBy: 'infos')]
    private ?ReportAnalysis $reportAnalysis = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSeedAt(): ?\DateTimeImmutable
    {
        return $this->seedAt;
    }

    public function setSeedAt(?\DateTimeImmutable $seedAt): static
    {
        $this->seedAt = $seedAt;

        return $this;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function setAction(string $action): static
    {
        $this->action = $action;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getReportAnalysis(): ?ReportAnalysis
    {
        return $this->reportAnalysis;
    }

    public function setReportAnalysis(?ReportAnalysis $reportAnalysis): static
    {
        $this->reportAnalysis = $reportAnalysis;

        return $this;
    }

}
