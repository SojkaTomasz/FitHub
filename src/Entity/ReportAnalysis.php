<?php

namespace App\Entity;

use App\Repository\ReportAnalysisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReportAnalysisRepository::class)]
class ReportAnalysis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateAnalysis;

    #[ORM\OneToOne(inversedBy: 'reportAnalysis', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private Report $report;

    #[ORM\ManyToOne(inversedBy: 'reportAnalyses')]
    private User $trainer;

    #[ORM\Column(type: Types::TEXT)]
    private string $trainingPlan;

    #[ORM\Column(type: Types::TEXT)]
    private string $nutritionPlan;

    #[ORM\Column(type: Types::TEXT)]
    private string $recommendations;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAnalysis(): ?\DateTimeInterface
    {
        return $this->dateAnalysis;
    }

    public function setDateAnalysis(\DateTimeInterface $dateAnalysis): static
    {
        $this->dateAnalysis = $dateAnalysis;

        return $this;
    }

    public function getReport(): Report
    {
        return $this->report;
    }

    public function setReport(Report $report): static
    {
        $this->report = $report;

        return $this;
    }

    public function getTrainer(): User
    {
        return $this->trainer;
    }

    public function setTrainer(User $trainer): static
    {
        $this->trainer = $trainer;

        return $this;
    }

    public function getTrainingPlan(): string
    {
        return $this->trainingPlan;
    }

    public function setTrainingPlan(string $trainingPlan): static
    {
        $this->trainingPlan = $trainingPlan;

        return $this;
    }

    public function getNutritionPlan(): ?string
    {
        return $this->nutritionPlan;
    }

    public function setNutritionPlan(string $nutritionPlan): static
    {
        $this->nutritionPlan = $nutritionPlan;

        return $this;
    }

    public function getRecommendations(): ?string
    {
        return $this->recommendations;
    }

    public function setRecommendations(string $recommendations): static
    {
        $this->recommendations = $recommendations;

        return $this;
    }
}
