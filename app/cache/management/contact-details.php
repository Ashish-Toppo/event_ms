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
                <h2>CONTACT DETAILS</h2>
                <h6 class="text-secondary"> <?php echo  $data['event_name'] ; ?> </h6>

                <!-- warning messages for event creator -->
                <div class="col-12 mt-3">
                    <?php if ( isset( $_SESSION['contact-details-error'] ) ) : ?>
                        <p class="alert alert-danger" role="alert"> <?php echo  $_SESSION['contact-details-error'] ; ?> </p>
                    <?php endif; ?>
                </div>
                
                <form action="/add-contact" method="POST" class="form">
                    <input type="hidden" name="csrf_token" value="8748fe4cc8c111104d0f8297e4ab7eaf" />
                    <div class="form-group"><input type="text" class="form-control" placeholder="Name" name="name"></div>
                    <div class="form-group"><input type="text" class="form-control" placeholder="designation" name="designation"></div>
                    <div class="form-group"><input type="number" class="form-control" placeholder="number" name="number"></div>
                    <input type="submit" value="Add" class="btn btn-primary">
                </form>
            </div>

            <div class="col-12 mt-5">
                <?php  $count = 1; ?>
                <?php foreach($data['contacts'] as $contact): ?>
                    <div class="row mb-2">
                        <div class="col-9"><?php echo  $count ; ?> <?php echo  $contact['name'] ; ?> : <?php echo  $contact['contact'] ; ?> ( <?php echo  $contact['designation'] ; ?> )  </div>
                        <div class="col-3"><a href="/delete-contact?id=<?php echo  $contact['id'] ; ?>&csrf=<?php echo  $_SESSION['csrf_token'] ; ?>" class="btn btn-danger">Delete</a></div>
                    </div>

                    <?php  $count++; ?>
                <?php endforeach; ?>
            </div>

            <div class="col-12 mt-5">
                <a href="/event-info?id=<?php echo  $_SESSION['edited-event-id'] ; ?>" class="btn btn-primary">Continue / Skip</a>
            </div>

            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Crop image</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="img-container">
                                <div class="row">
                                    <div class="col-md-8">  
                                        <!--  default image where we will set the src via jquery-->
                                        <img id="image" style="width:100%">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="preview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="crop">Crop</button>
                        </div>
                    </div>
                </div>
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