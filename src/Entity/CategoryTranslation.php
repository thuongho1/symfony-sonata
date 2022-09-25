<?php

namespace App\Entity;

use App\Entity\Common\IdTrait;
use App\Repository\CategoryTranslationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\SluggableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Sluggable\SluggableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;


/**
 * @ORM\Entity(repositoryClass=CategoryTranslationRepository::class)
 */
class CategoryTranslation implements SluggableInterface, TranslationInterface
{
    use TranslationTrait;
    use SluggableTrait;
    use IdTrait;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    public function shouldGenerateUniqueSlugs(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function getSluggableFields(): array
    {
        return ['name'];
    }

    private function getSlugDelimiter(): string
    {
        return '_';
    }
}
