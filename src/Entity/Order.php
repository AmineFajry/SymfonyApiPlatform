<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: ['store' => 'exact'])]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $appointmentDate;

    #[ORM\Column(type: 'string', length: 255)]
    private $status;

    #[ORM\OneToMany(mappedBy: 'order_', targetEntity: OrderArticle::class)]
    private $orderArticle;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'orders')]
    private $user;

    #[ORM\ManyToOne(targetEntity: Store::class, inversedBy: 'order_')]
    private $store;

    public function __construct()
    {
        $this->orderArticle = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAppointmentDate(): ?\DateTimeInterface
    {
        return $this->appointmentDate;
    }

    public function setAppointmentDate(\DateTimeInterface $appointmentDate): self
    {
        $this->appointmentDate = $appointmentDate;

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

    /**
     * @return Collection|OrderArticle[]
     */
    public function getOrderArticle(): Collection
    {
        return $this->orderArticle;
    }

    public function addOrderArticle(OrderArticle $orderArticle): self
    {
        if (!$this->orderArticle->contains($orderArticle)) {
            $this->orderArticle[] = $orderArticle;
            $orderArticle->setOrder($this);
        }

        return $this;
    }

    public function removeOrderArticle(OrderArticle $orderArticle): self
    {
        if ($this->orderArticle->removeElement($orderArticle)) {
            // set the owning side to null (unless already changed)
            if ($orderArticle->getOrder() === $this) {
                $orderArticle->setOrder(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getStore(): ?Store
    {
        return $this->store;
    }

    public function setStore(?Store $store): self
    {
        $this->store = $store;

        return $this;
    }
}
