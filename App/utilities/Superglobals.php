<?php

namespace App\utilities;

/**
 * This class groups all the 'superglobal' variables useful for the project
 */
class Superglobals
{
    private $_POST;
    private $_GET;
    private $_SESSION;

    /**
     * Constructor for superglobal variables
     */
    public function __construct()
    {
        $this->define_superglobals();
    }

    /**
     * Function for using $_POST variable
     *
     * @param string|null $key
     * @return array
     */
    public function get_POST($key = null)
    {
        if (null !== $key) {
            return (isset($this->_POST["$key"])) ? $this->_POST["$key"] : null;
        } else {
            return $this->_POST;
        }
    }

    /**
     * Function for using $_GET variable
     *
     * @param string|null $key
     * @return array
     */
    public function get_GET($key = null)
    {
        if (null !== $key) {
            return (isset($this->_GET["$key"])) ? $this->_GET["$key"] : null;
        } else {
            return $this->_GET;
        }
    }

    /**
     * Function for using $_SESSION variable
     *
     * @param string|null $key
     * @return array
     */
    public function get_SESSION($key = null)
    {
        if (null !== $key) {
            return (isset($this->_SESSION["$key"])) ? $this->_SESSION["$key"] : null;
        } else {
            return $this->_SESSION;
        }
    }

    /**
     * Sets the conditions of use of the superglobal variables
     *
     */
    private function define_superglobals()
    {

        // Store a local copy of the PHP superglobals
        // This should avoid dealing with the global scope directly
        $this->_POST = (isset($_POST)) ? $_POST : null;
        $this->_GET = (isset($_GET)) ? $_GET : null;
        $this->_SESSION = (isset($_SESSION)) ? $_SESSION : null;
    }

    /**
     * Unsets superglobal variables
     *
     */
    public function unset_superglobals()
    {
        unset($_POST);
        unset($_GET);
        unset($_SESSION);
    }
}
