<?php
use firebird\FireBird;

class User extends Node
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
        $this->db->delete( $this->getTable(), array('username'=>$username) );
    }

    /**
     * Delete a user by email
     * @param $email
     */
    final public function deleteByEmail($email) {
        $this->db->delete($this->getTable(), array('email'=>$email));
    }


    /**
     *
     * Encrypt the input (plain-text) password as in md5 and save into 'password' field.
     *
     * @Attention This methods can be used only if the Entity has 'password fields'
     *
     * @param $plain_text_password
     * @return $this
     * @code
     * $jaeho = user()->create()
    ->set('username', 'jaeho')
    ->setPassword('1234')
    ->set('email', 'jaeho@gmail.com')
    ->save();
    $this->unit->run( $jaeho->checkPassword('1234'), TRUE, "Passsword Check");

     * @endcode
     */
    final public function setPassword($plain_text_password)
    {
        return $this->set('password', FireBird::encryptPassword($plain_text_password));
    }



    /**
     * Returns TRUE if the input $password is the same password as the user
     * @param $plain_text_password
     * @return bool
     */
    final public function checkPassword($plain_text_password)
    {
        if ( empty($plain_text_password) ) return FALSE;
        return FireBird::checkPassword($plain_text_password, $this->get('password'));
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
     * @return User|FALSE
     */
    final public function loadByEmail($email)
    {
        return $this->loadBy('email', $email);
    }

    /**
     * Returns a user object after logged in.
     *
     *
     *
     * @note it does not actually set the user logged in. It uses $this->setLogin() method to do that.
     *
     * @param $username
     * @param bool $cookie_save
     * @return FALSE|User
     * @example See User_test.php
     */
    final public function login($username=null, $cookie_save=TRUE) {
        if ($username) {
            $user = $this->loadByUsername($username);
            return $this->setLogin($user,$cookie_save);
        }
        else {
            return $this->setLogin($this,$cookie_save);
        }
    }

    /**
     * Set the logged-in-user logged-out.
     */
    final public function logout() {
        $this->setLogout();
    }


    /**
     * This method actually sets the user logged in.
     * @param $user
     * @param $cookie_save - if it is true, then it saves 'id' to COOKIE ID in cookie.
     *              For CLI-use or Test-use, you can use this without saving 'id' in cookie.
     * @return User
     */
    final private function setLogin(&$user,$cookie_save) {

        $this->setCurrent($user);

        if ( is_cli() ) {

        }
        else if ( $cookie_save ) {
            $cookie = array(
                'name'   => COOKIE_ID,
                'value'  => $user->get('id'),
                'expire' => 365 * 24 * 60 * 60,
                'domain' => '.' . getBaseDomain(getDomain()),
                'path'   => '/',
            );
            $this->input->set_cookie($cookie);
        }
        return $user;
    }

    /**
     * Sets the logged-in-user logged-out.
     */
    final private function setLogout() {
        $this->load->helper('cookie');
        $this->setCurrent(null);
        delete_cookie(COOKIE_ID, '.' . getBaseDomain(getDomain()));
    }


    /**
     * Returns a user object after logged in with email
     *
     * @note it sets
     *
     * @param $email
     * @param bool $cookie_save
     * @return FALSE|User
     */
    final public function loginByEmail($email, $cookie_save=TRUE) {
        $user = $this->loadByEmail($email);
        $this->setCurrent($user, $cookie_save);
        return $user;
    }


    /**
     *
     * Sets the $user as the current logged user.
     *
     * @param $id
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
        if ( self::$current === null ) {
            if ( $id = $this->input->cookie(COOKIE_ID) ) {
                $this->setCurrent($id);
            }
            else $this->setCurrent(ANONYMOUS_USERNAME);
        }
        return self::$current;
    }



    final public function serach($o) {

    }
}
