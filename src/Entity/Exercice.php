<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
#[ORM\Table('exercices')]

class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 300)]
    private ?string $description = null;

    /**
     * @var Collection<int, WorkoutExercice>
     */
    #[ORM\OneToMany(targetEntity: WorkoutExercice::class, mappedBy: 'exercice')]
    private Collection $contain;

    public function __construct()
    {
        $this->contain = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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
            $contain->setExercice($this);
        }

        return $this;
    }

    public function removeContain(WorkoutExercice $contain): static
    {
        if ($this->contain->removeElement($contain)) {
            // set the owning side to null (unless already changed)
            if ($contain->getExercice() === $this) {
                $contain->setExercice(null);
            }
        }

        return $this;
    }
}
