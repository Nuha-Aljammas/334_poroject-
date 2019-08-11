<?php
class Book
{

  //books variables
    protected $isbn;
    protected $title;
    protected $author;
    protected $catagory;
    protected $year;

    public function set_isbn($isbn)
    {
        $this->isbn = $isbn;
        return $this;
    }
    public function get_book_chart()
    {
      $conn = Connection::instance();
      $query =  "select catagory, count (*) as cnt from classics group by catagory";
      $result = $conn->query($query);

      return $result->fetch_assoc();
    }

    public function delete_books($isbn){
      $conn = Connection::instance();

      $isbn = implode(',',$isbn);
      $conn->query("DELETE FROM classics WHERE isbn IN ($isbn)");
    }

    public function insert_book($author, $title, $category, $year, $isbn){
      $conn = Connection::instance();
      $info = array(
        "author"=>$author,
        "title"=>$title,
        "catagory"=>$category,
        "year"=>$year,
        "isbn"=>$isbn
      );

      $insert_string = Connection::insert("classics",$info);
      $stmt = $conn->prepare($insert_string);
      $stmt->bind_param("sssss",$info['author'],$info['title'], $info['catagory'], $info['year'], $info['isbn']);
      $stmt->execute();


    }

    public function get_isbn()
    {
        return $this->isbn;
    }

    public function find_by_id($id)
    {
        $conn = Connection::instance();
        $results = $conn->query("SELECT * FROM classics WHERE ISBN = {$conn->real_escape_string($id)}");
        if (!empty($array = $results->fetch_assoc())) {
            $this->prepare($array);
            return $this;
        }
        return false;
    }

    private function prepare($array)
    {
        $this->author = $array['author'];
        $this->title = $array['title'];
        $this->catagory = $array['catagory'];
        $this->year = $array['year'];
        $this->isbn = $array['ISBN'];
    }

    public static function search_books($my_books)
    {
        $connection = Connection::instance();
        $query  = "SELECT * FROM `classics` WHERE title like '%{$connection->real_escape_string($my_books)}%'";
        $result = $connection->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_all_books(){
      $conn = Connection::instance();
      $q = "SELECT * FROM `classics`;";
      $results = $conn->query($q);
      return $results->fetch_all(MYSQLI_ASSOC);
    }

    public function get_title()
    {
        return $this->title;
    }
}
