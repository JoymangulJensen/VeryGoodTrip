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
     * @var \VeryGoodTrip\Domain\Category
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

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param String $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return String
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param String $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return String
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param String $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
}