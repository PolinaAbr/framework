<?php

session_start();
require "polinaframework/core/include.php";
use polinaframework\core\tables\UserTable;
use auth\User;

//$user = "admin";
//$password = "admin";
//$login = new User();
////$login->newUser($user, $password);
//$login->login();
////$login->logout();
//if ($login->login) {
//    debug("Authorization was successful");
//}

//$data = array('username' => 'guest', 'password' => 'guestguest');
//UserTable::add($data);
//$id = 3;
//UserTable::delete($id);
//$data = array('password' => 'administrator');
//$id = 2;
//UserTable::update($id, $data);
//$data = array(
//    'select' => array('username' , 'password'),
//    'filter' => array(
//        "username" => "user, name"
//    ),
//    'order' => array('username' => 'desc'),
//    'limit' => 3);
//$result = UserTable::getList($data);
//while ($row = $result->fetch()) {
//    debug($row);
//}

function debug($arr) {
    echo '<pre>' . print_r($arr, true) . '</pre>';
//    echo '<pre>' . var_export($arr, true) . '</pre>';
}