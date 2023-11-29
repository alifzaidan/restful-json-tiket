<?php
include "Client.php";

if ($_POST['aksi'] == 'tambah') {
    $data = array(
        "id_pengguna" => $_POST['id_pengguna'],
        "nama" => $_POST['nama'],
        "username" => $_POST['username'],
        "email" => $_POST['email'],
        "no_telp" => $_POST['no_telp'],
        "password" => $_POST['password'],
        "aksi" => $_POST['aksi']
    );
    $abc->tambah_pengguna($data);
    header('location: admin/pengguna.php');
} else if ($_POST['aksi'] == 'ubah') {
    $data = array(
        "id_pengguna" => $_POST['id_pengguna'],
        "nama" => $_POST['nama'],
        "username" => $_POST['username'],
        "email" => $_POST['email'],
        "no_telp" => $_POST['no_telp'],
        "password" => $_POST['password'],
        "aksi" => $_POST['aksi']
    );
    $abc->ubah_pengguna($data);
    header('location: admin/pengguna.php');
} else if ($_GET['aksi'] == 'hapus') {
    $data = array(
        "id_pengguna" => $_GET['id_pengguna'],
        "aksi" => $_GET['aksi']
    );
    $abc->hapus_pengguna($data);
    header('location: admin/pengguna.php');
}

unset($abc, $data);
