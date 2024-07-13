<?php

$routes = new Route;

/**
 * the above initializes the Route class
 * 
 * routes can be created below
 * parameters to be passed -> (string: path, function: callback || array: [controller, method], string: middleware_name || emtpy_string)
 */

/**
 * if you want to use controller methods here, accept it as a parameter in the callback function
 * example:
 * 
 * $routes->get('/', function ($controller) {
 *      $controller->view('home');
 * });
 * 
 */

/**
 * ------------------------------- CREATE YOUR ROUTES BELOW -------------------------------
 */


// get routes for view pages that are public
$routes->get('/', ['PublicView', 'home'], '');
$routes->get('/event-info', ['PublicView', 'event_info'], '');
$routes->get('/sign-in-user', ['PublicView', 'sign_in_user']);
$routes->get('/page', ['PublicView', 'page']);
$routes->get('/enroll', ['PublicView', 'enroll']);
$routes->get('/enrollment-certificate', ['PublicView', 'enrollment_certificate']);
$routes->get('/check-enrollment', ['PublicView', 'check_enrollment']);
$routes->get('/see-results', ['PublicView', 'see_results']);
$routes->get('/certificate', ['PublicView', 'see_certificate'], '');
$routes->get('/see-certificate', ['PublicView', 'see_certificate_form'], '');
$routes->get('/view-results', ['PublicView', 'see_result_with_id'], '');
$routes->get('/calender', ['PublicView', 'calender'], '');

// public apis for javascript
$routes->get('/get-events', ['PublicAPIs', 'events'], '');
$routes->get('/get-schools', ['PublicAPIs', 'schools'], '');
$routes->get('/get-departments', ['PublicAPIs', 'departments'], '');
$routes->post('/get-events', ['PublicAPIs', 'get_events_for_home'], '');

// payment gateway routes
$routes->post('/pay', ['Razorpay', 'pay'], '');




// get routes for view pages that requires user to sign in
$routes->get('/manage-events', ['ManagementView', 'main'], 'user_authenticated');
$routes->get('/new-event', ['ManagementView', 'new_event'], 'user_authenticated');
$routes->get('/upload-images', ['ManagementView', 'upload_images'], 'user_authenticated');
$routes->get('/add-additional-pages', ['ManagementView', 'add_additional_pages'], 'user_authenticated');
$routes->get('/create-awards', ['ManagementView', 'create_awards'], 'user_authenticated');
$routes->get('/enrollment-details', ['ManagementView', 'enrollment_details'], 'user_authenticated');
$routes->get('/upload-logo', ['ManagementView', 'upload_logo'], 'user_authenticated');
$routes->get('/contact-details', ['ManagementView', 'contact_details'], 'user_authenticated');
$routes->get('/edit-event', ['ManagementView', 'edit_event'], 'user_authenticated');
$routes->get('/view-participants', ['ManagementView', 'view_participants'], 'user_authenticated');
$routes->get('/distribute-prizes', ['ManagementView', 'distribute_prizes'], 'user_authenticated');
$routes->get('/templates', ['ManagementView', 'templates'], 'user_authenticated');




// post routes for form actions that dont required user sign in
$routes->post('/sign-in-user', ['Authenticator', 'verify_user'], '');
$routes->post('/enroll', ['ManagementAPIs', 'enroll'], '');
$routes->post('/see-results', ['PublicView', 'see_results_of_event'], '');



// post routes for form action that requires user to sign in
$routes->post('/new-event', ['ManagementAPIs', 'new_event'], 'user_authenticated');
$routes->post('/add-contact', ['ManagementAPIs', 'add_contact'], 'user_authenticated');
$routes->post('/add-award', ['ManagementAPIs', 'add_award'], 'user_authenticated');
$routes->post('/add-page', ['ManagementAPIs', 'add_page'], 'user_authenticated');
$routes->post('/add-enrollment-details', ['ManagementAPIs', 'add_enrollment_details'], 'user_authenticated');
$routes->post('/add-enrollment-type', ['ManagementAPIs', 'add_enrollment_types'], 'user_authenticated');
$routes->post('/add-enrollment-type', ['ManagementAPIs', 'add_enrollment_types'], 'user_authenticated');
$routes->post('/update-event-summary', ['ManagementAPIs', 'update_event_summary'], 'user_authenticated');
$routes->post('/distribute-prizes', ['ManagementAPIs', 'distribute_prizes_close_event'], 'user_authenticated');


// get (non -view) routes that requires user to sign in
$routes->get('/delete-image', ['ManagementAPIs', 'delete_image'], 'user_authenticated');
$routes->get('/delete-contact', ['ManagementAPIs', 'delete_contact'], 'user_authenticated');
$routes->get('/delete-award', ['ManagementAPIs', 'delete_award'], 'user_authenticated');
$routes->get('/event-to-private', ['ManagementAPIs', 'event_to_private'], 'user_authenticated');
$routes->get('/event-to-public', ['ManagementAPIs', 'event_to_public'], 'user_authenticated');
$routes->get('/delete-added-field', ['ManagementAPIs', 'delete_added_field'], 'user_authenticated');
$routes->get('/delete-enrollment-type', ['ManagementAPIs', 'delete_enrollment_type'], 'user_authenticated');
$routes->get('/start-enrollment', ['ManagementAPIs', 'start_enrollment'], 'user_authenticated');
$routes->get('/stop-enrollment', ['ManagementAPIs', 'stop_enrollment'], 'user_authenticated');
$routes->get('/delete-page', ['ManagementAPIs', 'delete_page'], 'user_authenticated');
$routes->get('/close-event', ['ManagementAPIs', 'close_event'], 'user_authenticated');
$routes->get('/change_to_theme_1', ['ManagementAPIs', 'change_template_to_1'], 'user_authenticated');
$routes->get('/change_to_theme_2', ['ManagementAPIs', 'change_template_to_2'], 'user_authenticated');




// javascript api routes
$routes->post('/upload-image', ['ManagementAPIs', 'upload_image'], 'user_authenticated');
$routes->post('/upload-logo', ['ManagementAPIs', 'upload_logo'], 'user_authenticated');





// for user signing out
$routes->get('/sign-out-user', ['Authenticator', 'sign_out_user']);


 
// create your own custom route not found handler
/**
 * uncomment the below code to create your own custom 'route not found' handler
 * Parameteres to be passed --> function that will run whenever uri route is invalid
 */

// $routes->routeNotFound(function () {
//     echo "route not found";
// });

// this will run the router
$routes->run();