<?php
include "Client.php";

if ($_POST['aksi'] == 'tambah') {
    $data = array(
        "id_event" => $_POST['id_event'],
        "nama_event" => $_POST['nama_event'],
        "harga_awal" => $_POST['harga_awal'],
        "tanggal" => $_POST['tanggal'],
        "jam" => $_POST['jam'],
        "venue" => $_POST['venue'],
        "deskripsi" => $_POST['deskripsi'],
        "aksi" => $_POST['aksi']
    );
    $abc->tambah_event($data);
    header('location: admin/event.php');
} else if ($_POST['aksi'] == 'ubah') {
    $data = array(
        "id_event" => $_POST['id_event'],
        "nama_event" => $_POST['nama_event'],
        "harga_awal" => $_POST['harga_awal'],
        "tanggal" => $_POST['tanggal'],
        "jam" => $_POST['jam'],
        "venue" => $_POST['venue'],
        "deskripsi" => $_POST['deskripsi'],
        "aksi" => $_POST['aksi']
    );
    $abc->ubah_event($data);
    header('location: admin/event.php');
} else if ($_GET['aksi'] == 'hapus') {
    $data = array(
        "id_event" => $_GET['id_event'],
        "aksi" => $_GET['aksi']
    );
    $abc->hapus_event($data);
    header('location: admin/event.php');
}

unset($abc, $data);
