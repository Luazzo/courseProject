<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Town
 *
 * @ORM\Table(name="towns")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TownRepository")
 */
class Town
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
     * @ORM\Column(name="town", type="string", length=255)
     */
    private $town;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="User", mappedBy="town")
     */
    private $users;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Zip", mappedBy="town")
     */
    private $zips;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Locality", mappedBy="town")
     */
    private $localities;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->localities = new ArrayCollection();
        $this->zips= new ArrayCollection();
    }

    public function __toString()
    {
        return $this->town;
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
        //$user->setTown($this);
    }

    /**
     * @param mixed $user
     */
    public function removeUser($user)
    {
        $this->users->removeElement($user);
        // uncomment if you want to update other side
        //$user->setTown(null);
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
        //$zip->setTown($this);
    }

    /**
     * @param mixed $zip
     */
    public function removeZip($zip)
    {
        $this->zips->removeElement($zip);
        // uncomment if you want to update other side
        //$zip->setTown(null);
    }


    /**
     * @return ArrayCollection
     */
    public function getLocalities()
    {
        return $this->localities;
    }

    /**
     * @param ArrayCollection $localities
     */
    public function setLocalities($localities)
    {
        $this->localities = $localities;
    }

    /**
     * @param mixed $locality
     */
    public function addLocality($locality)
    {
        $this->localities->add($locality);
        // uncomment if you want to update other side
        //$locality->setTown($this);
    }

    /**
     * @param mixed $locality
     */
    public function removeLocality($locality)
    {
        $this->localities->removeElement($locality);
        // uncomment if you want to update other side
        //$locality->setTown(null);
    }


    /**
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @param string $town
     */
    public function setTown($town)
    {
        $this->town = $town;
    }

}

