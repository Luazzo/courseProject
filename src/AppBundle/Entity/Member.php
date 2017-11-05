<?php

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\User;

/**
 * Member
 *
 * @ORM\Table(name="members")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MemberRepository")
 */
class Member extends User
{

    /**
     * @var bool
     *
     * @ORM\Column(name="newsletter", type="boolean")
     */
    protected $newsletter;

    /**
     * @var Image
     * @ORM\OneToOne(targetEntity="Image")
     */
    protected $image;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Abuse", mappedBy="member")
     */
    protected $abuses;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="member")
     */
    protected $comments;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Favorite", mappedBy="member")
     */
    protected $favorites;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Rating", mappedBy="member")
     */
    protected $ratings;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="OrdreBlock", mappedBy="member")
     */
    protected $ordreblocks;

    /**
     * Constructor
     */
    public function __construct(){
        parent:: __construct();
        $this->abuses=new ArrayCollection();
        $this->comments=new ArrayCollection();
        $this->ratings=new ArrayCollection();
        $this->favorites=new ArrayCollection();
        $this->ordreblocks=new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection
     */
    public function getOrdreblocks()
    {
        return $this->ordreblocks;
    }

    /**
     * @param ArrayCollection $ordreblocks
     */
    public function setOrdreblocks($ordreblocks)
    {
        $this->ordreblocks = $ordreblocks;
    }

    /**
     * @return mixed
     */
    public function getUserType()
    {
        return $this->user_type;
    }

    /**
     * @param mixed $user_type
     */
    public function setUserType($user_type)
    {
        $this->user_type = $user_type;
    }

    /**
     * @return Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param Image $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return ArrayCollection
     */
    public function getAbuses()
    {
        return $this->abuses;
    }

    /**
     * @param ArrayCollection $abuses
     */
    public function setAbuses($abuses)
    {
        $this->abuses = $abuses;
    }

    /**
     * @param mixed $abuse
     */
    public function addAbuse($abuse)
    {
        $this->abuses->add($abuse);
        // uncomment if you want to update other side
        //$abuse->setMember($this);
    }

    /**
     * @param mixed $abuse
     */
    public function removeAbuse($abuse)
    {
        $this->abuses->removeElement($abuse);
        // uncomment if you want to update other side
        //$abuse->setMember(null);
    }


    /**
     * @return ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param ArrayCollection $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @param mixed $comment
     */
    public function addComment($comment)
    {
        $this->comments->add($comment);
        // uncomment if you want to update other side
        //$comment->setMember($this);
    }

    /**
     * @param mixed $comment
     */
    public function removeComment($comment)
    {
        $this->comments->removeElement($comment);
        // uncomment if you want to update other side
        //$comment->setMember(null);
    }


    /**
     * @return ArrayCollection
     */
    public function getFavorites()
    {
        return $this->favorites;
    }

    /**
     * @param ArrayCollection $favorites
     */
    public function setFavorites($favorites)
    {
        $this->favorites = $favorites;
    }

    /**
     * @param mixed $favorite
     */
    public function addFavorite($favorite)
    {
        $this->favorites->add($favorite);
        // uncomment if you want to update other side
        //$favorite->setMember($this);
    }

    /**
     * @param mixed $favorite
     */
    public function removeFavorite($favorite)
    {
        $this->favorites->removeElement($favorite);
        // uncomment if you want to update other side
        //$favorite->setMember(null);
    }


    /**
     * @return ArrayCollection
     */
    public function getRatings()
    {
        return $this->ratings;
    }

    /**
     * @param ArrayCollection $ratings
     */
    public function setRatings($ratings)
    {
        $this->ratings = $ratings;
    }

    /**
     * @param mixed $rating
     */
    public function addRating($rating)
    {
        $this->ratings->add($rating);
        // uncomment if you want to update other side
        //$rating->setMember($this);
    }

    /**
     * @param mixed $rating
     */
    public function removeRating($rating)
    {
        $this->ratings->removeElement($rating);
        // uncomment if you want to update other side
        //$rating->setMember(null);
    }


    /**
     * @return bool
     */
    public function isNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * @param bool $newsletter
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;
    }

}

