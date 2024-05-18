<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity('email', message: 'Znaleziono w bazie')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 180)]
    private string $email;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private string $password;

    #[ORM\Column(length: 255)]
    private string $firstName;

    #[ORM\Column(length: 255)]
    private string $lastName;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'students')]
    private ?User $trainer = null;

    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'trainer')]
    private Collection $students;

    #[ORM\OneToMany(targetEntity: Report::class, mappedBy: 'student')]
    private Collection $reportsStudent;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar = null;

    #[ORM\OneToMany(targetEntity: ReportAnalysis::class, mappedBy: 'trainer')]
    private Collection $reportAnalyses;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(targetEntity: Report::class, mappedBy: 'trainer')]
    private Collection $reportsTrainer;

    #[ORM\OneToMany(targetEntity: Reviews::class, mappedBy: 'trainer')]
    private Collection $reviews;

    #[ORM\Column]
    private int $unreadMessageCount = 0;

    #[ORM\OneToMany(targetEntity: Info::class, mappedBy: 'user')]
    private Collection $infos;

    #[ORM\OneToMany(targetEntity: Info::class, mappedBy: 'newStudent')]
    private Collection $newStudent;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->reportsStudent = new ArrayCollection();
        $this->reportAnalyses = new ArrayCollection();
        $this->reportsTrainer = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->infos = new ArrayCollection();
        $this->newStudent = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getTrainer(): ?self
    {
        return $this->trainer;
    }

    public function setTrainer(?self $trainer): static
    {
        $this->trainer = $trainer;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(self $student): static
    {
        if (!$this->students->contains($student)) {
            $this->students->add($student);
            $student->setTrainer($this);
        }

        return $this;
    }

    public function removeStudent(self $student): static
    {
        if ($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getTrainer() === $this) {
                $student->setTrainer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Report>
     */
    public function getReportsStudent(): Collection
    {
        return $this->reportsStudent;
    }

    public function addReportStudent(Report $report): static
    {
        if (!$this->reportsStudent->contains($report)) {
            $this->reportsStudent->add($report);
            $report->setStudent($this);
        }

        return $this;
    }

    public function removeReportStudent(Report $report): static
    {
        if ($this->reportsStudent->removeElement($report)) {
            // set the owning side to null (unless already changed)
            if ($report->getStudent() === $this) {
                $report->setStudent(null);
            }
        }

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): static
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return Collection<int, ReportAnalysis>
     */
    public function getReportAnalyses(): Collection
    {
        return $this->reportAnalyses;
    }

    public function addReportAnalysis(ReportAnalysis $reportAnalysis): static
    {
        if (!$this->reportAnalyses->contains($reportAnalysis)) {
            $this->reportAnalyses->add($reportAnalysis);
            $reportAnalysis->setTrainer($this);
        }

        return $this;
    }

    public function removeReportAnalysis(ReportAnalysis $reportAnalysis): static
    {
        if ($this->reportAnalyses->removeElement($reportAnalysis)) {
            // set the owning side to null (unless already changed)
            if ($reportAnalysis->getTrainer() === $this) {
                $reportAnalysis->setTrainer(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Report>
     */
    public function getReportsTrainer(): Collection
    {
        return $this->reportsTrainer;
    }

    public function addReportsTrainer(Report $reportsTrainer): static
    {
        if (!$this->reportsTrainer->contains($reportsTrainer)) {
            $this->reportsTrainer->add($reportsTrainer);
            $reportsTrainer->setTrainer($this);
        }

        return $this;
    }

    public function removeReportsTrainer(Report $reportsTrainer): static
    {
        if ($this->reportsTrainer->removeElement($reportsTrainer)) {
            // set the owning side to null (unless already changed)
            if ($reportsTrainer->getTrainer() === $this) {
                $reportsTrainer->setTrainer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reviews>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Reviews $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setTrainer($this);
        }

        return $this;
    }

    public function removeReview(Reviews $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getTrainer() === $this) {
                $review->setTrainer(null);
            }
        }

        return $this;
    }

    public function getUnreadMessageCount(): ?int
    {
        return $this->unreadMessageCount;
    }

    public function setUnreadMessageCount(int $unreadMessageCount): static
    {
        $this->unreadMessageCount = $unreadMessageCount;

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
            $info->setUser($this);
        }

        return $this;
    }

    public function removeInfo(Info $info): static
    {
        if ($this->infos->removeElement($info)) {
            // set the owning side to null (unless already changed)
            if ($info->getUser() === $this) {
                $info->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Info>
     */
    public function getNewStudent(): Collection
    {
        return $this->newStudent;
    }

    public function addNewStudent(Info $newStudent): static
    {
        if (!$this->newStudent->contains($newStudent)) {
            $this->newStudent->add($newStudent);
            $newStudent->setNewStudent($this);
        }

        return $this;
    }

    public function removeNewStudent(Info $newStudent): static
    {
        if ($this->newStudent->removeElement($newStudent)) {
            // set the owning side to null (unless already changed)
            if ($newStudent->getNewStudent() === $this) {
                $newStudent->setNewStudent(null);
            }
        }

        return $this;
    }
}
