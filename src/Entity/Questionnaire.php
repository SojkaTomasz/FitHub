<?php

namespace App\Entity;

use App\Repository\QuestionnaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionnaireRepository::class)]
class Questionnaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\OneToOne(inversedBy: 'questionnaire', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\Column(type: Types::TEXT)]
    private string $productsLike;

    #[ORM\Column(type: Types::TEXT)]
    private string $productsNotLike;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $trainingDays;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $trainingHours;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $typeWork;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $goals;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $shortTermGoals;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $longTermGoals;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $activityLevel;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $currentTraining;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $healthIssues;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $mobilityIssues;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $stressLevel;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $sleepQuality;

    #[ORM\Column(type: Types::TEXT)]
    private string $currentDiet;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $mealsPerDay;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $snackingHabits;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $waterIntake;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $alcoholIntake;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $smokingHabits;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $motivation;

    #[ORM\Column]
    private array $preferredTraining = [];

    #[ORM\Column]
    private array $dislikedTraining = [];

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $preferredTrainingTime;

    #[ORM\Column]
    private array $availableEquipment = [];

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $additionalInfo = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeImmutable $createdAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(targetEntity: Info::class, mappedBy: 'questionnaire')]
    private Collection $infos;

    public function __construct()
    {
        $this->infos = new ArrayCollection();
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getProductsLike(): string
    {
        return $this->productsLike;
    }

    public function setProductsLike(string $productsLike): static
    {
        $this->productsLike = $productsLike;

        return $this;
    }

    public function getProductsNotLike(): string
    {
        return $this->productsNotLike;
    }

    public function setProductsNotLike(string $productsNotLike): static
    {
        $this->productsNotLike = $productsNotLike;

        return $this;
    }

    public function getTrainingDays(): string
    {
        return $this->trainingDays;
    }

    public function setTrainingDays(string $trainingDays): static
    {
        $this->trainingDays = $trainingDays;

        return $this;
    }

    public function getTrainingHours(): string
    {
        return $this->trainingHours;
    }

    public function setTrainingHours(string $trainingHours): static
    {
        $this->trainingHours = $trainingHours;

        return $this;
    }

    public function getTypeWork(): string
    {
        return $this->typeWork;
    }

    public function setTypeWork(string $typeWork): static
    {
        $this->typeWork = $typeWork;

        return $this;
    }

    public function getGoals(): string
    {
        return $this->goals;
    }

    public function setGoals(string $goals): static
    {
        $this->goals = $goals;

        return $this;
    }

    public function getShortTermGoals(): string
    {
        return $this->shortTermGoals;
    }

    public function setShortTermGoals(string $shortTermGoals): static
    {
        $this->shortTermGoals = $shortTermGoals;

        return $this;
    }

    public function getLongTermGoals(): string
    {
        return $this->longTermGoals;
    }

    public function setLongTermGoals(string $longTermGoals): static
    {
        $this->longTermGoals = $longTermGoals;

        return $this;
    }

    public function getActivityLevel(): string
    {
        return $this->activityLevel;
    }

    public function setActivityLevel(string $activityLevel): static
    {
        $this->activityLevel = $activityLevel;

        return $this;
    }

    public function getCurrentTraining(): string
    {
        return $this->currentTraining;
    }

    public function setCurrentTraining(?string $currentTraining): static
    {
        $this->currentTraining = $currentTraining;

        return $this;
    }

    public function getHealthIssues(): string
    {
        return $this->healthIssues;
    }

    public function setHealthIssues(string $healthIssues): static
    {
        $this->healthIssues = $healthIssues;

        return $this;
    }

    public function getMobilityIssues(): string
    {
        return $this->mobilityIssues;
    }

    public function setMobilityIssues(string $mobilityIssues): static
    {
        $this->mobilityIssues = $mobilityIssues;

        return $this;
    }

    public function getStressLevel(): string
    {
        return $this->stressLevel;
    }

    public function setStressLevel(string $stressLevel): static
    {
        $this->stressLevel = $stressLevel;

        return $this;
    }

    public function getSleepQuality(): string
    {
        return $this->sleepQuality;
    }

    public function setSleepQuality(string $sleepQuality): static
    {
        $this->sleepQuality = $sleepQuality;

        return $this;
    }

    public function getCurrentDiet(): string
    {
        return $this->currentDiet;
    }

    public function setCurrentDiet(string $currentDiet): static
    {
        $this->currentDiet = $currentDiet;

        return $this;
    }


    public function getMealsPerDay(): string
    {
        return $this->mealsPerDay;
    }

    public function setMealsPerDay(string $mealsPerDay): static
    {
        $this->mealsPerDay = $mealsPerDay;

        return $this;
    }

    public function getSnackingHabits(): string
    {
        return $this->snackingHabits;
    }

    public function setSnackingHabits(?string $snackingHabits): static
    {
        $this->snackingHabits = $snackingHabits;

        return $this;
    }

    public function getWaterIntake(): string
    {
        return $this->waterIntake;
    }

    public function setWaterIntake(string $waterIntake): static
    {
        $this->waterIntake = $waterIntake;

        return $this;
    }

    public function getAlcoholIntake(): string
    {
        return $this->alcoholIntake;
    }

    public function setAlcoholIntake(string $alcoholIntake): static
    {
        $this->alcoholIntake = $alcoholIntake;

        return $this;
    }

    public function getSmokingHabits(): string
    {
        return $this->smokingHabits;
    }

    public function setSmokingHabits(string $smokingHabits): static
    {
        $this->smokingHabits = $smokingHabits;

        return $this;
    }

    public function getMotivation(): string
    {
        return $this->motivation;
    }

    public function setMotivation(string $motivation): static
    {
        $this->motivation = $motivation;

        return $this;
    }

    public function getPreferredTraining(): array
    {
        return $this->preferredTraining;
    }

    public function setPreferredTraining(array $preferredTraining): static
    {
        $this->preferredTraining = $preferredTraining;

        return $this;
    }

    public function getDislikedTraining(): array
    {
        return $this->dislikedTraining;
    }

    public function setDislikedTraining(array $dislikedTraining): static
    {
        $this->dislikedTraining = $dislikedTraining;

        return $this;
    }

    public function getPreferredTrainingTime(): string
    {
        return $this->preferredTrainingTime;
    }

    public function setPreferredTrainingTime(string $preferredTrainingTime): static
    {
        $this->preferredTrainingTime = $preferredTrainingTime;

        return $this;
    }

    public function getAvailableEquipment(): array
    {
        return $this->availableEquipment;
    }

    public function setAvailableEquipment(array $availableEquipment): static
    {
        $this->availableEquipment = $availableEquipment;

        return $this;
    }

    public function getAdditionalInfo(): string
    {
        return $this->additionalInfo;
    }

    public function setAdditionalInfo(string $additionalInfo): static
    {
        $this->additionalInfo = $additionalInfo;

        return $this;
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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Info>
     */
    public function getInfos(): Collection
    {
        return $this->infos;
    }

    public function addInfo(Info $info): static
    {
        if (!$this->infos->contains($info)) {
            $this->infos->add($info);
            $info->setQuestionnaire($this);
        }

        return $this;
    }

    public function removeInfo(Info $info): static
    {
        if ($this->infos->removeElement($info)) {
            // set the owning side to null (unless already changed)
            if ($info->getQuestionnaire() === $this) {
                $info->setQuestionnaire(null);
            }
        }

        return $this;
    }
}
