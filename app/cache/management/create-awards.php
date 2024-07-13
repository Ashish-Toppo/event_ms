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
    <?php include ('../app/views/' . '/components/header.php'); ?>

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
                <h2>CREATE AWARDS</h2>
                <h6 class="text-secondary"> <?php echo  $data['event_name'] ; ?> </h6>

                <!-- warning messages for event creator -->
                <div class="col-12 mt-3">
                    <?php if ( isset( $_SESSION['create-awards-error'] ) ) : ?>
                        <p class="alert alert-danger" role="alert"> <?php echo  $_SESSION['create-awards-error'] ; ?> </p>
                    <?php endif; ?>
                </div>
                
                <form action="/add-award" method="POST" class="form">
                    <input type="hidden" name="csrf_token" value="8697e652960f1ad110d36a867f0a3f93" />
                    <div class="form-group"><input type="text" class="form-control" placeholder="Name of Award" name="name"></div>
                    <div class="form-group"><input type="number" class="form-control" placeholder="number of winners" name="number"></div>
                    <input type="submit" value="Add" class="btn btn-primary">
                </form>
            </div>

            <div class="col-12 mt-5">
                <?php  $count = 1; ?>
                <?php foreach($data['awards'] as $award): ?>
                    <div class="row mb-2">
                        <div class="col-9"> <b> <?php echo  $count ; ?>.</b> <?php echo  $award['name'] ; ?> --- &gt;  ( <?php echo  $award['no_of_awards'] ; ?> )  </div>
                        <div class="col-3"><a href="/delete-award?id=<?php echo  $award['id'] ; ?>&csrf=<?php echo  $_SESSION['csrf_token'] ; ?>" class="btn btn-danger">Delete</a></div>
                    </div>

                    <?php  $count++; ?>
                <?php endforeach; ?>
            </div>

            <div class="col-12 mt-5">
                <a href="/event-info?id=<?php echo  $_SESSION['edited-event-id'] ; ?>" class="btn btn-primary">Continue / Skip</a>
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