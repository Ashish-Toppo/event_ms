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
                            <th scope="col">Prize</th>
                            <th scope="col">Certificate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $count = 1; ?>
                        <?php foreach($data['winners'] as $winner): ?> 
                            <tr>
                                <th scope="row"> <?php echo  $count ; ?> </th>
                                <td> <?php echo  $winner['winner_name'] ; ?> </td>
                                <td> <?php echo  $winner['prize_name'] ; ?> </td>
                                <td> <a href="/certificate?id=<?php echo  $winner['certificate_no'] ; ?>" class="btn btn-warning">Download</a> </td>
                            </tr>
                            <?php  $count++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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