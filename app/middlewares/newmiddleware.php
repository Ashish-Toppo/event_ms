<?php


class newmiddleware {

    public function run () :bool {

        return TRUE;
    }

    public function failed () :void {

        echo "the middleware failed, hence execution stopped";
    }

}