<?php

class ManagementAPIs extends Controller {
    /**
     * ---------------- MANAGEMENT APIs ------------------
     * ------> this controller is for managing the api calls for the management section of the portal
     * 
     * --- upload image, requires authentication middleware 
     * --- add new event
     */

     // function to check whether the requester is the actual owner of the event
    private function event_owner_verification ($event_id) {
        /**
         * -- check if the request if from a super admin, if yes allow
         * -- if no, check if the request is from the owner of the event, if yes allow
         */

         if ($_SESSION['user']['user_type'] == 1) {
            // the user is a super admin, so allow
            return;
         }

        //  check if the request is from the owner of the event on which action is requested
        if ($_SESSION['user']['user_type'] == 2) {
            if($this->model('Events')->fetch_where(' `id` = ?', [$event_id])[0]['created_by'] == $_SESSION['user']['id']) {
                return;
            }
        }

        // check if the request is from a user of user type 3 (not allowed)
        if ($_SESSION['user']['user_type'] == 3) {
            echo "You are not authorised to access this page!";
            die;
        }

        // if none of the above returns then kill furthur continuation
        echo "You are not authorised to access this page!";
        die;
    }

    // function to verify csrf
    private function verify_csrf($token) {
        // if token not exists and token mathces then continue
        if (isset($token)) {
            if ($token == $_SESSION['csrf_token']) {
                return;
            }
        }

        // if none of the above returns, then stop furthur continuation
        echo "Could Not Continue due to Security Issues! <br> CSRF Validation Error!";
        die;
    }



    //  function to upload image for the events
    public function upload_image () {
        /**
         * -- get the event id
         * -- csrf validation
         * -- check if its the owner of the event
         * -- get the image
         * -- upload image
         * -- update record in event table
         * 
         */

        //  -- get the event Id
        $event_id = $_SESSION['edited-event-id'];


        // verify csrf
        $this->verify_csrf($_POST['csrf']);

        //  ownership verification
        $this->event_owner_verification($event_id);

        //  -- get the image
        $folderPath = 'uploaded_items/event_images/';
        $image_parts = explode(";base64,", $_POST['image']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        // -- upload image
        $file = $folderPath . $event_id . '_' . uniqid() . '.png';
        file_put_contents($file, $image_base64);

        // -- update record in the database
        $inserted = $this->model('Images')->insert([
            'image' => $file,
            'event_id' => $event_id,
        ]);

        echo json_encode(["image uploaded successfully."]);
    }


    // function to delete event image
    public function delete_image ($passed_data) {
        /**
         * -- get the image id
         * -- check if the user is signed in
         * -- check ownership of the event
         * -- csrf validation
         * -- delete the image 
         * -- delete recored from the database
         * 
         */

        //  image id
        $image_id = $passed_data['id'];

        // to check if user is signed in, route is passed through middleware

        /**
         * ---- check the ownership of image
         * -- get the event id of the image
         * -- get the owner of the event
         * -- if signed in user and owner of event match, then ownership confirmed
         * 
         */

         $event_id_of_image = $this->model('Images')->fetch_where(' `id` = ? ', [$image_id])[0]['event_id'];
         
         //  ownership verification
        $this->event_owner_verification($event_id_of_image);

        // csrf validation
        $this->verify_csrf($passed_data['csrf']);

        //  delete the image file
        $link_to_image_file =  $this->model('Images')->fetch_where(' `id` = ? ', [$image_id])[0]['image'];
        unlink($link_to_image_file);

        // delete record from database
        $deleted = $this->model('Images')->delete_where(' `id` = ? ', [$image_id]);
         
        // refresh back to upload images file
        header('location: /upload-images');
    }


    // function to upload event logo 
    public function upload_logo () {
            /**
         * --
         * -- get the event id
         * -- csrf validation
         * -- check if its the owner of the event
         * -- get the image
         * -- upload image
         * -- update record in event table
         * 
         */

        //  --- get the event Id
        $event_id = $_SESSION['edited-event-id'];

        // verify csrf
        $this->verify_csrf($_POST['csrf']);

         //  ownership verification
         $this->event_owner_verification($event_id);


        //  --- get the image
        $folderPath = 'uploaded_items/event_logos/';
        $image_parts = explode(";base64,", $_POST['image']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        // --- upload image
        $file = $folderPath . 'event_' . $event_id . '.png';
        file_put_contents($file, $image_base64);
        
    
        // update record in the database
        $updated = $this->model('Events')->query("UPDATE `events` SET `logo`= '$file' WHERE `id` = ?", [$event_id]);

        echo json_encode(["image uploaded successfully."]);
    }


    // function to add new event
    public function new_event ($passed_data) {

        // this function will create a new event and direct to pages wherever required
        /**
         * -- verify csrf
         * -- get the values of the form
         * -- validate the values of the form 
         * -- check for checkboxes and create pending-event-actions variable
         * -- insert the values in the database
         * -- insert date/time as per whether or not its a one day event
         * -- redirect to pending-event-actions page if any 
         */

         // verify csrf
        $this->verify_csrf($passed_data['csrf_token']);

        //  validate the values of the form
        // validate the name of the event
        if (!preg_match('/^[a-zA-Z0-9_\s]+$/', $passed_data['eventName'])) {
            // if the execution point reaches here
            // the string contains unallowed characters
            // redirect to sign-in-user with username domain violation

            // create the error message
            $_SESSION['new-event-error'] = 'Only letters(a-z, A-Z), numbers(0-9), Underscore(_) and space( ) are allowed in the Name of the Event';

            // redirect to sign-in-user
            header("location: /new-event");

            // stop furthur execution
            die;
        }
        // validate the description of the event
        if (!preg_match('/^[a-zA-Z0-9_\s]+$/', $passed_data['eventName'])) {
            // if the execution point reaches here
            // the string contains unallowed characters
            // redirect to sign-in-user with username domain violation

            // create the error message
            $_SESSION['new-event-error'] = 'Only letters(a-z, A-Z), numbers(0-9) and Underscore(_), space( ) are allowed in event description';

            // redirect to sign-in-user
            header("location: /new-event");

            // stop furthur execution
            die;
        }


        // check whether it is a one day event
        $passed_data['one_day_event'] = ( isset($passed_data['one_day_event']) && $passed_data['one_day_event'] == 'on' ) ? 1 : 0;

        // if one day event, then check if event_date_on, and times exist
        if ($passed_data['one_day_event'] == 1) {

            // if event date on does not exist, return with error
            if (!isset($passed_data['event_date_on']) || strlen($passed_data['event_date_on']) < 1) {
                // create the error message
                $_SESSION['new-event-error'] = 'Event date must not be empty';

                // redirect to sign-in-user
                header("location: /new-event");

                // stop furthur execution
                die;
            }

            // if event time form does not exist, return with error
            if (!isset($passed_data['event_time_from']) || strlen($passed_data['event_time_from']) < 1) {
                // create the error message
                $_SESSION['new-event-error'] = 'Event Time must not be empty';

                // redirect to sign-in-user
                header("location: /new-event");

                // stop furthur execution
                die;
            }

            // if event time to does not exist, return with error
            if (!isset($passed_data['event_time_to']) || strlen($passed_data['event_time_to']) < 1) {
                // create the error message
                $_SESSION['new-event-error'] = 'Event Time must not be empty';

                // redirect to sign-in-user
                header("location: /new-event");

                // stop furthur execution
                die;
            }


        }


        // if multi date event, check if date from and to exists
        if ($passed_data['one_day_event'] == 0) {

            // if event date from does not exists, return with error
            if (!isset($passed_data['event_date_from']) || strlen($passed_data['event_date_from']) < 1) {
                // create the error message
                $_SESSION['new-event-error'] = 'Event Date must not be empty';

                // redirect to sign-in-user
                header("location: /new-event");

                // stop furthur execution
                die;
            }

            // if event date to does not exists, return with error
            if (!isset($passed_data['event_date_to']) || strlen($passed_data['event_date_to']) < 1) {
                // create the error message
                $_SESSION['new-event-error'] = 'Event Date must not be empty';

                // redirect to sign-in-user
                header("location: /new-event");

                // stop furthur execution
                die;
            }
        }

        
        // id of the last inserted row
        // increment it to get the new id
        $insert = $this->model('Events');
        $event_id = ++$insert->query("SELECT `id` FROM `events` ORDER BY `id` DESC")[0][0];

        // check if user want enrollment or not 
        $need_enrollment = 0;

        
        // create new event in the database
        $inserted = $insert->insert([
            'id' => $event_id,
            'event_name' => $passed_data['eventName'],
            'event_description' => $passed_data['eventDescription'],
            'one_day_event' => $passed_data['one_day_event'],
            'logo' => '/default_items/event_logo.png',
            'public' => 1,
            'active' => 1,
            'enrollment' => 0,
            'created_by' => $_SESSION['user']['id'],
            'created_on' => date("Y-m-d"),
            'updated_on' => date("Y-m-d"),
            'need_enrollment' => $need_enrollment,
            'dept_id' => $passed_data['department'],
            'school_id' => $passed_data['school'],
        ]);

        if(!$inserted) {
            echo "failed to add event";
            die;
        }

        // if one day event, insert time and date in one_day_event_date
        if ($passed_data['one_day_event'] == 1) {
            // insert into the table one_day_event_date
            // $dateInsert =   $this->model('OneDayEvent');
            // $dataInserted = $dateInsert->insert([
            //     'time_from' => $passed_data['event_time_from'],
            //     'time_to' => $passed_data['event_time_to'],
            //     'date_on' => $passed_data['event_date_on'],
            //     'event_id' => $event_id,
            // ]);

            $dateInsert = $this->model('EventTimings');
            $dataInserted = $dateInsert->insert([
                'event_id' => $event_id,
                'one_day_event' => 1,
                'start_date' => $passed_data['event_date_on'],
                'end_date' => $passed_data['event_date_on'],
                'start_time' => $passed_data['event_time_from'],
                'end_time' => $passed_data['event_time_to'],
            ]);
        }

        // if multi day event, insert date in multi_day_event_date
        else if ($passed_data['one_day_event'] == 0) {
            // insert into the table one_day_event_date
            // $dateInsert =   $this->model('MultiDayEvent');
            // $dataInserted = $dateInsert->insert([
            //     'date_from' => $passed_data['event_date_from'],
            //     'date_to' => $passed_data['event_date_to'],
            //     'event_id' => $event_id,
            // ]);

            $dateInsert = $this->model('EventTimings');
            $dataInserted = $dateInsert->insert([
                'event_id' => $event_id,
                'one_day_event' => 0,
                'start_date' => $passed_data['event_date_from'],
                'end_date' => $passed_data['event_date_to'],
            ]);
        }

        // create pending-actions variable and add event id
        $_SESSION['edited-event-id'] = $event_id;

        // destroy new event error session
        $_SESSION['new-event-error'] = [];

        // redirect to page to add logo
        header("location: /edit-event?id=$event_id");
                
    }



    // function to add new contact
    public function add_contact ($passed_data) {
        /**
         * -- get the event id
         * -- csrf validation
         * -- check if its the owner of the event
         * -- validate the input data
         * -- get the details
         * -- update record in contact table
         */

        //  event id
        $event_id = $_SESSION['edited-event-id'];

        // verify csrf
        $this->verify_csrf($passed_data['csrf_token']);

        //  ownership verification
        $this->event_owner_verification($event_id);

        // validate the input data
        // validate the name
        if (!preg_match('/^[a-zA-Z0-9_\s]+$/', $passed_data['name'])) {
            // if the execution point reaches here
            // the string contains unallowed characters
            // redirect to sign-in-user with username domain violation

            // create the error message
            $_SESSION['contact-details-error'] = 'Only letters(a-z, A-Z), numbers(0-9) and Underscore(_), space( ) are allowed in the name';

            // redirect to contact details page
            header("location: /contact-details");

            // stop furthur execution
            die;
        }

        // validate the designation
        if (!preg_match('/^[a-zA-Z0-9_\s]+$/', $passed_data['designation'])) {
            // if the execution point reaches here
            // the string contains unallowed characters
            // redirect to sign-in-user with username domain violation

            // create the error message
            $_SESSION['contact-details-error'] = 'Only letters(a-z, A-Z), numbers(0-9) and Underscore(_), space( ) are allowed in the designation';

            // redirect to contact details page
            header("location: /contact-details");

            // stop furthur execution
            die;
        }

        // validate the contact no
        if (!preg_match('/^[0-9]+$/', $passed_data['number'])) {
            // if the execution point reaches here
            // the string contains unallowed characters
            // redirect to sign-in-user with username domain violation

            // create the error message
            $_SESSION['contact-details-error'] = 'Only numbers(0-9) are allowed in the contact number';

            // redirect to contact details page
            header("location: /contact-details");

            // stop furthur execution
            die;
        }

        // insert data into the database
        $inserted = $this->model('Contact')->insert([
            'name' => $passed_data['name'],
            'designation' => $passed_data['designation'],
            'contact' => $passed_data['number'],
            'event_id' => $event_id,
        ]);

        if (!$inserted) {
             // create the error message
             $_SESSION['contact-details-error'] = 'Failed to add Contact, Try Again!';

             // redirect to contact details page
             header("location: /contact-details");
 
             // stop furthur execution
             die;
        }

        // destroy the error message if any
        $_SESSION['contact-details-error'] = "";
        unset($_SESSION['contact-details-error']);

        header("location: /contact-details");
    }


    // function to add enrollment details for an event, what are the fields that will be asked while enrollment
    public function add_enrollment_details ($passed_data) {
        /**
         * -- get the event id
         * -- csrf validation
         * -- check if its the owner of the event
         * -- validate the input data
         * -- get the details
         * -- update record in enrollment details table
         */

        //  event id
        $event_id = $_SESSION['edited-event-id'];

        // verify csrf
        $this->verify_csrf($passed_data['csrf_token']);

        // if enrollment is not required in this event then stop
        $needed_enrollment = $this->model('Events')->fetch_where(' `id` =?', [$event_id])[0]['need_enrollment'];
        if (!$needed_enrollment) {
            echo "Cannot Add Enrollment Details for this Event! This might be because you have set this event to not required Enrollment!";

            die;
        }

        //  ownership verification
        $this->event_owner_verification($event_id);

        // validate the input data
        // validate the name
        if (!preg_match('/^[a-zA-Z0-9_\s]+$/', $passed_data['field-name'])) {
            // if the execution point reaches here
            // the string contains unallowed characters
            // redirect to enrollment-details with Field-name constraint violation error

            // create the error message
            $_SESSION['enrollment-details-error'] = 'Only letters(a-z, A-Z), numbers(0-9) and Underscore(_), space( ) are allowed in the field name';

            // redirect to contact details page
            header("location: /enrollment-details");

            // stop furthur execution
            die;
        }

        // insert data into the database
        $inserted = $this->model('EnrollmentDetails')->insert([
            'field_name' => $passed_data['field-name'],
            'field_type' => $passed_data['field-type'],
            'event_id' => $event_id,
        ]);

        if (!$inserted) {
             // create the error message
             $_SESSION['enrollment-details-error'] = 'Failed to add Field, Try Again!';

             // redirect to contact details page
             header("location: /enrollment-details");
 
             // stop furthur execution
             die;
        }

        // destroy the error message if any
        $_SESSION['enrollment-details-error'] = "";
        unset($_SESSION['enrollment-details-error']);

        header("location: /enrollment-details");

    }


    // function to add enrollment types for event
    public function add_enrollment_types ($passed_data) {
        /**
         * -- get the event id
         * -- csrf validation
         * -- check if its the owner of the event
         * -- validate the input data
         * -- get the types
         * -- update record in enrollment types table
         */

        //  event id
        $event_id = $_SESSION['edited-event-id'];

        // verify csrf
        $this->verify_csrf($passed_data['csrf_token']);

        //  ownership verification
        $this->event_owner_verification($event_id);

        // validate the input data
        // validate the type
        if (!preg_match('/^[a-zA-Z0-9_\s]+$/', $passed_data['enrollment-type'])) {
            // if the execution point reaches here
            // the string contains unallowed characters
            // redirect to enrollment-details with Field-name constraint violation error

            // create the error message
            $_SESSION['enrollment-details-error'] = 'Only letters(a-z, A-Z), numbers(0-9) and Underscore(_), space( ) are allowed in the Enrollment Type';

            // redirect to contact details page
            header("location: /enrollment-details");

            // stop furthur execution
            die;
        }
        // validate the enrollment currency
        if (!preg_match('/^[0-9]+$/', $passed_data['enrollment-charges'])) {
            // if the execution point reaches here
            // the string contains unallowed characters
            // redirect to enrollment-details with Field-name constraint violation error

            // create the error message
            $_SESSION['enrollment-details-error'] = 'Only Numbers are allowed in the Enrollment charges';

            // redirect to contact details page
            header("location: /enrollment-details");

            // stop furthur execution
            die;
        }

        // insert data into the database
        $inserted = $this->model('EnrollmentTypes')->insert([
            'enrollment_type' => $passed_data['enrollment-type'],
            'enrollment_charges' => $passed_data['enrollment-charges'],
            'enrollment_charges_curr' => $passed_data['enrollment-charges-currency'],
            'event_id' => $event_id,
        ]);

        if (!$inserted) {
             // create the error message
             $_SESSION['enrollment-details-error'] = 'Failed to add Field, Try Again!';

             // redirect to contact details page
             header("location: /enrollment-details");
 
             // stop furthur execution
             die;
        }

        // destroy the error message if any
        $_SESSION['enrollment-details-error'] = "";
        unset($_SESSION['enrollment-details-error']);

        header("location: /enrollment-details");
    }



    // function to add award
    public function add_award ($passed_data) {
        /**
         * -- get the event id
         * -- csrf validation
         * -- check if its the owner of the event
         * -- validate the input data
         * -- get the details
         * -- update record in awards table
         */

        //  event id
        $event_id = $_SESSION['edited-event-id'];

        // verify csrf
        $this->verify_csrf($passed_data['csrf_token']);

        // if enrollment is not required in this event then stop
        $needed_enrollment = $this->model('Events')->fetch_where(' `id` =?', [$event_id])[0]['need_enrollment'];
        if (!$needed_enrollment) {
            echo "Cannot Add Enrollment Details for this Event! This might be because you have set this event to not required Enrollment!";

            die;
        }


        //  ownership verification
        $this->event_owner_verification($event_id);


        // validate the input data
        // validate the name
        if (!preg_match('/^[a-zA-Z0-9_\s]+$/', $passed_data['name'])) {
            // if the execution point reaches here
            // the string contains unallowed characters
            // redirect to sign-in-user with username domain violation

            // create the error message
            $_SESSION['create-awards-error'] = 'Only letters(a-z, A-Z), numbers(0-9) and Underscore(_), space( ) are allowed in the name';

            // redirect to contact details page
            header("location: /create-awards");

            // stop furthur execution
            die;
        }
        // validate the no of winners
        if (!preg_match('/^[0-9]+$/', $passed_data['number'])) {
            // if the execution point reaches here
            // the string contains unallowed characters
            // redirect to sign-in-user with username domain violation

            // create the error message
            $_SESSION['create-awards-error'] = 'Only numbers(0-9) are allowed in the number';

            // redirect to contact details page
            header("location: /create-awards");

            // stop furthur execution
            die;
        }

        // insert record in the database
        // insert data into the database
        $inserted = $this->model('Awards')->insert([
            'name' => $passed_data['name'],
            'no_of_awards' => $passed_data['number'],
            'event_id' => $event_id,
        ]);

        // show error msg if data not inserted
        if (!$inserted) {
            // create the error message
            $_SESSION['create-awards-error'] = 'Failed to add Award, Try Again!';

            // redirect to contact details page
            header("location: /create-awards");

            // stop furthur execution
            die;
        }

        // refresh back to the same page
        // destroy the error message if any
        $_SESSION['create-awards-error'] = "";
        unset($_SESSION['create-awards-error']);

        header("location: /create-awards");
        
    }



    // functiont to delete a contact no
    public function delete_contact ($passed_data) {
        /**
         * -- get the contact id
         * -- check if the user is signed in
         * -- check ownership of the event
         * -- csrf validation
         * -- delete the contact 
         */

        //  contact id
        $contact_id = $passed_data['id'];
        
        // check ownership of event
        $contact_event_id = $this->model('Contact')->fetch_where(' `id` = ? ', [$contact_id])[0]['event_id'];
        //  ownership verification
        $this->event_owner_verification($contact_event_id);

        // csrf validation
        $this->verify_csrf($passed_data['csrf']);

        // delete the contact
        $deleted = $this->model('Contact')->delete_where(' `id` =  ?', [$contact_id]);

        // refresh back to contact details page
        header('location: /contact-details');
    }

    // function to delete additional page
    public function delete_page ($passed_data) {
        /**
         * -- get the page id
         * -- check if the user is signed in
         * -- check ownership of the event
         * -- csrf validation
         * -- delete the contact 
         */

        //  $page id
        $page_id = $passed_data['id'];

        // page event id
        $page_event_id = $this->model('Pages')->fetch_where(' `id` =?', [$page_id])[0]['event_id'];

        // ownership verification
        $this->event_owner_verification($page_event_id);

        // csrf validation
        $this->verify_csrf($passed_data['csrf']);

        // delete the page
        $deleted = $this->model('Pages')->delete_where(' `id` =  ?', [$page_id]);

        // refresh back to contact details page
        header('location: /add-additional-pages');

    }


    // function to add delete additional enrollment fields from event
    public function delete_added_field ($passed_data) {
         /**
         * -- get the field id
         * -- check if the user is signed in
         * -- check ownership of the event
         * -- csrf validation
         * -- delete the field 
         */

        //  field id
        $field_id = $passed_data['id'];

        // check ownership of event
        $field_event_id = $this->model('EnrollmentDetails')->fetch_where(' `id` = ? ', [$field_id])[0]['event_id'];
        //  ownership verification
        $this->event_owner_verification($field_event_id);

        // csrf validation
        $this->verify_csrf($passed_data['csrf']);

        // delete the field
        $deleted = $this->model('EnrollmentDetails')->delete_where(' `id` =  ?', [$field_id]);

        // refresh back to contact details page
        header('location: /enrollment-details');
    }

    // function to delete enrollment types of an event
    public function delete_enrollment_type ($passed_data) {
         /**
         * -- get the type id
         * -- check if the user is signed in
         * -- check ownership of the event
         * -- csrf validation
         * -- delete the field 
         */

        //  field id
        $type_id = $passed_data['id'];

        // check ownership of event
        $type_event_id = $this->model('EnrollmentTypes')->fetch_where(' `id` = ? ', [$type_id])[0]['event_id'];
        //  ownership verification
        $this->event_owner_verification($type_event_id);

        // csrf validation
        $this->verify_csrf($passed_data['csrf']);

        // delete the field
        $deleted = $this->model('EnrollmentTypes')->delete_where(' `id` =  ?', [$type_id]);

        // refresh back to contact details page
        header('location: /enrollment-details');
    }


    // functiont to delete a contact no
    public function delete_award ($passed_data) {
        /**
         * -- get the award id
         * -- check if the user is signed in
         * -- check ownership of the event
         * -- csrf validation
         * -- delete the award
         */

        //  award id
        $award_id = $passed_data['id'];
        
        // check ownership of event
        $award_event_id = $this->model('Awards')->fetch_where(' `id` = ? ', [$award_id])[0]['event_id'];
        //  ownership verification
        $this->event_owner_verification($award_event_id);

        // csrf validation
        $this->verify_csrf($passed_data['csrf']);

        // delete the contact
        $deleted = $this->model('Awards')->delete_where(' `id` =  ?', [$award_id]);

        // refresh back to contact details page
        header('location: /create-awards');
    }




    // function to add new additional page
    public function add_page ($passed_data) {
        /**
         * ------------ add additional pages for the event
         * 
         * -- get event id
         * -- csrf validation
         * -- check event ownership
         * -- input values sanitization
         * -- insert into the database
         * -- refresh back to the same page
         * 
         */

        //  event id
        $event_id = $_SESSION['edited-event-id'];

        // verify csrf
        $this->verify_csrf($passed_data['csrf_token']);

        //  ownership verification
        $this->event_owner_verification($event_id);

        // input values sanitization
        // validate the name
        if (!preg_match('/^[a-zA-Z0-9_\s]+$/', $passed_data['name'])) {
            // if the execution point reaches here
            // the string contains unallowed characters
            // redirect to sign-in-user with username domain violation

            // create the error message
            $_SESSION['create-pages-error'] = 'Only letters(a-z, A-Z), numbers(0-9) and Underscore(_), space( ) are allowed in the name';

            // redirect to contact details page
            header("location: /add-additional-pages");

            // stop furthur execution
            die;
        }

        // sanitize the details part for dangerous tags
        $stripped_page_details = strip_tags($passed_data['details'], [
            '<p>', '<strong>', '<s>', '<ul>', '<ol>', '<li>', '<blockquote>', '<hr>', '<br>', '<h1>', '<h2>', '<h3>'
        ]);

        $inserted = $this->model('Pages')->insert([
            'name' => $passed_data['name'],
            'details' => $stripped_page_details,
            'event_id' => $event_id,
        ]);

        // refresh back to the same page
        header('location: /add-additional-pages');

    }


    // function to turn a privae event to public
    public function event_to_public($passed_data) {
        /**
         * -- check if user is signed in using middleware
         * -- check if the event id is passed
         * -- get the event id
         * -- check ownership of the event
         * -- csrf validation
         * -- update record in the event
         * 
         */

        //  check if event id is passed
        if (!isset($passed_data['id'])){
            echo "Invalid Approach!";

            // stop furthur execution
            die;
        }

        // get the event id
        $event_id = $passed_data['id'];

        //  ownership verification
        $this->event_owner_verification($event_id);

        // csrf validation
        $this->verify_csrf($passed_data['csrf']);

        // update record in database
        $updated = $this->model('Events')->query("UPDATE `events` SET `public`='1' WHERE `id` = ?", [$event_id]);

        header("location: /manage-events");

    }


    // function to turn a public event to private
    public function event_to_private($passed_data) {
        /**
         * -- check if user is signed in using middleware
         * -- check if the event id is passed
         * -- get the event id
         * -- check ownership of the event
         * -- csrf validation
         * -- update record in the event
         * 
         */

        //  check if event id is passed
        if (!isset($passed_data['id'])){
            echo "Invalid Approach!";

            // stop furthur execution
            die;
        }

        // get the event id
        $event_id = $passed_data['id'];

        //  ownership verification
        $this->event_owner_verification($event_id);

        // csrf validation
        $this->verify_csrf($passed_data['csrf']);

        // update record in database
        $updated = $this->model('Events')->query("UPDATE `events` SET `public`='0' WHERE `id` = ?", [$event_id]);

        header("location: /manage-events");

    }


    // function to start enrollment
    public function start_enrollment ($passed_data) {
        /**
         * -- get the event id
         * -- check if the user is the owner of the event
         * -- verify csrf -------------
         * -- check if enrollment types have been created
         * -- update record in database to indicate that enrollment has started
         */

        $event_id = $passed_data['id'];

        //  ownership verification
        $this->event_owner_verification($event_id);

        // verify csrf
        $this->verify_csrf($passed_data['csrf']);

        // check if enrollment types have been created
        $enrollment_types = $this->model('EnrollmentTypes')->fetch_where(' `event_id` = ? ', [$event_id]);
        if (count($enrollment_types) < 1) {
            echo "Cannot Start Enrollment!, Please create enrollment details before you start enrollment in an event";

            // stop furthure execution
            die;
        }

        // start enrollment
        // update record in database to indicated enrollment is going on
        $this->model('Events')->query("UPDATE `events` SET `enrollment`='1' WHERE `id` = ?", [$event_id]);

        // return back to the same page
        header("location: /manage-events");
    }


    // function to stop enrollment of an event 
    public function stop_enrollment ($passed_data) {
        /**
         * -- get the event id
         * -- check if the user is the owner of the event
         * -- verify csrf -------------
         * -- update record in database to indicate that enrollment has ended
         */

        $event_id = $passed_data['id'];

        //  ownership verification
        $this->event_owner_verification($event_id);

        // verify csrf
        $this->verify_csrf($passed_data['csrf']);


        // stop enrollment
        // update record in database to indicated enrollment has ended
        $this->model('Events')->query("UPDATE `events` SET `enrollment`='0' WHERE `id` = ?", [$event_id]);

        // return back to the same page
        header("location: /manage-events");
    }



    // function to enroll user to an event
    public function enroll ($passed_data) {
        /**
         * -- get the event id
         * -- check if enrollment is going on
         * -- get the post data
         * -- validate the post data
         * -- insert into database
         * -- add additional info
         */

        //  get the event id
        if (!isset($passed_data['id'])) {
            echo "ERROR 400: BAD REQUEST";

            // stop furthur execution
            die;
        }
        $event_id = $passed_data['id'];

        // verify csrf
        $this->verify_csrf($passed_data['csrf_token']);

        // check if enrollment is going on
        $enrollment_going_on = $this->model('Events')->fetch_where(' `id` = ? ', [$event_id])[0]['enrollment'];

        if (!$enrollment_going_on) {
            // enrollment is not going on
            echo "ERROR 403: FORBIDDEN";
            echo "<br> Enrollment is not going on";

            // stop furthur execution 
            die;
        }
        

        // validate name and phone number
        if(!preg_match('/^[a-zA-Z0-9\s_]+$/', $passed_data['username'])) {
            $_SESSION['enrollment-error'] = "Please enter Correct Details in the form";
            header("location: /enroll?id=" . $event_id);
            // stop furthur execution
            die;
        }
        // validate phone
        if(!preg_match('/^[0-9\s]+$/', $passed_data['phone'])) {
            $_SESSION['enrollment-error'] = "Please enter Correct Details in the form";
            header("location: /enroll?id=" . $event_id);
            // stop furthur execution
            die;
        }

        // validate the form data
        foreach ($_POST as $key => $value) {
            if ($key !== 'username' && $key !== 'phone' && $key !== 'type' && $key !== 'csrf_token') {
                $field_type = $this->model('EnrollmentDetails')->fetch_where(' `id` = ? ', [(int)$key]);

                if ($field_type == 'text') {
                    if(!preg_match('/^[a-zA-Z0-9\s_]+$/', $value)) {
                        $_SESSION['enrollment-error'] = "Please enter Correct Details in the form";
                        header("location: /enroll?id=" . $event_id);
                        // stop furthur execution
                        die;
                    }
                }

                else if ($field_type == 'number') {
                    if(!preg_match('/^[0-9\s]+$/', $value)) {
                        $_SESSION['enrollment-error'] = "Please enter Correct Details in the form";
                        header("location: /enroll?id=" . $event_id);
                        // stop furthur execution
                        die;
                    }
                }

                else if ($field_type == 'email') {
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $_SESSION['enrollment-error'] = "Please enter Correct Details in the form";
                        header("location: /enroll?id=" . $event_id);
                        // stop furthur execution
                        die;
                    }
                }
            }
        }


        // verification completed
        $no = date('ymdhis') . $event_id;

        // create record in the database
        $this->model('Enrollment')->insert([
            'enrollment_no' => $no,
            'event_id' => $event_id,
            'name' => $passed_data['username'],
            'phone' => $passed_data['phone'],
            'type' => $passed_data['type'],
            'date' => date('y-m-d'),
            'fee_payment' => 0,
        ]);

        // create record for the additional details
        foreach ($_POST as $key => $value) {
            if ($key !== 'username' && $key !== 'phone' && $key !== 'type' && $key !== 'csrf_token') {
                $this->model('EnrollmentAddDet')->insert([
                    'enrollment_no' => $no,
                    'event_id' => $event_id,
                    'field_id' => $key,
                    'field_value' => $value,
                ]);
            }
        }
        
        // show enrollment certificate
        header('location: /enrollment-certificate?id='.$no);
    }


    // function to distribute prizes
    public function distribute_prizes ($passed_data) {
        /**
         * -- get event id
         * -- check csrf
         * -- check event ownership
         * -- store data in database  
         */

        //  get the event id
        if (!isset($passed_data['id'])) {
            echo "ERROR 400: BAD REQUEST";

            // stop furthur execution
            die;
        }
        $event_id = $passed_data['id'];

        //  ownership verification
        $this->event_owner_verification($event_id);

        // verify csrf
        $this->verify_csrf($passed_data['csrf_token']);

        // get the event details
        $event = $this->model('Events')->fetch_where(" `id` = ? ", [$event_id])[0];

        

        // update record in winners table for each prize
        foreach ($_POST as $prize => $winner) {
            if ($prize !== 'csrf_token') {
                $prize_id = (int)substr($prize, 0, -2);
                $digits = 3;
                $certificate_no = date('ymdhis') . rand(pow(10, $digits-1), pow(10, $digits)-1) . $event_id;
                
                // if no winner selected, then skip inserting into database
                if ($winner !== 'none') {
                    $this->model('Winners')->insert([
                        'event_id' => $event_id,
                        'prize_id' => $prize_id,
                        'winner_id' => $winner,
                        'certificate_no' => $certificate_no,
                    ]);
                }
                
            }
        }

        // close the event
        $this->model('Events')->query("UPDATE `events` SET `public`='0',`enrollment`='0',`active`='0',`ended`='1' WHERE `id` =? ", [$event_id]);

        // return back to manage events page
        echo "<script>window.alert('The event has been closed successfully');</script>";
        header("location: /manage-events");
    }


    // function to close event that does not require enrollment
    public function close_event ($passed_data) {
        /**
         * -- get event id 
         * -- check if the event does not require enrollment, if it requires enrollment then cannot close event with this method
         * -- verify csrf
         * -- verify ownership
         * -- close event
         */

        //  event id
        $event_id = $passed_data['id'];

        // check if the event requires enrollment, if yes then stop furthur execution
        if ( $this->model('Events')->fetch_where(' `id` = ?', [$event_id])[0]['need_enrollment'] ) {
            echo "ERROR: FORBIDDEN";

            die;
        }

        // csrf verification
        $this->verify_csrf($passed_data['csrf']);

        // verify ownership
        $this->event_owner_verification($event_id);

        // close event
        $this->model('Events')->query("UPDATE `events` SET `public`='0',`active`='0' WHERE `id` = ?", [$event_id]);

        // return back to manage events page
        echo "<script>window.alert('The event has been closed successfully');</script>";
        header("location: /manage-events");
        
    }

    // function to change template of the event
    public function change_template_to_1 ($passed_data) {
        /**
         * -- get event id
         * -- check csrf
         * -- check ownership
         * -- change template to 1
         */

        //  get id of event
        $event_id = $passed_data['id'];

        //  verify csrf
        $this->verify_csrf($passed_data['csrf']);

        // event owner verification
        $this->event_owner_verification($event_id);

        // update record
        $this->model('Events')->query("UPDATE `events` SET `theme`='1' WHERE `id` = ?", [$event_id]);

        header("location: /manage-events");

    }


    // function to change template of the event
    public function change_template_to_2 ($passed_data) {
        /**
         * -- get event id
         * -- check csrf
         * -- check ownership
         * -- change template to 2
         */

        //  get id of event
        $event_id = $passed_data['id'];

        //  verify csrf
        $this->verify_csrf($passed_data['csrf']);

        // event owner verification
        $this->event_owner_verification($event_id);

        // update record
        $this->model('Events')->query("UPDATE `events` SET `theme`='2' WHERE `id` = ?", [$event_id]);
        
        header("location: /manage-events");


    }


    public function update_event_summary ($passed_data) {
        /**
         * this  function will be used to update the summary of the event
         * -- get event id
         * -- check for csrf
         * -- check ownership  of the event
         * -- update the record
         * -- return back to the same page
         */

        //  get id of event
        $event_id = $passed_data['id'];

        //  verify csrf
        $this->verify_csrf($passed_data['csrf_token']);

        // event owner verification
        $this->event_owner_verification($event_id);

        // update record
        $this->model('Events')->query("UPDATE `events` SET `event_description`=? WHERE `id` = ?", [trim($passed_data['event-summary']), $event_id]);
        
        // return back to the previous page
        header("location: /edit-event?id=".$passed_data['id']);
    }



    public function distribute_prizes_close_event ($passed_data) {
        /**
         * -- get the event id
         * -- csrf verification
         * -- event ownership verification
         * -- distribute the prizes and close the event
         */

        //  get the event id
        $event_id = $passed_data['id'];

        // csrf verification
        $this->verify_csrf($passed_data['csrf_token']);

        // event owner verification
        $this->event_owner_verification($event_id);

        echo "<pre>";
        
        // distribute the prizes and cloase the event 
        foreach ($passed_data as $prize_id => $winner_id) {
           if ($prize_id !== 'id' && $prize_id !== 'csrf_token' && $winner_id !== 'none') {
                
                // extract prize id
                $prize_id = explode("_", $prize_id)[0];

                // create a random certificate number
                $certificate_no = $event_id . $prize_id . $winner_id . substr(str_shuffle("0123456789"), 0, 5);
                
                // create winner
                $this->model('Winners')->insert([
                    'event_id' => $event_id,
                    'prize_id' => $prize_id,
                    'winner_id' => $winner_id,
                    'certificate_no' => $certificate_no,
                ]);

           }
        }


        // close the event
        // set public = 0 (make the event private)
        // set active = 0 (make the event inactive)
        // set ended = 1 (denote that event has ended)
        // set need_enrollment = 0 (donte that event does not need enrollment now)
        $this->model('Events')->query(" UPDATE `events` SET `public`='0', `enrollment`='0', `active`='0',`ended`='1', `need_enrollment`='0' WHERE `id` = ? ", [$event_id]);


        // redirect to manage events page 
        header("Location: /manage-events");
    }

}  