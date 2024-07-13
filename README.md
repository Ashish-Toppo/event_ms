
# Event Management Portal

A simple events management portal along with events calender created using MVC model in php.




## Authors

- [Ashish Toppo](https://github.com/Ashish-Toppo)
- [Robin Ekka](https://github.com/RobindanielEkka)


## Demo

https://ashish-toppo-testing.000webhostapp.com/


## Deployment

To deploy this project run

```bash
  1. Extract all the folders in the root directory of the server
  2. Rename the 'public' folder to the default public directory of your server (htdocs, html, public_html, etc.)
  3. Change the database configuration details in the 'config/config.php' file
     => For the users
        => user type '1' : Super admin (can control all events)
        => user type '2' : Priviledged (can access the management side of the portal but can control only the events created by himself/herself)
        => user type '3' : viewers (cannot create and manage events) 
```


## Documentation

### Software model
 MVC (Model View Controller) structure is used   
Model - Database related functions and queries  
View - All display pages and designs  
Controller - All login and calculations

#### Create New Controller
Create new file insdie the 'app/controllers' folder  
demo: newController.php  
```
<?php
class newController extends Controller {

    public function newFunction () {

        // calling a new model 
        $newModel = $this->model('newModel);

        // calling a new view file
        $this->view('viewFile', $viewData);
    }
}
```
  
  
#### Create New Model
Create new file insdie the 'app/models' folder  
Model should have a public variable ```$table``` and ```$primary``` denoting the table and the primary key  
demo: newModel.php  
```
<?php
class newModel extends Controller {
    public $table = 'name_of_table';
    public $primary = 'name_of_primary_key';

    public function newFunction () {

    }
}
```
  
    
     
#### Create New View
Create new file insdie the 'app/views' folder  
demo: newView.php  
```
<html>
<body>
    <h2>This is demo View file</h2>
</body>
</html>
```

## Routing
The routing is done by the 'system/classes/Route.php' file  
All routes are set in 'app/setup/routes.php' file  
Two types of routes are supported - get and post  
Inside the 'app/setup/routes.php' file:
```
// get route with middleware
$routes->get('/uri', ['Name_of_Controller', 'handling_function'], 'middleware_name');

// get route without middleware
$routes->get('/uri', ['Name_of_Controller', 'handling_function'], '');

// post route with middleware
$routes->post('/uri', ['Name_of_Controller', 'handling_function'], 'middleware_name');

// post route without middleware
$routes->post('/uri', ['Name_of_Controller', 'handling_function'], '');
```


### Middlewares
The middlewares are classes/functions that decide whether the given route will continue furher or not.  
Middleware has two function run (returns bool) and failed (returns void)  
When a middleware is included in a route, the middleware runs the 'run' function  
     => If run returns true: the handling_function function of the handling_controller is called  
     => If run returns false: the failed method is called within the same middleware and further execution of code is stopped.  
#### Create New Middleware  
Create a new file inside the 'app/middlewares' folder  
demo: newMiddleware.php  
```
<?php


class newmiddleware {

    public function run () :bool {

        return TRUE;
    }

    public function failed () :void {

        echo "the middleware failed, hence execution stopped";
    }

}
```

## Template Engine
This site uses a custom templating engine for code understandability in the view files  
templating is done by the 'system/helpers/template.php' file  
How to use:  
```{{ }}```  is used to print a variable  
```{{ }}?``` is used to check if a variable exists, and print only if it exists

```@if( condition )``` ```@endif``` is replaced with ```if(condition){``` and ```} ```  
```@elseif( condition )``` ```@endif``` is replaced with ``` else if(condition){``` and ```} ```  
```@else``` ```@endif``` is replaced with ```else {``` and ```} ```  

```@while( condition )``` ```@endwhile``` is replaced with ```while(condition){``` and ```} ```  
Similar pattern is used for for and foreach loops.