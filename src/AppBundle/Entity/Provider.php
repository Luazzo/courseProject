<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\User;

/**
 * Provider
 *
 * @ORM\Table(name="providers")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProviderRepository")
 */
class Provider extends User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="site", type="string", length=255)
     */
    private $site;

    /**
     * @var string
     *
     * @ORM\Column(name="email_company", type="string", length=255)
     */
    private $emailCompany;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_company", type="string", length=255)
     */
    private $telCompany;

    /**
     * @var string
     *
     * @ORM\Column(name="tva", type="string", length=255)
     */
    private $tva;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Promotion", mappedBy="provider")
     */
    private $promotions;
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Course", mappedBy="provider")
     */
    private $courses;
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="provider")
     */
    private $comments;
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Image", mappedBy="provider")
     */
    private $images;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Category", mappedBy="providers")
     */
    private $categories;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Favorite", mappedBy="provider")
     */
    private $favorites;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Rating", mappedBy="provider")
     */
    private $ratings;

    /**
     * Constructor
     */
    public function __construct(){
        parent:: __construct();
        $this->user_type=User::TYPE_PROVIDER;
        $this->promotions=new ArrayCollection();
        $this->courses=new ArrayCollection();
        $this->comments=new ArrayCollection();
        $this->images=new ArrayCollection();
        $this->categories=new ArrayCollection();
        $this->favorites=new ArrayCollection();
        $this->ratings=new ArrayCollection();
        $this->addRole('role_provider');
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
     * @return string
     */
    public function getUserType()
    {
        return $this->user_type;
    }

    /**
     * @param string $user_type
     */
    public function setUserType($user_type)
    {
        $this->user_type = $user_type;
    }

    /**
     * @return ArrayCollection
     */
    public function getPromotions()
    {
        return $this->promotions;
    }

    /**
     * @param ArrayCollection $promotions
     */
    public function setPromotions($promotions)
    {
        $this->promotions = $promotions;
    }

    /**
     * @param mixed $promotion
     */
    public function addPromotion($promotion)
    {
        $this->promotions->add($promotion);
        // uncomment if you want to update other side
        //$promotion->setProvider($this);
    }

    /**
     * @param mixed $promotion
     */
    public function removePromotion($promotion)
    {
        $this->promotions->removeElement($promotion);
        // uncomment if you want to update other side
        //$promotion->setProvider(null);
    }


    /**
     * @return ArrayCollection
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * @param ArrayCollection $courses
     */
    public function setCourses($courses)
    {
        $this->courses = $courses;
    }

    /**
     * @param mixed $course
     */
    public function addCourse($course)
    {
        $this->courses->add($course);
        // uncomment if you want to update other side
        //$course->setProvider($this);
    }

    /**
     * @param mixed $course
     */
    public function removeCourse($course)
    {
        $this->courses->removeElement($course);
        // uncomment if you want to update other side
        //$course->setProvider(null);
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
        //$comment->setProvider($this);
    }

    /**
     * @param mixed $comment
     */
    public function removeComment($comment)
    {
        $this->comments->removeElement($comment);
        // uncomment if you want to update other side
        //$comment->setProvider(null);
    }


    /**
     * @return ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param ArrayCollection $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    /**
     * @param mixed $image
     */
    public function addImage($image)
    {
        $this->images->add($image);
        // uncomment if you want to update other side
        //$image->setProvider($this);
    }

    /**
     * @param mixed $image
     */
    public function removeImage($image)
    {
        $this->images->removeElement($image);
        // uncomment if you want to update other side
        //$image->setProvider(null);
    }


    /**
     * @return ArrayCollection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param ArrayCollection $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * @param mixed $category
     */
    public function addCategory($category)
    {
        $this->categories->add($category);
        // uncomment if you want to update other side
        //$category->setProvider($this);
    }

    /**
     * @param mixed $category
     */
    public function removeCategory($category)
    {
        $this->categories->removeElement($category);
        // uncomment if you want to update other side
        //$category->setProvider(null);
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
        //$favorite->setProvider($this);
    }

    /**
     * @param mixed $favorite
     */
    public function removeFavorite($favorite)
    {
        $this->favorites->removeElement($favorite);
        // uncomment if you want to update other side
        //$favorite->setProvider(null);
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
        //$rating->setProvider($this);
    }

    /**
     * @param mixed $rating
     */
    public function removeRating($rating)
    {
        $this->ratings->removeElement($rating);
        // uncomment if you want to update other side
        //$rating->setProvider(null);
    }


    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return string
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param string $site
     */
    public function setSite($site)
    {
        $this->site = $site;
    }

    /**
     * @return string
     */
    public function getEmailCompany()
    {
        return $this->emailCompany;
    }

    /**
     * @param string $emailCompany
     */
    public function setEmailCompany($emailCompany)
    {
        $this->emailCompany = $emailCompany;
    }

    /**
     * @return string
     */
    public function getTelCompany()
    {
        return $this->telCompany;
    }

    /**
     * @param string $telCompany
     */
    public function setTelCompany($telCompany)
    {
        $this->telCompany = $telCompany;
    }

    /**
     * @return string
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * @param string $tva
     */
    public function setTva($tva)
    {
        $this->tva = $tva;
    }

}

