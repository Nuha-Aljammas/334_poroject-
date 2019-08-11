<?php
include_once("../config.php");
  $action = $_POST['action'];
  switch ($action) {
    case "search":
      search_book();
    break;
    case "favourite":
      favourite_book();
    break;
    case "borrow":
      borrow_book();
    break;
    case "delete_user":
      delete_user();
    break;
    case "get_stats":
      get_stats();
    break;
    die;  
  }
function get_stats(){

$books = new book();
  $stats = $books->get_book_chart();
  $encoded_stats = json_encode($stats);

  echo $encoded_stats;
}

  function delete_user()
  {
      $id = $_POST['user_id'];
      $user = User::query_user_by_id($_SESSION['UID']);
      //Dont delete myself
      if ($user instanceof Admin && $user->get_id() != $id) {
          $user->delete_user($id);
      }
  }

  function favourite_book()
  {
      if (isset($_SESSION['UID']) && isset($_POST['book_id'])) {
          $favourite = new Favourites();
          $favourite->toggle_favourite($_POST['book_id'], $_SESSION['UID']);
      }
  }

  function borrow_book()
  {
      if (isset($_SESSION['UID']) && isset($_POST['book_id'])) {
          $borrowed = new Borrowed_List();
          $borrowed->toggle_borrowed($_POST['book_id'], $_SESSION['UID']);
      }
  }

  function search_book()
  {
      $string = $_POST['string'];
      $possible_books = Book::search_books($string);
      $dom = "<div class='books_searched'>";
      foreach ($possible_books as $book) {
          $dom .= "<div class='bookListing'>
                    <span class='title'>" ."<p> <b> TITLE:</b> " . $book['title'] . "</p></span>
                    <span class='author'>" ."<p><b>AUTHOR:</b> " . $book['author'] . "</p></span>

                    <span class='buttons'> <input type='button' value='Favourites' class='fav' id='".$book['ISBN']."' onclick='fav(this);'> <input type='button' value='borrow' class='borrow' id='".$book['ISBN']."' onclick='borrow(this);' >  </span>
                  </div>";
      }
      echo $dom . "</div>";
  }
