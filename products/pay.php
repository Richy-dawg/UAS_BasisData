<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php

    if(!isset($_SERVER['HTTP_REFERER'])){
        // redirect them to your desired location
        header('location: http://localhost/coffee-blend/index.php');
        exit;
    }

    if(!isset($_SESSION['user_id'])) {
		header("location: " .APPURL."");
	}
?>

<section class="home-slider owl-carousel">

    <div class="slider-item" style="background-image: url(<?php echo APPURL; ?>/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="row slider-text justify-content-center align-items-center">
            <div class="col-md-7 col-sm-12 text-center ftco-animate">
                <h1 class="mb-3 mt-5 bread">Pay with PayPal</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo APPURL; ?>">Home</a></span> <span>Pay with PayPal</span></p>
            </div>
        </div>
    </div>
</section>

<div class="container">  

    <!-- Replace "test" with your own sandbox Business account app client ID -->

    <script src="https://www.paypal.com/sdk/js?client-id=AU5pYqRuJ04ZDmuYQUUMCWlwOlJS_K4eMNvwAMeyUXRpMii-LjOrRB6AJP3aB6zqtAWss9fedPQ4YUSK&currency=USD"></script>


    <!-- Set up a container element for the button -->

    <div id="paypal-button-container"></div>

        
    <script>
        paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
            return actions.order.create({
            purchase_units: [{
                amount: {
                value: '<?php echo $_SESSION['total_price']; ?>' // Can also reference a variable or function
                }
            }]
            });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
            
                window.location.href='delete-cart.php';
            });
        }
        }).render('#paypal-button-container');
    </script>
</div>

<?php require "../includes/footer.php"; ?>
