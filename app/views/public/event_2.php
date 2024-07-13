<!-- ***** Preloader Start ***** -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADBU | Events</title>
    <link rel="shortcut icon" href="./favicon.ico"  type="image/x-icon">

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/owl-carousel.css">

    <link rel="stylesheet" href="css/event_2.css">
</head>
<body>
    <!-- include the componenet: header -->
    @component('/components/header.php')

    




























    <!-- <div id="js-preloader" class="js-preloader">
      <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div> -->
    <!-- ***** Preloader End ***** -->
    
    <!-- ***** Pre HEader ***** -->
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <span>
                        <!-- enrollment button -->
                        @if( $data['details']['need_enrollment'] == 1 )
                            @if( $data['details']['ended'] == 1 )
                                <p class="text-danger">Enrollment Has Ended!</p>
                            @else 
                                @if( $data['details']['enrollment'] == 1 )
                                    <div class="col-md-6 col-sm-12">
                                        <p>Enrollment is going on!</p>
                                    </div>
                                @else
                                    <div class="col-md-6 col-sm-12">
                                        <p class="text-danger">Enrollment Will Start Soon!</p>
                                    </div>
                                @endif
                            @endif
                        @endif
                    </span>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="text-button">
                    @if( $data['details']['need_enrollment'] == 1 )
                            @if( $data['details']['ended'] == 1 )
                                <a href="#" class="btn btn-danger">Enrollment has ended!</a>
                            @else 
                                @if( $data['details']['enrollment'] == 1 )
                                    <a class="btn btn-outline-success" href="/enroll?id={{ $data['details']['id'] }}">Enroll Now!</a>
                                @else
                                <a class="btn btn-outline-danger" href="#">Keep Checking!</a>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <!-- <a href="index.html" class="logo">Art<em>Xibition</em></a> -->
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            @if( $data['awards'] !== 0 || $data['images'] !== 0 )
                                <li>
                                    <a href="#event_images">Images </a>
                                </li>
                            @endif

                            @if( $data['awards'] !== 0 )
                                <li>
                                    <a href="#event_awards">Awards </a>
                                </li>
                            @endif

                            @if( $data['images'] !== 0 )
                                <li>
                                    <a href="#event_images">Images</a>
                                </li>
                            @endif 
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" style="background-image: url({{ $data['details']['logo'] }}) !important;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-content">
                        <div class="main-white-button">
                            @if( $data['details']['need_enrollment'] == 1 )
                                @if( $data['details']['ended'] == 1 )
                                    <a href="#" class="btn btn-danger">Enrollment has ended!</a>
                                @else 
                                    @if( $data['details']['enrollment'] == 1 )
                                        <a class="btn btn-outline-success" href="/enroll?id={{ $data['details']['id'] }}">Enroll Now!</a>
                                    @else
                                    <a class="btn btn-outline-danger" href="#">Keep Checking!</a>
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- *** Owl Carousel Items ***-->
    <div class="show-events-carousel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-show-events owl-carousel">
                        <!-- dynamically added event images if available -->
                        @if( $data['images'] !== 0 )
                            @foreach( $data['images'] as $image)
                                <div class="item">
                                    <a href="{{ $image }}"><img src="{{ $image }}" alt=""></a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- *** Amazing Venus ***-->
    <div class="amazing-venues">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="left-content">
                        <h4> {{ $data['details']['event_name'] }} </h4>
                        <p>
                            {{ $data['details']['event_description'] }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="right-content">
                        <h5><i class="fa fa-map-marker"></i> Event Schedule</h5>
                        <span>
                            <!-- for one day event -->
                            @if( $data['details']['one_day_event'] == 1 )
                                <strong> ON: {{ $data['date']['date_on'] }}</strong> <br>
                                    
                                <strong>Start: </strong> {{ $data['date']['start_time'] }} <br>
                            
                                <strong>End:</strong> {{ $data['date']['end_time'] }} 
                                    
                                 <!-- for multi day event -->
                            @elseif( $data['details']['one_day_event'] == 0 )
                                <strong>Start: </strong>{{ $data['date']['start_date'] }} <br>
                                <strong>End: </strong>{{ $data['date']['end_date'] }} 
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- *** Venues & Tickets ***-->
    <div class="venue-tickets">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @if( $data['awards'] !== 0 || $data['images'] !== 0 )
                        @if( $data['awards'] !== 0 )
                            @if( $data['images'] !== 0 )
                                <div class="section-heading">
                                    <h2>More Information</h2>
                                </div>
                            @endif 
                        @endif
                    @endif
                </div>

                <div class="row mt-5">
                    <div class="col-lg-4  mx-auto">
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
                    </div>
                </div>
                
                <div class="row mt-5">
                    <div class="col-lg-4 mx-auto">
                        <div class="venue-item">
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
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-4 mx-auto">
                        <div class="col-12 mt-4">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <!-- create additional links for each additional info page of the event -->
                                    <table class="table table-bordered">
                                        @php $pages = count($data['pages']); @endphp
                                        @if( $pages !== 0 )
                                            <tr>
                                                <th> Read More</th>
                                            </tr>
                                            @foreach($data['pages'] as $page)
                                                <tr>
                                                    <td>
                                                        <a class="text-primary text-decoration-none" href="/page?id={{ $page['id'] }}"> {{ $page['name'] }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                                
                                            
                                        @endif
                                    </table>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


    <!-- *** Coming Events ***-->
    

        <!-- dynamically added event images if available -->
        @if( $data['images'] !== 0 )
            <div class="coming-events">
                <div class="left-button">
                    <div class="main-white-button">
                        <a href="shows-events.html">Images</a>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        @foreach( $data['images'] as $image)
                            <div class="col-lg-4 mt-3">
                                <div class="event-item">
                                    <div class="thumb">
                                        <a href="{{ $image['image'] }}"><img src=" {{ $image['image']  }} " alt=""></a>
                                    </div>
                                    
                                </div>
                            </div> 
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        
    


    <!-- *** Subscribe *** -->
    <!-- <div class="subscribe">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h4>Subscribe Our Newsletter:</h4>
                </div>
                <div class="col-lg-8">
                    <form id="subscribe" action="" method="get">
                        <div class="row">
                          <div class="col-lg-9">
                            <fieldset>
                              <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email Address" required="">
                            </fieldset>
                          </div>
                          <div class="col-lg-3">
                            <fieldset>
                              <button type="submit" id="form-submit" class="main-dark-button">Submit</button>
                            </fieldset>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->

    <!-- *** Footer *** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="address">
                        <h4> {{ $data['details']['event_name'] }} </h4>
                        <ul class="">
                            @if( $data['awards'] !== 0 || $data['images'] !== 0 )
                                <li>
                                    <a href="#event_images">Images </a>
                                </li>
                            @endif

                            @if( $data['awards'] !== 0 )
                                <li>
                                    <a href="#event_awards">Awards </a>
                                </li>
                            @endif

                            @if( $data['images'] !== 0 )
                                <li>
                                    <a href="#event_images">Images</a>
                                </li>
                            @endif 
                        </ul> 
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="links">
                        <h4>Read More</h4>
                        <ul>
                        @php $pages = count($data['pages']); @endphp
                        @if( $pages !== 0 )
                            @foreach($data['pages'] as $page)
                                <li>
                                        <a class="text-primary text-decoration-none" href="/page?id={{ $page['id'] }}"> {{ $page['name'] }} </a>
                                </li>
                            @endforeach
                                
                            
                        @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="hours">
                        <h4>Schedule</h4>
                        <span>
                            <!-- for one day event -->
                            @if( $data['details']['one_day_event'] == 1 )
                                <strong> ON: {{ $data['date']['date_on'] }}</strong> <br>
                                    
                                <strong>Start: </strong> {{ $data['date']['start_time'] }} <br>
                            
                                <strong>End:</strong> {{ $data['date']['end_time'] }} 
                                    
                                 <!-- for multi day event -->
                            @elseif( $data['details']['one_day_event'] == 0 )
                                <strong>Start: </strong>{{ $data['date']['start_date'] }} <br>
                                <strong>End: </strong>{{ $data['date']['end_date'] }} 
                            @endif
                        </span>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="under-footer">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <p>{{ $data['details']['event_name'] }}</p>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <p class="copyright"> Copyright ADBU </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="sub-footer">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="logo"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    

    <script src="js/scroll-reveal.js"></script>
    <script src="js/way-points.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/img-fix.js"></script>
    <script src="js/mix.js"></script>
    <script src="js/accordion.js"></script>
    <script src="js/own-carousel.js"></script>
    <script src="js/init.js"></script>
</body>
</html>












































