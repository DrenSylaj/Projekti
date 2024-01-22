<?php
$con = mysqli_connect("localhost", "root", "", "projektiKCT");

if(!$con){
    die("Lidhja deshtoi: ".mysqli_connect_error());
}
?>