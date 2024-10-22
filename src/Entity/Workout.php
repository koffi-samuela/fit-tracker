<?php

namespace App\Entity;

use App\Repository\WorkoutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkoutRepository::class)]
#[ORM\Table('workouts')]

class Workout
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $notes = null;

    #[ORM\Column(length: 255)]
    private ?string $type_of_workout = null;

    /**
     * @var Collection<int, WorkoutExercice>
     */
    #[ORM\OneToMany(targetEntity: WorkoutExercice::class, mappedBy: 'workout')]
    private Collection $contain;

    #[ORM\ManyToOne(inversedBy: 'register')]
    private ?User $user = null;

    public function __construct()
    {
        $this->contain = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }

    public function getTypeOfWorkout(): ?string
    {
        return $this->type_of_workout;
    }

    public function setTypeOfWorkout(string $type_of_workout): static
    {
        $this->type_of_workout = $type_of_workout;

        return $this;
    }

    /**
     * @return Collection<int, WorkoutExercice>
     */
    public function getContain(): Collection
    {
        return $this->contain;
    }

    public function addContain(WorkoutExercice $contain): static
    {
        if (!$this->contain->contains($contain)) {
            $this->contain->add($contain);
            $contain->setWorkout($this);
        }

        return $this;
    }

    public function removeContain(WorkoutExercice $contain): static
    {
        if ($this->contain->removeElement($contain)) {
            // set the owning side to null (unless already changed)
            if ($contain->getWorkout() === $this) {
                $contain->setWorkout(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
