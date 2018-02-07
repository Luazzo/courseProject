<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="user_type", type="string")
 * @ORM\DiscriminatorMap({"admin"="User","provider" = "Provider", "member" = "Member"})
 * @UniqueEntity("username",message="This username is already in use on that host.")
 * @UniqueEntity("email",message="This email is already in use on that host.")
 */
class User implements AdvancedUserInterface, \Serializable
{
    const TYPE_ADMIN = "admin";
    const TYPE_PROVIDER = "provider";
    const TYPE_MEMBER = "member";

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
     * @ORM\Column(name="username", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $username;

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
     * @var array
     *
     * @ORM\Column(name="role", type="array")
     */
    protected $roles;


    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    protected $password;


    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="address_number", type="string", length=255)
     */
    protected $addressNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="address_street", type="string", length=255)
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
    protected $attempts = "0";

    /**
     * @var bool
     *
     * @ORM\Column(name="enable", type="boolean")
     */
    protected $enable = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="confirm_reg", type="boolean")
     */
    protected $confirmReg = false;
    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    protected $salt;



    /**
     * Constructor
     */
    public function __construct(){
        $this->registration=new \DateTime();
        $this->enable=true;
        $this->salt = "MONSALTPARDEFAUT";
    }

    public function __toString(){
        return $this->name.' '.$this->firstName;
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
     * @param mixed $role
     */
    public function addRole($role)
    {
        $this->roles[] = $role;
    }
    /**
     * @param mixed $role
     */
    public function removeRole($role)
    {
        if ($key = array_search($role, $this->roles, true) !== false) {
            array_splice($this->roles, $key, 1);
        }
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
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
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
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
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
    public function isAccountNonExpired()
    {
        return true;
    }
    public function isAccountNonLocked()
    {
        return true;
    }
    public function isCredentialsNonExpired()
    {
        return true;
    }
     /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            //$this->salt,
        ));
    }
    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
           // $this->salt
            ) = unserialize($serialized);
    }
    public function getRoles()
    {
       return $this->roles;
    }

       public function eraseCredentials()
    {
        $this->plainPassword=null;
    }

        public function getSalt()
    {
        return null;
    }

        public function isEnabled()
    {
        return $this->enable;
    }
}

