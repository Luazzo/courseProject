<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Provider
 *
 * @ORM\Table(name="providers")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProviderRepository")
 */
class Provider
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

