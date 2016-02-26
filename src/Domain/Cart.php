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
     * Date on which the cart wad created
     * @var string
     */
    private $date;
    /**
     *
     * @var trips[] An array of \VeryGoodTrip\Domain\Trip
     */
    private $trips;



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
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return trip[]
     */
    public function getTrips()
    {
        return $this->trips;
    }

    /**
     * @param trip[] $trips
     */
    public function setTrips($trips)
    {
        $this->trips = $trips;
    }

    /*************************************************************
     ********************       Methods        *******************
     *************************************************************/
    /**
     * Add a trip to the array of trips in a cart
     * @param $trip \VeryGoodTrip\Domain\Trip
     * @return bool confirmation of addition
     */
    public function addTrip($trip)
    {
        if(isset($trip))
        {
            $this->trips[$trip->getId()] = $trip;
            return true;
        }
        return false;
    }
}