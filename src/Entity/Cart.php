<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
#[ApiResource]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToMany(targetEntity: Article::class, mappedBy: 'cart')]
    private $articles;

    #[ORM\OneToMany(mappedBy: 'cart', targetEntity: CartArticle::class)]
    private $cartArticle;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->cartArticle = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->addCart($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            $article->removeCart($this);
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
            $cartArticle->setCart($this);
        }

        return $this;
    }

    public function removeCartArticle(CartArticle $cartArticle): self
    {
        if ($this->cartArticle->removeElement($cartArticle)) {
            // set the owning side to null (unless already changed)
            if ($cartArticle->getCart() === $this) {
                $cartArticle->setCart(null);
            }
        }

        return $this;
    }
}
