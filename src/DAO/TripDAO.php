<?php

namespace VeryGoodTrip\DAO;

use VeryGoodTrip\Domain\Trip;

class TripDAO extends DAO
{
    /**
     * Returns a list of all trips sorted by date(most recent first)
     * @return trips[] An array of \VeryGoodTrip\Domain\Trip
     */
    public function findAll()
    {
        $sql = "select * from trip order by trip_id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $trips = array();
        foreach ($result as $row) {
            $trip_id= $row['trip_id'];
            $trips[$trip_id] = $this->buildDomainObject($row);
        }
        return $trips;
    }

    /**
     * Creates a trip object based on a DB row.
     *
     * @param array : $row The DB row containing Article data.
     * @return \VeryGoodTrip\Domain\Trip
     */
    protected function buildDomainObject($row) {
        $trip = new Trip();
        $trip->setId($row['trip_id']);
        $trip->setName($row['trip_name']);
        $trip->setDescription($row['trip_description']);
        $trip->setPrice($row['trip_price']);
        $trip->setCategory($row['trip_category']);
        $trip->setImage($row['trip_image']);
        return $trip;
    }

    public function getAllCategories()
    {
        $sql = "select trip_category from trip order by trip_category asc";
        $result = $this->getDb()->fetchAll($sql);
        //Storing the different categories from the query result in an string array
        $categories = array();
        foreach ($result as $row) {
            $category= $row['trip_category'];
            $categories[$category] = $this->amountTripsByCategory($category);
        }
        return $categories;
    }

    public function amountTripsByCategory($category)
    {
        $sql = "select count(*) from trip where trip_category=?";
        $result = $this->getDb()->fetchAll($sql,array($category));
        foreach ($result as $row) {
            $count= $row['count(*)'];
        }
        return $count;
    }
}