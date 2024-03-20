<?php

namespace App\Entity;

use App\Repository\ReportRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReportRepository::class)]
class Report
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private string $weight;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private string $calfCircumference;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private string $thighCircumference;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private string $beltCircumference;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private string $neckCircumference;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private string $bicepsCircumference;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private string $forearmCircumference;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'reports')]
    private User $student;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private string $Comments;

    #[ORM\Column]
    private int $percentDiet;

    public function getId(): int
    {
        return $this->id;
    }

    public function getWeight(): string
    {
        return $this->weight;
    }

    public function setWeight(string $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getCalfCircumference(): string
    {
        return $this->calfCircumference;
    }

    public function setCalfCircumference(string $calfCircumference): static
    {
        $this->calfCircumference = $calfCircumference;

        return $this;
    }

    public function getThighCircumference(): string
    {
        return $this->thighCircumference;
    }

    public function setThighCircumference(string $thighCircumference): static
    {
        $this->thighCircumference = $thighCircumference;

        return $this;
    }

    public function getBeltCircumference(): string
    {
        return $this->beltCircumference;
    }

    public function setBeltCircumference(string $beltCircumference): static
    {
        $this->beltCircumference = $beltCircumference;

        return $this;
    }

    public function getNeckCircumference(): string
    {
        return $this->neckCircumference;
    }

    public function setNeckCircumference(string $neckCircumference): static
    {
        $this->neckCircumference = $neckCircumference;

        return $this;
    }

    public function getBicepsCircumference(): string
    {
        return $this->bicepsCircumference;
    }

    public function setBicepsCircumference(string $bicepsCircumference): static
    {
        $this->bicepsCircumference = $bicepsCircumference;

        return $this;
    }

    public function getForearmCircumference(): string
    {
        return $this->forearmCircumference;
    }

    public function setForearmCircumference(string $forearmCircumference): static
    {
        $this->forearmCircumference = $forearmCircumference;

        return $this;
    }

    public function getStudent(): User
    {
        return $this->student;
    }

    public function setStudent(?User $student): static
    {
        $this->student = $student;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getComments(): string
    {
        return $this->Comments;
    }

    public function setComments(string $Comments): static
    {
        $this->Comments = $Comments;

        return $this;
    }

    public function getPercentDiet(): int
    {
        return $this->percentDiet;
    }

    public function setPercentDiet(int $percentDiet): static
    {
        $this->percentDiet = $percentDiet;

        return $this;
    }
}
