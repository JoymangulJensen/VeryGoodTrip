<?php

namespace VeryGoodTrip\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'text', array(
                'label' => "Courriel",
                'constraints' => new Assert\Email(),
                'attr' => array(
                    'placeholder' => 'i.e: john@doe.com',
                )))
            ->add('firstname', 'text', array(
                'label' => "Prénom",
                'constraints' => array(new Assert\NotBlank())))
            ->add('lastname', 'text', array(
                'label' => "Nom",
                'constraints' => array(new Assert\NotBlank()),
                ))
            ->add('address', 'textarea')
            ->add('town', 'text', array('label' => "Ville"))
            ->add('zipcode', 'integer',  array('label' => "Code Postale"))
            ->add('password', 'repeated', array(
                'type'            => 'password',
                'invalid_message' => 'The password fields must match.',
                'options'         => array('required' => true),
                'first_options'   => array('label' => 'Mot de Passe'),
                'second_options'  => array('label' => 'Ré-écrire Mot de Passe'),
            ))
            ;
    }

    public function getName()
    {
        return 'user';
    }
}