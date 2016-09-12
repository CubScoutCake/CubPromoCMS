<?php 

/**
 * _main.php
 * Main markup file
 *
 * This file contains all the main markup for the site and outputs the regions 
 * defined in the initialization (_init.php) file. These regions include: 
 * 
 *   $title: The page title/headline 
 *   $content: The markup that appears in the main content/body copy column
 *   $sidebar: The markup that appears in the sidebar column
 * 
 * Of course, you can add as many regions as you like, or choose not to use
 * them at all! This _init.php > [template].php > _main.php scheme is just
 * the methodology we chose to use in this particular site profile, and as you
 * dig deeper, you'll find many others ways to do the same thing. 
 * 
 * This file is automatically appended to all template files as a result of 
 * $config->appendTemplateFile = '_main.php'; in /site/config.php. 
 *
 * In any given template file, if you do not want this main markup file 
 * included, go in your admin to Setup > Templates > [some-template] > and 
 * click on the "Files" tab. Check the box to "Disable automatic append of
 * file _main.php". You would do this if you wanted to echo markup directly 
 * from your template file or if you were using a template file for some other
 * kind of output like an RSS feed or sitemap.xml, for example. 
 *
 * See the README.txt file for more information. 
 *
 */
?><!DOCTYPE html>

<html>

<head>

	<html lang="en">

	<meta charset="utf-8" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title><?php echo $title; ?></title>
	<meta name="description" content="<?php echo $page->summary; ?>" />

	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo $config->urls->templates; ?>styles/maintenance_reset.css">
	<link rel="stylesheet" href="<?php echo $config->urls->templates; ?>fonts/maintenance_stylesheet.css">
	<link rel="stylesheet" href="<?php echo $config->urls->templates; ?>styles/maintenance_style.css">

	<!--[if lt IE 9]>
		<link rel="stylesheet" href="css/ie.css">
	<![endif]-->

	<!-- IE fix for HTML5 tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- jQuery and Modernizr-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="<?php echo $config->urls->templates; ?>scripts/modernizr.custom.js"></script>

	<!-- Countdown timer and other animations -->
	<script src="<?php echo $config->urls->templates; ?>scripts/jquery.countdown.js"></script>
	<script src="<?php echo $config->urls->templates; ?>scripts/maintenance_script.js"></script>

</head>

<body class="<?php if($sidebar) echo "has-sidebar "; ?>">

	<?php include_once("analyticstracking.php") ?>

	<header>
		<h1><?php echo $page->headline; ?></h1>
		<p><?php echo $page->summary; ?></p>
	</header>

	<div id="main">

		<!-- main content -->
		<div id='content'>
			<h1><?php echo $page->relatedtitle	; ?></h1>
			</br>
			<div id="links">
				<div class="books"><a href="http://booking.hertscubs.uk">booking.hertscubs.uk</a></div>

				<div><p>You can book at booking.hertscubs.uk.</p></div>
				<div><p>This is the same system as booking.hertscubs100.uk.</p></div>	
			</div>
			<div id="counthead">
				<h1>Countdown to Hertfordshire Cubs 100<sup>th</sup> Birthday Camp</h1>
			</div>
			<div id="counter"></div>
		</div>

		<!--<div class="social-media-arrow"></div> -->

		<footer>	
			<ul>
				<li><a class="processwire" href="https://processwire.com"></a></li>
				<li><?php 
					if($user->isLoggedin()) {
						// if user is logged in, show a logout link
						echo "<a class='login' href='{$config->urls->admin}login/logout/'>Logout ($user->name)</a>";
					} else {
						// if user not logged in, show a login link
						echo "<a class='login' href='{$config->urls->admin}'>Admin Login</a>";
					}
					?></a></li>
			</ul>
		</footer>

	</div>

	<!-- footer -->

</body>
</html>