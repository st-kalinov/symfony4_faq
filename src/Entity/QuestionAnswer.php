<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionAnswerRepository")
 */
class QuestionAnswer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */

    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="questionAnswers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $question;

    /**
     * @ORM\Column(type="text")
     */
    private $answer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\QuestionReaction", mappedBy="question", orphanRemoval=true)
     */
    private $questionReactions;

    public function __construct()
    {
        $this->questionReactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * @return Collection|QuestionReaction[]
     */
    public function getQuestionReactions(): Collection
    {
        return $this->questionReactions;
    }

    public function addQuestionReaction(QuestionReaction $questionReaction): self
    {
        if (!$this->questionReactions->contains($questionReaction)) {
            $this->questionReactions[] = $questionReaction;
            $questionReaction->setQuestion($this);
        }

        return $this;
    }

    public function removeQuestionReaction(QuestionReaction $questionReaction): self
    {
        if ($this->questionReactions->contains($questionReaction)) {
            $this->questionReactions->removeElement($questionReaction);
            // set the owning side to null (unless already changed)
            if ($questionReaction->getQuestion() === $this) {
                $questionReaction->setQuestion(null);
            }
        }

        return $this;
    }

}
