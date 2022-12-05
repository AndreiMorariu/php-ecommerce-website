<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'proiect';

$con = mysqli_connect(
    $DATABASE_HOST,
    $DATABASE_USER,
    $DATABASE_PASS,
    $DATABASE_NAME
);

if (mysqli_connect_errno()) {
    exit('Error connecting to database' . mysqli_connect_error());
}