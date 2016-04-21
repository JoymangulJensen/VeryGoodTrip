<?php

namespace VeryGoodTrip\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TripType extends AbstractType
{
    /**
     * @var array $categories List of all categories
     */
    private $categories;

    /**
     * Constructor
     * @param array $categories List of all categories
     */
    public function __construct(array $categories)
    {
        $this->categories = $categories;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //Construct the array with matching key(id) and value from the list of categories
        $choices = array();
        foreach ($this->categories as $id => $categories) {
            $cle = $categories->__toString();
            $choices[$cle] = $id;
        }

        $builder
            ->add('name', 'text', array('label' => "Nom"))
            ->add('description', 'textarea')
            ->add('price', 'integer', array('label' => "Prix", 'max_length' => 4))
            // Build combo box containing all categories
            ->add('category', 'choice', array(
                    'label' => "Catégorie",
                    'choices' => $choices,
                    'choices_as_values' => true,
                    'choice_value' => function ($choice) {
                        return $choice;
                    },
                    'expanded' => false,
                    'multiple' => false,
                    'mapped' => true,  // This field is not matching with the object property
                )
            )
            ->add('image', 'file', array(
                    'required' => false,
                    'data_class' => null
                )
            );
    }

    public function getName()
    {
        return 'trip';
    }
}