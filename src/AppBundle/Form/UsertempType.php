<?php

namespace AppBundle\Form;

use AppBundle\Entity\UserTemp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class UserTempType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $tokenTemp = bin2hex(random_bytes(16));

        $builder
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password')
            ))
            ->add('type', ChoiceType::class, array(
                'choices' => array(
                    'Provider' => "provider",
                    'Member' => 'member',
                ),
                'expanded' => true,
                'multiple' => false,
                'required' => true
            ))
            ->add('tokenTemp', HiddenType::class, array(
                             'data' => "$tokenTemp",))
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\UserTemp'
        ));
    }

    public function getBlockPrefix()
    {
        return 'appbundle_usertemp';
    }


}
