<?php
//Only show this page if the user is logged in?
    include_once("header.php");
    if (!$user instanceof User) {
        header("Location: /");
    }
 ?>


			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

		<!-- Banner -->
			<section id="banner">
				<div class="inner">
					<h1>Scholar Library: <span> Get your book at the press of a button</span></h1>

				</div>
			</section>

		<!-- One -->
			<section id="one">
				<div class="inner">
					<header>
						<h2>Search for books:</h2>
					</header>
							<div class="field half search-bar">
							<label for="search"></label>
							<input type="text" name="search" id="search" />
						</div>
				</div>
			</section>

		<!-- Two -->
			<section id="two">
				<div class="inner">
					<article>
						<div class="content">
							<header>
								<h3>Borrowed: </h3>
							</header>
              <?php
              //User must exists to get here
                 foreach ($user->get_borrowed() as $borrowed_book) {
                     ?>
                     <div <?php if ($borrowed_book->get_late()) {
                         echo "class='late'";
                     } ?>>
                       <div>
                         Title: <?php echo $borrowed_book->get_title(); ?>
                       </div>
                       <div class="due_date">
                          Due: <?php echo $borrowed_book->get_due_date(); ?>
                       </div>

                     </div>


                     <?php
                 }
               ?>
							<div class="image fit">
								<p> Make sure to return the books on time, Clock is ticking </p>
								<img src="images/pic01.jpg" alt="" />
							</div>
							<p> .. </p>
						</div>
					</article>
					<article class="alt">
						<div class="content">
							<header>
								<h3>Favourites</h3>
							</header>
              <div class="favourites">
              <?php
              foreach ($user->get_favourites() as $favourite_book) {
                  ?>
                  <div class="favourite_book" id="fav-<?php echo $favourite_book->get_isbn(); ?>">
                    <div class="title">
                      <?php echo $favourite_book->get_title(); ?>
                    </div>
                    <span class='buttons'> <input type='button' value='Remove' class='fav' id='<?php echo $favourite_book->get_isbn(); ?>' onclick='fav(this);'></span>
                  </div>

                  <?php
              }

              ?>
              </div>
							<div class="image fit">
							<p> To be read later:
								<img src="images/pic02.jpg" alt="" />
							</div>
							<p>...</p>
						</div>
					</article>
				</div>
			</section>


		<!-- Footer -->
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



		<?php
        include_once("footer.php");
    ?>
