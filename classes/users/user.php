<?php
  abstract class User
  {
    //useful variables a user have
      private $id;
      private $email;
      private $password;
      private $first_name;
      private $last_name;
      private $created_at;
      protected $favourites;
      protected $borrowed;

//two functions to be implemented by classes that extends user
      abstract public function home_page();
      abstract public function get_type();


//log in function that takes the email and password
//return the user if it matches
//false if doesnt match
      public static function login($email, $password)
      {
        //get a user that has that email from the query
          $pw_hash = new PasswordHash();
          $possible_user = self::query_user($email);

          //if you found a matching email, check the password
          //associated with that email againest the password entered now
          if(!empty($possible_user)){
            $hash = $possible_user[6];

            //if you return true grab the user id and start a session
            //otherwise return false
            if ($pw_hash->check_password($password, $hash)) {
              $user = self::factory($possible_user[3]);
              $user->prepare($possible_user);
              $_SESSION['UID'] = $user->get_id();
              return $user;
            }
          }
          return false;
      }

      private static function factory($usercode)
      {
          if ($usercode == 2) {
              //user
              return new Admin();
          } else {
              //Client
              return new Client();
          }
      }

      private static function query_user($email)
      {
          $connect= Connection::instance();
          $query  = "SELECT * FROM `user_profile` WHERE email like '{$connect->real_escape_string($email)}'";
          $result = $connect->query($query);
          $rows = $result->num_rows;
          $result->data_seek(0);
          $row = $result->fetch_array(MYSQLI_NUM);
          return $row;
      }

      protected function prepare($array)
      {
          $this->set_id($array[0])
        ->set_first_name($array[1])
        ->set_last_name($array[2])
        ->set_created_at($array[4])
        ->set_email($array[5])
        ->set_password($array[6])
        ->load_favourites($array[0])
        ->load_borrowed($array[0]);
      }

      private function load_favourites()
      {
          if (!isset($this->favourites)) {
              $fav = new Favourites();
              $this->favourites = $fav->query_favourites_by_user_id($this->id);
          }
          return $this;
      }

      private function load_borrowed()
      {
          //Aggregation of users borrowed books
          //Prevent multiple queries on one load

          if (!isset($this->borrowed)) {
              $borrows = new Borrowed_List();
              $this->borrowed = $borrows->query_borrowed_by_user_id($this->id);
          }
          return $this;
      }

      public function delete_user($id)
      {
          $conn = Connection::instance();
          $conn->query("DELETE from `user_profile` where id = {$conn->real_escape_string($id)}");
          exit;
      }


      public static function query_user_by_id($id)
      {
          if ($id == null) {
              return false;
          }
          $connect= Connection::instance();
          $query  = "SELECT * FROM `user_profile` WHERE id = {$connect->real_escape_string($id)}";
          $result = $connect->query($query);
          $rows = $result->num_rows;
          $result->data_seek(0);
          $row = $result->fetch_array(MYSQLI_NUM);
          if (!empty($row)) {
              $user = self::factory($row[3]);
              $user->prepare($row);
              return $user;
          } else {
              return false;
          }
      }

      //setters and getters 

      public function update_password()
      {
          $pw_hash = new PasswordHash();
      }

      public function get_email()
      {
          return $this->email;
      }

      public function set_email($email)
      {
          $this->email = $email;
          return $this;
      }

      public function set_first_name($first_name)
      {
          $this->first_name = $first_name;
          return $this;
      }

      public function get_first_name()
      {
          return ucfirst($this->first_name);
      }

      public function get_last_name()
      {
          return ucfirst($this->last_name);
      }

      public function set_last_name($last_name)
      {
          $this->last_name = $last_name;
          return $this;
      }

      protected function set_password($pass)
      {
          $this->password = $pass;
          return $this;
      }

      public function set_created_at($created_at)
      {
          $this->created_at = $created_at;
          return $this;
      }

      public function set_id($id)
      {
          $this->id = $id;
          return $this;
      }

      public function get_id()
      {
          return $this->id;
      }

      public function get_borrowed()
      {
          return $this->borrowed;
      }

      public function get_favourites()
      {
          return $this->favourites;
      }
  }
