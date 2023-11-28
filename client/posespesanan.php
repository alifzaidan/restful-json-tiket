<?php
include "Client.php";

if ($_POST['aksi'] == 'tambah') {
    $data = array(
        "id_pesanan" => $_POST['id_pesanan'],
        "id_pengguna" => $_POST['id_pengguna'],
        "id_event" => $_POST['id_event'],
        "id_tiket1" => $_POST['id_tiket1'],
        "jumlah_tiket1" => $_POST['jumlah_tiket1'],
        "id_tiket1" => $_POST['id_tiket1'],
        "jumlah_tiket2" => $_POST['jumlah_tiket2'],
        "id_tiket2" => $_POST['id_tiket2'],
        "jumlah_tiket3" => $_POST['jumlah_tiket3'],
        "id_tiket3" => $_POST['id_tiket3'],
        "jumlah_tiket4" => $_POST['jumlah_tiket4'],
        "id_tiket4" => $_POST['id_tiket4'],
        "jumlah_tiket1" => $_POST['jumlah_tiket1'],
        "total_harga" => $_POST['total_harga'],
        "tgl_pemesanan" => $_POST['tgl_pemesanan'],

    );
    $abc->tambah_pesanan($data);
    header('location:index.php?page=daftar-data');
} else if ($_POST['aksi'] == 'ubah') {
    $data = array(
        "id_pesanan" => $_POST['id_pesanan'],
        "id_pengguna" => $_POST['id_pengguna'],
        "id_event" => $_POST['id_event'],
        "id_tiket1" => $_POST['id_tiket1'],
        "jumlah_tiket1" => $_POST['jumlah_tiket1'],
        "id_tiket2" => $_POST['id_tiket2'],
        "jumlah_tiket2" => $_POST['jumlah_tiket2'],
        "id_tiket3" => $_POST['id_tiket3'],
        "jumlah_tiket3" => $_POST['jumlah_tiket3'],
        "id_tiket4" => $_POST['id_tiket4'],
        "jumlah_tiket4" => $_POST['jumlah_tiket4'],
        "total_harga" => $_POST['total_harga'],
        "tgl_pemesanan" => $_POST['tgl_pemesanan'],

    );
    $abc->ubah_pesanan($data);
    header('location: index.php?page=daftar-data');
} else if ($_GET['aksi'] == 'hapus') {
    $data = array(
        "id_pesanan" => $_GET['id_pesanan'],
        "aksi" => $_GET['aksi']
    );
    $abc->hapus_pesanan($data);
    header('location: index.php?page=daftar-data');
}

unset($abc, $data);
