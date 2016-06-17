<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class RegistrationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('email', EmailType::class, array(
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ))
                ->add('username', TextType::class, array(
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ))
                ->add('plainPassword', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'invalid_message' => 'The password fields must match.',
                    'options' => array('attr' => array('class' => 'form-control')),
                    'required' => true,
                    'first_options' => array('label' => 'Password'),
                    'second_options' => array('label' => 'Repeat Password'),
                ))
                ->add('firstname', TextType::class, array(
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ))
                ->add('lastname', TextType::class, array(
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ))
                ->add('dateofbirth', BirthdayType::class, array(
                    'placeholder' => array(
                        'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                    ),
                    'format' => 'dd-MM-yyyy',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ))
                ->add('phonenumber', TextType::class, array(
                    'attr' => array(
                        'class' => 'form-control'
                    )
        ));
    }

    public function getParent() {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix() {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName() {
        return $this->getBlockPrefix();
    }

}

?>