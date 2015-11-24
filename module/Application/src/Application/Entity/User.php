<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/** 
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\Product")
 * @ORM\Table(name="users") 
 */
class User
{
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $name;
    
    /** @ORM\OneToMany(targetEntity="Application\Entity\Bug", mappedBy="reporter") */
    private $reportedBugs = null;
    
    /** @ORM\OneToMany(targetEntity="Application\Entity\Bug", mappedBy="engineer") */
    private $assignedBugs = null;

    public function __construct()
    {
        $this->reportedBugs = new ArrayCollection();
        $this->assignedBugs = new ArrayCollection();
    }

    public function addReportedBug($bug)
    {
        $this->reportedBugs[] = $bug;
    }
    
    public function assignedToBug($bug)
    {
        $this->assignedBugs[] = $bug;
    }

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