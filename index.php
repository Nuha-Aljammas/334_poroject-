<?php

include_once("config.php");
$connect = Connection::instance();

if ($connect->connect_error) {
    die($connect->connect_error);
}

if (isset($_POST['firstname']) &&
    isset($_POST['lastname']) &&
    isset($_POST['users']) &&
    isset($_POST['email']) &&
    isset($_POST['password'])) {
    $pw_hash = new PasswordHash();
    $hashed_password = $pw_hash->create_hash(get_post($connect, 'password'));
    $firstname   = get_post($connect, 'firstname');
    $lastname   = get_post($connect, 'lastname');
    $email    = get_post($connect, 'email');
    $password     = $hashed_password;
    $users = get_post($connect, 'users');

    $query  = "SELECT * FROM user_profile";
    $result = $connect->query($query);
    // if (!$result) die ("Database access failed: " . $connect->error);

    $rows = $result->num_rows;

    $email_exist = false;

    for ($j = 0 ; $j < $rows ; ++$j) {
        $result->data_seek($j);
        $row = $result->fetch_array(MYSQLI_NUM);
        if ($row[4]==$email) {
            $email_exist=true;
        }
    }

    if ($email_exist==false) {
        $stmt =$connect->prepare("insert into user_profile(fname,lname,usercode,email,password)values(?,?,?,?,?)");

        $stmt->bind_param("sssss", $firstname, $lastname, $users, $email, $password);
        $stmt->execute();


        if ($stmt->error) {
            $error =  "Email already exists" ;
      $connect->error . "<br><br>";
        } elseif (!$stmt->error) {
            $msg = "Successfully Signed up";
        }
    } else {
        echo "Enter a different email !! This email has been registered !!";
        $email_exits=false;
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
							<header>
								<h3>Sign up: </h3>
							</header>
              <?php
              if(isset($error)){
                echo "<div class='late rounded padded centered'>".$error."</div>";
              }
              if(isset($msg)){
                echo"<div class='go rounded padded centered'>".$msg."</div>";
              }
               ?>
								<form action="index.php" method="post">
									<label>First name: </label><br><input type="text" name="firstname" id="firstname" required /><br />
									<label>Last name: </label><br><input type="text" name="lastname" id="lastname" required /><br />
									<label>User Type: </label><br><select name="users"><br>
										<option value="1">user</option>
										<option value="2">admin</option>
										</select><br />
									<label>E-mail:       </label><br><input type="text" name="email" id="email" required/><br />
									<label>Password: </label><br><input type="password" name="password" id="password" required/><br /><br>
									<input value="Sign up" type="submit" />

								</form>
						</div>
					</article>
					<article class="alt">
						<div class="content">
							<header>
								<h3>Already a User?</h3>
							</header>
							<form action="signin.php">
							<input value="Sign in" type="submit" />
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


			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>

<?php




// $result->close();
$connect->close();
function get_post($connect, $var)
{
    return $connect->real_escape_string($_POST[$var]);
}



?>
