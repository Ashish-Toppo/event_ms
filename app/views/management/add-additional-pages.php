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

    <div class="container-fluid">
        <div class="row">



            <!-- sidebar starts here -->
            <div class="col-md-3 col-sm-12 p-3">
                <!-- more information pages for the event -->
                <div class="sidebar sticky-top">
                    <div class="row">
                        <!-- progress bar for event creation -->
                        <div class="col-12">
                                <div class="col-12">
                                    <table>
                                        <table class="text-center text-secondary mx-auto">
                                        <tr><td><a href="/upload-logo">Upload Logo</a></td></tr>
                                        <tr><td><a href="/upload-images">Upload Images</a></td></tr>
                                        <tr><td><a href="/create-awards">Awards Offered</a></td></tr>
                                        <tr><td><a href="/contact-details">Contact Details</a></td></tr>
                                        <tr><td><a href="/add-additional-pages">More Information Pages</a></td></tr>
                                    </table>
                                </div>
                        </div>

                        <div class="col-12 mt-5">
                            @php $count = 1; @endphp
                            @foreach( $data['pages'] as $page )
                                <div class="row mb-2">
                                    <div class="col-6"><b> {{ $count }} </b> {{ $page['name'] }}  </div>
                                    <div class="col-3"><a href="/page?id={{ $page['id'] }}" class="btn btn-success">View</a></div>
                                    <div class="col-3"><a href="/delete-page?id={{ $page['id'] }}&csrf={{ $_SESSION['csrf_token'] }}" class="btn btn-danger">Delete</a></div>
                                </div>

                                @php $count++; @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- side bar ends here -->


            <!-- the main form for the add event starts here -->
            <div class="col-md-9 col-sm-12 my-3">
                




            <div class="col-12 mb-5">
                <h2>CREATE PAGES</h2>
                <h6 class="text-secondary"> {{ $data['event_name'] }} </h6>

                <!-- warning messages for event creator -->
                <div class="col-12 mt-3">
                    @ifset( $_SESSION['add-pages-error'] )
                        <p class="alert alert-danger" role="alert"> {{ $_SESSION['add-pages-error'] }} </p>
                    @endif
                </div>
                
                <form action="/add-page" method="POST" class="form">
                    @csrf_field
                    <div class="form-group"><input type="text" class="form-control" placeholder="Name" name="name"></div>
                    <div class="form-group"><textarea class="form-control" name="details" id="details" style="height: 300px;"></textarea></div>
                    <input type="submit" value="Add" class="btn btn-primary">
                </form>
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
<script src="ckeditor/ckeditor.js"></script>
<script>

var editor = CKEDITOR.replace( 'details' );

CKEDITOR.config.height = 300;

</script>
</body>
</html>