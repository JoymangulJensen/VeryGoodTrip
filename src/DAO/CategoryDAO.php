<?php
namespace VeryGoodTrip\DAO;

use VeryGoodTrip\Domain\Category;

class CategoryDAO extends DAO
{
    /**
     * Return a list of all Categories, sorted by date (most recent first).
     *
     * @return array C list of all categories.
     */
    public function findAll() {
        $sql = "select * from category order by category_id desc";
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
     * Returns a random list of images, the number is entered as parameter
     * @param $nbImages Integer : Number of images
     * @return string[] An array of url of images
     */
    public function findRandomImages($nbImages)
    {
        $sql = "select category_image from category order by RAND() limit :nbImages";
        $result = $this->getDb()->prepare($sql);
        $result->bindValue("nbImages", $nbImages, \PDO::PARAM_INT);
        $result->execute();
        // Convert query result to an array of domain objects
        $images = array();
        foreach ($result as $row) {
            $images[] = $row['category_image'];
        }
        return $images;
    }

    /**
     * Return a list of all Categories, sorted by date (most recent first).
     *
     * @return array C list of all categories.
     */
    public function findAllWithCount() {
        $sql = "select category.*, count(trip.trip_id) as nb_trips from category left join trip on trip.category_id =
          category.category_id group by category.category_id order by category_id asc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $categories = array();
        foreach ($result as $row) {
            $categoryId = $row['category_id'];
            $category = $this->buildDomainObject($row);
            $category->setNbtrips($row['nb_trips']);

            $categories[$categoryId] = $category;
            // $categories[$categoryId]->setNbtrips(3);
        }
        return $categories;
    }

    /**
     * Saves a trip into the database
     *
     * @param \VeryGoodTrip\Domain\Category $article The article to save
     */
    public function save(Category $category) {
        $categoryData = array(
            'category_id' => $category->getId(),
            'category_name' => $category->getName(),
            'category_description' => $category->getDescription(),
            'category_image' => $category->getImage()
        );

        if ($category->getId()) {
            // The article has already been saved : update it
            $this->getDb()->update('category', $categoryData, array('category_id' => $category->getId()));
        } else {
            // The article has never been saved : insert it
            $this->getDb()->insert('category', $categoryData);
            // Get the id of the newly created article and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $category->setId($id);
        }
    }

    /**
     * Removes a category from the database.
     *
     * @param integer $id The category id.
     */
    public function delete($id) {
        // Delete the trip
        $this->getDb()->delete('category', array('category_id' => $id));
    }


    /**
     * Creates a Category object based on a DB row.
     *
     * @param array $row The DB row containing Category data.
     * @return \VeryGoodTrip\Domain\Category
     */
    protected function buildDomainObject($row) {
        $category= new Category();
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