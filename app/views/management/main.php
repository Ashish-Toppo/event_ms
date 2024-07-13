<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADBU | Events</title>
    <link rel="shortcut icon" href="./favicon.ico"  type="image/x-icon">

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        tr.table-inactive {
            background-color: #ececec!important;
            color: #b9b9b9!important;
        }
    </style>
</head>
<body>
    <!-- include the componenet: header -->
    @component('/components/header.php')

    <div class="container">
        <div class="row">



            <!-- sidebar starts here -->
            <div class="col-md-3 col-sm-12 p-3">
                <!-- more information pages for the event -->
                <div class="sidebar sticky-top">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td><a href="/manage-events" class="text-decoration-none">All Events</a></td>
                                </tr>
                                <tr>
                                    <td><a href="/new-event" class="text-secondary text-decoration-none">Add New Event</a></td>
                                </tr>
                                <tr>
                                    <td><a href="/sign-out-user" class="text-danger text-decoration-none">Sign Out</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- side bar ends here -->


            <!-- event management section starts here -->
            <div class="col-md-9 col-sm-12">
                <div class="row">
                    <div class="col-12">
                        <h2>All Events</h2>
                    </div>

                    <div class="col-12">
                        <table class="table table-bordered">
                            <tr>
                                <th>SL No</th>
                                <th>Name</th>
                                <th>Privacy</th>
                                <th>Actions</th>
                            </tr>

                            <!-- add table rows  -->
                            @php $count = 1; @endphp
                            @foreach( $data['active_events'] as $event )
                                <tr>
                                    <td> {{ $count }} </td>
                                    <td> {{ $event['event_name'] }} </td>
                                    <td>
                                        @if( $event['public'] == 1 )
                                            Public
                                        @else
                                            Private
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-secondary" href="/event-info?id={{ $event['id'] }}">View</a>
                                        <a class="btn btn-secondary" href="/edit-event?id={{ $event['id'] }}">Edit</a>

                                        <!-- if needed enrollment then show start/stop enrollment -->
                                        @if( $event['need_enrollment'] == 1 )
                                            @if( $event['enrollment'] == 0 )
                                                <a class="btn btn-success" href="/start-enrollment?id={{ $event['id'] }}&csrf={{ $_SESSION['csrf_token'] }}">Start Enrollment</a>
                                            @elseif( $event['enrollment'] == 1)
                                                <a class="btn btn-warning" href="/stop-enrollment?id={{ $event['id'] }}&csrf={{ $_SESSION['csrf_token'] }}">Stop Enrollment</a>
                                            @endif
                                        @endif

                                        <!-- toggle event privacy -->
                                        @if( $event['public'] == 1 )
                                            <a class="btn btn-danger" href="/event-to-private?id={{ $event['id'] }}&csrf={{ $_SESSION['csrf_token'] }}">Turn to Private</a>
                                        @else
                                            <a class="btn btn-primary" href="/event-to-public?id={{ $event['id'] }}&csrf={{ $_SESSION['csrf_token'] }}">Turn to Public</a>
                                        @endif
                                        
                                        @if( $event['need_enrollment'] == 1 )
                                            <a class="btn btn-danger" href="/view-participants?id={{ $event['id'] }}">View Participants</a>
                                        @else
                                            <a class="btn btn-danger" href="/close-event?id={{ $event['id'] }}&csrf={{ $_SESSION['csrf_token'] }}">Close Event</a>
                                        @endif
                                    </td>
                                </tr>
                                @php $count++; @endphp
                            @endforeach
                            
                                <tr>
                                    <td colspan="4"> Past Events: </td>
                                </tr>
                            <!-- create table rows for past events -->
                            @foreach( $data['past_events'] as $event )
                                <tr class="table-inactive">
                                    <td> {{ $count }} </td>
                                    <td> {{ $event['event_name'] }} </td>
                                    <td>
                                        private
                                    </td>
                                    <td>
                                        <a class="btn btn-secondary" href="/event-info?id={{ $event['id'] }}">View</a>
                                        
                                        @if( $event['need_enrollment'] == 1 )
                                            <a class="btn btn-primary" href="/view-participants?id={{ $event['id'] }}">View Participants</a>
                                            <a class="btn btn-success" href="/view-results?id={{ $event['id'] }}">View Result</a>
                                        @endif
                                    </td>
                                </tr>
                                @php $count++; @endphp
                            @endforeach
                        </table>


                    </div>
                </div>
            </div>
            <!-- event mangement section ends here -->









        </div>
    </div>
</body>
</html>