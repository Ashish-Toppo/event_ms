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

    <div class="container">
        <div class="row">



            <!-- sidebar starts here -->
            <div class="col-md-3 col-sm-12 p-3">
                <!-- more information pages for the event -->
                <div class="sidebar sticky-top">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered">
                                <tr>
                                    <th><a href="/" class="text-primary text-decoration-none">Home</a></th>
                                </tr>
                                <tr>
                                    <th><a href="/event-info?id=<?php echo  $data['event_id'] ; ?>" class="text-primary text-decoration-none"> <?php echo  $data['event_name'] ; ?> </a></th>
                                </tr>
                                <tr>
                                    <th>Additional Details: </th>
                                </tr>
                                <!-- create additional links for each additional info page of the event -->

                                <?php foreach($data['pages'] as $page): ?>
                                    <tr>
                                        <td><a class="text-primary text-decoration-none" href="/page?id=<?php echo  $page['id'] ; ?>"> <?php echo  $page['name'] ; ?> </a></td>
                                    </tr>
                                <?php endforeach; ?>
                                
                            </table>
                        </div>

                        <!-- enrollment button -->
                        <div class="col-12 mt-2 text-center">
                            <p>Enrollment is going on</p>
                            <a href="" class="btn btn-outline-success">Enroll Now!</a>
                        </div>

                        
                    </div>
                </div>
            </div>
            <!-- side bar ends here -->


            <!-- main event info section starts here -->
            <main class="col-md-9 col-sm-12">
                <!-- dynamically added event details starts here -->

                <div class="row">
                    <div class="col-12 text-center">
                        <h2> <?php echo  $data['event_name'] ; ?> </h2>
                    </div>

                    <div class="col-12 mt-3">
                        <h2 class="text-secondary text-decoration-underline"> <?php echo  $data['page']['name'] ; ?> </h2>
                    </div>

                    <div class="col-12 mt-3">
                        <?php echo  $data['page']['details'] ; ?>
                    </div>

                    
                </div>

                <!-- dynamically added event details ends here -->
            </main>
            <!-- main event info section ends here -->










        </div>
    </div>
</body>
</html>