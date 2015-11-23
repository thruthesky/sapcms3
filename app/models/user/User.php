<?php
class User extends Entity
{
    private static $current = null; // ID of current logged user.

    public function __construct() {
        parent::__construct();
        $this->setTable(USER_TABLE);
    }


    /**
     * Delete a user by username
     * @param $username
     *
     */
    final public function deleteByUsername($username) {
        $this->db->delete(USER_TABLE, array('username'=>$username));
    }

    /**
     * Delete a user by email
     * @param $email
     */
    final public function deleteByEmail($email) {
        $this->db->delete(USER_TABLE, array('email'=>$email));
    }


    /**
     *
     * Encrypt the input (plain-text) password as in md5 and save into 'password' field.
     *
     * @Attention This methods can be used only if the Entity has 'password fields'
     *
     * @param $plain_text_password
     * @return $this
     */
    final public function setPassword($plain_text_password)
    {
        return $this->set('password', encrypt_password($plain_text_password));
    }

    /**
     * Returns a User object after login with email id.
     * @param $username
     * @return User|FALSE
     */
    final public function loadByUsername($username) {
        return $this->loadBy('username', $username);
    }

    /**
     * Returns a User object after login with email address.
     * @param $email
     * @return Entity|FALSE
     */
    final public function loadByEmail($email)
    {
        return $this->loadBy('email', $email);
    }

    /**
     * Returns a user object after logged in.
     *
     * @note it sets
     *
     * @param $username
     * @return User|FALSE
     *
     * @example See User_test.php
     */
    final public function login($username=null) {
        if ($username) {
            $user = $this->loadByUsername($username);
            $this->setCurrent($user);
            return $user;
        }
        else {
            $this->setCurrent($this);
            return $this;
        }

    }
    /**
     * Returns a user object after logged in with email
     *
     * @note it sets
     *
     * @param $email
     * @return User|FALSE
     */
    final public function loginByEmail($email) {
        $user = $this->loadByEmail($email);
        $this->setCurrent($user);
        return $user;
    }


    /**
     *
     * Sets the $user as the current logged user.
     *
     * @param $user
     *
     */
    final protected function setCurrent($id)
    {
        if ( is_numeric($id) ) self::$current = $this->load($id);
        else if ( is_email($id) ) self::$current = $this->loadByEmail($id);
        else if ( is_string($id) ) self::$current = $this->loadByUsername($id);
        else if ( $id instanceof User ) self::$current = $id;
        else self::$current = null;
    }



    /**
     * Returns the login user's User Entity
     * @return User
     */
    final public function getCurrent() {
        if ( self::$current === null ) $this->setCurrent(ANONYMOUS_USERNAME);
        return self::$current;
    }



    final public function serach($o) {

    }
}
