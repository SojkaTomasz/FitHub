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
    private string $chestCircumference;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private string $neckCircumference;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private string $bicepsCircumference;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private string $forearmCircumference;

    #[ORM\Column]
    private int $percentDiet;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'reports')]
    private User $student;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date;

    #[ORM\Column(length: 255)]
    private string $frontImg;

    #[ORM\Column(length: 255)]
    private string $sideImg;

    #[ORM\Column(length: 255)]
    private string $backImg;

    #[ORM\Column]
    private bool $verified;

    #[ORM\OneToOne(mappedBy: 'report', cascade: ['persist', 'remove'])]
    private ?ReportAnalysis $reportAnalysis = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $weightDifference = null;

    #[ORM\ManyToOne(inversedBy: 'reportsTrainer')]
    private User $trainer;


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

    public function getChestCircumference(): string
    {
        return $this->chestCircumference;
    }

    public function setChestCircumference(string $chestCircumference): static
    {
        $this->chestCircumference = $chestCircumference;

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

    public function getComment(): string
    {
        if (is_null($this->comment)) {
            return '';
        }
        return $this->comment;
    }

    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

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

    public function getFrontImg(): string
    {
        return $this->frontImg;
    }

    public function setFrontImg(string $frontImg): static
    {
        $this->frontImg = $frontImg;

        return $this;
    }

    public function getSideImg(): string
    {
        return $this->sideImg;
    }

    public function setSideImg(string $sideImg): static
    {
        $this->sideImg = $sideImg;

        return $this;
    }

    public function getBackImg(): string
    {
        return $this->backImg;
    }

    public function setBackImg(string $backImg): static
    {
        $this->backImg = $backImg;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->verified;
    }

    public function setVerified(bool $verified): static
    {
        $this->verified = $verified;

        return $this;
    }

    public function getReportAnalysis(): ?ReportAnalysis
    {
        return $this->reportAnalysis;
    }

    public function setReportAnalysis(ReportAnalysis $reportAnalysis): static
    {
        // set the owning side of the relation if necessary
        if ($reportAnalysis->getReport() !== $this) {
            $reportAnalysis->setReport($this);
        }

        $this->reportAnalysis = $reportAnalysis;

        return $this;
    }

    public function getWeightDifference(): string
    {
        return $this->weightDifference;
    }

    public function setWeightDifference(string $weightDifference): static
    {
        $this->weightDifference = $weightDifference;

        return $this;
    }

    public function getTrainer(): User
    {
        return $this->trainer;
    }

    public function setTrainer(?User $trainer): static
    {
        $this->trainer = $trainer;

        return $this;
    }
}
