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
                                <table class="table table-secondary text-center text-light mx-auto">
                                    <tr><td style="background: transparent">Edit Event:</td></tr>
                                    <tr><td><a href="/upload-logo" class="text-dark text-decoration-none">Upload Logo</a></td></tr>
                                    <tr><td><a href="/upload-images" class="text-dark text-decoration-none">Upload Images</a></td></tr>

                                    <!-- if enrollment is not required, then cannot offer awards -->
                                    @if( $data['event']['need_enrollment'] )
                                        <tr><td><a href="/create-awards" class="text-dark text-decoration-none">Awards Offered</a></td></tr>
                                    @endif
                                    
                                    <tr><td><a href="/contact-details" class="text-dark text-decoration-none">Contact Details</a></td></tr>
                                    <tr><td><a href="/add-additional-pages" class="text-dark text-decoration-none">More Information Pages</a></td></tr>

                                    <!-- if enrollment is not required, then cannot create enrollment fields -->
                                    @if( $data['event']['need_enrollment'] )
                                        <tr><td><a href="/enrollment-details" class="text-dark text-decoration-none">Enrollment Details</a></td></tr>
                                    @endif


                                    <tr>
                                        <td>
                                        <style>
                                            /* Style The Dropdown Button */
                                            .dropbtn {
                                            background-color: inherit;
                                            color: #000;
                                            padding: 16px;
                                            font-size: 16px;
                                            border: none;
                                            cursor: pointer;
                                            }

                                            /* The container <div> - needed to position the dropdown content */
                                            .dropdown {
                                            position: relative;
                                            display: inline-block;
                                            }

                                            /* Dropdown Content (Hidden by Default) */
                                            .dropdown-content {
                                            display: none;
                                            position: absolute;
                                            background-color: #f9f9f9;
                                            min-width: 160px;
                                            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                                            z-index: 1;
                                            }

                                            /* Links inside the dropdown */
                                            .dropdown-content a {
                                            color: black;
                                            padding: 12px 16px;
                                            text-decoration: none;
                                            display: block;
                                            }

                                            /* Change color of dropdown links on hover */
                                            .dropdown-content a:hover {background-color: #f1f1f1}

                                            /* Show the dropdown menu on hover */
                                            .dropdown:hover .dropdown-content {
                                            display: block;
                                            }

                                            /* Change the background color of the dropdown button when the dropdown content is shown */
                                            .dropdown:hover .dropbtn {
                                            background-color: #3e8e41;
                                            }
                                        </style>

                                        <div class="dropdown">
                                        <button class="dropbtn">Select Theme</button>
                                        <div class="dropdown-content">
                                            <a href="/change_to_theme_1?id={{ $data['event']['id'] }}&csrf={{ $_SESSION['csrf_token'] }}">Theme 1</a>
                                            <a href="/change_to_theme_2?id={{ $data['event']['id'] }}&csrf={{ $_SESSION['csrf_token'] }}">Theme 2</a>
                                            <!-- <a href="#">Link 3</a> -->
                                        </div>
                                        </div>
                                        
                                        
                                        
                                        






                                        

                                        

                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <h3 class="col-12 text-secondary" >More Actions</h3>
                            <div class="col-12">
                                <ul class="p-3">
                                    <li><a class="btn" href="/start-enrollment?id={{ $data['event']['id'] }}">Start Enrollment</a></li>
                                    <li><a class="btn" href="/event-private?id={{ $data['event']['id'] }}">Turn to Private</a></li>
                                    <li><a class="btn" href="/close-event?id={{ $data['event']['id'] }}">Close Event</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- side bar ends here -->


            <!-- the main form for the add event starts here -->
            <div class="col-md-9 col-sm-12 my-3">

                <div class="card p-3 mb-3">
                    <div class="row">
                        <div class="img col-sm-12  col-md-4">
                            <img class="img logo-img" src="{{ $data['event']['logo'] }}" alt="">
                        </div>
                        <div class="content col-md-8 col-sm-12">
                            <h2 class="heading text-center"> {{ $data['event']['event_name'] }} </h2>
                            <!-- <p class="event-summary"> {{ $data['event']['event_description'] }} </p> -->
                            <form action="/update-event-summary?id={{ $data['event']['id'] }}" method="POST">
                                @csrf_field
                                <textarea name="event-summary" class="event-summary" id=""> {{ $data['event']['event_description'] }} </textarea>
                                <br>
                                <input type="submit" value="Update" class="btn btn-success">
                            </form>
                            <div class="d-flex justify-content-center">
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    .event-summary{
                        display: block;
                        width: 100%;
                        min-height: 300px;
                    }
                </style>

            </div>
            <!-- the main form for the add events ends here -->



        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>