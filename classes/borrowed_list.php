<?php
class Borrowed_List
{
    public function toggle_borrowed($book_id, $user_id)
    {
        $conn = Connection::instance();
        /*Has the book been added before? Can we use that entry?*/
        $q = "SELECT * FROM borrowed_books WHERE `book_id` = ". $conn->real_escape_string($book_id). " AND `user_id` = ".$conn->real_escape_string($user_id);
        $result = $conn->query($q);
        if ($result->num_rows > 0) {
            //Theres a row, let's delete it.
            $this->remove_from_borrowed($book_id, $user_id);
        } else {
            $this->add_as_borrowed($book_id, $user_id);
        }
    }

    private function add_as_borrowed($book_id, $user_id)
    {
        $conn = Connection::instance();
        //Book is due back in one week
        $date = new DateTime();
        $date->add(new DateInterval("P7D"));

        $insert = array(
        "user_id"=>$user_id,
        "book_id"=>$book_id,
        "due_date"=>$date->format("Y-m-d")
      );
        $string = Connection::insert("borrowed_books", $insert);
        $stmt = $conn->prepare($string);
        $stmt->bind_param("iis", $insert['user_id'], $insert['book_id'], $insert['due_date']);
        $stmt->execute();
    }

    private function remove_from_borrowed($book_id, $user_id)
    {
      $user = User::query_user_by_id($_SESSION['UID']);
      if ($user instanceof Admin) {
        $conn = Connection::instance();
        $conn->query("DELETE FROM borrowed_books WHERE user_id = {$conn->real_escape_string($user_id)} AND book_id = {$conn->real_escape_string($book_id)}");
      }
    }

    public function query_borrowed_by_user_id($uid)
    {
        $borrowed_list = [];
        $conn = Connection::instance();
        $q = "SELECT * FROM borrowed_books WHERE `user_id` = ".$conn->real_escape_string($uid);
        $results = $conn->query($q);
        $books = $results->fetch_all();

        foreach ($books as $book) {
            $classic = new Borrowed_book();
            $classic->find_by_id($book[1]);
            $classic->set_due_date($book[3]);

            if(!empty($classic->get_title()))
              $borrowed_list[] = $classic;
        }
        return $borrowed_list;
    }

    public static function get_all_borrowed_books()
    {
        $borrowed_list = [];
        $conn = Connection::instance();
        $q = "SELECT * FROM borrowed_books;";
        $results = $conn->query($q);
        $books = $results->fetch_all();

        foreach ($books as $book) {
            $classic = new Borrowed_book();
            $classic->find_by_id($book[1]);
            $classic->set_due_date($book[3]);
            $classic->set_user($book[2]);
            if(!empty($classic->get_title()))
              $borrowed_list[] = $classic;
        }
        return $borrowed_list;
    }
}
