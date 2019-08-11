<?php
class Favourites
{
    public function toggle_favourite($book_id, $user_id)
    {
        $conn = Connection::instance();
        /*Has the book been added before? Can we use that entry?*/
        $q = "SELECT * FROM favourite_books WHERE `book_id` = ". $conn->real_escape_string($book_id). " AND `user_id` = ".$conn->real_escape_string($user_id);
        $result = $conn->query($q);
        if ($result->num_rows > 0) {
            //Theres a row, let's delete it.
            $this->remove_from_favourite($book_id, $user_id);
        } else {
            $this->add_as_favourite($book_id, $user_id);
        }
    }

    private function add_as_favourite($book_id, $user_id)
    {
        $conn = Connection::instance();
        $insert = array(
          "user_id"=>$user_id,
          "book_id"=>$book_id,
        );
        $string = Connection::insert("favourite_books", $insert);
        $stmt = $conn->prepare($string);
        $stmt->bind_param("ii", $insert['user_id'], $insert['book_id']);
        $stmt->execute();
        echo "added";
        die;
    }

    private function remove_from_favourite($book_id, $user_id)
    {
        $conn = Connection::instance();
        $conn->query("DELETE FROM favourite_books WHERE user_id = {$conn->real_escape_string($user_id)} AND book_id = {$conn->real_escape_string($book_id)}");
        echo "removed";
        die;
    }

    public function query_favourites_by_user_id($uid)
    {
        $favourites_list = [];
        $conn = Connection::instance();
        $q = "SELECT * FROM favourite_books WHERE `user_id` = ".$conn->real_escape_string($uid);
        $results = $conn->query($q);
        $books = $results->fetch_all();
        foreach ($books as $book) {
            $classic = new Book();
            $classic->find_by_id($book[1]);
            $favourites_list[] = $classic;
        }
        return $favourites_list;
    }

    public function all_favourited_books()
    {
    }
}

 ?>
