<?php

namespace VeryGoodTrip\Domain;


class Review
{
    /**
     * The id of review
     * @var Integer
     */
    private $id;
    /**
     * The concerning trip
     * @var \VeryGoodTrip\Domain\Trip
     */
    private $trip;
    /**
     * User making the review
     * @var \VeryGoodTrip\Domain\User
     */
    private $user;
    /**
     * review content
     * @var string
     */
    private $content;
    /**
     * Rating of the trip
     * values : [1 - 5]
     * @var integer
     */
    private $rating;



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
     * @return Trip
     */
    public function getTrip()
    {
        return $this->trip;
    }

    /**
     * @param Trip $trip
     */
    public function setTrip($trip)
    {
        $this->trip = $trip;
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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

}