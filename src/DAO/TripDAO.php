<?php

namespace VeryGoodTrip\DAO;

use VeryGoodTrip\Domain\Trip;

class TripDAO extends DAO
{
    /**
     * @var \VeryGoodTrip\DAO\CategoryDAO
     */
    private $categoryDAO;

    /**
     * Set the categoryDAO object
     * @param CategoryDAO $categoryDAO
     */
    public function setCategoryDAO(CategoryDAO $categoryDAO) {
        $this->categoryDAO = $categoryDAO;
    }

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
     * Returns a random list of trips, the number of trips is entered as parameter
     * @param $nbtrips Integer : Number of trips
     * @return trips[] An array of \VeryGoodTime\Domain\Trip
     */
    public function findRandom($nbtrips)
    {
        $sql = "select * from trip order by RAND() limit :nbtrips";
        $result = $this->getDb()->prepare($sql);
        $result->bindValue("nbtrips", $nbtrips, \PDO::PARAM_INT);
        $result->execute();
        // Convert query result to an array of domain objects
        $trips = array();
        foreach ($result as $row) {
            $trip_id= $row['trip_id'];
            $trips[$trip_id] = $this->buildDomainObject($row);
        }
        return $trips;
    }

    /**
     * Returns a trip matching the supplied id.
     * @param integer $id
     * @return Trip
     * @throws \Exception
     */
    public function find($id) {

        $sql = "select * from trip where trip_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No trip matching id " . $id);
    }

    /**
     * Creates a trip object based on a DB row.
     *
     * @param array : $row The DB row containing Trip data.
     * @return \VeryGoodTrip\Domain\Trip
     */
    protected function buildDomainObject($row) {
        $trip = new Trip();
        $trip->setId($row['trip_id']);
        $trip->setName($row['trip_name']);
        $trip->setDescription($row['trip_description']);
        $trip->setPrice($row['trip_price']);
        //find the category of the tri and category a Category
        $category = $this->categoryDAO->find($row['category_id']);
        $trip->setCategory($category);
        $trip->setImage($row['trip_image']);
        return $trip;
    }

}