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
    @component('/components/header.php')

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
                                
                                @php $pages = count( $data['pages'] ); @endphp
                                @if( $pages !== 0 )
                                    <tr>
                                        <th>Additional Details: </th>
                                    </tr>
                                    
                                    <!-- create additional links for each additional info page of the event -->
                                    @foreach($data['pages'] as $page)
                                        <tr>
                                            <td><a class="text-primary text-decoration-none" href="/page?id={{ $page['id'] }}"> {{ $page['name'] }} </a></td>
                                        </tr>
                                    @endforeach
                                @endif
                                
                            </table>
                        </div>

                        <!-- enrollment button -->
                        @if( $data['details']['need_enrollment'] == 1 )
                            @if( $data['details']['ended'] == 1 )
                                <div class="col-md-6 col-sm-12">
                                    <p class="text-danger">Enrollment Has Ended!</p>
                                </div>
                            @else 
                                @if( $data['details']['enrollment'] == 1 )
                                    <div class="col-md-6 col-sm-12">
                                        <p>Enrollment is going on!</p>
                                        <a class="btn btn-outline-success" href="/enroll?id={{ $data['details']['id'] }}">Enroll Now!</a>
                                    </div>
                                @else
                                    <div class="col-md-6 col-sm-12">
                                        <p class="text-danger">Enrollment Will Start Soon!</p>
                                        <a class="btn btn-outline-danger" href="#">Keep Checking!</a>
                                    </div>
                                @endif
                            @endif
                        @endif

                        <!-- internal anchor links -->
                        <div class="col-12 mt-4">
                            <table class="table table-bordered">
                                @if( $data['awards'] !== 0 || $data['images'] !== 0 )
                                    <tr>
                                        <th>Go to Section:</th>
                                    </tr>
                                @endif

                                @if( $data['awards'] !== 0 )
                                    <tr>
                                        <td><a href="#event_awards">Awards </a></td>
                                    </tr>
                                @endif

                                @if( $data['images'] !== 0 )
                                    <tr>
                                        <td><a href="#event_images">Images</a></td>
                                    </tr>
                                @endif
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
                        <h2> {{ $data['details']['event_name'] }} </h2>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <img src="{{ $data['details']['logo'] }}" alt="">
                            </div>

                            <div class="col-md-8 col-sm-12">
                                <div class="details mt-3">
                                    {{ $data['details']['event_description'] }}
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
                                @if( $data['details']['one_day_event'] == 1 )
                                    <tr class="">
                                        <th colspan="2"> ON: {{ $data['date']['start_date'] }} </th>
                                    </tr>
                                    <tr>
                                        <td>Start</td>
                                        <td> {{ $data['date']['start_time'] }} </td>
                                    </tr>
                                    <tr>
                                        <td>End</td>
                                        <td> {{ $data['date']['end_time'] }} </td>
                                    </tr>

                                 <!-- for multi day event -->
                                 @elseif( $data['details']['one_day_event'] == 0 )
                                    <tr>
                                        <td>Start</td>
                                        <td> {{ $data['date']['start_date'] }} </td>
                                    </tr>
                                    <tr>
                                        <td>End</td>
                                        <td> {{ $data['date']['end_date'] }} </td>
                                    </tr>
                                @endif

                            </table>
                        </div>

                        <!-- awards distributed section -->
                        <div class="col-12 prizes mt-3">
                            @if( $data['awards'] !== 0 )
                                <table class="table table-bordered" id="event_awards">
                                    <tr class="text-center">
                                        <th colspan="3">Awards Distributed</th>
                                    </tr>
                                    <tr>
                                        <td>SL No.</td>
                                        <td>Name of Award</td>
                                        <td>No of winners</td>
                                    </tr>
                                    @php $count = 1; @endphp
                                    @foreach( $data['awards'] as $award)
                                        <tr>
                                            <td> {{ $count }} </td>
                                            <td> {{ $award['name'] }} </td>
                                            <td> {{ $award['no_of_awards'] }} </td>
                                        </tr>
                                        @php $count++; @endphp
                                    @endforeach
                                </table>
                            @endif
                        </div>

                        <!-- event image gallery -->
                        <div class="col-12 py-3">
                            <!-- dynamically added images -->                        
                            @if( $data['images'] !== 0 )
                                <div class="row" id="event_images">
                                    <div class="col-12 text-center">
                                        <!-- <h3>Event Images</h3> -->
                                    </div>
                                </div>
                                @php 
                                    $image = $data['images'];
                                    $count = count($data['images']);
                                @endphp

                                @for($i = 0; $i < $count; $i++ )
                                    
                                    @if($i == 0)
                                        @template
                                            <!-- start new row -->
                                            <div class="row mt-2">
                                        @endtemplate
                                    @elseif($i % 3 == 0)
                                        @template
                                            </div>
                                            <!-- close row -->

                                            <!-- start new row -->
                                            <div class="row mt-2">
                                        @endtemplate
                                    @endif

                                    <!-- print the image tag -->
                                    <div class="col-md-4 col-sm-12 p-1">
                                        <img src=" {{ $data['images'][$i]['image'] }} " alt="" style="width:100%">
                                    </div>

                                    @if($i == $count - 1)
                                        @template
                                            </div>
                                            <!-- close the last row -->
                                        @endtemplate
                                    @endif

                                @endfor
                            @endif
                        
                            
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
                                @if( $data['contacts'] !== 0 )
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
                                    @php $count = 1; @endphp
                                    @foreach( $data['contacts'] as $contact )
                                        <tr>
                                            <td> {{ $count }} </td>
                                            <td> {{ $contact['name'] }} </td>
                                            <td> {{ $contact['designation'] }} </td>
                                            <td> {{ $contact['contact'] }} </td>
                                        </tr>
                                        @php $count++; @endphp
                                    @endforeach
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- additional information of the events -->
                        <div class="col-12 mt-4">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <!-- create additional links for each additional info page of the event -->
                                    @php $pages = count($data['pages']); @endphp
                                    @if( $pages !== 0 )
                                        <div class="col-12">
                                            <h3>Read More Information</h3>
                                        </div>
                                        <div class="col-12">
                                            <ul>
                                                @foreach($data['pages'] as $page)
                                                    <li><a class="text-primary text-decoration-none" href="/page?id={{ $page['id'] }}"> {{ $page['name'] }} </a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>

                                <!-- enrollment button -->
                               <!-- enrollment button -->
                                @if( $data['details']['need_enrollment'] == 1 )
                                    @if( $data['details']['ended'] == 1 )
                                        <div class="col-md-6 col-sm-12">
                                            <p class="text-danger">Enrollment Has Ended!</p>
                                        </div>
                                    @else 
                                        @if( $data['details']['enrollment'] == 1 )
                                            <div class="col-md-6 col-sm-12">
                                                <p>Enrollment is going on!</p>
                                                <a class="btn btn-outline-success" href="/enroll?id={{ $data['details']['id'] }}">Enroll Now!</a>
                                            </div>
                                        @else
                                            <div class="col-md-6 col-sm-12">
                                                <p class="text-danger">Enrollment Will Start Soon!</p>
                                                <a class="btn btn-outline-danger" href="#">Keep Checking!</a>
                                            </div>
                                        @endif
                                    @endif
                                @endif

                                
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