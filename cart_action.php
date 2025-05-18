<?php
session_start();
require 'cart_logic.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = handleCartAction($_POST, $_SESSION);
    echo json_encode($response);
}
