<?php
include "Client.php";

if ($_POST['aksi'] == 'tambah') {
    $data = array(
        "id_tiket" => $_POST['id_tiket'],
        "id_event" => $_POST['id_event'],
        "kategori" => $_POST['kategori'],
        "harga" => $_POST['harga'],
        "jumlah" => $_POST['jumlah']
    );
    $abc->tambah_tiket($data);
    header('location:index.php?page=daftar-data');
} else if ($_POST['aksi'] == 'ubah') {
    $data = array(
        "id_tiket" => $_POST['id_tiket'],
        "id_event" => $_POST['id_event'],
        "kategori" => $_POST['kategori'],
        "harga" => $_POST['harga'],
        "jumlah" => $_POST['jumlah']
    );
    $abc->ubah_tiket($data);
    header('location: index.php?page=daftar-data');
} else if ($_GET['aksi'] == 'hapus') {
    $data = array(
        "id_tiket" => $_GET['id_tiket'],
        "aksi" => $_GET['aksi']
    );
    $abc->hapus_tiket($data);
    header('location: index.php?page=daftar-data');
}

unset($abc, $data);
