<?php

namespace VeryGoodTrip\Domain;


class Category
{
    /**
     * Category ID
     * @var integer
     */
    private $id;
    /**
     * Category name
     * @var string
     */
    private $name;
    /**
     * Category description
     * @var string
     */
    private $description;
    /**
     * Category image path
     * @var string
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

}