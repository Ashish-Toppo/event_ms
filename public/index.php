<?php declare(strict_types=1);

/**
 * 
 * ------------------ M V C A T ----------------
 * --------------------------------------------
 * --> A light weight MVC Framework in PHP
 * --> version : 2.1 
 * --> author  : Ashish Toppo
 * --> contact : ashishtoppo8958@gmail.com
 * --> licence : MIT Licence ( Open Source ) 
 * --> Last Update: 08th April 2023
 * 
 */


/**
 * ---------------- EVENT MANAGEMENT PORTAL -----------------------
 * BUILT ON TOP OF :
 * ----------------> 1. MVCAT PHP MVC Framework v2.1
 * ----------------> 2. COREUI Bootstrap Dashboard v4.2.2
 * ----------------> 3. Boostrap 5.3
 * ----------------> 4. JQuery 3
 * 
 * --> version: 1.0
 * --> authors: Ashish Toppo, Robin Ekka, 
 * --> contact: Ashish Toppo -> ashishtoppo8958@gmail.com, Robin Ekka -> robindanielekka@gmail.com, 
 * --> licence: Not Licenced
 * 
 * 
 * --> last update: 11th June, 2024
 */

  /**
  *  ----------------------- W -- A -- R -- N -- I -- N -- G ----------------------------
  * -----------------------------------------------------------------------------------
  * -------------------------------------------------------------------------------------
  * ---------------------------- D - A - N - G - E - R ----------------------------
  * -------------> After the last update, only God knows how this code works, touch this at your own risk
  * -------------> TOUCH THIS AT YOUR OWN RISK  
  */


// start the session
session_start();

// load necessary helpers
include_once ("../system/debugger/debugger.php");
include_once ("../system/helpers/validator.php");
include_once ("../system/helpers/template.php");
include_once ('../system/helpers/math.php');
include_once ('../system/helpers/links.php');

// load database configurations
include_once ("../config/config.php");

// check if all necessary configuration information are available
include_once ("../system/debugger/audit.php");

// load all autoload files
include_once ("../system/init.php");

// start routing
include_once ("../app/setup/routes.php");
