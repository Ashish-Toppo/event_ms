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
                            <span class="certification">Certificate of Registration</span>
                            <br><br>
                            <span class="certify"><i>This is to certify that</i></span>
                            <br><br>
                            <span class="name"><b> {{ $data['details']['name'] }} </b></span><br/><br/>
                            <span class="certify"><i>has successfully registered for the event </i></span> <br/><br/>
                            <span class="fs-30"><b> {{ $data['event_name'] }} </b></span> <br/><br/>
                            <span class="fs-20"> Registration No: {{ $data['enrollment_no'] }} <b></b></span> <br/><br/><br/><br/>
                            <span class="certify">
                                <i>
                                    Registration Fee: {{ $data['enrollment_charges'] }}

                                    @if( $data['details']['fee_payment'] == 0 )
                                        (unpaid)
                                    @elseif( $data['details']['fee_payment'] == 1 )
                                        (paid)
                                    @endif
                                    
                                 </i>
                            </span><br>
                            
                            <span class="fs-30">Date: {{ $data['details']['date'] }} </span>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                       
                    </div>
                    <div class="col-3">
                        
                    </div>
                    <div class="col-3">
                        <a href="#" id="PayNow" class="btn btn-primary"> Pay Now </a>
                    </div>
                </div>
            </main>
        </div>

        
        <!-- home main container ends here -->
    </div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    //Pay Amount
    jQuery(document).ready(function($){

        jQuery('#PayNow').click(function(e){

            console.log('button is clicked');
            
            var paymentOption='';
            let billing_name = '{{ $data['details']['name'] }}';
            let billing_mobile = '0000000000';
            let billing_email = 'mail@dummy.co';
            var shipping_name = 'ship';
            var shipping_mobile = '1111111111';
            var shipping_email = 'mail@dummy.com';
            var paymentOption= "netbanking";
            var payAmount = 100;
                        
            var request_url="/pay";
            var formData = {
                billing_name:billing_name,
                billing_mobile:billing_mobile,
                billing_email:billing_email,
                shipping_name:shipping_name,
                shipping_mobile:shipping_mobile,
                shipping_email:shipping_email,
                paymentOption:paymentOption,
                payAmount:payAmount,
                action:'payOrder'
            }
                
            $.ajax({
                type: 'POST',
                url:request_url,
                data:formData,
                dataType: 'json',
                encode:true,
            }).done(function(data){

                console.log(data);
                if(data.res=='success'){
                    console.log('ajax success');
                    var orderID=data.order_number;
                    var orderNumber=data.order_number;
                    var options = {
                        "key": data.razorpay_key, // Enter the Key ID generated from the Dashboard
                        "amount": data.userData.amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                        "currency": "INR",
                        "name": "Tutorialswebsite", //your business name
                        "description": data.userData.description,
                        "image": "https://www.tutorialswebsite.com/wp-content/uploads/2022/02/cropped-logo-tw.png",
                        "order_id": data.userData.rpay_order_id, //This is a sample Order ID. Pass 
                        "handler": function (response){
                            window.location.replace("payment-success.php?oid="+orderID+"&rp_payment_id="+response.razorpay_payment_id+"&rp_signature="+response.razorpay_signature);
                        },
                        "modal": {
                            "ondismiss": function(){
                                window.location.replace("payment-success.php?oid="+orderID);
                            }
                        },
                        "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
                            "name": data.userData.name, //your customer's name
                            "email": data.userData.email,
                            "contact": data.userData.mobile //Provide the customer's phone number for better conversion rates 
                        },
                        "notes": {
                            "address": "Tutorialswebsite"
                        },
                        "config": {
                            "display": {
                                "blocks": {
                                    "banks": {
                                        "name": 'Pay using '+paymentOption,
                                        "instruments": [
                                            {
                                                "method": paymentOption
                                            },
                                        ],
                                    },
                                },
                                "sequence": ['block.banks'],
                                "preferences": {
                                    "show_default_blocks": true,
                                },
                            },
                        },
                        "theme": {
                            "color": "#3399cc"
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.on('payment.failed', function (response){
                        window.location.replace("payment-failed.php?oid="+orderID+"&reason="+response.error.description+"&paymentid="+response.error.metadata.payment_id);

                    });

                    rzp1.open();
                    e.preventDefault();

                }
        
            });
        });
    });
</script>
</body>
</html>