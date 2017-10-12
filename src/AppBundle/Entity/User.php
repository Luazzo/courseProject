<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository") *
 * @ORM\InheritanceType
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="user_type", type="string")
 * @ORM\DiscriminatorMap({"admin"="User","provider" = "Provider", "member" = "Member"})
 */
class User
{
    const TYPE_USER = "admin";
    const TYPE_PROVIDER = "provider";
    const TYPE_VISITOR = "member";

    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_PROVIDER = 'ROLE_PROVIDER';
    const ROLE_MEMBER = 'ROLE_MEMBER';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    protected $password;

    /**
     * @var string
     *
     * @ORM\Column(name="address_number", type="string", length=255, nullable=true)
     */
    protected $addressNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="address_street", type="string", length=255, nullable=true)
     */
    protected $addressStreet;

    /**
     * @ORM\ManyToOne(targetEntity="Town", inversedBy="users")
     */
    protected $town;

    /**
     * @ORM\ManyToOne(targetEntity="Locality", inversedBy="users")
     */
    protected $locality;

    /**
     * @ORM\ManyToOne(targetEntity="Zip", inversedBy="users")
     */
    protected $zip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registration", type="date")
     */
    protected $registration;

    /**
     * @var int
     *
     * @ORM\Column(name="attempts", type="integer")
     */
    protected $attempts;

    /**
     * @var bool
     *
     * @ORM\Column(name="enable", type="boolean")
     */
    protected $enable;

    /**
     * @var bool
     *
     * @ORM\Column(name="confirm_reg", type="boolean")
     */
    protected $confirmReg;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Block",mappedBy="user")
     */
    protected $blocks;

    /**
     * Constructor
     */
    public function __construct(){
        parent:: __construct();
        $this->blocks=new ArrayCollection();
        $this->registration=new \DateTime();
        $this->addRole('role_admin');
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
     * @return mixed
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * @param mixed $locality
     */
    public function setLocality($locality)
    {
        $this->locality = $locality;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param mixed $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return ArrayCollection
     */
    public function getBlocks()
    {
        return $this->blocks;
    }

    /**
     * @param ArrayCollection $blocks
     */
    public function setBlocks($blocks)
    {
        $this->blocks = $blocks;
    }

    /**
     * @param mixed $block
     */
    public function addBlock($block)
    {
        $this->blocks->add($block);
        // uncomment if you want to update other side
        //$block->setUser($this);
    }

    /**
     * @param mixed $block
     */
    public function removeBlock($block)
    {
        $this->blocks->removeElement($block);
        // uncomment if you want to update other side
        //$block->setUser(null);
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
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getAddressNumber()
    {
        return $this->addressNumber;
    }

    /**
     * @param string $addressNumber
     */
    public function setAddressNumber($addressNumber)
    {
        $this->addressNumber = $addressNumber;
    }

    /**
     * @return string
     */
    public function getAddressStreet()
    {
        return $this->addressStreet;
    }

    /**
     * @param string $addressStreet
     */
    public function setAddressStreet($addressStreet)
    {
        $this->addressStreet = $addressStreet;
    }

    /**
     * @return \DateTime
     */
    public function getRegistration()
    {
        return $this->registration;
    }

    /**
     * @param \DateTime $registration
     */
    public function setRegistration($registration)
    {
        $this->registration = $registration;
    }

    /**
     * @return string
     */
    public function getUserType()
    {
        return $this->userType;
    }

    /**
     * @param string $userType
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;
    }

    /**
     * @return int
     */
    public function getAttempts()
    {
        return $this->attempts;
    }

    /**
     * @param int $attempts
     */
    public function setAttempts($attempts)
    {
        $this->attempts = $attempts;
    }

    /**
     * @return bool
     */
    public function isEnable()
    {
        return $this->enable;
    }

    /**
     * @param bool $enable
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    /**
     * @return bool
     */
    public function isConfirmReg()
    {
        return $this->confirmReg;
    }

    /**
     * @param bool $confirmReg
     */
    public function setConfirmReg($confirmReg)
    {
        $this->confirmReg = $confirmReg;
    }

}

