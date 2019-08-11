<?php
class Borrowed_book extends Book
{
    protected $late;
    protected $due_date;
    protected $user;
    
    public function set_late(bool $late)
    {
        $this->late = $late;
        return $this;
    }
    
    public function get_late()
    {
        return $this->late;
    }
    
    public function get_due_date()
    {
        return $this->due_date;
    }
    
    public function set_user($user)
    {
        $this->user = $user;
    }
    
    public function get_user()
    {
        return $this->user;
    }
    
    public function set_due_date($due_date)
    {
        //Will also calculate if this is late
        $current_date = new DateTime();
        $due_date_object = new DateTime($due_date);
        if ($due_date_object < $current_date) {
            $this->set_late(true);
        }
        $this->due_date = $due_date;
        return $this;
    }
}
