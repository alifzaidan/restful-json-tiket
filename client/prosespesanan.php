<?php
include "Client.php";

if ($_POST['aksi'] == 'tambah') {
    $data = array(
        "id_pesanan" => $_POST['id_pesanan'],
        "id_pengguna" => $_POST['id_pengguna'],
        "id_event" => $_POST['id_event'],
        "id_tiket1" => isset($_POST['id_tiket1']) ? $_POST['id_tiket1'] : 0,
        "jumlah_tiket1" => isset($_POST['jumlah_tiket1']) ? $_POST['jumlah_tiket1'] : 0,
        "id_tiket2" => isset($_POST['id_tiket2']) ? $_POST['id_tiket2'] : 0,
        "jumlah_tiket2" => isset($_POST['jumlah_tiket2']) ? $_POST['jumlah_tiket2'] : 0,
        "id_tiket3" => isset($_POST['id_tiket3']) ? $_POST['id_tiket3'] : 0,
        "jumlah_tiket3" => isset($_POST['jumlah_tiket3']) ? $_POST['jumlah_tiket3'] : 0,
        "id_tiket4" => isset($_POST['id_tiket4']) ? $_POST['id_tiket4'] : 0,
        "jumlah_tiket4" => isset($_POST['jumlah_tiket4']) ? $_POST['jumlah_tiket4'] : 0,
        "total_harga" => $_POST['total_harga'],
        "tgl_pemesanan" => date("Y-m-d"),
        "aksi" => $_POST['aksi']
    );
    $abc->tambah_pesanan($data);
    header('location: index.php');
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
        "aksi" => $_POST['aksi']
    );
    $abc->ubah_pesanan($data);
    header('location: admin/pesanan.php');
} else if ($_GET['aksi'] == 'hapus') {
    $data = array(
        "id_pesanan" => $_GET['id_pesanan'],
        "aksi" => $_GET['aksi']
    );
    $abc->hapus_pesanan($data);
    header('location: admin/pesanan.php');
}

unset($abc, $data);
