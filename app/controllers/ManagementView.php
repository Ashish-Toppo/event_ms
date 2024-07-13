<?php

class Managementview extends Controller {

    // this controller will handle all the view requests for the event managers
    /**
     * 1. main page for viewing the events created by user
     * 2. add new event 
     * 3. edit existing event
     */

    // default directory for the public view pages
    private $default_public_directory = 'management/';

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
        die;
    }


    // function to return the main page to view and mange events as soon as user signs in
    public function main () {
        // as soon as user signs in, the the following information and return the main management view page

        /**
         * get the following information and send along with view 
         * 1. all events created and view links, button to start enrollment, make public/private, close event after selecting winners
         */

        //  the main page
        $main_page = $this->default_public_directory . 'main';

        // the active events
        $user_events = [];

        // the past events
        $past_events = [];

        // if the user is super admin send all events
        if ($_SESSION['user']['user_type'] == 1) {
            // all active events 
            $user_events = $this->model('Events')->fetch_where("  `active` = '1' ");
            // all past events
            $past_events = $this->model('Events')->fetch_where("  `active` = '0' ");
        }
        else if ($_SESSION['user']['user_type'] == 2) {
            // all active events created by user
            $user_events = $this->model('Events')->fetch_where(' `created_by` = ? AND `active` = 1 ', [$_SESSION['user']['id']]);
            // all past events created by user
            $past_events = $this->model('Events')->fetch_where(' `created_by` = ? AND `active` = 0 ', [$_SESSION['user']['id']]);
        }
        
        // create view data
        $view_data = [
            'active_events' => $user_events,
            'past_events' => $past_events,
        ];

        // echo "<pre>"; print_r($view_data); die;

        // return the view page with necessary information
        $this->view($main_page, $view_data);
    }


    // function to handle the add new event view paage request
    public function new_event () {
        // if user wants to add new event, this page will be shown
        /**
         * 1. add new event details
         * 2. add any number of images
         * 3. add any number of additional pages
         */

        //  the add_event page
        $add_event_page = $this->default_public_directory . 'new-event';

        // get information of all the campusses
        $conn = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

        $query = $conn->query(" SELECT * FROM `campuses` ");

        $campuses = $query->fetch_all(MYSQLI_ASSOC);

        $view_data = [
            'campuses' => $campuses,
        ];


        // return the view page for add new event
        $this->view($add_event_page, $view_data);
    }


    // function to handle the upload images view page
    public function upload_images () {
        /**
         * ------------------ upload images for events
         * -- get the event id
         * -- ownership verification
         * -- get the name of the event
         * -- get the images of the event
         * -- return the upload-images page with images
         * 
         */

        //  ownership verification
        $this->event_owner_verification($_SESSION['edited-event-id']);

         // get the name of the event
        $events = $this->model('Events');
        $event_name = $events->query("SELECT `event_name` FROM `events` WHERE `id` = ? ", [$_SESSION['edited-event-id']])[0]['event_name'];

        // get all the images of the event
        $images = $this->model('Images')->fetch_where('event_id = ?', [$_SESSION['edited-event-id']]);
        
        $view_data = [
            'event_name' => $event_name,
            'images' => $images,
        ];

        // the upload images page
        $add_event_page = $this->default_public_directory . 'upload-images';


        // return the view page with necessary image files
        $this->view($add_event_page, $view_data);
    }


    // function to show add event logo to event
    public function upload_logo () {
        /**
         * -- ownerhsip verification
         * -- send the add logo page with event id
         */

        //  event id
        
        //  ownership verification
        $this->event_owner_verification($_SESSION['edited-event-id']);

        // get the name of the event
        $events = $this->model('Events');
        $event_name = $events->query("SELECT `event_name` FROM `events` WHERE `id` = ? ", [$_SESSION['edited-event-id']])[0]['event_name'];

        $view_data = [
            'event_name' => $event_name,
        ];

        // the add logo page
        $add_logo_page = $this->default_public_directory . 'upload-logo';

        // return the view page of the upload-event with event id
        $this->view($add_logo_page, $view_data);
    }




    // function to show the add contact details page
    public function contact_details ($passed_data) {
        /**
         * ------------------ contact details for the event
         * -- get the event id
         * -- ownership verification
         * -- get the name of the event
         * -- get the contact details of the event
         * -- return the contact details page of the event
         * 
         */

         //  ownership verification
        $this->event_owner_verification($_SESSION['edited-event-id']);

         // get the name of the event
         $events = $this->model('Events');
         $event_name = $events->query("SELECT `event_name` FROM `events` WHERE `id` = ? ", [$_SESSION['edited-event-id']])[0]['event_name'];
 
         // get all the contact details of the event
         $contacts = $this->model('Contact')->fetch_where('event_id = ?', [$_SESSION['edited-event-id']]);
         
         $view_data = [
             'event_name' => $event_name,
             'contacts' => $contacts,
         ];
 
         // the upload images page
         $view_page_name = $this->default_public_directory . 'contact-details';
 
 
         // return the view page with necessary image files
         $this->view($view_page_name, $view_data);

    }


    // function to return the page where user can create awards
    public function create_awards () {
        /**
         * ----------- return the page to create awards
         * -- get the event id
         * -- ownership verification
         * -- get the name of the event
         * -- get the awards of the event
         * -- return the create awards page of the event
         */

         //  ownership verification
        $this->event_owner_verification($_SESSION['edited-event-id']);
         
        // get the name of the event
        $events = $this->model('Events');
        $event_name = $events->query("SELECT `event_name` FROM `events` WHERE `id` = ? ", [$_SESSION['edited-event-id']])[0]['event_name'];

        // get all the awards of the event
        $awards = $this->model('Awards')->fetch_where('event_id = ?', [$_SESSION['edited-event-id']]);

        // the create awards page
        $view_page_name = $this->default_public_directory . 'create-awards';

        // view data to send to the view page
        $view_data = [
            'event_name' => $event_name,
            'awards' => $awards,
        ];


        // return the create awards page of the event
        $this->view($view_page_name, $view_data);

    }



    // function to return the page where user can create additional pages
    public function add_additional_pages () {
        /**
         * ----------- return the page to create additional pages
         * -- get the event id
         * -- ownership verification
         * -- get the name of the page
         * -- get the pages of the event
         * -- return the create additional pages page of the event
         */

         //  ownership verification
        $this->event_owner_verification($_SESSION['edited-event-id']);

        // get the name of the event
        $events = $this->model('Events');
        $event_name = $events->query("SELECT `event_name` FROM `events` WHERE `id` = ? ", [$_SESSION['edited-event-id']])[0]['event_name'];

        // get all the pages of the event
        $pages = $this->model('Pages')->fetch_where('event_id = ?', [$_SESSION['edited-event-id']]);

        // the create awards page
        $view_page_name = $this->default_public_directory . 'add-additional-pages';

        // view data to send to the view page
        $view_data = [
            'event_name' => $event_name,
            'pages' => $pages,
        ];


        // return the create awards page of the event
        $this->view($view_page_name, $view_data);

    }


    // function to show the edit events page
    public function edit_event ($passed_data) {
        /**
         *  ---------- show the edit events page
         * 
         *  --  get the id of the event
         *  --  check the ownership of the event
         *  --  get the event details 
         *  -- create edited-event-id session variable 
         *  --  return the edit event page
         */

        //  event id 
        $event_id = $passed_data['id'];

        //  ownership verification
        $this->event_owner_verification($event_id);


        // get the event details
        $event = $this->model('Events')->fetch_where(" `id` = ? ", [$event_id])[0];

        // edited-event-id session variable
        $_SESSION['edited-event-id'] = $event_id;


        // edit event page
        $edit_event_page = $this->default_public_directory . 'edit-event';

        // view data
        $view_data = [
            'event' => $event,
        ];


        // return the edit event page with details
        $this->view($edit_event_page, $view_data);


    }


    // function to return the enrollment details page
    public function enrollment_details () {
         /**
         *  ---------- show the enrollment details page
         * 
         *  --  get the id of the event
         *  --  check the ownership of the event
         *  --  get the event details 
         *  -- create edited-event-id session variable 
         *  --  return the edit event page
         */
        if (!isset($_SESSION['edited-event-id'])) {
            echo "Invalid Approach!";

            die;
        }

        //  event id 
        $event_id = $_SESSION['edited-event-id'];

        //  ownership verification
        $this->event_owner_verification($event_id);


        // get the event details
        $event = $this->model('Events')->fetch_where(" `id` = ? ", [$event_id])[0];


        

        // return the saved enrollment details of the event 
        $det = $this->model('EnrollmentDetails')->fetch_where(" `event_id` =? ", [$event_id]);
        

        // return the saved enrollment types of the event
        $enType = $this->model('EnrollmentTypes')->fetch_where(" `event_id` =? ", [$event_id]);

        // edit event page
        $enrollment_details_page = $this->default_public_directory . 'enrollment-charges';

        // view data
        $view_data = [
            'event' => $event,
            'det' => $det,
            'enType' => $enType,
        ];


        // return the edit event page with details
        $this->view($enrollment_details_page, $view_data);
    }


    // function to return the page where event managers can view the participants
    public function view_participants ($passed_data) {
        /**
         * -- get the event id
         * -- check ownership of event
         * -- get enrollment data
         * -- get additional data for each enrollment of the event
         * -- show the page with info
         */

        //  get the event id
        $event_id = $passed_data['id']; 

        //  ownership verification
        $this->event_owner_verification($event_id);

        // get the event details
        $event = $this->model('Events')->fetch_where(" `id` = ? ", [$event_id])[0];

        // whether event has ended or not
        $event_ended = $event['ended'];

        // get the enrollments for the event
        $enrollments = $this->model('Enrollment')->fetch_where(" `event_id` = ? ", [$event_id]);

        // add additional enrollment data for each record
        $add_fields = $this->model('EnrollmentDetails')->fetch_where(" `event_id` = ? ", [$event_id], PDO::FETCH_ASSOC);

        

        for($i = 0; $i < count($enrollments); $i++) {
            // the enrollment no for this enrollment
            $enrollment_no = $enrollments[$i]['enrollment_no'];

            $enrollments[$i]['additional_fields'] = [];

            foreach ($add_fields as $key => $value) {
                // current field id and name
                $field_id = $value['id'];
                $field_name = $value['field_name'];

                // get the field value
                $field_value = $this->model('EnrollmentAddDet')->fetch_where(" `field_id` =? && `enrollment_no` =? ", [$field_id, $enrollment_no])[0]['field_value'];
                
                // add key and value to the original array
                $enrollments[$i]['additional_fields'][$field_name] = $field_value;
            }

            // get type name of each enrollment
            $type_name = $this->model('EnrollmentTypes')->fetch_where(' `id` =? ', [$enrollments[$i]['type']])[0]['enrollment_type'];

            // add type to each enrollment
            $enrollments[$i]['enrollment_type'] = $type_name;
        }

        // return the page with details
        // edit event page
        $edit_event_page = $this->default_public_directory . 'enrollment-details';

        $view_data = [
            'event_id' => $event_id,
            'event_ended' => $event_ended,
            'enrollments' => $enrollments,
        ];

        // print "<pre>"; print_r($enrollments); die;

        // return the edit event page with details
        $this->view($edit_event_page, $view_data);
    }


    // function show the page where the event managers can select winners before closing the events
    public function distribute_prizes ($passed_data) {
        /**
         * -- get the event id
         * -- check ownership of event
         * -- get enrollment data
         * -- prizes data
         * -- show the page with info
         */

        //  get the event id
        $event_id = $passed_data['id']; 

        //  ownership verification
        $this->event_owner_verification($event_id);

        // get the event details
        $event = $this->model('Events')->fetch_where(" `id` = ? ", [$event_id])[0];

        // get prizes data
        $prizes = $this->model('Awards')->fetch_where(' `event_id` =? ', [$event_id]);

        // get enrollment data
        $enrollments = $this->model('Enrollment')->fetch_where(' `event_id` =? ', [$event_id]);

        // return the page with details
        // edit event page
        $edit_event_page = $this->default_public_directory . 'distribute-prizes';

        $view_data = [
            'event_name' => $event['event_name'],
            'event_id' => $event_id,
            'enrollments' => $enrollments,
            'prizes' => $prizes,
        ];

        // print "<pre>"; print_r($view_data); die;

        // print "<pre>"; print_r($enrollments); die;

        // return the edit event page with details
        $this->view($edit_event_page, $view_data);
    }

    // function to show page from where user can change themse of the event
    public function change_templates () {
        /**
         * -- get event id
         * -- get t
         */
    }

}