<?php
/**
 * Created by PhpStorm.
 * User: seljo
 * Date: 01/03/2016
 * Time: 17:08
 */

namespace VeryGoodTrip\DAO;

use VeryGoodTrip\Domain\Category;

class CategoryDAO
{
    /**
     * Return a list of all Categories, sorted by date (most recent first).
     *
     * @return array C list of all categories.
     */
    public function findAll() {
        $sql = "select * from category order by art_id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $category = array();
        foreach ($result as $row) {
            $categoryId = $row['category_id'];
            $category[$categoryId] = $this->buildDomainObject($row);
        }
        return $category;
    }

    /**
     * Creates a Category object based on a DB row.
     *
     * @param array $row The DB row containing Category data.
     * @return \VeryGoodTrip\Domain\Category
     */
    protected function buildDomainObject($row) {
        $category = new Category();
        $category->setId($row['category_id']);
        $category->setDescription($row['category_description']);
        $category->setName($row['category_name']);
        $category->setImage($row['category_image']);

        return $category;
    }

    /**
     * Returns a Category matching the supplied id.
     *
     * @param integer $id
     * @return Category the category matching the supplied id
     * @throws|Category an exception if no matching category is found
     */
    public function find($id) {
        $sql = "select * from category where category_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No category matching id " . $id);
    }

    /**
     * Returns the number of trips of the supplied category id
     *
     * @param integer $id the id of the category
     * @return integer the number of trips for the category supplied
     * @throws|Category an exception if no matching category is found
     */
    public function countTripsByCategory($id) {
        $sql = "select count(*) as nb_trips from trip where category_id = ?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));
        if ($row)
            return $row->fetchColumn();
        else
            throw new \Exception("No category matching id " . $id);
    }
}