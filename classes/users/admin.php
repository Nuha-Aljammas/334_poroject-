<?php
  class Admin extends User
  {
    //this function loades the admin view
      public function home_page()
      {
          header("Location: /admin.php");
      }

      //this function returns the type of the user
      public function get_type()
      {
          return "Admin";
      }

      //this function returns all users as a list
      public static function get_all_users()
      {
        //instance is a static function in the class connection
          $conn = Connection::instance();
          $q = "SELECT * FROM `user_profile`;";
          $results = $conn->query($q);
          $user_list = [];
          foreach ($results->fetch_all() as $listed_user) {
              $user = self::query_user_by_id($listed_user[0]);
              $user_list[] = $user;
          }
          return $user_list;
      }
  }
