<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname' , 'text', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Enter your first name'
                    )
                ))
                ->add('lastname' , 'text', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Enter your last name'
                    )
                ))
                ->add('dateofbirth' , 'date', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Enter your date of birthday'
                    )
                ))
                ->add('phonenumber' , 'text', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Enter your phone number'
                    )
                ))
                // ->add('teams' , 'text', array(
                //     'attr' => array(
                //         'placeholder' => 'Enter your research team'
                //     )
                // ));
                ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
?>