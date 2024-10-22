<?php

namespace App\Entity;

use App\Repository\WorkoutExerciceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkoutExerciceRepository::class)]
#[ORM\Table('workout_exercices')]

class WorkoutExercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $number_of_repetitions = null;

    #[ORM\Column]
    private ?float $duration = null;

    #[ORM\ManyToOne(inversedBy: 'contain')]
    private ?Exercice $exercice = null;

    #[ORM\ManyToOne(inversedBy: 'contain')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Workout $workout = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberOfRepetitions(): ?int
    {
        return $this->number_of_repetitions;
    }

    public function setNumberOfRepetitions(int $number_of_repetitions): static
    {
        $this->number_of_repetitions = $number_of_repetitions;

        return $this;
    }

    public function getDuration(): ?float
    {
        return $this->duration;
    }

    public function setDuration(float $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getExercice(): ?Exercice
    {
        return $this->exercice;
    }

    public function setExercice(?Exercice $exercice): static
    {
        $this->exercice = $exercice;

        return $this;
    }

    public function getWorkout(): ?Workout
    {
        return $this->workout;
    }

    public function setWorkout(?Workout $workout): static
    {
        $this->workout = $workout;

        return $this;
    }
}
