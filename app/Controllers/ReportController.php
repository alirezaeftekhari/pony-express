<?php

namespace App\Controllers;

use PonyExpress\Utilities\Mysql\Mysql;
use PonyExpress\Helpers\JSON;
use Core\View;

class ReportController
{
    public function index()
    {
        $number = filter_input(INPUT_POST, 'number');
        $text = filter_input(INPUT_POST, 'text');
        $provider = filter_input(INPUT_POST, 'provider');
        $status = filter_input(INPUT_POST, 'status');

        $sql = "select * from Messages where 1 ";

        (isset($number) and $number     !== 'undefined' and !empty($number))    ? $sql .= " and number = :number" : $sql .= '';
        (isset($text) and $text         !== 'undefined' and !empty($text))      ? $sql .= " and text like :text" : $sql .= '';
        (isset($provider) and $provider !== 'undefined' and !empty($provider))  ? $sql .= " and provider = :provider" : $sql .= '';
        (isset($status) and $status     !== 'undefined' and !empty($status))    ? $sql .= " and status = :status" : $sql .= '';

        $mysql = new Mysql();

        $data = $mysql->read($sql, $number, $text, $provider, $status);

        echo JSON::encoder($data);
    }

//    public function view()
//    {
//        echo View::render('report', ['name' => 'pure']);
//    }

}