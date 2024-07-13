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
                




            <div class="col-12">
                <h2>UPLOAD IMAGES</h2>
                <h6 class="text-secondary"> {{ $data['event_name'] }} </h6>

                
               
                
                
                <form method="post">
                    <input type="file" name="image" class="image">
                </form>
            </div>

            <div class="col-12 mt-5">
                @php $count = 1; @endphp
                @foreach( $data['images'] as $image )
                    <div class="row mb-2">
                        <div class="col-6">{{ $count }} {{ $image['image'] }} </div>
                        <div class="col-6"><a href="{{ $image['image'] }}" class="btn btn-primary">View</a> <a href="/delete-image?id={{ $image['id'] }}&csrf={{ $_SESSION['csrf_token'] }}" class="btn btn-danger">Delete</a></div>
                    </div>

                    @php $count++; @endphp
                @endforeach
            </div>

            <div class="col-12 mt-5">
                <a href="/event-info?id={{ $_SESSION['edited-event-id'] }}" class="btn btn-primary">Continue / Skip</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script>

    var bs_modal = $('#modal');
    var image = document.getElementById('image');
    var cropper,reader,file;
   

    $("body").on("change", ".image", function(e) {
        var files = e.target.files;
        var done = function(url) {
            image.src = url;
            bs_modal.modal('show');
        };


        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function(e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    bs_modal.on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            aspectRatio: 1.75,
            viewMode: 3,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });

    $("#crop").click(function() {
        console.log('the crop has been clicked');
        canvas = cropper.getCroppedCanvas({
            width: 350,
            height: 200,
        });

        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;
				//alert(base64data);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/upload-image",
                    data: {
                        image: base64data,
                        csrf: '@csrf_token'
                    },
                    success: function(data) { 
                        bs_modal.modal('hide');
                        alert("Image Uploaded Successfully");
                        location.reload();
                    }, 
                    error : function() {
                        alert("Failed to Upload Image");
                    }
                });
            };
        });

    });

</script>
</body>
</html>