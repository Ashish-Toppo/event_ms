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
                                        <th colspan="2"> ON: {{ $data['date']['date_on'] }} </th>
                                    </tr>
                                    <tr>
                                        <td>Start</td>
                                        <td> {{ $data['date']['time_from'] }} </td>
                                    </tr>
                                    <tr>
                                        <td>End</td>
                                        <td> {{ $data['date']['time_to'] }} </td>
                                    </tr>

                                 <!-- for multi day event -->
                                 @elseif( $data['details']['one_day_event'] == 0 )
                                    <tr>
                                        <td>Start</td>
                                        <td> {{ $data['date']['date_from'] }} </td>
                                    </tr>
                                    <tr>
                                        <td>End</td>
                                        <td> {{ $data['date']['date_to'] }} </td>
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


            <main class="col-md-9 col-sm-12">



















            <div class="main-layout">
            <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#" /></div>
      </div>
      <div class="wrapper">
         <!-- end loader -->
         <div class="sidebar">
            <!-- Sidebar  -->
            <nav id="sidebar">
               <div id="dismiss">
                  <i class="fa fa-arrow-left"></i>
               </div>
               <ul class="list-unstyled components">
                  <li class="active">
                     <a href="index.html">Home</a>
                  </li>
                  <li>
                     <a href="#about">About</a>
                  </li>
                  <li>
                     <a href="#game">Game</a>
                  </li>
                  <li>
                     <a href="#customer">Our customer</a>
                  </li>
                  <li>
                     <a href="#contact">Conatct</a>
                  </li>
               </ul>
            </nav>
         </div>
         <div id="content">
            <!-- header -->
            <header>
               <!-- header inner -->
               <div class="head_top">
                  <div class="header">
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-md-3 logo_section">
                              <div class="full">
                                 <div class="center-desk">
                                    <div class="logo">
                                       <a href="index.html"><img src="images/logo.png" alt="#"></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-9">
                              <div class="right_header_info">
                                 <ul>
                                    <li class="menu_iconb">
                                       <a href="Javascript:void(0)">Login</a>
                                    </li>
                                    <li>
                                       <button type="button" id="sidebarCollapse">
                                       <img src="images/menu_icon.png" alt="#" />
                                       </button>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </header>
            <!-- end header inner -->
            <!-- end header -->
            <section class="slider_section">
               <div class="banner_main">
                  <img src="images/bg_main.jpg" alt="#"/>
                  <div class="container-fluid padding3">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="text-bg">
                              <a href="Javascript:void(0)">Play now</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         <!-- Categories -->
         <!-- casino -->
         <div id="game" class="casino">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <div class="titlepage">
                        <h2>Our Casino Games</h2>
                        <span></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4 padding_bottom">
                     <div class="game_box">
                        <figure><img src="images/game1.jpg" alt="#"/></figure>
                     </div>
                     <div class="game">
                        <h3>Game 1</h3>
                     </div>
                  </div>
                  <div class="col-md-4 padding_bottom">
                     <div class="game_box">
                        <figure><img src="images/game2.jpg" alt="#"/></figure>
                     </div>
                     <div class="game">
                        <h3>Game 2</h3>
                     </div>
                  </div>
                  <div class="col-md-4 padding_bottom">
                     <div class="game_box">
                        <figure><img src="images/game3.jpg" alt="#"/></figure>
                     </div>
                     <div class="game">
                        <h3>Game 3</h3>
                     </div>
                  </div>
                  <div class="col-md-4 margin_bottom1">
                     <div class="game_box">
                        <figure><img src="images/game4.jpg" alt="#"/></figure>
                     </div>
                     <div class="game">
                        <h3>Game 4</h3>
                     </div>
                  </div>
                  <div class="col-md-4 margin_bottom1">
                     <div class="game_box">
                        <figure><img src="images/game5.jpg" alt="#"/></figure>
                     </div>
                     <div class="game">
                        <h3>Game 5</h3>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="game_box">
                        <figure><img src="images/game6.jpg" alt="#"/></figure>
                     </div>
                     <div class="game">
                        <h3>Game 6</h3>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- end casino -->
         <!-- licens -->
         <div class="licens">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <div class="titlepage">
                        <h2>Licensing & Reglation</h2>
                        <span></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div id="licens" class="carousel slide licens_Carousel " data-ride="carousel">
                        <ol class="carousel-indicators">
                           <li data-target="#licens" data-slide-to="0" class="active"></li>
                           <li data-target="#licens" data-slide-to="1"></li>
                           <li data-target="#licens" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                           <div class="carousel-item active">
                              <div class="container">
                                 <div class="carousel-caption ">
                                    <div class="row d_flex">
                                       <div  class="col-md-6">
                                          <div class="test_box">
                                             <div class="jons">
                                                <h4>Promotins</h4>
                                             </div>
                                             <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                                             <a class="read_more" href="Javascript:void(0)">Play Online</a>
                                          </div>
                                       </div>
                                       <div  class="col-md-6">
                                          <div class="test_box">
                                             <div class="jons">
                                                <figure><img src="images/jons_img1.png" alt="#"/></figure>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="carousel-item">
                              <div class="container">
                                 <div class="carousel-caption">
                                    <div class="row d_flex">
                                       <div  class="col-md-6">
                                          <div class="test_box">
                                             <div class="jons">
                                                <h4>Promotins</h4>
                                             </div>
                                             <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                                             <a class="read_more" href="Javascript:void(0)">Play Online</a>
                                          </div>
                                       </div>
                                       <div  class="col-md-6">
                                          <div class="test_box">
                                             <div class="jons">
                                                <figure><img src="images/jons_img1.png" alt="#"/></figure>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="carousel-item">
                              <div class="container">
                                 <div class="carousel-caption">
                                    <div class="row d_flex">
                                       <div  class="col-md-6">
                                          <div class="test_box">
                                             <div class="jons">
                                                <h4>Promotins</h4>
                                             </div>
                                             <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                                             <a class="read_more" href="Javascript:void(0)">Play Online</a>
                                          </div>
                                       </div>
                                       <div  class="col-md-6">
                                          <div class="test_box">
                                             <div class="jons">
                                                <figure><img src="images/jons_img1.png" alt="#"/></figure>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <a class="carousel-control-prev" href="#licens" role="button" data-slide="prev">
                        <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                        </a>
                        <a class="carousel-control-next" href="#licens" role="button" data-slide="next">
                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </a>
                     </div>
                     <p class="lorem">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                  </div>
                  <div id="about" class="col-md-12">
                     <ul class="spinit">
                        <li><a href="Javascript:void(0)">About spinit</a></li>
                        <li><a href="Javascript:void(0)">our promotions</a></li>
                        <li><a href="Javascript:void(0)">over 1000games</a></li>
                        <li><a href="Javascript:void(0)">our mobile app</a></li>
                     </ul>
                     <div class="two_box">
                        <div class="row d_flex">
                           <div class="col-md-4">
                              <div class="many_box_img">
                                 <figure><img src="images/imag.jpg" alt="#"/></figure>
                              </div>
                           </div>
                           <div class="col-md-8">
                              <div class="many_box">
                                 <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.There are many variati<br>
                                    ons of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                 </p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- end lLicens -->
         <!-- customer -->
         <div id="customer"  class="customer">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <div class="titlepage">
                        <h2>What Says Our customer</h2>
                        <span></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-10 offset-md-1">
                     <div class="customer_text">
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                        <div class="customer_box">
                           <i><img src="images/customer.png" alt="#"/></i>
                           <h4>Mark jo</h4>
                           <span>jected humour</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- end customer -->
         <!-- reqeste -->
         <div id="contact" class="reqeste">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <div class="titlepage">
                        <h2>Reqeste A call back</h2>
                        <span></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6 offset-md-3">
                     <form id="cochang" class="form_main">
                        <div class="row">
                           <div class="col-md-12">
                              <input class="form_control" placeholder="Name" type="text" name="Name">
                           </div>
                           <div class="col-md-12">
                              <input class="form_control" placeholder="Phone number" type="text" name="Phone number">
                           </div>
                           <div class="col-md-12">
                              <input class="form_control" placeholder="Email" type="text" name="Email">
                           </div>
                           <div class="col-md-12">
                              <input class="form_control" placeholder="Message" type="text" name="Message">
                           </div>
                           <div class="col-md-12">
                              <button class="send_btn">Send</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <!-- end reqeste -->
         <!--  footer -->
         <footer>
            <div class="footer">
               <div class="container">
                  <div class="row">
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                        <div class="address">
                           <h3>Subscribe Now</h3>
                           <form class="newtetter">
                              <button class="submit">submit</button>
                              <input class="tetter" placeholder="Enter your email" type="text" name="Enter your email">
                           </form>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="row">
                           <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                              <div class="address">
                                 <h3>Links</h3>
                                 <ul class="Menu_footer">
                                    <li class="active"> <a href="index.html">Home</a> </li>
                                    <li><a href="#about">About</a> </li>
                                    <li><a href="#game">Game</a> </li>
                                    <li><a href="#customer">customer</a> </li>
                                    <li><a href="#conatct">Conatct</a></li>
                                 </ul>
                              </div>
                           </div>
                           <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                              <div class="address">
                                 <h3>Contact us</h3>
                                 <ul class="Links_footer">
                                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="copyright">
                  <div class="container">
                     <p>Copyright 2019 All Right Reserved By <a href="https://html.design/">Free html Templates</a></p>
                  </div>
               </div>
            </div>
         </footer>
         <!-- end footer -->
      </div>
      <div class="overlay"></div>
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
       <script src="js/custom.js"></script>
      <script type="text/javascript">
         $(document).ready(function() {
             $("#sidebar").mCustomScrollbar({
                 theme: "minimal"
             });
         
             $('#dismiss, .overlay').on('click', function() {
                 $('#sidebar').removeClass('active');
                 $('.overlay').removeClass('active');
             });
         
             $('#sidebarCollapse').on('click', function() {
                 $('#sidebar').addClass('active');
                 $('.overlay').addClass('active');
                 $('.collapse.in').toggleClass('in');
                 $('a[aria-expanded=true]').attr('aria-expanded', 'false');
             });
         });
      </script>
      <script>
         $(document).ready(function() {
             $(".fancybox").fancybox({
                 openEffect: "none",
                 closeEffect: "none"
             });
         
             $(".zoom").hover(function() {
         
                 $(this).addClass('transition');
             }, function() {
         
                 $(this).removeClass('transition');
             });
         });
      </script>
            </div>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            </main>


        </div>
    </div>
</body>
</html>