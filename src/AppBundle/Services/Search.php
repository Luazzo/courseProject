<?php
namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;

class Search{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    public function __construct(EntityManager $em) {
        $this->entityManager = $em;
    }

    public function providersSearch($keyword, $category, $locality) {

        $providers = null;

        switch (true){
            case $keyword !=='':
                $providers=$this->entityManager->getRepository('AppBundle:Provider')->findWithKeyword($keyword);
                break;
            case $locality!=='':
                $providers=$this->entityManager->getRepository('AppBundle:Provider')->findWithLocality($locality);
                break;
            case $category!=='':
                $providers=$this->entityManager->getRepository('AppBundle:Provider')->findWithCategory($category);
                break;
            case ( $locality !== '' && $category !== '' ):
                $providers=$this->entityManager->getRepository('AppBundle:Provider')->findWithLocalityCategory($locality,$category);
                break;
            case ($keyword !=='' && $locality !== ''):
                $providers=$this->entityManager->getRepository('AppBundle:Provider')->findWithKeywordLocality($keyword,$locality);
                break;
            case ($keyword !=='' &&  $locality !== '' && $category !== '' ):
                $providers=$this->entityManager->getRepository('AppBundle:Provider')->findWithKeywordLocalityCategory($keyword,$locality,$category);
                break;

            default:
                $providers=$this->entityManager->getRepository('AppBundle:Provider')->bestProviders('*');
        }

        return $providers;
    }
}

