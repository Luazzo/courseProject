<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SearchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('keyword', TextType::class, array(
                'required' => false
                )
            )

            ->add('locality', EntityType::class, array(
                'class'        => 'AppBundle:Locality',
                'choice_label' => 'locality',
                'multiple'     => false,
                'placeholder'  => "Locality",
                'label'        => false,
                'required'     => false,
            ))

            ->add('category', EntityType::class, array(
                'class'        => 'AppBundle:Category',
                'choice_label' => 'name',
                'multiple'     => false,
                'placeholder'  => "Category",
                'required' => false,

            ));
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'error_bubbling' => true
        ));
    }


    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_search';
    }


}
