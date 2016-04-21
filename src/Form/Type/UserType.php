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
                'label' => "Email",
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
            ->add('address', 'textarea', array('label' => 'Adresse'))
            ->add('town', 'text', array('label' => "Ville"))
            ->add('zipcode', 'integer',  array('label' => "Code Postal"))
            ->add('password', 'repeated', array(
                'type'            => 'password',
                'invalid_message' => 'Les mots de passes doivent être les mêmes. ',
                'options'         => array('required' => true),
                'first_options'   => array('label' => 'Mot de Passe'),
                'second_options'  => array('label' => 'Confirmation du Mot de Passe'),
            ))
            ;
    }

    public function getName()
    {
        return 'user';
    }
}