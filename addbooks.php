<?php
include_once("header.php");
?>

<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

<!-- Banner -->
<section id="banner">
  <div class="inner">
    <h1>Scholar Library: <span> Admin Portal</span></h1>

  </div>
</section>


<section id="one">
  <div class="inner">
    <header>
      <h2>Manage Books</h2>
    </header>


    <?php



    if (isset($_POST['delete']))
     {
       if(!empty($_POST['box'])){
         $book = new Book();
         $book->delete_books($_POST['box']);
       }
     }



      if (isset($_POST['author'])   &&
          isset($_POST['title'])    &&
          isset($_POST['category']) &&
          isset($_POST['year'])     &&
          isset($_POST['isbn']))
      {
        $author   = $_POST['author'];
        $title    = $_POST['title'];
        $category = $_POST['category'];
        $year     = $_POST['year'];
        $isbn     = $_POST['isbn'];
        $book = new Book();
        $book->insert_book($author,$title,$category,$year,$isbn);
      }


    ?>

    <link rel="stylesheet" type="text/css" >
      <form action="addbooks.php" method="post"><pre>
        Author <input type="text" name="author">
         Title <input type="text" name="title">
      Category <input type="text" name="category">
          Year <input type="text" name="year">
          ISBN <input type="text" name="isbn">
               <input type="submit" value="ADD RECORD">
      </pre></form>

  <?php
    $book = new Book();
    $all_books = $book->get_all_books();
   ?>



    <script src="assets/js/checkall.js"></script>
    <link rel="stylesheet" href="assets/css/check_boxes.css" />

     <form action="addbooks.php" method="post">
     <input type="submit" name="delete" value="DELETE">
    <table>

    <thead><tr><td>Author</td><td>Title</td><td>Category</td><td>Year</td><td>ISBN</td>




            <td><input type="checkbox" name="all" value="all" onclick="check_them_all()"/><td></tr></thead>
    <?php
      foreach($all_books as $a_book){
        ?>
      <tr>
        <td><?php echo $a_book['author'] ?></td>
         <td><?php echo $a_book['title']?></td>
         <td><?php echo $a_book['catagory']?></td>
           <td><?php echo $a_book['year']?></td>
          <td><?php echo $a_book['ISBN']?></td>
    <td><input type="checkbox" class="book-checkbox" name="box[]" value="<?php echo $a_book['ISBN']?>" /></td>
    </tr>




    <?php
      }
      ?>
    </table>




     </form>


    <?php




      function get_post($conn, $var)
      {
        return $conn->real_escape_string($_POST[$var]);
      }
    ?>
