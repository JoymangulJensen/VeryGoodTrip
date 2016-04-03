<?php

namespace VeryGoodTrip\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'text', array(
                'constraints' => new Assert\Email(),
                'attr' => array(
                    'placeholder' => 'i.e: john@doe.com',
                )))
            ->add('firstname', 'text', array(
                'constraints' => array(new Assert\NotBlank())))
            ->add('lastname', 'text', array(
                'constraints' => array(new Assert\NotBlank()),
                ))
            ->add('address', 'textarea')
            ->add('town', 'text')
            ->add('zipcode', 'integer')
            ->add('password', 'repeated', array(
                'type'            => 'password',
                'invalid_message' => 'The password fields must match.',
                'options'         => array('required' => true),
                'first_options'   => array('label' => 'Password'),
                'second_options'  => array('label' => 'Repeat password'),
            ))
            ;
    }

    public function getName()
    {
        return 'user';
    }
}