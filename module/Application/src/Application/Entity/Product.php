<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** 
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\Product")
 * @ORM\Table(name="products") 
 */
class Product {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $name;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}