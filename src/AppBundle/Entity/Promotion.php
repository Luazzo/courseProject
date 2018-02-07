<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Promotion
 *
 * @ORM\Table(name="promotions")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PromotionRepository")
 */
class Promotion
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
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="pdf", type="blob")
     */
    private $pdf;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="date")
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="finish", type="date")
     */
    private $finish;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="display_start", type="date")
     */
    private $displayStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="display_finish", type="date")
     */
    private $displayFinish;

    /**
     * @ORM\ManyToOne(targetEntity="Provider", inversedBy="promotions")
     */
    private $provider;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="promotions")
     */
    private $category;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Image", mappedBy="promotion")
     */
    private $images;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->start;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images=new ArrayCollection();
        $this->start=new DateTime();
        $this->finish=new DateTime();
        $this->displayFinish=new DateTime();
        $this->displayStart=new DateTime();
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
     * @return mixed
     */
    public  function getSlug(){
        return $this->slug;
    }/**
     * @param mixed $slug
     */
    public  function setSlug($slug):void {
        $this->slug = $slug;
    }



    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param mixed $provider
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
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
        //$image->setPromotion($this);
    }

    /**
     * @param mixed $image
     */
    public function removeImage($image)
    {
        $this->images->removeElement($image);
        // uncomment if you want to update other side
        //$image->setPromotion(null);
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
     * @return string
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * @param string $pdf
     */
    public function setPdf($pdf)
    {
        $this->pdf = $pdf;
    }

    /**
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param \DateTime $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @return \DateTime
     */
    public function getFinish()
    {
        return $this->finish;
    }

    /**
     * @param \DateTime $finish
     */
    public function setFinish($finish)
    {
        $this->finish = $finish;
    }

    /**
     * @return \DateTime
     */
    public function getDisplayStart()
    {
        return $this->displayStart;
    }

    /**
     * @param \DateTime $displayStart
     */
    public function setDisplayStart($displayStart)
    {
        $this->displayStart = $displayStart;
    }

    /**
     * @return \DateTime
     */
    public function getDisplayFinish()
    {
        return $this->displayFinish;
    }

    /**
     * @param \DateTime $displayFinish
     */
    public function setDisplayFinish($displayFinish)
    {
        $this->displayFinish = $displayFinish;
    }

}

