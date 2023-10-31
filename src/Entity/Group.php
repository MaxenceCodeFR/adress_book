<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupRepository::class)]
#[ORM\Table(name: '`group`')]
class Group
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'groupe', targetEntity: GroupContact::class)]
    private Collection $groupContacts;

    public function __construct()
    {
        $this->groupContacts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, GroupContact>
     */
    public function getGroupContacts(): Collection
    {
        return $this->groupContacts;
    }

    public function addGroupContact(GroupContact $groupContact): static
    {
        if (!$this->groupContacts->contains($groupContact)) {
            $this->groupContacts->add($groupContact);
            $groupContact->setGroupe($this);
        }

        return $this;
    }

    public function removeGroupContact(GroupContact $groupContact): static
    {
        if ($this->groupContacts->removeElement($groupContact)) {
            // set the owning side to null (unless already changed)
            if ($groupContact->getGroupe() === $this) {
                $groupContact->setGroupe(null);
            }
        }

        return $this;
    }
}
