<?php
error_reporting(1);

class Client
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
        unset($url);
    }

    public function filter($data)
    {
        $data = preg_replace('/[^a-zA-Z0-9]/', '', $data);
        return $data;
        unset($data);
    }

    // ==================================== TAMPIL SEMUA DATA ====================================

    public function tampil_semua_event()
    {
        $client = curl_init($this->url . "serverevent.php");
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;

        unset($data, $client, $response);
    }

    public function tampil_semua_tiket()
    {
        $client = curl_init($this->url . "servertiket.php");
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;

        unset($data, $client, $response);
    }

    public function tampil_semua_pengguna()
    {
        $client = curl_init($this->url . "serverpengguna.php");
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;

        unset($data, $client, $response);
    }

    public function tampil_semua_pesanan()
    {
        $client = curl_init($this->url . "serverpesanan.php");
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;

        unset($data, $client, $response);
    }

    // ===================================== TAMPIL DATA =========================================

    public function tampil_event($id_event)
    {
        $id_event = $this->filter($id_event);
        $client = curl_init($this->url . "serverevent.php?aksi=tampil&id_event=" . $id_event);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;

        unset($id_event, $client, $response, $data);
    }

    public function tampil_tiket($id_tiket)
    {
        $id_tiket = $this->filter($id_tiket);
        $client = curl_init($this->url . "servertiket.php?aksi=tampil&id_tiket=" . $id_tiket);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;

        unset($id_tiket, $client, $response, $data);
    }

    public function tampil_pengguna($id_pengguna)
    {
        $id_pengguna = $this->filter($id_pengguna);
        $client = curl_init($this->url . "serverpengguna.php?aksi=tampil&id_pengguna=" . $id_pengguna);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;

        unset($id_pengguna, $client, $response, $data);
    }

    public function tampil_pengguna_byuser($username)
    {
        $username = $this->filter($username);
        $client = curl_init($this->url . "serverpengguna.php?aksi=tampil&username=" . $username);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;

        unset($username, $client, $response, $data);
    }

    public function tampil_pesanan($id_pesanan)
    {
        $id_pesanan = $this->filter($id_pesanan);
        $client = curl_init($this->url . "serverpesanan.php?aksi=tampil&id_pesanan=" . $id_pesanan);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;

        unset($id_pesanan, $client, $response, $data);
    }

    // ===================================== TAMBAH DATA =========================================

    public function tambah_event($data)
    {
        $data = '{ 
            "id_event" : "' . $data['id_event'] . '", 
            "nama_event" : "' . $data['nama_event'] . '", 
            "harga_awal" : "' . $data['harga_awal'] . '", 
            "tanggal" : "' . $data['tanggal'] . '", 
            "jam" : "' . $data['jam'] . '", 
            "venue" : "' . $data['venue'] . '", 
            "deskripsi" : "' . $data['deskripsi'] . '", 
            "aksi": "' . $data['aksi'] . '"
        }';

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . "serverevent.php");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
    }

    public function tambah_tiket($data)
    {
        $data = '{ 
            "id_tiket" : "' . $data['id_tiket'] . '", 
            "id_event" : "' . $data['id_event'] . '", 
            "kategori" : "' . $data['kategori'] . '", 
            "harga" : "' . $data['harga'] . '", 
            "jumlah" : "' . $data['jumlah'] . '",
            "aksi": "' . $data['aksi'] . '"
        }';

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . "servertiket.php");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
    }

    public function tambah_pengguna($data)
    {
        $data = '{ 
            "id_pengguna" : "' . $data['id_pengguna'] . '", 
            "nama" : "' . $data['nama'] . '", 
            "username" : "' . $data['username'] . '", 
            "email" : "' . $data['email'] . '", 
            "no_telp" : "' . $data['no_telp'] . '", 
            "password" : "' . $data['password'] . '",
            "aksi": "' . $data['aksi'] . '"
        }';

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . "serverpengguna.php");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
    }

    public function tambah_pesanan($data)
    {
        $data = '{ 
            "id_pesanan" : "' . $data['id_pesanan'] . '", 
            "id_pengguna" : "' . $data['id_pengguna'] . '", 
            "id_event" : "' . $data['id_event'] . '", 
            "id_tiket1" : "' . $data['id_tiket1'] . '", 
            "jumlah_tiket1" : "' . $data['jumlah_tiket1'] . '", 
            "id_tiket2" : "' . $data['id_tiket2'] . '", 
            "jumlah_tiket2" : "' . $data['jumlah_tiket2'] . '", 
            "id_tiket3" : "' . $data['id_tiket3'] . '", 
            "jumlah_tiket3" : "' . $data['jumlah_tiket3'] . '", 
            "id_tiket4" : "' . $data['id_tiket4'] . '", 
            "jumlah_tiket4" : "' . $data['jumlah_tiket4'] . '", 
            "total_harga" : "' . $data['total_harga'] . '", 
            "tgl_pemesanan" : "' . $data['tgl_pemesanan'] . '", 
            "aksi": "' . $data['aksi'] . '"
        }';

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . "serverpesanan.php");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
    }

    // ===================================== UBAH DATA =========================================

    public function ubah_event($data)
    {
        $data = '{ 
            "id_event" : "' . $data['id_event'] . '", 
            "nama_event" : "' . $data['nama_event'] . '", 
            "harga_awal" : "' . $data['harga_awal'] . '", 
            "tanggal" : "' . $data['tanggal'] . '", 
            "jam" : "' . $data['jam'] . '", 
            "venue" : "' . $data['venue'] . '", 
            "deskripsi" : "' . $data['deskripsi'] . '", 
            "aksi": "' . $data['aksi'] . '"
        }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . "serverevent.php");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
        // You can unset variables here or later as needed.
    }

    public function ubah_tiket($data)
    {
        $data = '{ 
            "id_pengguna" : "' . $data['id_pengguna'] . '", 
            "nama" : "' . $data['nama'] . '", 
            "username" : "' . $data['username'] . '", 
            "email" : "' . $data['email'] . '", 
            "no_telp" : "' . $data['no_telp'] . '", 
            "password" : "' . $data['password'] . '",
            "aksi": "' . $data['aksi'] . '"
        }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . "servertiket.php");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
        // You can unset variables here or later as needed.
    }

    public function ubah_pengguna($data)
    {
        $data = '{ 
            "id_event" : "' . $data['id_event'] . '", 
            "nama_event" : "' . $data['nama_event'] . '", 
            "harga_awal" : "' . $data['harga_awal'] . '", 
            "tanggal" : "' . $data['tanggal'] . '", 
            "jam" : "' . $data['jam'] . '", 
            "venue" : "' . $data['venue'] . '", 
            "deskripsi" : "' . $data['deskripsi'] . '", 
            "aksi": "' . $data['aksi'] . '"
        }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . "serverpengguna.php");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
        // You can unset variables here or later as needed.
    }

    public function ubah_pesanan($data)
    {
        $data = '{ 
            "id_pesanan" : "' . $data['id_pesanan'] . '", 
            "id_pengguna" : "' . $data['id_pengguna'] . '", 
            "id_event" : "' . $data['id_event'] . '", 
            "id_tiket1" : "' . $data['id_tiket1'] . '", 
            "jumlah_tiket1" : "' . $data['jumlah_tiket1'] . '", 
            "id_tiket2" : "' . $data['id_tiket2'] . '", 
            "jumlah_tiket2" : "' . $data['jumlah_tiket2'] . '", 
            "id_tiket3" : "' . $data['id_tiket3'] . '", 
            "jumlah_tiket3" : "' . $data['jumlah_tiket3'] . '", 
            "id_tiket4" : "' . $data['id_tiket4'] . '", 
            "jumlah_tiket4" : "' . $data['jumlah_tiket4'] . '", 
            "total_harga" : "' . $data['total_harga'] . '", 
            "tgl_pemesanan" : "' . $data['tgl_pemesanan'] . '", 
            "aksi": "' . $data['aksi'] . '"
        }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . "serverpesanan.php");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
        // You can unset variables here or later as needed.
    }

    // ===================================== HAPUS DATA =========================================

    public function hapus_event($data)
    {
        $id_event = $this->filter($data['id_event']);
        $data = '{ 
            "id_event" : "' . $id_event . '",
            "aksi": "' . $data['aksi'] . '"
        }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . "serverevent.php");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($id_event, $data, $c, $response);
        // You can unset variables here or later as needed.
    }

    public function hapus_tiket($data)
    {
        $id_tiket = $this->filter($data['id_tiket']);
        $data = '{ 
            "id_tiket" : "' . $id_tiket . '",
            "aksi": "' . $data['aksi'] . '"
        }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . "servertiket.php");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($id_tiket, $data, $c, $response);
        // You can unset variables here or later as needed.
    }

    public function hapus_pengguna($data)
    {
        $id_pengguna = $this->filter($data['id_pengguna']);
        $data = '{ 
            "id_pengguna" : "' . $id_pengguna . '",
            "aksi": "' . $data['aksi'] . '"
        }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . "serverpengguna.php");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($id_pengguna, $data, $c, $response);
        // You can unset variables here or later as needed.
    }

    public function hapus_pesanan($data)
    {
        $id_pesanan = $this->filter($data['id_pesanan']);
        $data = '{ 
            "id_pesanan" : "' . $id_pesanan . '",
            "aksi": "' . $data['aksi'] . '"
        }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . "serverpesanan.php");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($id_pesanan, $data, $c, $response);
        // You can unset variables here or later as needed.
    }

    public function __destruct()
    {
        unset($this->url);
    }
}

$url = 'http://192.168.137.1/restful-json-tiket/server/';
$abc = new Client($url);
