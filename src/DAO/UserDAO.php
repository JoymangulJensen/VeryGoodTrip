<?php

namespace VeryGoodTrip\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use VeryGoodTrip\Domain\User;

class UserDAO extends DAO implements UserProviderInterface
{




    /**
     * Returns a list of all users, sorted by role and name.
     *
     * @return array A list of all users.
     */
    public function findAll() {
        $sql = "select * from t_user order by usr_role, usr_name";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $entities = array();
        foreach ($result as $row) {
            $id = $row['usr_id'];
            $entities[$id] = $this->buildDomainObject($row);
        }
        return $entities;
    }


    /**
     * Saves a user into the database.
     *
     * @param \MicroCMS\Domain\User $user The user to save
     */
    public function save(User $user) {
        $userData = array(
            'usr_name' => $user->getUsername(),
            'usr_salt' => $user->getSalt(),
            'usr_password' => $user->getPassword(),
            'usr_role' => $user->getRole()
        );

        if ($user->getId()) {
            // The user has already been saved : update it
            $this->getDb()->update('t_user', $userData, array('usr_id' => $user->getId()));
        } else {
            // The user has never been saved : insert it
            $this->getDb()->insert('t_user', $userData);
            // Get the id of the newly created user and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $user->setId($id);
        }
    }

    /**
     * Removes a user from the database.
     *
     * @param @param integer $id The user id.
     */
    public function delete($id) {
        // Delete the user
        $this->getDb()->delete('t_user', array('usr_id' => $id));
    }


    /**
     * Returns a user matching the supplied email.
     *
     * @param string $username The email/username of user.
     *
     * @return \VeryGoodTrip\Domain\User | throws an exception if no matching user is found
     */
    public function find($username) {
        $sql = "select * from user where user_email=?";
        $row = $this->getDb()->fetchAssoc($sql, array($username));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($username)
    {
        return $this->find($username);
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return 'VeryGoodTrip\Domain\User' === $class;
    }

    /**
     * Creates a User object based on a DB row.
     *
     * @param array $row The DB row containing User data.
     * @return \VeryGoodTrip\Domain\User
     */
    protected function buildDomainObject($row) {
        $user = new User();
        $user->setEmail($row['user_email']);
        $user->setLastname($row['user_lastname']);
        $user->setFirstname($row['user_firstname']);
        $user->setPassword($row['user_password']);
        $user->setSalt($row['user_salt']);
        $user->setAddress($row['user_address']);
        $user->setTown($row['user_town']);
        $user->setZipcode($row['user_zipcode']);
        $user->setRole($row['user_role']);
        return $user;
    }

}