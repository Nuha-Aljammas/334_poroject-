<?php
include_once("header.php");
if (!isset($user) || (!$user instanceof Admin)) {
    header("Location: /");
}

$connect = Connection::instance();
$query="select catagory,count(*) as cnt from classics group by catagory";
$result =$connect->query($query);

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
      <h2>Users: </h2>
    </header>
    <div class="user-list">
    <?php
      //ADMIN ONLY FUNCTION
      $all_users = $user->get_all_users();

      foreach ($all_users as $site_user) {
          ?>
          <div class="user-block">
            <div>Name: <?php echo $site_user->get_first_name() . " " . $site_user->get_last_name(); ?></div>
            <div>Type: <?php echo $site_user->get_type(); ?></div>
            <div class="delete-button"><span class="buttons danger"><input type='button' value='Delete' class='fav' id='<?php echo $site_user->get_id(); ?>' onclick='del_user(this);'></span></div>
          </div>

          <?php
      }
     ?>
   </div>
  </div>


</section>

<section id="two">
  <div class="inner">
    <article class="alt">
      <div class="content">
        <header>
          <h3>Borrowed Books</h3>
        </header>
        <div class="borrowed">
        <?php
          foreach (Borrowed_List::get_all_borrowed_books() as $borrowed_book) {
              ?>
                <div>
                  <div>
                    Title: <?php echo $borrowed_book->get_title(); ?>
                  </div>
                  <div>
                    Due Date: <?php echo $borrowed_book->get_due_date(); ?>
                  </div>


                </div>

              <?php
          }
        ?>
        </div>
      </div>
    </article>
    <artical class="alt">

        <header> <h3> In Stock By Category:</h3><header>
      <div class="content" id="piechart">  </div>
      </articale>
  </div>
</section>




    </article>
  </div>
</section>
<?php include_once("footer.php"); ?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Book', 'Count'],
      <?php
      if($result->num_rows > 0){
          while($row = $result->fetch_assoc()){
            echo "['".$row['catagory']."', ".$row['cnt']."],";
          }
      }
      ?>
    ]);

    var options = {
        title: 'Book By Category',
        width: 450,
        height: 500,
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
}
</script>
<script src="assets/js/user_actions.js"></script>
