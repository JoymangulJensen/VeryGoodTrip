<?php

namespace VeryGoodTrip\Domain;

class Cart
{
    /**
     * Unique ID of cart
     * @var integer
     */
    private $id;
    /**
     * User that created the cart
     * @var \VeryGoodTrip\Domain\User
     */
    private $user;
    /**
     * A trip in the user cart
     * @var \VeryGoodTrip\Domain\Trip
     */
    private $trip;


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
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return trip
     */
    public function getTrip()
    {
        return $this->trip;
    }

    /**
     * @param trip $trip
     */
    public function setTrip($trip)
    {
        $this->trip = $trip;
    }

}