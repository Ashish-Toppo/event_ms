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
                            
                        </div>

                        <div class="col-12 mt-3">
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- side bar ends here -->


            <!-- the main form for the add event starts here -->
            <div class="col-md-9 col-sm-12 my-3">
                <div class="row">
                    <div class="col-12 mb-4">
                        <h3> <b> <?php echo  $data['event_name'] ; ?>  </b> </h3>
                        <span><u>SELECT WINNERS</u></span>
                    </div>
                </div>
                <form action="/distribute-prizes?id=<?php echo  $data['event_id'] ; ?>" method="post">
                    <input type="hidden" name="csrf_token" value="8697e652960f1ad110d36a867f0a3f93" />
                    <?php foreach($data['prizes'] as $prize): ?>
                        <?php for($i = 1;  $i <= $prize['no_of_awards']; $i++): ?>
                            <div class="form-group mb-4">
                                <label for="<?php echo  $prize['id'] ; ?>_<?php echo  $i ; ?>"> <?php echo  $prize['name'] ; ?> ( <?php echo  $i ; ?> ) </label>
                                <select  class="form-control" name="<?php echo  $prize['id'] ; ?>_<?php echo  $i ; ?>" id="<?php echo  $prize['id'] ; ?>_<?php echo  $i ; ?>">
                                    <option value="none"> None </option>
                                    <?php foreach($data['enrollments'] as $enrollment): ?>
                                        <option value="<?php echo  $enrollment['id'] ; ?>"> <?php echo  $enrollment['enrollment_no'] ; ?> => <b> <?php echo  $enrollment['name'] ; ?> </b> ( <?php echo  $enrollment['phone'] ; ?> ) </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endfor; ?>
                    <?php endforeach; ?>
                    
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="submit">
                    </div>
                </form>
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