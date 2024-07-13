<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    
    <link rel="stylesheet" href="fonts/icomoon/style.css">
  
    <link href='fullcalendar/packages/core/main.css' rel='stylesheet' />
    <link href='fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
    
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/calender.css">

    <title>ADBU ACADEMIC CUM EVENT CALENDER</title>
  </head>
  <body>
  

  <div id='calendar-container'>
    <div id='calendar'></div>
  </div>
    
    

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src='fullcalendar/packages/core/main.js'></script>
    <script src='fullcalendar/packages/interaction/main.js'></script>
    <script src='fullcalendar/packages/daygrid/main.js'></script>
    <script src='fullcalendar/packages/timegrid/main.js'></script>
    <script src='fullcalendar/packages/list/main.js'></script>

    
    <script src="js/date.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
      







    // 1. Create a new XMLHttpRequest object
    let xhr = new XMLHttpRequest();

    // 2. Configure it: GET-request for the URL /article/.../load
    xhr.open('GET', '/get-events');

    // 3. Send the request over the network
    xhr.send();

    // 4. This will be called after the response is received
    xhr.onload = function() {
      if (xhr.status != 200) { // analyze HTTP status of the response
        alert(`Error ${xhr.status}: ${xhr.statusText}`); // e.g. 404: Not Found
      } else { // show the result
        // alert(`Done, got ${xhr.response.length} bytes`); // response is the server response
        console.log(xhr.responseText);

        // calendar.events = JSON.parse(xhr.responseText);
        










        // render the calender
        var date = new Date();
        
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
          height: 'parent',
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
          },
          defaultView: 'dayGridMonth',
          defaultDate: getTodayDate(),
          navLinks: true, // can click day/week names to navigate views
          editable: false,
          eventLimit: true, // allow "more" link when too many events
          events: JSON.parse(xhr.responseText),
        });
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        calendar.render();
        
        
        
      }
    };

    xhr.onprogress = function(event) {
      if (event.lengthComputable) {
        // alert(`Received ${event.loaded} of ${event.total} bytes`);
      } else {
        // alert(`Received ${event.loaded} bytes`); // no Content-Length
      }

    };

    xhr.onerror = function() {
      // alert("Request failed");
    };
        
    
    
    
    
    
    

    
  });


  const d = new Date();
  let year = d.getFullYear();

    </script>

    <script src="js/main.js"></script>
  </body>
</html>