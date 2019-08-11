<?php
include_once("config.php");
include_once("header.php");

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
      <h2>About this Library:</h2>
    </header>
    <span>
      This project demonestrates an example of having two levels of users <br>
      <b> If you are a Client: </b>
      <ul>
        <li> you can search a book by name(first letters and so on) </li>
        <li> you can add a book to your favourites </li>
        <li> you can remove a book from your favourites </li>
        <li> you can borrow that book with the ability to see the due date </li>
        <li> we always try to be close, you can fill out the form to contact us about any concerns </li>
      </ul>

      <i> we value privacy so our back end system encrypts the passwords entered by users </i><br>
      <b> If you are an Admin: </b>
      <ul>
        <li> you have the ability to delete users (knowing what type that user was) </li>
        <li> you can see the amount of books we have in stock based of category demonestrated by a chart </li>
        <li> you can update the books available</li>
        <li> you can delete books from the database </li>
      </ul>
    </span>



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
