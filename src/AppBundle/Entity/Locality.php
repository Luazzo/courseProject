<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Locality
 *
 * @ORM\Table(name="localities")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LocalityRepository")
 */
class Locality
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
     * @ORM\Column(name="locality", type="string", length=255)
     */
    private $locality;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="User", mappedBy="locality")
     */
    private $users;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Zip", mappedBy="locality")
     */
    private $zips;

    /**
     * @ORM\ManyToOne(targetEntity="Town", inversedBy="localities")
     */
    protected  $town;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->zips = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->locality;
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
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param ArrayCollection $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

    /**
     * @param mixed $user
     */
    public function addUser($user)
    {
        $this->users->add($user);
        // uncomment if you want to update other side
        //$user->setLocality($this);
    }

    /**
     * @param mixed $user
     */
    public function removeUser($user)
    {
        $this->users->removeElement($user);
        // uncomment if you want to update other side
        //$user->setLocality(null);
    }


    /**
     * @return ArrayCollection
     */
    public function getZips()
    {
        return $this->zips;
    }

    /**
     * @param ArrayCollection $zips
     */
    public function setZips($zips)
    {
        $this->zips = $zips;
    }

    /**
     * @param mixed $zip
     */
    public function addZip($zip)
    {
        $this->zips->add($zip);
        // uncomment if you want to update other side
        //$zip->setLocality($this);
    }

    /**
     * @param mixed $zip
     */
    public function removeZip($zip)
    {
        $this->zips->removeElement($zip);
        // uncomment if you want to update other side
        //$zip->setLocality(null);
    }


    /**
     * @return mixed
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @param mixed $town
     */
    public function setTown($town)
    {
        $this->town = $town;
    }

    /**
     * @return string
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * @param string $locality
     */
    public function setLocality($locality)
    {
        $this->locality = $locality;
    }

}

