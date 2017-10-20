<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Block
 *
 * @ORM\Table(name="blocks")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BlockRepository")
 */
class Block
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
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="OrdreBlock", mappedBy="block")
     */
    private $ordreblocks;

    /**
     * Constructor
     */
    public function __construct(){
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
     * @param mixed $ordreblock
     */
    public function addOrdreblock($ordreblock)
    {
        $this->ordreblocks->add($ordreblock);
        // uncomment if you want to update other side
        //$ordreblock->setBlock($this);
    }

    /**
     * @param mixed $ordreblock
     */
    public function removeOrdreblock($ordreblock)
    {
        $this->ordreblocks->removeElement($ordreblock);
        // uncomment if you want to update other side
        //$ordreblock->setBlock(null);
    }


}

