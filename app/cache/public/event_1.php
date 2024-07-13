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
                                    <th><a href="/">Home</a></th>
                                </tr>
                                
                                <?php  $pages = count( $data['pages'] ); ?>
                                <?php if($pages !== 0): ?>
                                    <tr>
                                        <th>Additional Details: </th>
                                    </tr>
                                    
                                    <!-- create additional links for each additional info page of the event -->
                                    <?php foreach($data['pages'] as $page): ?>
                                        <tr>
                                            <td><a class="text-primary text-decoration-none" href="/page?id=<?php echo  $page['id'] ; ?>"> <?php echo  $page['name'] ; ?> </a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                
                            </table>
                        </div>

                        <!-- enrollment button -->
                        <?php if($data['details']['need_enrollment'] == 1): ?>
                            <?php if($data['details']['ended'] == 1): ?>
                                <div class="col-md-6 col-sm-12">
                                    <p class="text-danger">Enrollment Has Ended!</p>
                                </div>
                            <?php else: ?> 
                                <?php if($data['details']['enrollment'] == 1): ?>
                                    <div class="col-md-6 col-sm-12">
                                        <p>Enrollment is going on!</p>
                                        <a class="btn btn-outline-success" href="/enroll?id=<?php echo  $data['details']['id'] ; ?>">Enroll Now!</a>
                                    </div>
                                <?php else: ?>
                                    <div class="col-md-6 col-sm-12">
                                        <p class="text-danger">Enrollment Will Start Soon!</p>
                                        <a class="btn btn-outline-danger" href="#">Keep Checking!</a>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>

                        <!-- internal anchor links -->
                        <div class="col-12 mt-4">
                            <table class="table table-bordered">
                                <?php if($data['awards'] !== 0 || $data['images'] !== 0): ?>
                                    <tr>
                                        <th>Go to Section:</th>
                                    </tr>
                                <?php endif; ?>

                                <?php if($data['awards'] !== 0): ?>
                                    <tr>
                                        <td><a href="#event_awards">Awards </a></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if($data['images'] !== 0): ?>
                                    <tr>
                                        <td><a href="#event_images">Images</a></td>
                                    </tr>
                                <?php endif; ?>
                            </table>
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
                        <h2> <?php echo  $data['details']['event_name'] ; ?> </h2>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <img src="<?php echo  $data['details']['logo'] ; ?>" alt="">
                            </div>

                            <div class="col-md-8 col-sm-12">
                                <div class="details mt-3">
                                    <?php echo  $data['details']['event_description'] ; ?>
                                </div>
                            </div>
                        </div>

                        <!-- event time section -->
                        <div class="col-12 time mt-3">
                            <table class="table table-bordered" id="event_time">
                                <tr class="text-center">
                                    <th colspan="2">Schedule</th>
                                </tr>

                                <!-- for one day event -->
                                <?php if($data['details']['one_day_event'] == 1): ?>
                                    <tr class="">
                                        <th colspan="2"> ON: <?php echo  $data['date']['start_date'] ; ?> </th>
                                    </tr>
                                    <tr>
                                        <td>Start</td>
                                        <td> <?php echo  $data['date']['start_time'] ; ?> </td>
                                    </tr>
                                    <tr>
                                        <td>End</td>
                                        <td> <?php echo  $data['date']['end_time'] ; ?> </td>
                                    </tr>

                                 <!-- for multi day event -->
                                 <?php elseif($data['details']['one_day_event'] == 0): ?>
                                    <tr>
                                        <td>Start</td>
                                        <td> <?php echo  $data['date']['start_date'] ; ?> </td>
                                    </tr>
                                    <tr>
                                        <td>End</td>
                                        <td> <?php echo  $data['date']['end_date'] ; ?> </td>
                                    </tr>
                                <?php endif; ?>

                            </table>
                        </div>

                        <!-- awards distributed section -->
                        <div class="col-12 prizes mt-3">
                            <?php if($data['awards'] !== 0): ?>
                                <table class="table table-bordered" id="event_awards">
                                    <tr class="text-center">
                                        <th colspan="3">Awards Distributed</th>
                                    </tr>
                                    <tr>
                                        <td>SL No.</td>
                                        <td>Name of Award</td>
                                        <td>No of winners</td>
                                    </tr>
                                    <?php  $count = 1; ?>
                                    <?php foreach($data['awards'] as $award): ?>
                                        <tr>
                                            <td> <?php echo  $count ; ?> </td>
                                            <td> <?php echo  $award['name'] ; ?> </td>
                                            <td> <?php echo  $award['no_of_awards'] ; ?> </td>
                                        </tr>
                                        <?php  $count++; ?>
                                    <?php endforeach; ?>
                                </table>
                            <?php endif; ?>
                        </div>

                        <!-- event image gallery -->
                        <div class="col-12 py-3">
                            <!-- dynamically added images -->                        
                            <?php if($data['images'] !== 0): ?>
                                <div class="row" id="event_images">
                                    <div class="col-12 text-center">
                                        <!-- <h3>Event Images</h3> -->
                                    </div>
                                </div>
                                <?php  
                                    $image = $data['images'];
                                    $count = count($data['images']);
                                ?>

                                <?php for($i = 0; $i < $count; $i++): ?>
                                    
                                    <?php if($i == 0): ?>
                                        <?php $str = <<<HTML
                                            <!-- start new row -->
                                            <div class="row mt-2">
                                         HTML; echo $str; ?>
                                    <?php elseif($i % 3 == 0): ?>
                                        <?php $str = <<<HTML
                                            </div>
                                            <!-- close row -->

                                            <!-- start new row -->
                                            <div class="row mt-2">
                                         HTML; echo $str; ?>
                                    <?php endif; ?>

                                    <!-- print the image tag -->
                                    <div class="col-md-4 col-sm-12 p-1">
                                        <img src=" <?php echo  $data['images'][$i]['image'] ; ?> " alt="" style="width:100%">
                                    </div>

                                    <?php if($i == $count - 1): ?>
                                        <?php $str = <<<HTML
                                            </div>
                                            <!-- close the last row -->
                                         HTML; echo $str; ?>
                                    <?php endif; ?>

                                <?php endfor; ?>
                            <?php endif; ?>
                        
                            
                            <!-- <div class="row mt-2">
                                <div class="col-md-4 col-sm-12 p-1">
                                    <img src="https://www.w3schools.com/w3images/lights.jpg" alt="" style="width:100%">
                                </div>
                                <div class="col-md-4 col-sm-12 p-1">
                                    <img src="https://www.w3schools.com/w3images/lights.jpg" alt="" style="width:100%">
                                </div>
                                <div class="col-md-4 col-sm-12 p-1">
                                    <img src="https://www.w3schools.com/w3images/lights.jpg" alt="" style="width:100%">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4 col-sm-12 p-1">
                                    <img src="https://www.w3schools.com/w3images/lights.jpg" alt="" style="width:100%">
                                </div>
                                <div class="col-md-4 col-sm-12 p-1">
                                    <img src="https://www.w3schools.com/w3images/lights.jpg" alt="" style="width:100%">
                                </div>
                            </div>
                        </div> -->


                        <!-- contact Numbers for queries -->
                        <div class="col-12 mt-4">
                            <div class="row">
                                <?php if($data['contacts'] !== 0): ?>
                                    <div class="col-12">
                                        <h3 class="text-center">For Any Queries</h3>
                                        <h5>Contact</h5>
                                    </div>
                                    <div class="col-12">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>SL No.</th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Contact</th>
                                            </tr>
                                    <!-- run for each loop for each contact detail -->
                                    <?php  $count = 1; ?>
                                    <?php foreach($data['contacts'] as $contact): ?>
                                        <tr>
                                            <td> <?php echo  $count ; ?> </td>
                                            <td> <?php echo  $contact['name'] ; ?> </td>
                                            <td> <?php echo  $contact['designation'] ; ?> </td>
                                            <td> <?php echo  $contact['contact'] ; ?> </td>
                                        </tr>
                                        <?php  $count++; ?>
                                    <?php endforeach; ?>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- additional information of the events -->
                        <div class="col-12 mt-4">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <!-- create additional links for each additional info page of the event -->
                                    <?php  $pages = count($data['pages']); ?>
                                    <?php if($pages !== 0): ?>
                                        <div class="col-12">
                                            <h3>Read More Information</h3>
                                        </div>
                                        <div class="col-12">
                                            <ul>
                                                <?php foreach($data['pages'] as $page): ?>
                                                    <li><a class="text-primary text-decoration-none" href="/page?id=<?php echo  $page['id'] ; ?>"> <?php echo  $page['name'] ; ?> </a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- enrollment button -->
                               <!-- enrollment button -->
                                <?php if($data['details']['need_enrollment'] == 1): ?>
                                    <?php if($data['details']['ended'] == 1): ?>
                                        <div class="col-md-6 col-sm-12">
                                            <p class="text-danger">Enrollment Has Ended!</p>
                                        </div>
                                    <?php else: ?> 
                                        <?php if($data['details']['enrollment'] == 1): ?>
                                            <div class="col-md-6 col-sm-12">
                                                <p>Enrollment is going on!</p>
                                                <a class="btn btn-outline-success" href="/enroll?id=<?php echo  $data['details']['id'] ; ?>">Enroll Now!</a>
                                            </div>
                                        <?php else: ?>
                                            <div class="col-md-6 col-sm-12">
                                                <p class="text-danger">Enrollment Will Start Soon!</p>
                                                <a class="btn btn-outline-danger" href="#">Keep Checking!</a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>

                                
                            </div>
                        </div>

                     
                    </div>
                </div>

                <!-- dynamically added event details ends here -->
            </main>
            <!-- main event info section ends here -->










        </div>
    </div>
</body>
</html>