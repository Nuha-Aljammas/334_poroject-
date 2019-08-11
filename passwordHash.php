<?php
  class PasswordHash{


    private function generate_salt($password){
      //Basic base_64 encode of first 3 letter;
      //by making the salt the 3 letters of the user Password
      //it is unique to each user
      $salt = substr($password, 0,2);

      $salt = base64_encode($salt);

      return $salt;
    }

    private function generate_hash($concatPassword){
      $hash = md5($concatPassword);
      return $hash;
    }

    public function create_hash($password){
      $salt = $this->generate_salt($password);
      $concatPassword = $salt.$password;
      $realHash = $this->generate_hash($concatPassword);

      return $realHash;
    }

    public function check_password($password, $hash){
      $salt = $this->generate_salt($password);
      $concatPassword = $salt.$password;

      $realHash = $this->generate_hash($concatPassword);

      if ($realHash == $hash){
        return true;
      }

      return false;
    }

  }
?>
