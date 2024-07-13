<?php

class Controller {

    // use template trait
    use template;

    // use validator trait
    use Validator;

    // function to load a view
    public function view ($viewName, $data = []) {

        if(file_exists("../app/views/".$viewName.".php")) {
            // extract the variable of the passed data

            // exception for calender route
            if($viewName == 'public/calender') { require "../app/views/".$viewName.".php";}
            else{
                $template  = $this->renderTemplate($viewName);

                // path of the cache file of the view
                $cacheFile = "../app/cache/$viewName.php";
    
                // directory of the cache file
                $cacheDir = explode('/', $cacheFile);
                array_pop($cacheDir);
                $cacheDir = implode('/', $cacheDir);
    
                // if cache directory does not exist then create one
                if (!is_dir($cacheDir)) {
                    mkdir($cacheDir, 0777, true);
                } 
    
                // create the cache file
                fopen($cacheFile, 'w');
    
                // put the contents of the view inside the cache file
                file_put_contents($cacheFile, $template);
                
                // call the cache view file
                require $cacheFile;
            }
            

        } else {
            showViewNotFoundError($viewName, $this->getDebugInfo(1));
        }
    }

    // function to load a model
    public function model ($modelName) {
        if (file_exists("../app/models/". $modelName .".php")) {            
            require_once "../app/models/".$modelName.".php";

            $model =  new $modelName;

            // model file should be associated with  a particular table from the database
            if(!isset($model->table) || empty($model->table)) {
                showTableNameNotSetError(get_class($model), $this->getDebugInfo(1));
            } elseif (!isset($model->primary) || empty($model->primary)) {
                showPrimaryNotSetError(get_class($model), $this->getDebugInfo(1));
            } else {
                return $model; // everything is ok
            }

        } else {
            showModelNotFoundError($modelName, $this->getDebugInfo(1));
        }
    }

    // function to use another controller inside another controller
    // public fucntion controller renamed to get_controller
    /**
     * method renamed to get_controller due to version issues
     * -- version 7.4 thinks the method is a constructor
     * -- version 8.2 has no issues because the constructor name with class name has been completely removed.
     * -- rename method name from controller to get_controller in all the files where the class controller is used
     */
    public function get_controller ($controllerName) {
        if (file_exists("../app/controllers/". $controllerName .".php")) {            
            require_once "../app/controllers/".$controllerName.".php";

            $controller =  new $controllerName;
            
            return $controller;
            
        } else {
            echo "controller $controllerName not found";
        }
    }

    // function to get inputs from user
    public function input ($inputName) {
        if($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'post') {
            return trim(strip_tags($_POST[$inputName]));
        } else {
            if($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'get') {
                return trim(strip_tags($_GET[$inputName]));
            }
        }
    }

    // function to set a session
    public function setSession ($sessionName, $sessionValue) {

        if(!empty($sessionName) && !empty($sessionValue)) {
            $_SESSION[$sessionName] = $sessionValue;
        }
    }

    // function to get a session
    public function getSession ($sessionName) {
        if(!empty($sessionName)) {
            return $_SESSION[$sessionName];
        }
    }

    // function to unset a session
    public function unsetSession ($sessionName) {
        if(!empty($sessionName)) {
            unset($_SESSION[$sessionName]);
        }
    }

    // function to destroy all sessions
    public function destroy () {
        session_destroy();
    }

    public function getDebugInfo ($i = 0) {
        $fileinfo = 'no_file_info';
        $backtrace = debug_backtrace();  
        if(!empty($backtrace[$i]) && is_array($backtrace[$i])) {
            $fileinfo = $backtrace[$i]['file'] . ":" . $backtrace[$i]['line'];
        }

        return $fileinfo;
    }

    
}