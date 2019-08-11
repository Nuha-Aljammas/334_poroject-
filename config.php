<?php
require_once'db.php';
include_once("classes/connections.php");
include_once("passwordHash.php");
include_once("classes/users/user.php");
include_once("classes/users/client.php");
include_once("classes/users/admin.php");
include_once("classes/book.php");
include_once("classes/favourites.php");
include_once("classes/borrowed_list.php");
include_once("classes/borrowed_book.php");

define("LIB_PATH", __DIR__);

session_start();
