<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
//use Sonata\ClassificationBundle\Model\CategoryInterface;
use Sonata\MediaBundle\Entity\BaseMedia;

/**
 * @ORM\Entity
 * @ORM\Table(name="media__media")
 */
class SonataMediaMedia extends BaseMedia
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    // NEXT_MAJOR: Uncomment this method and remove __call and __set
     final public function setCategory($category = null): void
     {
         $this->category = $category;
     }
}
