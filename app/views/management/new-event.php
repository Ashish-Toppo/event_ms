<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADBU | Events</title>
    <link rel="shortcut icon" href="./favicon.ico"  type="image/x-icon">

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- custom check box style -->
    <link rel="stylesheet" href="/css/checkbox.css">
</head>
<body>
    <!-- include the componenet: header -->
    @component('/components/header.php')

    <div class="container-fluid">
        <div class="row">



            <!-- sidebar starts here -->
            <div class="col-md-3 col-sm-12 p-3">
                <!-- more information pages for the event -->
                <div class="sidebar sticky-top">
                    <div class="row">

                        <!-- progress bar for event creation -->
                        <div class="row">
                            <div class="col-12">
                                <table>
                                    <tr><td class="text-secondary">Create Event</td></tr>
                                    <tr><td>Upload Logo</td></tr>
                                    <tr><td>Upload Images</td></tr>
                                    <tr><td>Create Awards</td></tr>
                                    <tr><td>Contact Details</td></tr>
                                    <tr><td>Additional Pages</td></tr>
                                    <tr><td>Payment Integration</td></tr>
                                </table>
                            </div>
                        </div>
                        
                        <!-- warning messages for event creator -->
                        <div class="col-12 mt-3">
                            @ifset( $_SESSION['new-event-error'] )
                                <p class="alert alert-danger" role="alert"> <?php print_r($_SESSION['new-event-error']); ?> </p>
                            @endif
                        </div>

                        <!-- general information for the event creator -->
                        <div class="col-12 mt-3">
                            <p>
                                <h3>Make Sure:</h3>
                                <ul>
                                    <li>Add Enough Details for the event</li>
                                    <li>Multiple images may be uploaded for an event</li>
                                    <li>User may add Additional pages for an event</li>
                                </ul>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <!-- side bar ends here -->


            <!-- the main form for the add event starts here -->
            <div class="col-md-9 col-sm-12 my-3">
                <form method="POST" action="/new-event">
                    <div class="form-group text-center"><h3>Add New Event</h3></div>
                    <div class="form-group text-danger text-decoration-underline">Event Details</div>

                    @csrf_field

                    <div class="form-group mb-2">
                        <label for="campus">Select campus</label>
                        <select name="campus" id="campus">
                            <option value="0">All</option>

                            @foreach( $data['campuses'] as $campus )
                                <option value="{{ $campus['id'] }}"> {{ $campus['campus'] }} </option>
                            @endforeach
                            
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label for="school">Select school</label>
                        <select name="school" id="schools">
                            <option value="0">All</option>
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label for="department">Select department</label>
                        <select name="department" id="department">
                            <option value="0">All</option>
                        </select>
                    </div>
                    
                    <div class="form-group mb-2">
                        <label for="eventName">Enter the name of new event:</label>
                        <input type="text" class="form-control" id="eventName" placeholder="Name of Event" name="eventName">
                    </div>
                    <div class="form-group mb-2">
                        <label for="eventDescription">Write Short Description:</label>
                        <textarea class="form-control" name="eventDescription" id="eventDescription" cols="30" rows="10"></textarea>
                    </div>

                    <hr> <hr> <hr>

                    <div class="form-group text-danger text-decoration-underline">Do You Want Enrollment?</div>
                    <div class="form-group">
                        <input type="checkbox" name="need_enrollment" id="need_enrollment" checked>
                    </div>
                    
                    <hr>
                    <hr>
                    <hr>


                    <div class="form-group text-danger text-decoration-underline">Date and Time</div>

                    <div class="form-group mb-2">
                        One Day Event? <input type="checkbox" id="one_day_event" name="one_day_event"> <br> <br>
                        <p id="event_date_div">
                            <b>Date:</b> &nbsp; From: <input type="date" id="event_date_from" name="event_date_from"> 
                            &nbsp;
                            <b>To:</b>  <input type="date" id="event_date_to" name="event_date_to">
                        </p>
                        <p id="event_date_on" class="d-none">
                            <b>On:</b> &nbsp; <input type="date" name="event_date_on">
                        </p>
                        <p id="event_time_div" class="d-none">
                            <b>Time:</b> &nbsp; From: <input type="time" name="event_time_from">
                            &nbsp; 
                            <b>To:</b> <input type="time" name="event_time_to"> 
                        </p>
                    </div>

                    <hr> <hr> <hr>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- the main form for the add events ends here -->



        </div>
    </div>



    <script>
        // Get the select element
        const selectCampus = document.getElementById('campus');

        // Add an event listener for the change event
        selectCampus.addEventListener('change', function(event) {
            // Get the selected option value
            let selectedValue = event.target.value;
            // Display the selected value

            // make get request to the server to get the school of the campus
            const xhr = new XMLHttpRequest();
            const url = '/get-schools?id=' + selectedValue;

            xhr.open('GET', url, true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        const data = JSON.parse(xhr.responseText);
                        // console.log(xhr.responseText);

                        // first clear all options of the school
                        let schools = document.getElementById('schools');
                        schools.innerHTML = "<option value='0'> ALL </option>";

                        for( let i = 0; i < data.length; i++ ) {

                            let newOption = document.createElement('option');

                            // Set the value and text content of the option element
                            newOption.value = data[i].id;
                            newOption.textContent = data[i].school;
                                                
                            schools.appendChild(newOption);
                        }


                    } else {
                        console.error('Error fetching data');
                    }
                }
            };

            xhr.send();
            
            
            
            // window.alert(selectedValue);
        });



        // when the school is selected
        let selectSchool = document.getElementById('schools');
        // Add an event listener for the change event
        selectSchool.addEventListener('change', function(event) {
            // Get the selected option value
            let selectedValue = event.target.value;
            // Display the selected value

            // make get request to the server to get the school of the campus
            const xhr = new XMLHttpRequest();
            const url = '/get-departments?id=' + selectedValue;

            xhr.open('GET', url, true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        const data = JSON.parse(xhr.responseText);
                        // console.log(xhr.responseText);
                        // console.log(JSON.stringify(data, null, 2));

                        // first clear all options of the school
                        let depts = document.getElementById('department');
                        depts.innerHTML = "<option value='0'> ALL </option>";

                        for( let i = 0; i < data.length; i++ ) {

                            let newOption = document.createElement('option');

                            // Set the value and text content of the option element
                            newOption.value = data[i].id;
                            newOption.textContent = data[i].dept;
                                                
                            depts.appendChild(newOption);
                        }


                    } else {
                        console.error('Error fetching data');
                    }
                }
            };

            xhr.send();
            
            
            
            // window.alert(selectedValue);
        });
        
        
    </script>


<script>
    // get the checkbox
    let one_day_event_checkbox = document.getElementById('one_day_event');

    // get the event-date and event-time divs
    let event_date_div = document.getElementById('event_date_div');
    let event_time_div = document.getElementById('event_time_div');
    let event_date_on = document.getElementById('event_date_on');

    one_day_event.addEventListener('click', e => {
       
        event_time_div.classList.toggle('d-none');
        event_date_div.classList.toggle('d-none');
        event_date_on.classList.toggle('d-none');

    });

    
</script>
</body>
</html>