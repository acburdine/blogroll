<?php

class Session {

    protected static function init() {
        if (!session_id()) {
            session_start();
        }
    }

    public function authenticate() {
        $_SESSION['loggedIn'] = true;
    }

    public function isAuthenticated() {
        return ($_SESSION && array_key_exists('loggedIn', $_SESSION) && $_SESSION['loggedIn']);
    }

    public function clear() {
        session_destroy();
    }

}

Session::init();
