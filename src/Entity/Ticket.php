<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $user_id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_submitted = null;

    #[ORM\Column(length: 255)]
    private ?string $subject = null;

    #[ORM\Column]
    private ?int $submitter_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $assigned_to = null;

    #[ORM\Column]
    private ?int $priority = null;

    #[ORM\OneToMany(mappedBy: 'ticket', targetEntity: TicketResponse::class)]
    private Collection $ticketResponses;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    public function __construct()
    {
        $this->ticketResponses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getDateSubmitted(): ?\DateTimeInterface
    {
        return $this->date_submitted;
    }

    public function setDateSubmitted(\DateTimeInterface $date_submitted): self
    {
        $this->date_submitted = $date_submitted;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getSubmitterId(): ?int
    {
        return $this->submitter_id;
    }

    public function setSubmitterId(int $submitter_id): self
    {
        $this->submitter_id = $submitter_id;

        return $this;
    }

    public function getAssignedTo(): ?int
    {
        return $this->assigned_to;
    }

    public function setAssignedTo(?int $assigned_to): self
    {
        $this->assigned_to = $assigned_to;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return Collection<int, TicketResponse>
     */
    public function getTicketResponses(): Collection
    {
        return $this->ticketResponses;
    }

    public function addTicketResponse(TicketResponse $ticketResponse): self
    {
        if (!$this->ticketResponses->contains($ticketResponse)) {
            $this->ticketResponses->add($ticketResponse);
            $ticketResponse->setTicket($this);
        }

        return $this;
    }

    public function removeTicketResponse(TicketResponse $ticketResponse): self
    {
        if ($this->ticketResponses->removeElement($ticketResponse)) {
            // set the owning side to null (unless already changed)
            if ($ticketResponse->getTicket() === $this) {
                $ticketResponse->setTicket(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
