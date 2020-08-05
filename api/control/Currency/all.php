<?php
include '../../index.php';

// $request = $_POST;

$currency = new Currency($db);
echo json_encode($currency->all());
?>