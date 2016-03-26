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