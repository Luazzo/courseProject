<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrdreBlock
 *
 * @ORM\Table(name="ordre_block")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrdreBlockRepository")
 */
class OrdreBlock
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
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre;


    /**
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="ordreblocks")
     */
    private $member;

    /**
     * @ORM\ManyToOne(targetEntity="Block", inversedBy="ordreblocks")
     */
    private $block;

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
    public function getMember()
    {
        return $this->member;
    }

    /**
     * @param mixed $member
     */
    public function setMember($member)
    {
        $this->member = $member;
    }


    /**
     * @return mixed
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * @param mixed $block
     */
    public function setBlock($block)
    {
        $this->block = $block;
    }



    /**
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return OrdreBlock
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return int
     */
    public function getOrdre()
    {
        return $this->ordre;
    }
}

