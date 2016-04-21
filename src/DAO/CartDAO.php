<?php

namespace VeryGoodTrip\DAO;

use VeryGoodTrip\Domain\Cart;

class CartDAO extends DAO
{
    /**
     * @var \VeryGoodTrip\DAO\TripDAO
     */
    private $tripDAO;
    /**
     * @var \VeryGoodTrip\DAO\UserDAO
     */
    private $userDAO;

    public function setTripDAO(TripDAO $tripDAO)
    {
        $this->tripDAO = $tripDAO;
    }

    public function setUserDAO(UserDAO $userDAO)
    {
        $this->userDAO = $userDAO;
    }

    /**
     * Find content of a cart for a specific user
     * @param $userId Integer : the user ID
     * @return cart[] An array of \VeryGoodTrip\Domain\Cart
     */
    public function find($userId)
    {
        $sql = "SELECT * FROM cart WHERE user_id=?";
        $result = $this->getDb()->fetchAll($sql, array($userId));

        $carts = Array();
        foreach ($result as $row)
        {
            $cart_id = $row['cart_id'];
            $carts[$cart_id] = $this->buildDomainObject($row);
        }
        return $carts;
    }

    /**
     * Save the given cart in the database
     * @param $cart Cart cart to be saved
     */
    public function save($cart)
    {
        $cartData = array(
            'trip_id' => $cart->getTrip()->getId(),
            'user_id' => $cart->getUser()->getId()
        );
        // Insert cart in the database table "cart"
        $this->getDb()->insert('cart', $cartData);
        // Get the id of the newly created cart and set it on the entity.
        $id = $this->getDb()->lastInsertId();
        $cart->setId($id);
    }

    /**
     * Removes a trip from the database.
     *
     * @param $cart_id int the id of the row in cart to be removed
     * @param $user_id int the id of the user logged in
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     * @internal param int $id The trip id.
     */
    public function delete($cart_id, $user_id) {
        // Delete the trip
        $this->getDb()->delete('cart', array('cart_id' => $cart_id, 'user_id' => $user_id));
    }



    /**
     * Creates a Cart object based on a DB row.
     *
     * @param array $row The DB row containing cart data.
     * @return \VeryGoodTrip\Domain\Cart
     */
    protected function buildDomainObject($row)
    {
        $cart = new Cart();
        $cart->setId($row['cart_id']);
        $cart->setUser($this->userDAO->findById($row['user_id']));
        $cart->setTrip($this->tripDAO->find($row['trip_id']));
        return $cart;
    }

}