<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADBU | Events</title>
    <link rel="shortcut icon" href="./favicon.ico"  type="image/x-icon">

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

















    <style>


@import url("https://fonts.googleapis.com/css2?family=Baloo+2&display=swap");
/* This pen */
body {
  font-family: "Baloo 2", cursive;
  font-size: 16px;
  color: #ffffff;
  text-rendering: optimizeLegibility;
  font-weight: initial;
}

.dark {
  background: #110f16;
}

.light {
  background: #f3f5f7;
}

a, a:hover {
  text-decoration: none;
  transition: color 0.3s ease-in-out;
}

#pageHeaderTitle {
  margin: 2rem 0;
  text-transform: uppercase;
  text-align: center;
  font-size: 2.5rem;
}

/* Cards */
.postcard {
  flex-wrap: wrap;
  display: flex;
  box-shadow: 0 4px 21px -12px rgba(0, 0, 0, 0.66);
  border-radius: 10px;
  margin: 0 0 2rem 0;
  overflow: hidden;
  position: relative;
  color: #ffffff;
}
.postcard.dark {
  background-color: #18151f;
}
.postcard.light {
  background-color: #e1e5ea;
}
.postcard .t-dark {
  color: #18151f;
}
.postcard a {
  color: inherit;
}
.postcard h1, .postcard .h1 {
  margin-bottom: 0.5rem;
  font-weight: 500;
  line-height: 1.2;
}
.postcard .small {
  font-size: 80%;
}
.postcard .postcard__title {
  font-size: 1.75rem;
}
.postcard .postcard__img {
  max-height: 180px;
  width: 100%;
  object-fit: cover;
  position: relative;
}
.postcard .postcard__img_link {
  display: contents;
}
.postcard .postcard__bar {
  width: 50px;
  height: 10px;
  margin: 10px 0;
  border-radius: 5px;
  background-color: #424242;
  transition: width 0.2s ease;
}
.postcard .postcard__text {
  padding: 1.5rem;
  position: relative;
  display: flex;
  flex-direction: column;
}
.postcard .postcard__preview-txt {
  overflow: hidden;
  text-overflow: ellipsis;
  text-align: justify;
  height: 100%;
}
.postcard .postcard__tagbox {
  display: flex;
  flex-flow: row wrap;
  font-size: 14px;
  margin: 20px 0 0 0;
  padding: 0;
  justify-content: center;
}
.postcard .postcard__tagbox .tag__item {
  display: inline-block;
  background: rgba(83, 83, 83, 0.4);
  border-radius: 3px;
  padding: 2.5px 10px;
  margin: 0 5px 5px 0;
  cursor: default;
  user-select: none;
  transition: background-color 0.3s;
}
.postcard .postcard__tagbox .tag__item:hover {
  background: rgba(83, 83, 83, 0.8);
}
.postcard:before {
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-image: linear-gradient(-70deg, #424242, transparent 50%);
  opacity: 1;
  border-radius: 10px;
}
.postcard:hover .postcard__bar {
  width: 100px;
}

@media screen and (min-width: 769px) {
  .postcard {
    flex-wrap: inherit;
  }
  .postcard .postcard__title {
    font-size: 2rem;
  }
  .postcard .postcard__tagbox {
    justify-content: start;
  }
  .postcard .postcard__img {
    max-width: 300px;
    max-height: 100%;
    transition: transform 0.3s ease;
  }
  .postcard .postcard__text {
    padding: 3rem;
    width: 100%;
  }
  .postcard .media.postcard__text:before {
    content: "";
    position: absolute;
    display: block;
    background: #18151f;
    top: -20%;
    height: 130%;
    width: 55px;
  }
  .postcard:hover .postcard__img {
    transform: scale(1.1);
  }
  .postcard:nth-child(2n+1) {
    flex-direction: row;
  }
  .postcard:nth-child(2n+0) {
    flex-direction: row-reverse;
  }
  .postcard:nth-child(2n+1) .postcard__text::before {
    left: -12px !important;
    transform: rotate(4deg);
  }
  .postcard:nth-child(2n+0) .postcard__text::before {
    right: -12px !important;
    transform: rotate(-4deg);
  }
}
@media screen and (min-width: 1024px) {
  .postcard__text {
    padding: 2rem 3.5rem;
  }
  .postcard__text:before {
    content: "";
    position: absolute;
    display: block;
    top: -20%;
    height: 130%;
    width: 55px;
  }
  .postcard.dark .postcard__text:before {
    background: #18151f;
  }
  .postcard.light .postcard__text:before {
    background: #e1e5ea;
  }
}
/* COLORS */
.postcard .postcard__tagbox .green.play:hover {
  background: #79dd09;
  color: black;
}

.green .postcard__title:hover {
  color: #79dd09;
}

.green .postcard__bar {
  background-color: #79dd09;
}

.green::before {
  background-image: linear-gradient(-30deg, rgba(121, 221, 9, 0.1), transparent 50%);
}

.green:nth-child(2n)::before {
  background-image: linear-gradient(30deg, rgba(121, 221, 9, 0.1), transparent 50%);
}

.postcard .postcard__tagbox .blue.play:hover {
  background: #0076bd;
}

.blue .postcard__title:hover {
  color: #0076bd;
}

.blue .postcard__bar {
  background-color: #0076bd;
}

.blue::before {
  background-image: linear-gradient(-30deg, rgba(0, 118, 189, 0.1), transparent 50%);
}

.blue:nth-child(2n)::before {
  background-image: linear-gradient(30deg, rgba(0, 118, 189, 0.1), transparent 50%);
}

.postcard .postcard__tagbox .red.play:hover {
  background: #bd150b;
}

.red .postcard__title:hover {
  color: #bd150b;
}

.red .postcard__bar {
  background-color: #bd150b;
}

.red::before {
  background-image: linear-gradient(-30deg, rgba(189, 21, 11, 0.1), transparent 50%);
}

.red:nth-child(2n)::before {
  background-image: linear-gradient(30deg, rgba(189, 21, 11, 0.1), transparent 50%);
}

.postcard .postcard__tagbox .yellow.play:hover {
  background: #bdbb49;
  color: black;
}

.yellow .postcard__title:hover {
  color: #bdbb49;
}

.yellow .postcard__bar {
  background-color: #bdbb49;
}

.yellow::before {
  background-image: linear-gradient(-30deg, rgba(189, 187, 73, 0.1), transparent 50%);
}

.yellow:nth-child(2n)::before {
  background-image: linear-gradient(30deg, rgba(189, 187, 73, 0.1), transparent 50%);
}

@media screen and (min-width: 769px) {
  .green::before {
    background-image: linear-gradient(-80deg, rgba(121, 221, 9, 0.1), transparent 50%);
  }
  .green:nth-child(2n)::before {
    background-image: linear-gradient(80deg, rgba(121, 221, 9, 0.1), transparent 50%);
  }
  .blue::before {
    background-image: linear-gradient(-80deg, rgba(0, 118, 189, 0.1), transparent 50%);
  }
  .blue:nth-child(2n)::before {
    background-image: linear-gradient(80deg, rgba(0, 118, 189, 0.1), transparent 50%);
  }
  .red::before {
    background-image: linear-gradient(-80deg, rgba(189, 21, 11, 0.1), transparent 50%);
  }
  .red:nth-child(2n)::before {
    background-image: linear-gradient(80deg, rgba(189, 21, 11, 0.1), transparent 50%);
  }
  .yellow::before {
    background-image: linear-gradient(-80deg, rgba(189, 187, 73, 0.1), transparent 50%);
  }
  .yellow:nth-child(2n)::before {
    background-image: linear-gradient(80deg, rgba(189, 187, 73, 0.1), transparent 50%);
  }
}


</style>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    
    
    
    
    
    
    
    
</head>
<body>
    <!-- include the componenet: header -->
    @component('/components/header.php')

    <div class="container-fluid" style="background-color: #DDDDDD;">
        <div class="row">
            <div class="col-md-3 col-sm-12 p-2">
                <!-- include the component: sidebar -->
                @component('/components/sidebar.php')
            </div>

            <!-- home main container starts here -->
            <main class="col-md-9 col-sm-12">
                <div class="row d-flex flex-column p-3">
                  
                    <!-- dynamically added section here -->
                    <section class="light">
                        <div class="container py-2">
                            <div class="h1 text-center text-dark" id="pageHeaderTitle">Events</div>

                            
                        </div>
                    </section>

                    <!-- dynamically genereated cards till upto here -->

                </div>
            </main>
        </div>
        <!-- home main container ends here -->
    </div>

    <!-- cdn link for jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- fetch and create dom -->
    <script>
      // the info will be fetched for the database and DOM will be created using js

      $(document).ready( () => {
        
        let start = 0;

        // how many events to fetch each time
        let amount_of_events_to_fetch = 10; // this value should match with the backend other wise may cause unexpected result

        // get the container
        let container = document.getElementById('pageHeaderTitle');
        
        // run this one time without scroll
        jQuery.ajax({
          url: '/get-events',
          data: "start=" + start,
          type: 'post',
          success: result => {
            result = JSON.parse(result);
            
            result.forEach (value => {
                let element;

                // if enrollment is going on
                let enrollment = '';

                if (value.need_enrollment == 1 && value.enrollment == 1) {
                  enrollment = `
                    <li class="tag__item play blue" style="background-color: #41B06E;">
                        <span style="color: white;"><i class="fas fa-play mr-2"></i>Enrollment is going on!</span>
                    </li>
                  `;
                } else if (value.need_enrollment == 1 && value.enrollment == 0) {
                  enrollment = `
                    <li class="tag__item play blue" style="background-color: #EE4266;">
                        <span style="color: white;"><i class="fas fa-play mr-2"></i>Enrollment will start soon!</span>
                    </li>
                  `;
                }
                
                if (value.id % 2 == 0) {
                  element = `
                  <a href="/event-info?id=${value.id}">
                                  <article class="postcard light blue">
                                      <span class="postcard__img_link">
                                          <img class="postcard__img" src="${value.logo}" alt="Image Title" />
                                      </span>                                    
                                      <div class="postcard__text t-dark">
                                          <h1 class="postcard__title blue"> ${value.event_name} </h1>
                                          <div class="postcard__subtitle small">
                                              <time datetime="2020-05-25 12:00:00">
                                                  <i class="fas fa-calendar-alt mr-2"></i> <!-- event date -->
                                              </time>
                                          </div>
                                          <div class="postcard__bar"></div>
                                          <div class="postcard__preview-txt" style="font-size: 16px"> ${value.event_description} </div>
                                          <ul class="postcard__tagbox">
                                              <li class="tag__item"><i class="fas fa-tag mr-2"></i>  </li>
                                              <!-- <li class="tag__item"><i class="fas fa-clock mr-2"></i>55 mins.</li> -->
                                              ${ enrollment }
                                          </ul>
                                      </div>
                                  </article>
                                </a>
                  `;
                } else {
                  element = `
                  <a href="/event-info?id=${value.id}">
                                  <article class="postcard light blue">
                                      
                                      <div class="postcard__text t-dark">
                                          <h1 class="postcard__title blue">${value.event_name}</h1>
                                          <div class="postcard__subtitle small">
                                              <time datetime="2020-05-25 12:00:00">
                                                  <i class="fas fa-calendar-alt mr-2"></i> <!-- event date -->
                                              </time>
                                          </div>
                                          <div class="postcard__bar"></div>
                                          <div class="postcard__preview-txt" style="font-size: 16px;"> ${value.event_description} </div>
                                          <ul class="postcard__tagbox">
                                              <li class="tag__item"><i class="fas fa-tag mr-2"></i>  </li>
                                              <!-- <li class="tag__item"><i class="fas fa-clock mr-2"></i>55 mins.</li> -->
                                              
                                              ${ enrollment }
                                              
                                          </ul>
                                      </div>
                                      <span class="postcard__img_link">
                                          <img class="postcard__img" src="${value.logo}" alt="Image Title" />
                                      </span>
                                  </article>
                                </a>
                  `;
                }


                // append to the cntainer
                let containerPrevContent = container.innerHTML;

                // append new content
                let newContent = containerPrevContent + element;

                // append
                container.innerHTML = newContent;
            });

            start += amount_of_events_to_fetch;
            
          }
        });

        jQuery(window).scroll( () => {
          if(jQuery(window).scrollTop() >= jQuery(document).height() - jQuery(window).height()) {
            console.log('call');


            jQuery.ajax({
          url: '/get-events',
          data: "start=" + start,
          type: 'post',
          success: result => {
            result = JSON.parse(result);
            
            result.forEach (value => {
                let element;

                // if enrollment is going on
                let enrollment = '';

                if (value.need_enrollment == 1 && value.enrollment == 1) {
                  enrollment = `
                    <li class="tag__item play blue" style="background-color: #41B06E;">
                        <span style="color: white;"><i class="fas fa-play mr-2"></i>Enrollment is going on!</span>
                    </li>
                  `;
                } else if (value.need_enrollment == 1 && value.enrollment == 0) {
                  enrollment = `
                    <li class="tag__item play blue" style="background-color: #EE4266;">
                        <span style="color: white;"><i class="fas fa-play mr-2"></i>Enrollment will start soon!</span>
                    </li>
                  `;
                }
                
                if (value.id % 2 == 0) {
                  element = `
                  <a href="/event-info?id=${value.id}">
                                  <article class="postcard light blue">
                                      <span class="postcard__img_link">
                                          <img class="postcard__img" src="${value.logo}" alt="Image Title" />
                                      </span>                                    
                                      <div class="postcard__text t-dark">
                                          <h1 class="postcard__title blue"> ${value.event_name} </h1>
                                          <div class="postcard__subtitle small">
                                              <time datetime="2020-05-25 12:00:00">
                                                  <i class="fas fa-calendar-alt mr-2"></i> <!-- event date -->
                                              </time>
                                          </div>
                                          <div class="postcard__bar"></div>
                                          <div class="postcard__preview-txt" style="font-size: 16px"> ${value.event_description} </div>
                                          <ul class="postcard__tagbox">
                                              <li class="tag__item"><i class="fas fa-tag mr-2"></i>  </li>
                                              <!-- <li class="tag__item"><i class="fas fa-clock mr-2"></i>55 mins.</li> -->
                                              ${ enrollment }
                                          </ul>
                                      </div>
                                  </article>
                                </a>
                  `;
                } else {
                  element = `
                  <a href="/event-info?id=${value.id}">
                                  <article class="postcard light blue">
                                      
                                      <div class="postcard__text t-dark">
                                          <h1 class="postcard__title blue">${value.event_name}</h1>
                                          <div class="postcard__subtitle small">
                                              <time datetime="2020-05-25 12:00:00">
                                                  <i class="fas fa-calendar-alt mr-2"></i> <!-- event date -->
                                              </time>
                                          </div>
                                          <div class="postcard__bar"></div>
                                          <div class="postcard__preview-txt" style="font-size: 16px;"> ${value.event_description} </div>
                                          <ul class="postcard__tagbox">
                                              <li class="tag__item"><i class="fas fa-tag mr-2"></i>  </li>
                                              <!-- <li class="tag__item"><i class="fas fa-clock mr-2"></i>55 mins.</li> -->
                                              
                                              ${ enrollment }
                                              
                                          </ul>
                                      </div>
                                      <span class="postcard__img_link">
                                          <img class="postcard__img" src="${value.logo}" alt="Image Title" />
                                      </span>
                                  </article>
                                </a>
                  `;
                }


                // append to the cntainer
                let containerPrevContent = container.innerHTML;

                // append new content
                let newContent = containerPrevContent + element;

                // append
                container.innerHTML = newContent;
            });

            start += amount_of_events_to_fetch;
            
          }
        });
            
            
            
          }
        });
        
      });
    </script>
    
</body>
</html>