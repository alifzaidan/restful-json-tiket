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
    $id_pesanan = $data->id_pesanan;
    $id_pengguna = $data->id_pengguna;
    $id_event = $data->id_event;
    $id_tiket1 = $data->id_tiket1;
    $jumlah_tiket1 = $data->jumlah_tiket1;
    $id_tiket2 = $data->id_tiket2;
    $jumlah_tiket2 = $data->jumlah_tiket2;
    $id_tiket3 = $data->id_tiket3;
    $jumlah_tiket3 = $data->jumlah_tiket3;
    $id_tiket4 = $data->id_tiket4;
    $jumlah_tiket4 = $data->jumlah_tiket4;
    $total_harga = $data->total_harga;
    $tgl_pemesanan = $data->tgl_pemesanan;
    $aksi = $data->aksi;

    if ($aksi == 'tambah') {
        $data2 = array(
            'id_pesanan' => $id_pesanan,
            'id_pengguna' => $id_pengguna,
            'id_event' => $id_event,
            'id_tiket1' => $id_tiket1,
            'jumlah_tiket1' => $jumlah_tiket1,
            'id_tiket2' => $id_tiket2,
            'jumlah_tiket2' => $jumlah_tiket2,
            'id_tiket3' => $id_tiket3,
            'jumlah_tiket3' => $jumlah_tiket3,
            'id_tiket4' => $id_tiket4,
            'jumlah_tiket4' => $jumlah_tiket4,
            'total_harga' => $total_harga,
            'tgl_pemesanan' => $tgl_pemesanan,
        );

        $abc->tambah_pesanan($data2);
    } elseif ($aksi == 'ubah') {
        $data2 = array(
            'id_pesanan' => $id_pesanan,
            'id_pengguna' => $id_pengguna,
            'id_event' => $id_event,
            'id_tiket1' => $id_tiket1,
            'jumlah_tiket1' => $jumlah_tiket1,
            'id_tiket2' => $id_tiket2,
            'jumlah_tiket2' => $jumlah_tiket2,
            'id_tiket3' => $id_tiket3,
            'jumlah_tiket3' => $jumlah_tiket3,
            'id_tiket4' => $id_tiket4,
            'jumlah_tiket4' => $jumlah_tiket4,
            'total_harga' => $total_harga,
            'tgl_pemesanan' => $tgl_pemesanan,
        );
        $abc->ubah_pesanan($data2);
    } elseif ($aksi == 'hapus') { // Ubah '=' menjadi '==' untuk memeriksa kesamaan
        $abc->hapus_pesanan($id_pesanan);
    }

    // hapus variabel dari memori
    unset($input, $data, $data2, $id_pesanan, $id_pengguna, $id_event, $id_tiket1, $jumlah_tiket1, $id_tiket2, $jumlah_tiket2, $id_tiket3, $jumlah_tiket3, $id_tiket4, $jumlah_tiket4, $total_harga, $tgl_pemesanan, $aksi, $abc);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (($_GET['aksi'] == 'tampil') and (isset($_GET['id_pesanan']))) {
        $id_pesanan = filter($_GET['id_pesanan']); // Ubah 'id pesanan' menjadi 'id_pesanan'
        $data = $abc->tampil_pesanan($id_pesanan); // Ubah 'tampil data' menjadi 'tampil_data'
        echo json_encode($data);
    } else {
        $pesanan = $abc->tampil_semua_pesanan();
        echo json_encode($pesanan);
    }
    unset($postdata, $pesanan, $data, $id_pesanan, $abc);
}
