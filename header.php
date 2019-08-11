<?php
  include_once("config.php");
   //This is the header. I can now include it instead of copying and pasting for every page.
   if (isset($_SESSION['UID'])) {
       $user = User::query_user_by_id($_SESSION['UID']);
   }
 ?>




<!DOCTYPE HTML>
<!--
	Introspect by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Final Project</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/search.css" />
    <script src="assets/js/jquery.min.js"></script>
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="index.html" class="logo">Scholar Library</a>
					<nav id="nav">
            <?php
            if(isset($user) && $user instanceof Admin){ ?>
						<a href="admin.php">Home</a>
            <a href="addbooks.php"> Book Management</a>
          <?php } ?>
          <?php if(isset($user)&& !$user instanceof Admin){ ?>
            <a href ="home.php"> Home </a>
            <a href="#footer">Contact us</a>
          <?php }?>
						<a href="about.php">About</a>

            <?php
              if (isset($_SESSION['UID'])) {
                  ?>
              <a href="logout.php">Log out</a>
            <?php
              } else {
                  ?>
						<a href="index.php">Log in</a>

            <?php
              }
             ?>

					</nav>
				</div>
			</header>
