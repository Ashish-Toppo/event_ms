<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADBU | Events</title>
    <link rel="shortcut icon" href="./favicon.ico"  type="image/x-icon">

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- include the componenet: header -->
    <?php include ('../app/views/' . '/components/header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-12 p-2">
                <!-- include the component: sidebar -->
                <?php include ('../app/views/' . '/components/sidebar.php'); ?>
            </div>

            <!-- home main container starts here -->
            <main class="col-md-9 col-sm-12">
                <div class="row d-flex flex-column p-3">

                    <!-- dynamically generated cards in here -->

                    <?php foreach($data['events'] as $event): ?>
                        <div class="card p-3 mb-3">
                            <div class="row">
                                <div class="img col-sm-12  col-md-4">
                                    <img class="img logo-img" src="<?php echo  $event['logo'] ; ?>" alt="">
                                </div>
                                <div class="content col-md-8 col-sm-12">
                                    <h2 class="heading text-center"> <?php echo  $event['event_name'] ; ?> </h2>
                                    <p class="event-summary"> <?php echo  $event['event_description'] ; ?> </p>
                                    <div class="d-flex justify-content-center">
                                        <table class="table table-sm table-borderless text-left">
                                            <tr>
                                                <td><a href="/event-info?id=<?php echo  $event['id'] ; ?>" class="btn btn-outline-info">Read More</a></td>
                                                <?php if($event['enrollment'] == 1): ?>
                                                    <td><a href="/enroll?id=<?php echo  $event['id'] ; ?>" class="btn btn-outline-success">Enroll</a></td>
                                                <?php elseif($event['enrollment'] == 0): ?>
                                                    <td><span class="btn btn-outline-danger">Enrollment will begin soon</a></td>
                                                <?php endif; ?>
                                            </tr>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- dynamically genereated cards till upto here -->

                </div>
            </main>
        </div>
        <!-- home main container ends here -->
    </div>
</body>
</html>