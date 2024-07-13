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
                




            <div class="col-12 mb-5">
                <h2>Enrollment Fields</h2>
                <h6 class="text-secondary"> </h6>

                <!-- warning messages for event creator -->
                <div class="col-12 mt-3">
                    @ifset( $_SESSION['enrollment-details-error'] )
                        <p class="alert alert-danger" role="alert"> {{ $_SESSION['enrollment-details-error'] }} </p>
                    @endif
                </div>
                
                <form action="/add-enrollment-details" method="POST" class="form">

                    @csrf_field
                    <div class="form-group"><input type="text" class="form-control" placeholder="Name" disabled></div>
                    <div class="form-group"><input type="number" class="form-control" placeholder="phone" disabled></div>
                    <div class="form-group">Add More Fields:</div>
                    <div class="form-group"><input type="text" class="form-control" placeholder="field name" name="field-name"></div>
                    <div class="form-group">
                        <select name="field-type" id="">
                            <option value="text">text</option>
                            <option value="number">number</option>
                            <option value="email">email</option>
                        </select>
                    </div>
                    <input type="submit" value="Add" class="btn btn-primary">
                </form>
            </div>

            <div class="col-12 mt-5">
                @php $count = 1; @endphp
                @foreach( $data['det'] as $field )
                    <div class="row mb-2">
                        <div class="col-9">{{ $count }}. {{ $field['field_name'] }} : {{ $field['field_type'] }}  </div>
                        <div class="col-3"><a href="/delete-added-field?id={{ $field['id'] }}&csrf={{ $_SESSION['csrf_token'] }}" class="btn btn-danger">Delete</a></div>
                    </div>

                    @php $count++; @endphp
                @endforeach
            </div>

            <div class="col-12 mt-5">
                <form action="/add-enrollment-type" method="POST" class="form">
                    @csrf_field
                    <div class="form-group"><input type="text" class="form-control" placeholder="Enrollment Type" name="enrollment-type"></div>
                    <div class="form-group"><input type="text" class="form-control" placeholder="Enrollment Charge" name="enrollment-charges"></div>
                    <div class="form-group">
                    <select name="enrollment-charges-currency" id="">
                        <option value="INR">INR</option>
                        <option value="USD">USD</option>
                    </select>
                    </div>
                    <input type="submit" value="Add" class="btn btn-primary">
                </form>
            </div>

            <div class="col-12 mt-5">
                @php $count = 1; @endphp
                @foreach( $data['enType'] as $type )
                    <div class="row mb-2">
                        <div class="col-9">{{ $count }}. {{ $type['enrollment_type'] }} => {{ $type['enrollment_charges_curr'] }} {{ $type['enrollment_charges'] }}   </div>
                        <div class="col-3"><a href="/delete-enrollment-type?id={{ $field['id'] }}&csrf={{ $_SESSION['csrf_token'] }}" class="btn btn-danger">Delete</a></div>
                    </div>

                    @php $count++; @endphp
                @endforeach
            </div>

            <div class="col-12 mt-5">
                <a href="/event-info?id={{ $_SESSION['edited-event-id'] }}" class="btn btn-primary">Continue / Skip</a>
            </div>

            
            
            
            
            
            
            
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