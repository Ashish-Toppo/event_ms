<?php


class user_authenticated extends Middleware{

    public function run () :bool {

        // if user is signed in, return ture
        if (isset($_SESSION['user'])  &&  count($_SESSION['user']) > 0) {
            return true;
        }

        else return false;
    }

    public function failed () :void {
        echo "Attempt For Unauthorised Access";
    }

}