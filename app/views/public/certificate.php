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
        .outer-border{
            width:800px; height:650px; padding:20px; text-align:center; border: 10px solid #673AB7;    margin-left: 21%;
        }

        .inner-dotted-border{
            width:750px; height:600px; padding:20px; text-align:center; border: 5px solid #673AB7;border-style: dotted;
        }

        .certification{
            font-size:50px; font-weight:bold;    color: #663ab7;
        }

        .certify{
            font-size:25px;
        }

        .name{
            font-size:30px;    color: green;
        }

        .fs-30{
            font-size:30px;
        }

        .fs-20{
            font-size:20px;
        }
    </style>
    
</head>
<body>
    <!-- include the componenet: header -->
    @component('/components/header.php')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-12 p-2">
                <!-- include the component: sidebar -->
                @component('/components/sidebar.php')
            </div>

            <!-- home main container starts here -->
            <main class="col-md-9 col-sm-12">
                <div class="row d-flex flex-column p-3">

                    <div class="outer-border">
                        <div class="inner-dotted-border">
                            <span class="certification">Certificate of Appreciation</span>
                            <br><br>
                            <span class="certify"><i>This is to certify that</i></span>
                            <br><br>
                            <span class="name"><b> {{ $data['winner_name'] }} </b></span><br/><br/>
                            <span class="certify"><i>has successfully participated in the event </i></span> <br/><br/>
                            <span class="fs-30"><b> {{ $data['event_name'] }} </b></span> <br/><br/>
                            <span class="certify"><i> And has been awarded the  </i></span> <br/><br/>
                            <span class="fs-30"><b> {{ $data['prize_name'] }} </b></span> <br/><br/>
                            <span class="fs-20"> certificate No: {{ $data['certificate_no'] }} <b></b></span> <br>
                            <span class="certify" style="font-size:12px">
                                This certificate is system generated, and may be verified at the Assam Don Bosco University's Events Portal.
                            </span><br>

                        </div>
                    </div>

                </div>
            </main>
        </div>
        <!-- home main container ends here -->
    </div>
</body>
</html>