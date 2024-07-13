<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADBU | Events</title>
    <link rel="shortcut icon" href="./favicon.ico"  type="image/x-icon">

    <!-- bootstrap -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css"  />
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
                        <!-- progress bar for event creation -->
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <table class="text-center text-secondary mx-auto">
                                        <tr><td><a href="/upload-logo">Upload Logo</a></td></tr>
                                        <tr><td><a href="/upload-images">Upload Images</a></td></tr>
                                        <tr><td><a href="/create-awards">Awards Offered</a></td></tr>
                                        <tr><td><a href="/contact-details">Contact Details</a></td></tr>
                                        <tr><td><a href="/add-additional-pages">More Information Pages</a></td></tr>
                                        <tr><td><a href="">Enrollment details</a></td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>

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
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Additional Details</th>
                            <td scope="col">Type</td>
                            <th scope="col">Payment</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach( $data['enrollments'] as $enrollment ) 
                            <tr>
                                <th scope="row"> {{ $count }} </th>
                                <td> {{ $enrollment['name'] }} </td>
                                <td> {{ $enrollment['phone'] }} </td>
                                <td>
                                    @foreach( $enrollment['additional_fields'] as $key => $value )
                                        <b> {{ $key }} </b> : {{ $value }} <br>
                                    @endforeach
                                </td>
                                <td> {{ $enrollment['enrollment_type'] }} </td>
                                <td>
                                    @php $fee_paid = ($enrollment['fee_payment'] == 1) ? 1 : 0; @endphp
                                    @if( $fee_paid )
                                        <b>Paid</b>
                                    @else
                                        <b>Not Paid</b>
                                    @endif
                                </td>
                            </tr>
                            @php $count++; @endphp
                        @endforeach
                    </tbody>
                </table>

                <!-- select winner button enebled only if event has not ended -->
                @if( !$data['event_ended'] )
                    <div class="row">
                        <div class="col-12">
                            <a href="/distribute-prizes?id={{ $data['event_id'] }}" class="btn btn-success">Select Winners</a>
                        </div>
                    </div>
                @endif
            </div>
            <!-- the main form for the add events ends here -->
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>



</script>
</body>
</html>