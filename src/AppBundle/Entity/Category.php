<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="forward", type="boolean")
     */
    private $forward;

    /**
     * @var bool
     *
     * @ORM\Column(name="valid", type="boolean")
     */
    private $valid;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Provider", inversedBy="categories")
     */
    private $providers;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Image", mappedBy="category")
     */
    private $images;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Promotion", mappedBy="category")
     */
    private $promotions;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Course", mappedBy="category")
     */
    private $courses;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->description;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->promotions=new ArrayCollection();
        $this->images=new ArrayCollection();
        $this->providers=new ArrayCollection();
        $this->courses=new ArrayCollection();
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
    public function getProviders()
    {
        return $this->providers;
    }

    /**
     * @param ArrayCollection $providers
     */
    public function setProviders($providers)
    {
        $this->providers = $providers;
    }

    /**
     * @param mixed $provider
     */
    public function addProvider($provider)
    {
        $this->providers->add($provider);
        // uncomment if you want to update other side
        //$provider->setCategory($this);
    }

    /**
     * @param mixed $provider
     */
    public function removeProvider($provider)
    {
        $this->providers->removeElement($provider);
        // uncomment if you want to update other side
        //$provider->setCategory(null);
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
        //$course->setCategory($this);
    }

    /**
     * @param mixed $course
     */
    public function removeCourse($course)
    {
        $this->courses->removeElement($course);
        // uncomment if you want to update other side
        //$course->setCategory(null);
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
        //$image->setCategory($this);
    }

    /**
     * @param mixed $image
     */
    public function removeImage($image)
    {
        $this->images->removeElement($image);
        // uncomment if you want to update other side
        //$image->setCategory(null);
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
        //$promotion->setCategory($this);
    }

    /**
     * @param mixed $promotion
     */
    public function removePromotion($promotion)
    {
        $this->promotions->removeElement($promotion);
        // uncomment if you want to update other side
        //$promotion->setCategory(null);
    }
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return bool
     */
    public function isForward()
    {
        return $this->forward;
    }

    /**
     * @param bool $forward
     */
    public function setForward($forward)
    {
        $this->forward = $forward;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->valid;
    }

    /**
     * @param bool $valid
     */
    public function setValid($valid)
    {
        $this->valid = $valid;
    }

}

