<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/** 
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\AssUser")
 * @ORM\Table(name="ass_users") 
 */
class AssUser
{
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    private $id;

    /**
     * Bidirectional - Many users have Many favorite comments (OWNING SIDE)
     *
     * @ORM\ManyToMany(targetEntity="AssComment", inversedBy="userFavorites")
     * @ORM\JoinTable(name="user_favorite_comments")
     */
    private $favorites;

    /**
     * Unidirectional - Many users have marked many comments as read
     *
     * @ORM\ManyToMany(targetEntity="AssComment")
     * @ORM\JoinTable(name="user_read_comments")
     */
    private $commentsRead;

    /**
     * Bidirectional - One-To-Many (INVERSE SIDE)
     *
     * @ORM\OneToMany(targetEntity="AssComment", mappedBy="author")
     */
    private $commentsAuthored;

    /**
     * Unidirectional - Many-To-One
     *
     * @ORM\OneToOne(targetEntity="AssComment")
     */
    private $firstComment;
    
    public function getReadComments()
    {
        return $this->commentsRead;
    }
    
    public function setFirstComment (\Application\Entity\AssComment $c)
    {
        $this->firstComment = $c;
    }
}