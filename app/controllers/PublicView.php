<?php

class PublicView extends Controller {

    // this controller will handle all the view requests for the publicly available pages
    /**
     * 1. Home page
     * 2. Event details page
     */

    // default directory for the public view pages
    private $default_public_directory = 'public/';


    // function to handle the home page request
    public function home () {

        // return the home page with information:
        /**
         * 1. links of additional pages created by the super admin
         * 2. all currently active events
         * 
         */

        // home page 
        $home_page = $this->default_public_directory . 'home_2';


        // start fetching the necessary information:

        // -- links of additional pages created by the super admin

        // -- all currently active events
        $events = $this->model('Events')->fetch_where(" `public` = 1 ");

        $view_data = [
            'events' => $events,
        ];

        // return the home page with the info
        $this->view($home_page, $view_data);
        
    }


    // function to handle the view event details page
    public function event_info ($passed_data) {

        // return the event info page with information:
        /**
         * -- check if the user reached here after creating new event :
         * ----------> If user reached here after creating new event, check if user has pending event actions
         * --------------------------> If user has pending event actions, redirect to necessary action page
         * 
         * -- fetch necessasry informaiton for the event
         * -- details and images of the event
         * -- all additional event details page links
         * 
         */

        

        // get id of the event
        $event_id = $passed_data['id'];


        // ------------ check if user has pending event action --> redirect
        if (isset($_SESSION['pending-event-actions']) && count($_SESSION['pending-event-actions']) > 0 ) {
            $next_page = array_pop($_SESSION['pending-event-actions']);

            // redirect
            header("location: $next_page");

            // stop furthur execution
            die;
        }

        // start fetching the necessary information:

        // --- all information of the event and images of the event
        /**
         * -- name of event, description of the event, logo ---
         * -- date,time of event ---
         * -- awards
         * -- images
         * -- queries contact info
         * -- additional information page
         */

        //  event details
        $curr_event = [];

        //  -- name, desc, logo of event
        $events = $this->model('Events');
        $event = $events->fetch_where(" `id` = ? ", [$event_id])[0];
        $curr_event[ 'details' ] = $event;



        //  -- date,time of eveent
        $curr_event['date'] = $this->model('EventTimings')->fetch_where(" `event_id` = ? ", [$event_id])[0];
        

        //  -- awards offered in the event
        $awards = $this->model('Awards');
        $award = $awards->fetch_where(" `event_id` = ? ", [$event_id]);
        if ( count($award) > 0 ) {
            $curr_event['awards'] = $award;
        } else {
            $curr_event['awards'] = 0;
        }

        // -- images of the event
        $images = $this->model('Images');
        $image = $images->fetch_where(" `event_id` = ? ", [$event_id]);
        if ( count($image) > 0 ) {
            $curr_event['images'] = $image;
        } else {
            $curr_event['images'] = 0;
        }


        // -- contact detail of the event
        $contacts = $this->model('Contact');
        $contact = $contacts->fetch_where(" `event_id` = ? ", [$event_id]);
        if ( count($contact) > 0 ) {
            $curr_event['contacts'] = $contact;
        } else {
            $curr_event['contacts'] = 0;
        }

        // -- all additional information pages of the event
        $pages = $this->model('Pages')->fetch_where(" `event_id` = ? ", [$event_id]);

        $curr_event['pages'] = $pages;

        // home page 
        $event_page = $this->default_public_directory . 'event_' . $event['theme'];

        // return the home page with the info
        $this->view($event_page, $curr_event);
        
    }


    // public function to return the page where users can enroll in events
    public function enroll ($passed_data) {
        /**
         * -- get the event id
         * -- check if enrollment is going on
         * -- fetch the name of the event
         * -- fetch the enrollment fields required for the event
         * -- fetch the enrollment types for the field
         * -- return the enroll page with data
         */

        //  get the event id
        $event_id = $passed_data['id'];

        // check if enrollment is going on
        $enrollment_going_on = $this->model('Events')->fetch_where(' `id` = ? ', [$event_id])[0]['enrollment'];
        if (!$enrollment_going_on) {
            // enrollment is not going on
            echo "ERROR 403: FORBIDDEN";
            echo "<br> Enrollment is not going on";

            // stop furthur execution 
            die;
        } 

        // fetch the name of the event
        $event_name = $this->model('Events')->fetch_where(' `id` = ? ', [$event_id])[0]['event_name'];

        // fetch enrollment fields required for the event
        $enrollment_fields = $this->model('EnrollmentDetails')->fetch_where(' `event_id` = ? ', [$event_id]);

        // fetch enrollment types for the event
        $enrollment_types = $this->model('EnrollmentTypes')->fetch_where(' `event_id` = ? ', [$event_id]);

        $view_data = [
            'event_id' => $event_id,
            'event_name' => $event_name,
            'enrollment_fields' => $enrollment_fields,
            'enrollment_types' => $enrollment_types,
        ];

        // enroll page 
        $page = $this->default_public_directory . 'enroll';

        // return the page with necesary info
        $this->view($page, $view_data);
    }


    
    // function to show enrollment certificate
    public function enrollment_certificate ($passed_data) {
        /**
         * -- get certificate no
         * -- get enrollment certificate details
         * -- show the certificate
         */

        // get certificate no
        $no = $passed_data['id'];

        // get enrollment details
        $enrollment_det = $this->model('Enrollment')->fetch_where(' `enrollment_no` = ?', [$no])[0];

        $event_name = $this->model('Events')->fetch_where(' `id` = ? ', [$enrollment_det['event_id']])[0]['event_name'];

        // enrollment charges
        $enrollment_charges_det = $this->model('EnrollmentTypes')->fetch_where(' `id` = ? ', [$enrollment_det['type']])[0];

        $enrollment_charges = $enrollment_charges_det['enrollment_charges_curr'] . ' ' . $enrollment_charges_det['enrollment_charges'];
        
        $view_data = [
            'event_name' => $event_name,
            'enrollment_no' => $no,
            'details' => $enrollment_det,
            'enrollment_charges' => $enrollment_charges,
        ];

        // enrollment certificate page 
        $page = $this->default_public_directory . 'enroll_certificate';

        // return the page with necesary info
        $this->view($page, $view_data);
    }


    // function to show the page from where they can check enrollment
    public function check_enrollment () {
        // sign in page
        $page = $this->default_public_directory . 'check_enrollment';

        // return the sign in page 
        $this->view($page);
    }

    // function to show the sign in as user page 
    public function sign_in_user () {

        // page
        $page = $this->default_public_directory . 'sign-in';

        // return the sign in page 
        $this->view($page);
    }


    // function to show additional information page of any event
    public function page ($passed_data) {
        $page_id = $passed_data['id'];

        // get the page information        
        $page = $this->model('Pages')->fetch_where(' `id` = ? ', [$page_id])[0];

        // get the event id of the page
        $event_id = $page['event_id'];

        // get all the other pages of the event
        $pages = $this->model('Pages')->fetch_where(' `event_id` = ?  ', [$event_id]);

        // get the event name 
        $event_name = $this->model('Events')->fetch_where(' `id` = ? ', [$event_id])[0]['event_name'];

        $view_data = [
            'event_name' => $event_name,
            'event_id' => $event_id,
            'page' => $page,
            'pages' => $pages,
        ];

        // page 
        $additional_info_page = $this->default_public_directory . 'page';


        // return the page with view data
        $this->view($additional_info_page, $view_data);

    }


    // function to show the page from where the user will enter enrollment no and see the result of the event
    public function see_results ($passed_data) {
        //  page 
        $page = $this->default_public_directory . 'see-result-form';


        // return the page with view data
        $this->view($page);
    }


    // function to check the event of the given enrollment and show the winners
    public function see_results_of_event ($passed_data) {
        /** ---------------------- (shift to public APIs later)
         * -- get the enrollment no
         * -- find the event id of the enrollment
         * -- check if the event has ended, otherwise there will be no winners
         * -- find all the winners of the enrollment
         * -- show it with links to download winner certificate
         */

        //  enrollment no
        $enrollment_no = $passed_data['id'];

        // event id
        $event_id = $this->model('Enrollment')->fetch_where(' `enrollment_no` = ?', [$enrollment_no])[0]['event_id'];

        // check if event has ended
        $event = $this->model('Events')->fetch_where(' `id` =?', [$event_id])[0];

        $event_name = $event['event_name'];

        $event_ended = $event['ended'];

        if (!$event_ended) {
            echo " Events Resulsts are not declared yet! <br> Come back after some time";
        }

        $winners = $this->model('Winners')->fetch_where(' `event_id` =? ', [$event_id]);

        // for ecah winner get the winner name and prize
        for ( $i = 0; $i < count($winners); $i++ ) {
            // find the winner name 
            $winners[$i]['winner_name'] = $this->model('Enrollment')->fetch_where(' `id` =? ', [$winners[$i]['winner_id']])[0]['name'];

            // find the prize
            $winners[$i]['prize_name'] = $this->model('Awards')->fetch_where(' `id` = ?', [$winners[$i]['prize_id']])[0]['name'];

        }

        // add event name to the view data
        $view_data = [
            'event_name' => $event_name,
            'winners' => $winners,
        ];

        $page = $this->default_public_directory . 'result';
        $this->view($page, $view_data);
    }


    // function to see result with event id 
    public function see_result_with_id ($passed_data) {
        /** ---------------------- (shift to public APIs later)
         * -- 
         * -- find the event id of the enrollment
         * -- check if the event has ended, otherwise there will be no winners
         * -- find all the winners of the enrollment
         * -- show it with links to download winner certificate
         */

        // event id
        $event_id = $passed_data['id'];

        // check if event has ended
        $event = $this->model('Events')->fetch_where(' `id` =?', [$event_id])[0];

        $event_name = $event['event_name'];

        $event_ended = $event['ended'];

        if (!$event_ended) {
            echo " Events Resulsts are not declared yet! <br> Come back after some time";
        }

        $winners = $this->model('Winners')->fetch_where(' `event_id` =? ', [$event_id]);

        // for ecah winner get the winner name and prize
        for ( $i = 0; $i < count($winners); $i++ ) {
            // find the winner name 
            $winners[$i]['winner_name'] = $this->model('Enrollment')->fetch_where(' `id` =? ', [$winners[$i]['winner_id']])[0]['name'];

            // find the prize
            $winners[$i]['prize_name'] = $this->model('Awards')->fetch_where(' `id` = ?', [$winners[$i]['prize_id']])[0]['name'];

        }

        // add event name to the view data
        $view_data = [
            'event_name' => $event_name,
            'winners' => $winners,
        ];

        $page = $this->default_public_directory . 'result';
        $this->view($page, $view_data);
    }


    // function to show certificate of the given certificate no
    public function see_certificate ($passed_data) {
        /**
         * -- get the certificate no
         * -- get the event name of the certificate
         * -- get the prize name
         * -- get the winner name 
         * -- show the certificate
         */

        //  get the certificate no
        $certificate_no = $passed_data['id'];

        // check if certificate exists
        $certificate = $this->model('Winners')->fetch_where(' `certificate_no` =?', [$certificate_no]);

        if ( count($certificate) < 1) {
            echo "Invalid certificate Number, Please recheck again";

            die;
        }

        // certificate exists
        // get the event name
        $event_name = $this->model('Events')->fetch_where(' `id` = ?', [$certificate[0]['event_id']])[0]['event_name'];

        // get the winner name 
        $winner_name = $this->model('Enrollment')->fetch_where(' `id` = ?', [$certificate[0]['winner_id']])[0]['name'];

        // get the prize name
        $prize_name = $this->model('Awards')->fetch_where(' `id` = ?', [$certificate[0]['prize_id']])[0]['name'];


        $view_data = [
            'event_name' => $event_name,
            'winner_name' => $winner_name,
            'prize_name' => $prize_name,
            'certificate_no' => $certificate_no,
        ];
         
        $page = $this->default_public_directory . 'certificate';
        $this->view($page, $view_data);
    }


    // function to show form from where users can download, view or verify certificates
    public function see_certificate_form () {
        //  page 
        $page = $this->default_public_directory . 'see-certificate-form';


        // return the page with view data
        $this->view($page);
    }


    // function to shwo the calender cum academic calender
    public function calender () {
        // page 
        $page = $this->default_public_directory . 'calender_2';

        // return the view page
        $this->view($page);
    }



}