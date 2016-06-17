<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('title', 'text', array(
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ))
                ->add('dateofpublication', 'date', array(
                    'years' => range(date('Y'), date('Y') - 100),
                    'data' => new \DateTime("first day of january"),
                    'placeholder' => array(
                        'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                    ),
                    'format' => 'dd-MM-yyyy',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'required' => false
                ))
                ->add('category', 'entity', array(
                    'class' => 'AppBundle:Category',
                    'choice_label' => 'wording',
                    'attr' => array(
                        'class' => 'form-control'
                    )
        ));
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Publication',
        ));
    }

    public function getBlockPrefix() {
        return 'app_form_publication';
    }

    // For Symfony 2.x
    public function getName() {
        return $this->getBlockPrefix();
    }

}
