<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\Bug")
 * @ORM\Table(name="bugs")
 */
class Bug
{
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;
    
    /** @ORM\Column(type="string") */
    protected $description;
    
    /** @ORM\Column(type="datetime") */
    protected $created;
    
    /** @ORM\Column(type="string") */
    protected $status;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Product")
     **/
    protected $products = null;
    
    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\User", inversedBy="assignedBugs")
     **/
    protected $engineer;
    
    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\User", inversedBy="reportedBugs")
     **/
    protected $reporter;
    
    public function __construct()
    {
        $this->products = new ArrayCollection();
    }
    
    public function assignToProduct($product)
    {
        $this->products[] = $product;
    }
    
    public function getProducts()
    {
        return $this->products;
    }
    
    public function setEngineer($engineer)
    {
        $engineer->assignedToBug($this);
        $this->engineer = $engineer;
    }
    
    public function setReporter($reporter)
    {
        $reporter->addReportedBug($this);
        $this->reporter = $reporter;
    }
    
    public function getEngineer()
    {
        return $this->engineer;
    }
    
    public function getReporter()
    {
        return $this->reporter;
    }
    

    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }
}