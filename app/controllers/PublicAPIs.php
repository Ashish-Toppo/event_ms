<?php

class PublicAPIs extends Controller {

    public function events () {

        // when js from frontend request for the events, this function will return all the events of the current year
        // find the current year
        // make sql request to get all events of the current year
        // return back to the requester code in json format

        $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        // Prepare the SQL query
        // $sql = "SELECT e.id, e.event_name as title, et.start_date as 'start', et.end_date as 'end', et.start_time, et.end_time, CONCAT('event-info?id=', e.id) AS 'url'
        // FROM events e
        // JOIN event_timings et ON e.id = et.event_id
        // WHERE YEAR(et.start_date) = YEAR(CURDATE())
        //    OR YEAR(et.end_date) = YEAR(CURDATE());";

        $sql = "
        SELECT 
            e.id AS event_id,
            e.event_name AS title,
            et.start_date AS 'start',
            et.end_date AS 'end',
            CONCAT('event-info?id=', e.id) AS 'url',
            s.color AS color
        FROM 
            events e
        JOIN 
            event_timings et ON e.id = et.event_id
        JOIN 
            schools s ON e.school_id = s.id
        WHERE 
            YEAR(et.start_date) = YEAR(CURDATE()) AND YEAR(et.end_date) = YEAR(CURDATE());

        ";

        // Prepare and bind
        $stmt = $mysqli->prepare($sql);
        // $stmt->bind_param("iii", $currentYear, $currentYear, $currentYear);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch all events as an associative array
        $events = $result->fetch_all(MYSQLI_ASSOC);

        // Output the result in JSON format
        echo json_encode($events);

        // Close connections
        $stmt->close();
        $mysqli->close();



    }



    public function schools ($passed_data) {

        // get the id of the campus
        $campus_id = $passed_data['id'];

        $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        // Prepare the SQL query
        $sql = "SELECT * FROM `schools` WHERE `campus_id` = ?";

        // Prepare and bind
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $campus_id);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch all events as an associative array
        $events = $result->fetch_all(MYSQLI_ASSOC);

        // Output the result in JSON format
        echo json_encode($events);

        // Close connections
        $stmt->close();
        $mysqli->close();

    }



    public function departments ($passed_data) {

        // get the id of the campus
        $school_id = $passed_data['id'];

        $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        // Prepare the SQL query
        $sql = "SELECT * FROM `departments` WHERE `school_id` = ?";

        // Prepare and bind
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $school_id);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch all events as an associative array
        $events = $result->fetch_all(MYSQLI_ASSOC);

        // Output the result in JSON format
        echo json_encode($events);

        // Close connections
        $stmt->close();
        $mysqli->close();

    }


    public function get_events_for_home ($passed_data) {

        // get the events model
        $events = $this->model('Events');

        // get start position 
        $start = $passed_data['start'];

        // run query
        $events = $events->fetch_assoc(" SELECT * FROM `events` WHERE `public` = '1' ORDER BY `id` DESC LIMIT $start,10 ");

        

        // return 
        echo json_encode($events);
        
    }














}