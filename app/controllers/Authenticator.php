<?php

class Authenticator extends Controller {
    /**
     * ------------------- AUTHENTICATOR ---------------------------
     * --------> The class is used for all authentication purpose
     * 
     *  1. to verify if the given user exists and create session 
     */

    //  function to verify user
    public function verify_user ($passed_data) {
        /**
         * -- Empty the sign-in-error variable
         * -- validate that the input values are whatever expected 
         * -- make database connection 
         * -- check if the user exists, if doesn't then return to the same page with errors
         * -- if user exists, direct to main page for the user
         */

        //  empty the sign-in-errors variable
        $_SESSION['sign-in-errors'] = '';
        unset($_SESSION['sign-in-errors']);

        //  validate user inputs
        // validate the username
        // --------> only allowed values: a-z, A-Z, 0-9 and _
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $passed_data['username'])) {
            // if the execution point reaches here
            // the string contains unallowed characters
            // redirect to sign-in-user with username domain violation

            // create the error message
            $_SESSION['sign-in-error'] = 'Only letters(a-z, A-Z), numbers(0-9) and Underscore(_) are allowed in username';

            // redirect to sign-in-user
            header("location: /sign-in-user");

            // stop furthur execution
            die;
        }

        // validate the password
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $passed_data['password'])) {
            // if the execution point reaches here
            // the string contains unallowed characters
            // redirect to sign-in-user with username domain violation

            // create the error message
            $_SESSION['sign-in-error'] = 'Only letters(a-z, A-Z), numbers(0-9) and Underscore(_) are allowed in password';

            // redirect to sign-in-user
            header("location: /sign-in-user");

            // stop furthur execution
            die;
        }


        // make database connection
        $host = USERSHOST;
        $user = USERSUSER;
        $db = USERSDATABASE;
        $pswd = USERSPASSWORD; 
        
        try{
            $this->con = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pswd);
        } catch (PDOException $e) {
            showDBConnectionError($e);
        }

        $query = "SELECT * FROM `users` WHERE `user_name` = ? AND `password` = ?";
        $result = $this->con->prepare($query);

        $found = [];

        if ($result->execute([$passed_data['username'], $passed_data['password']])) {
            $found = $result->fetchAll();
        }

        if ( count ($found) < 1) {
            // user not found 
            // write sign-in-error
            // redirect to sign in page
            $_SESSION['sign-in-error'] = 'Incorrect Username or Password';
            header('location: /sign-in-user');

            // stop furthur execution
            die;
        }

        // if user type not allowed 
        if ($found[0]['user_type'] !== 1  &&  $found[0]['user_type'] !== 2) {
            $_SESSION['sign-in-error'] = "You are prohibitted from this section, please contact website admin";
            header('location: /sign-in-user');

            // stop furthur execution
            die;
        }


        // user found
        // create user session
        $_SESSION['user'] = $found[0];

        // redirect to main page of the event management
        header('location: /manage-events');
    }


    // function to sign out the user 
    public function sign_out_user () {
        // -- destroy the session
        // -- redirect to public home page

        $_SESSION = [];
        unset($_SESSION);

        header('location: /');
    }

}