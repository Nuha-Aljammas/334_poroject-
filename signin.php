<?php
include_once("config.php");

if (isset($_POST['email']) && isset($_POST['password'])) {
    $user = User::login($_POST['email'], $_POST['password']);
    if ($user) {
        $user->home_page();
    } else {
        $error = "Invalid Username or Password";
    }
}


include_once("header.php");
 ?>

			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>


			<section id="banner">
				<div class="inner">
					<h1>Scholar Library: <span> Get your book at the press of a button</span></h1>

				</div>
			</section>





			<section id="two">
				<div class="inner">
					<article>
						<div class="content">
              <?php
              if(isset($error)){
                echo "<div class='late rounded padded centered'>".$error."</div>";
              }
               ?>
							<header>
								<h3>Sign IN: </h3>
							</header>
								<form method="POST" action="/signin.php">
								<br><label>E-mail: </label><br><input type="text" name="email" id="email" required/><br />
								<br><label>Password: </label><br><input type="password" name="password" id="password" required/><br />
								<br><input value="log in" type="submit" />

								</form>
						</div>
					</article>

				</div>
			</section>



			<section id="footer">
				<div class="inner">
					<header>
						<h2>Get in Touch</h2>
					</header>
					<form method="post" action="mailto:aljamman@uwindsor.ca">
						<div class="field half first">
							<label for="name">Name</label>
							<input type="text" name="name" id="name" />
						</div>
						<div class="field half">
							<label for="email">Email</label>
							<input type="email" name="email" id="email" />
						</div>
						<div class="field">
							<label for="message">Message</label>
							<textarea name="message" id="message" rows="6"></textarea>
						</div>
						<ul class="actions">
							<li><input type="submit" value="Send Message" class="alt" /></li>
						</ul>
					</form>
					<div class="copyright">
						&copy; Untitled Design: <a href="https://templated.co/">TEMPLATED</a>. Images <a href="https://unsplash.com/">Unsplash</a>
					</div>
				</div>
			</section>
