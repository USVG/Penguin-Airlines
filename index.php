<?php

include  "ifSessionHeader.php";
 ?>

	<!-- Header -->
	<header id="head">

		<div class="container">
			<div class="row">
				<h1 class="lead">Penguin Airlines!</h1>
				<p class="tagline">Because Penguins can't fly, but we can ! <a href="http://www.gettemplate.com/?utm_source=progressus&amp;utm_medium=template&amp;utm_campaign=progressus"></a></p>
				<p><a class="btn btn-default btn-lg" href="searchFlights.php" <a class="btn btn-action btn-lg" role="button">BOOK NOW</a></p>
			</div>
		</div>
	</header>
	<!-- /Header -->

	<!-- Intro -->
    <style>
        .images{
            width: 318px;
            height: 200px;
            float: left;
            display: flex;
            flex: 33.33%;
            align-content: center;




        }
    </style>


<body>

<style>

.column {
  float: left;
  width: 20%;
}

</style>

<div class="row">
  <div class="column" >
    <img style='width: 100%; height: 250px;' src = "assets/images/ibiza.jpg">
  </div>
  <div class="column" >
    <img style='width: 100%; height: 250px;' src = "assets/images/panama.webp">
  </div>
  <div class="column" >
    <img style='width: 100%; height: 250px;' src = "assets/images/paris.jpg">
  </div>
  <div class="column" >
    <img style='width: 100%; height: 250px;' src = "assets/images/madrid.webp">
  </div>
  <div class="column" >
    <img style='width: 100%; height: 250px;' src = "assets/images/spain.jpg">
  </div>
</div>
</div>

</body>
<br>
<br>
<br>
<br>
	<div class="container text-center">


        <div>
        <img style = ' height: 240px; ' src = "assets/images/Logo (1).png">
		<h2 class="thin">The best place to tell book your holidays</h2>
        </div>




        <h3 class="text-center thin">Reasons to use our airline</h3>

        <div class="row">
            <div class="col-md-3 col-sm-6 highlight">
                <div class="h-caption"><h4><i class="fa fa-cogs fa-5"></i>Latest planes technologies</h4></div>
                <div class="h-body text-center">
                    <p>Fly with planes that are that are safe</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 highlight">
                <div class="h-caption"><h4><i class="fa fa-flash fa-5"></i>Fast and Efficient!</h4></div>
                <div class="h-body text-center">
                    <p>Get to your destinations as fast as possible! </p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 highlight">
                <div class="h-caption"><h4><i class="fa fa-heart fa-5"></i>Nature-Friendly</h4></div>
                <div class="h-body text-center">
                    <p>Environmentally Friendly. Our flight service tries to minimize air pollution as much as possible!</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 highlight">
                <div class="h-caption"><h4><i class="fa fa-smile-o fa-5"></i>Support</h4></div>
                <div class="h-body text-center">
                    <p>Our customer service will reach you back within 24 hours </p>
                </div>
            </div>
        </div> <!-- /row  -->
	</div>
	<!-- /Intro-->

	<!-- Highlights - jumbotron -->

	<!-- /Highlights -->

	<!-- container -->
	<div class="container">

        <h2 class="text-center top-space"> <b> Frequently Asked Questions </b></h2>
		<br>
        <div>
            <center>
            <img style = ' height: 100px;  text-align:center;' src = "assets/images/question.png">
            </center>
        </div><br>
		<div class="row">
			<div class="col-sm-6">
				<h3>How do I book a flight?</h3>
				<p>First you need to have an account, you can register <a href="registration.php">here</a>. Having an account allows you to book flights and keep track of them in your bookings page.</p>
			</div>
			<div class="col-sm-6">
				<h3>Can I change my personal information if I entered it incorrectly?</h3>
				<p>
					Yes you can, after you login you will see a button with your name,
					after you click it you will be redirected to account settings.
			</div>
		</div> <!-- /row -->

		<div class="row">
			<div class="col-sm-6">
				<h3>Can I rent a car?</h3>
				<p>
					Yes, you can. Visit <a href ="carHire.php"> Car Hire </a> page, you will see all the information
				</p>
			</div>
			<div class="col-sm-6">
				<h3>How do I get in contact?</h3>
				<p>You can give us a call or send an email ! Visit <a href="contact.php" > Contact Page</a> for info.</p>
			</div>
		</div> <!-- /row -->



</div>	<!-- /container -->

	<!-- Social links. @TODO: replace by link/instructions in template -->
	<section id="social">
		<div class="container">
			<div class="wrapper clearfix">
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style">
				<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
				<a class="addthis_button_tweet"></a>
				<a class="addthis_button_linkedin_counter"></a>
				<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
				</div>
				<!-- AddThis Button END -->
			</div>
		</div>
	</section>
	<!-- /social links -->


	<?php
	include "footer.php";
	?>
