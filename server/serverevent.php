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
    $id_event = $data->id_event;
    $nama_event = $data->nama_event;
    $harga_awal = $data->harga_awal;
    $tanggal = $data->tanggal;
    $jam = $data->jam;
    $venue = $data->venue;
    $deskripsi = $data->deskripsi;
    $aksi = $data->aksi;

    if ($aksi == 'tambah') {
        $data2 = array(
            'id_event' => $id_event,
            'nama_event' => $nama_event,
            'harga_awal' => $harga_awal,
            'tanggal' => $tanggal,
            'jam' => $jam,
            'venue' => $venue,
            'deskripsi' => $deskripsi,
        );

        $abc->tambah_event($data2);
    } elseif ($aksi == 'ubah') {
        $data2 = array(
            'id_event' => $id_event,
            'nama_event' => $nama_event,
            'harga_awal' => $harga_awal,
            'tanggal' => $tanggal,
            'jam' => $jam,
            'venue' => $venue,
            'deskripsi' => $deskripsi,
        );
        $abc->ubah_event($data2);
    } elseif ($aksi == 'hapus') { // Ubah '=' menjadi '==' untuk memeriksa kesamaan
        $abc->hapus_event($id_event);
    }

    // hapus variabel dari memori
    unset($input, $data, $data2, $id_event, $nama_event, $harga_awal, $tanggal, $jam, $venue, $deskripsi, $aksi, $abc);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (($_GET['aksi'] == 'tampil') and (isset($_GET['id_event']))) {
        $id_event = filter($_GET['id_event']); // Ubah 'id event' menjadi 'id_event'
        $data = $abc->tampil_event($id_event); // Ubah 'tampil data' menjadi 'tampil_data'
        echo json_encode($data);
    } else {
        $event = $abc->tampil_semua_event();
        echo json_encode($event);
    }
    unset($postdata, $event, $data, $id_event, $abc);
}
