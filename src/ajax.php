<?php
require_once "../conexion.php";
session_start();

if (isset($_POST['cambio'])) {
    if (empty($_POST['actual']) || empty($_POST['nueva'])) {
        $msg = 'Los campos estan vacios';
    } else {
        $id = $_SESSION['idUser'];
        $actual = md5($_POST['actual']);
        $nueva = md5($_POST['nueva']);
        $consulta = mysqli_query($conexion, "SELECT * FROM users WHERE password = '$actual' AND id = $id");
        $result = mysqli_num_rows($consulta);
        if ($result == 1) {
            $query = mysqli_query($conexion, "UPDATE users SET password = '$nueva' WHERE id = $id");
            if ($query) {
                $msg = 'ok';
            } else {
                $msg = 'error';
            }
        } else {
            $msg = 'dif';
        }
    }
    echo $msg;
    die();
}
