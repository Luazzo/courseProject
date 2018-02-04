<?php

namespace AppBundle\Form\Front;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProviderType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('company')
        ->add('site')
        ->add('emailCompany')
        ->add('telCompany')
        ->add('tva')
        ->add('name')
        ->add('firstName')
        ->add('email')
        ->add('addressNumber')
        ->add('addressStreet')
        ->add('categories')
        ->add('town')
        ->add('locality')
        ->add('zip')
        ->add('presentation');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Provider'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_provider';
    }


}
