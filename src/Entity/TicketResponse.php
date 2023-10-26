<?php

namespace App\Entity;

use App\Repository\TicketReplyRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketResponseRepository::class)]
class TicketResponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ticketResponses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ticket $ticket = null;

    #[ORM\OneToOne(inversedBy: 'child', targetEntity: self::class, cascade: ['persist', 'remove'])]
    private ?self $parent = null;

    #[ORM\OneToOne(mappedBy: 'parent', targetEntity: self::class, cascade: ['persist', 'remove'])]
    private ?self $child = null;

    #[ORM\Column(length: 255)]
    private ?string $subject = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $body = null;

    #[ORM\Column(length: 255)]
    private ?string $submitter = null;

    // #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    // private ?\DateTimeInterface $dateSubmitted = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTicket(): ?Ticket
    {
        return $this->ticket;
    }

    public function setTicket(?Ticket $ticket): static
    {
        $this->ticket = $ticket;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    public function getChild(): ?self
    {
        return $this->child;
    }

    public function setChild(?self $child): static
    {
        // unset the owning side of the relation if necessary
        if ($child === null && $this->child !== null) {
            $this->child->setParent(null);
        }

        // set the owning side of the relation if necessary
        if ($child !== null && $child->getParent() !== $this) {
            $child->setParent($this);
        }

        $this->child = $child;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): static
    {
        $this->subject = $subject;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): static
    {
        $this->body = $body;

        return $this;
    }

    public function getSubmitter(): ?string
    {
        return $this->submitter;
    }

    public function setSubmitter(string $submitter): static
    {
        $this->submitter = $submitter;

        return $this;
    }

    public function getDateSubmitted(): ?\DateTimeInterface
    {
        return $this->dateSubmitted;
    }

    public function setDateSubmitted(\DateTimeInterface $dateSubmitted): static
    {
        $this->dateSubmitted = $dateSubmitted;

        return $this;
    }
}
