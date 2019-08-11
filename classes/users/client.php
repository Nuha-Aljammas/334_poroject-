<?php
  class Client extends User
  {
    //function that loads the client view home page
      public function home_page()
      {
            header("Location: /home.php");

      }

//this function return the type of the user 
      public function get_type()
      {
          return "Client";
      }
  }
