<?php
error_reporting(1); // error ditampilkan 

include "Database.php";
// buat objek baru dari class Database
$abc = new Database();

// function untuk menghapus selain huruf dan angka 
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin:{$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials:true');
    header('Access-Control-Max-Age:86400');
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header('Access-Control-Allow-Method:OPTIONS GET, POST, OPTIONS');
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS)']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}

$postdata = file_get_contents("php://input");

function filter($data)
{
    $data = preg_replace('/[^a-zA-Z0-9]/', ' ', $data);
    return $data;
    unset($data);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_tiket = $data->id_tiket;
    $id_event = $data->id_event;
    $kategori = $data->kategori;
    $harga = $data->harga;
    $jumlah = $data->jumlah;
    $aksi = $data->aksi;

    if ($aksi == 'tambah') {
        $data2 = array(
            'id_tiket' => $id_tiket,
            'id_event' => $id_event,
            'kategori' => $kategori,
            'harga' => $harga,
            'jumlah' => $jumlah,
        );

        $abc->tambah_tiket($data2);
    } elseif ($aksi == 'ubah') {
        $data2 = array(
            'id_tiket' => $id_tiket,
            'id_event' => $id_event,
            'kategori' => $kategori,
            'harga' => $harga,
            'jumlah' => $jumlah,
        );
        $abc->ubah_tiket($data2);
    } elseif ($aksi == 'hapus') { // Ubah '=' menjadi '==' untuk memeriksa kesamaan
        $abc->hapus_tiket($id_tiket);
    }

    // hapus variabel dari memori
    unset($input, $data, $data2, $id_tiket, $id_event, $kategori, $harga, $jumlah, $aksi, $abc);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (($_GET['aksi'] == 'tampil') and (isset($_GET['id_tiket']))) {
        $id_tiket = filter($_GET['id_tiket']); // Ubah 'id tiket' menjadi 'id_tiket'
        $data = $abc->tampil_tiket($id_tiket); // Ubah 'tampil data' menjadi 'tampil_data'
        echo json_encode($data);
    } else {
        $tiket = $abc->tampil_semua_tiket();
        echo json_encode($tiket);
    }
    unset($postdata, $tiket, $data, $id_tiket, $abc);
}
