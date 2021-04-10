<?php
/**
 * Entité d'une recette
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package MyCook
 */

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 */
class Recipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Nom de la recette
     * 
     * @var String
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * Nombre de personne pour les quantités définies dans la recette
     * 
     * @var Integer
     * @ORM\Column(type="smallint")
     */
    private $person;

    /**
     * Niveau de difficulté de la recette
     * 
     * @var Integer
     * @ORM\Column(type="smallint")
     */
    private $difficulty;

    /**
     * Coût de la recette
     * 
     * @var Integer
     * @ORM\Column(type="smallint")
     */
    private $rate;

    /**
     * Temps de préparation en minutes
     * 
     * @var Integer
     * @ORM\Column(name="time_preparation", type="smallint")
     */
    private $timePreparation;

    /**
     * Temps de cuisson en minutes
     * 
     * @var Integer
     * @ORM\Column(name="time_cooking", type="smallint", nullable=true)
     */
    private $timeCooking;

    /**
     * Jointure avec les catégories
     * 
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="recipes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * Jointure avec les étapes
     * 
     * @ORM\OneToMany(targetEntity=Step::class, mappedBy="recipe", orphanRemoval=true)
     */
    private $steps;

    /**
     * Jointure avec les ingrédients
     * 
     * @ORM\OneToMany(targetEntity=RecipeIngredient::class, mappedBy="recipe", orphanRemoval=true)
     */
    private $ingredients;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPerson(): ?int
    {
        return $this->person;
    }

    public function setPerson(int $person): self
    {
        $this->person = $person;

        return $this;
    }

    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    public function setDifficulty(int $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getTimePreparation(): ?int
    {
        return $this->timePreparation;
    }

    public function setTimePreparation(int $timePreparation): self
    {
        $this->timePreparation = $timePreparation;

        return $this;
    }

    public function getTimeCooking(): ?int
    {
        return $this->timeCooking;
    }

    public function setTimeCooking(?int $timeCooking): self
    {
        $this->timeCooking = $timeCooking;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSteps(): Collection
    {
        return $this->steps;
    }

    public function addStep(Recipe $step): self
    {
        if (!$this->steps->contains($step)) {
            $this->steps[] = $step;
            $step->setRecipe($this);
        }

        return $this;
    }

    public function removeStep(Recipe $step): self
    {
        if ($this->steps->removeElement($step)) {
            // set the owning side to null (unless already changed)
            if ($step->getRecipe() === $this) {
                $step->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RecipeIngredient[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(RecipeIngredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
            $ingredient->setRecipe($this);
        }

        return $this;
    }

    public function removeIngredient(RecipeIngredient $ingredient): self
    {
        if ($this->ingredients->removeElement($ingredient)) {
            // set the owning side to null (unless already changed)
            if ($ingredient->getRecipe() === $this) {
                $ingredient->setRecipe(null);
            }
        }

        return $this;
    }
}
