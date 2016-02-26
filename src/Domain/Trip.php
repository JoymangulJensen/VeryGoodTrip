<?php

namespace VeryGoodTrip\Domain;

class Trip
{
    /**
     * Trip ID
     * @var integer
     */
    private $id;
    /**
     * Trip name
     * @var String
     */
    private $name;
    /**
     * Trip description
     * @var String
     */
    private $description;
    /**
     * Trip price
     * @var integer
     */
    private $price;
    /**
     * Trip category
     * @var String
     */
    private $category;
    /**
     * Path to Trip image
     * @var String
     */
    private $image;

    /*************************************************************
     *************       Getters and setters         *************
     *************************************************************/
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getImage()
    {
        return $this->image;
    }


    public function setImage($image)
    {
        $this->image = $image;
    }


}