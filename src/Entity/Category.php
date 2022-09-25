<?php

namespace App\Entity;

use App\Entity\Common\IdTrait;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface as KnpTranslatorInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Knp\DoctrineBehaviors\Contract\Entity\SluggableInterface;
use Knp\DoctrineBehaviors\Model\Sluggable\SluggableTrait;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Category implements KnpTranslatorInterface
{
    use TranslatableTrait;
    use IdTrait;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, inversedBy="categories", fetch="EXTRA_LAZY")
     */
    private $products;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Version
     */
    protected $version;
    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->products = new ArrayCollection();
       $this->translator =  $translator;
    }

    public function __call($method, $arguments)
    {
        return PropertyAccess::createPropertyAccessor()->getValue($this->translate(), $method);
    }
    public function __toString()
    {
        return $this->getName() ?: ''; // shown in the breadcrumb on the create view
    }
    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->products->removeElement($product);

        return $this;
    }

    public function getName()
    {
        return $this->translate()->getName();
    }
}
