<?php

namespace VeryGoodTrip\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', 'textarea')
            ->add('rating', 'choice', array (
                    'choices' => array(
                        1 => 1,
                        2 => 2,
                        3 => 3,
                        4 => 4,
                        5 => 5
                    ),
                    'multiple' => false,
                    'expanded' => true
                )
            );
    }

    public function getName()
    {
        return 'review';
    }
}