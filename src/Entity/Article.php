<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ApiResource]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'integer')]
    private $quantity;

    #[ORM\Column(type: 'float')]
    private $price;

    #[ORM\Column(type: 'string', length: 255)]
    private $imageUrl;

    #[ORM\ManyToOne(targetEntity: Store::class, inversedBy: 'articles')]
    private $store;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: OrderArticle::class)]
    private $orderArticle;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: CartArticle::class)]
    private $cartArticle;

    public function __construct()
    {
        $this->orderArticle = new ArrayCollection();
        $this->cart = new ArrayCollection();
        $this->cartArticle = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

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
            $orderArticle->setArticle($this);
        }

        return $this;
    }

    public function removeOrderArticle(OrderArticle $orderArticle): self
    {
        if ($this->orderArticle->removeElement($orderArticle)) {
            // set the owning side to null (unless already changed)
            if ($orderArticle->getArticle() === $this) {
                $orderArticle->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CartArticle[]
     */
    public function getCartArticle(): Collection
    {
        return $this->cartArticle;
    }

    public function addCartArticle(CartArticle $cartArticle): self
    {
        if (!$this->cartArticle->contains($cartArticle)) {
            $this->cartArticle[] = $cartArticle;
            $cartArticle->setArticle($this);
        }

        return $this;
    }

    public function removeCartArticle(CartArticle $cartArticle): self
    {
        if ($this->cartArticle->removeElement($cartArticle)) {
            // set the owning side to null (unless already changed)
            if ($cartArticle->getArticle() === $this) {
                $cartArticle->setArticle(null);
            }
        }

        return $this;
    }
}
