<?php

$allData = [
    1 => ['company' => 'Emirates', 'first_name' => 'Adam', 'last_name' => 'Smith', 'phone' => '55555555', 'email' => 'adam.smith@gmail.com', 'address' => 'bul Bulgariq 11 '],
    2 => ['company' => 'Emirates', 'first_name' => 'Harvey', 'last_name' => 'Jones', 'phone' => '88888888', 'email' => 'harvey.jones@gmail.com', 'address' => 'bul Vitoshka 50'],
    3 => ['company' => 'Emirates', 'first_name' => 'Daniel', 'last_name' => 'Smith', 'phone' => '666666666', 'email' => 'daniel.smith@gmail.com', 'address' => 'ul Pirotska 16'],
    4 => ['company' => 'Apple', 'first_name' => 'Emi', 'last_name' => 'Hanks', 'phone' => '99999999', 'email' => 'emi.hanks@gmail.com', 'address' => 'ul Praga 19'],
    5 => ['company' => 'Apple', 'first_name' => 'Mishel', 'last_name' => 'Smith', 'phone' => '55555555', 'email' => 'mishel.smith@gmail.com', 'address' => 'bul Vasil Levski 43'],
    6 => ['company' => 'Apple', 'first_name' => 'Jamie', 'last_name' => 'Evan', 'phone' => '88888888', 'email' => 'jamie.evan@gmail.com', 'address' => 'ul Georgi Rakovski 20'],
    7 => ['company' => 'Google', 'first_name' => 'Math', 'last_name' => 'Miling', 'phone' => '666666666', 'email' => 'math.miling@gmail.com', 'address' => 'ul Patriarh EVtimi 48'],
    8 => ['company' => 'Google', 'first_name' => 'Daniel', 'last_name' => 'Mason', 'phone' => '99999999', 'email' => 'daniel.mason@gmail.com', 'address' => 'ul Han Asparuh 5']
];

if (isset($_GET['getInformationById']) && (int)$_GET['getInformationById'] > 0) {
    echo json_encode($allData[(int)$_GET['getInformationById']]);
    exit;
}

if (isset($_GET['get_company']) && $_GET['get_company'] == 1) {

    $searched_types = [];

    foreach ($allData as $key => $data) {
        if (stripos($data['company'], $_GET['term']) !== false) {
            $searched_types[] = array('id' => $key, 'text' => $data['company'], 'name' => '(' . $data['first_name'] . ' ' . $data['last_name'] . ')', 'address' => $data['address']);
        }
    }

    $ret['results'] = $searched_types;
    echo json_encode($ret);
    exit;
}

if (isset($_GET['get_first_name']) && $_GET['get_first_name'] == 1) {

    $searched_types = [];

    foreach ($allData as $key => $data) {
        if (stripos($data['first_name'], $_GET['term']) !== false) {
            $searched_types[] = array('id' => $key, 'text' => $data['first_name'], 'company' => $data['company'], 'name' => $data['last_name'], 'address' => $data['address']);
        }
    }

    $ret['results'] = $searched_types;
    echo json_encode($ret);
    exit;
}

if (isset($_GET['get_last_name']) && $_GET['get_last_name'] == 1) {

    $searched_types = [];

    foreach ($allData as $key => $data) {
        if (stripos($data['last_name'], $_GET['term']) !== false) {
            $searched_types[] = array('id' => $key, 'text' => $data['last_name'], 'company' => $data['company'], 'name' => $data['first_name'], 'address' => $data['address']);
        }
    }

    $ret['results'] = $searched_types;
    echo json_encode($ret);
    exit;
}