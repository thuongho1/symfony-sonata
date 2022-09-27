<?php

namespace App\Entity;

use App\Entity\Common\IdTrait;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product implements TranslatableInterface
{
    use TranslatableTrait;
    use IdTrait;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, mappedBy="products", fetch="EXTRA_LAZY")
     */
    private $categories;
    /**
     * @ORM\Column(type="integer")
     * @ORM\Version
     */
    protected $version;

    /**
     * @Assert\Valid
     */
    protected $translations;
//private $translator;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
//        $this->translator = $translator;
    }
    public function __call($method, $arguments)
    {
        return PropertyAccess::createPropertyAccessor()->getValue($this->translate(), $method);
    }

    public function __toString()
    {
        return $this->getName() ?: 'Product'; // shown in the breadcrumb on the create view
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

//    public function setDescription($description)
//    {
//        $this->description = $description;
//    }
//
//    public function getDescription()
//    {
//        return $this->description;
//    }


    public function getVersion(): ?float
    {
        return $this->version;
    }

    public function setVersion(int $version): self
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addProduct($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeProduct($this);
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
//    public function getName()
//    {
//        return $this->translate()->getName();
//    }
}
