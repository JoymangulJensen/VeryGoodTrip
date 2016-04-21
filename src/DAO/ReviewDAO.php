<?php

namespace VeryGoodTrip\DAO;

use VeryGoodTrip\Domain\Review;

class ReviewDAO extends DAO
{
    /**
     * @var \VeryGoodTrip\DAO\TripDAO
     */
    private $tripDAO;
    /**
     * @var \VeryGoodTrip\DAO\UserDAO
     */
    private $userDAO;

    /**
     * @param TripDAO $tripDAO
     */
    public function setTripDAO($tripDAO)
    {
        $this->tripDAO = $tripDAO;
    }

    /**
     * @param UserDAO $userDAO
     */
    public function setUserDAO($userDAO)
    {
        $this->userDAO = $userDAO;
    }

    /**
     * Find all the reviews matching the given trip
     *
     * @param $tripId integer the trip id
     * @return array Review[] the reviews matching the given trip
     * @throws \Exception
     */
    public function findAllByTrip($tripId)
    {
        // The associated trip is retrieved only once
        $trip = $this->tripDAO->find($tripId);

        $sql = "select * from review where trip_id=? order by review_id";
        $result = $this->getDb()->fetchAll($sql, array ($tripId));

        $reviews = array();
        foreach ($result as $row) {
            $reviewId = $row['review_id'];
            $review = $this->buildDomainObject($row);
            // The associated trip is defined for the constructed review
            $review->setTrip($trip);
            $reviews[$reviewId] = $review;
        }
        return $reviews;
    }

    /**
     * Saves a review into the database.
     *
     * @param \VeryGoodTrip\Domain\Review $review The review to save
     */
    public function save(Review $review) {
        $reviewDate = array(
            'trip_id' => $review->getTrip()->getId(),
            'user_id' => $review->getUser()->getId(),
            'review_content' => $review->getContent(),
            'review_rating' => $review->getRating()
        );

        if ($review->getId()) {
            // The review has already been saved : update it
            $this->getDb()->update('review', $reviewDate, array('review_id' => $review->getId()));
        } else {
            // The review has never been saved : insert it
            $this->getDb()->insert('review', $reviewDate);
            // Get the id of the newly created review and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $review->setId($id);
        }
    }

    /**
     * Creates a Review object based on a DB row.
     *
     * @param array $row The DB row containing Review data.
     * @return \VeryGoodTrip\Domain\Review
     */
    protected function buildDomainObject($row)
    {
        $review = new Review();
        $review->setId($row['review_id']);
        $review->setContent($row['review_content']);
        $review->setRating($row['review_rating']);

        if (array_key_exists('review_id', $row)) {
            //Find and set the associated trip
            $tripId = $row['trip_id'];
            $trip = $this->tripDAO->find($tripId);
            $review->setTrip($trip);
        }
        if (array_key_exists('user_id', $row)) {
            // Find and set the associated author
            $userId = $row['user_id'];
            $user = $this->userDAO->find($userId);
            $review->setUser($user);
        }

        return $review;
    }
    
}