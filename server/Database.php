<?php
error_reporting(1); // error ditampilkan
class Database
{
    private $host = "localhost";
    private $dbname = "tiket";
    private $user = "root";
    private $password = "";
    private $port = "3307";
    private $conn;

    // function yang pertama kali di-load saat class dipanggil
    public function __construct()
    {
        // koneksi database 
        try {
            $this->conn = new PDO("mysql:host=$this->host;port=$this->port; dbname=$this->dbname; charset=utf8", $this->user, $this->password);
        } catch (PDOException $e) {
            echo "Koneksi gagal";
        }
    }

    // ==================================== TAMPIL DATA ====================================

    public function tampil_event($id_event)
    {
        $query = $this->conn->prepare("select id_event, nama_event, harga_awal, tanggal, jam, venue, deskripsi from event where id_event=?");
        $query->execute(array($id_event));
        // mengambil satu data dengan fetch
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data;
        // hapus variable dari memory
        $query->closeCursor();
        unset($id_event, $data);
    }

    public function tampil_tiket($id_tiket)
    {
        $query = $this->conn->prepare("select id_tiket, id_event, kategori, harga, jumlah from tiket where id_tiket=?");
        $query->execute(array($id_tiket));
        // mengambil satu data dengan fetch
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data;
        // hapus variable dari memory
        $query->closeCursor();
        unset($id_tiket, $data);
    }

    public function tampil_tiket_byevent($id_event)
    {
        $query = $this->conn->prepare("select id_tiket, id_event, kategori, harga, jumlah from tiket where id_event=?");
        $query->execute(array($id_event));
        // mengambil satu data dengan fetch
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data;
        // hapus variable dari memory
        $query->closeCursor();
        unset($id_event, $data);
    }

    public function tampil_pengguna($id_pengguna)
    {
        $query = $this->conn->prepare("select id_pengguna, nama, username, email, no_telp, password from pengguna where id_pengguna=?");
        $query->execute(array($id_pengguna));
        // mengambil satu data dengan fetch
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data;
        // hapus variable dari memory
        $query->closeCursor();
        unset($id_pengguna, $data);
    }

    public function tampil_pengguna_byuser($username)
    {
        $query = $this->conn->prepare("select id_pengguna, nama, username, email, no_telp, password from pengguna where username=?");
        $query->execute(array($username));
        // mengambil satu data dengan fetch
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data;
        // hapus variable dari memory
        $query->closeCursor();
        unset($username, $data);
    }

    public function tampil_pesanan($id_event)
    {
        $query = $this->conn->prepare("select id_pesanan, id_pengguna, id_event, id_tiket1, jumlah_tiket1, id_tiket2, jumlah_tiket2, id_tiket3, jumlah_tiket3, id_tiket4, jumlah_tiket4, total_harga, tgl_pemesanan from pesanan where id_pesanan=?");
        $query->execute(array($id_event));
        // mengambil satu data dengan fetch
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data;
        // hapus variable dari memory
        $query->closeCursor();
        unset($id_event, $data);
    }

    // ==================================== TAMPIL SEMUA DATA ====================================

    public function tampil_semua_event()
    {
        $query = $this->conn->prepare("select id_event, nama_event, harga_awal, tanggal, jam, venue, deskripsi from event order by id_event");
        $query->execute();
        // mengambil banyak data dengan fetchAll
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $query->closeCursor();
        unset($data);
    }

    public function tampil_semua_tiket()
    {
        $query = $this->conn->prepare("select id_tiket, id_event, kategori, harga, jumlah from tiket order by id_tiket");
        $query->execute();
        // mengambil banyak data dengan fetchAll
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $query->closeCursor();
        unset($data);
    }

    public function tampil_semua_pengguna()
    {
        $query = $this->conn->prepare("select id_pengguna, nama, username, email, no_telp, password from pengguna order by id_pengguna");
        $query->execute();
        // mengambil banyak data dengan fetchAll
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $query->closeCursor();
        unset($data);
    }

    public function tampil_semua_pesanan()
    {
        $query = $this->conn->prepare("select id_pesanan, id_pengguna, id_event, id_tiket1, jumlah_tiket1, id_tiket2, jumlah_tiket2, id_tiket3, jumlah_tiket3, id_tiket4, jumlah_tiket4, total_harga, tgl_pemesanan from pesanan order by id_pesanan");
        $query->execute();
        // mengambil banyak data dengan fetchAll
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $query->closeCursor();
        unset($data);
    }

    // ==================================== TAMBAH DATA ====================================

    public function tambah_event($data)
    {
        $query = $this->conn->prepare("insert ignore into event (id_event, nama_event, harga_awal, tanggal, jam, venue, deskripsi) values (?,?,?,?,?,?,?)");
        $query->execute(array($data['id_event'], $data['nama_event'], $data['harga_awal'], $data['tanggal'], $data['jam'], $data['venue'], $data['deskripsi']));
        $query->closeCursor();
        unset($data);
    }

    public function tambah_tiket($data)
    {
        $query = $this->conn->prepare("insert ignore into event (id_tiket, id_event, kategori, harga, jumlah) values (?,?,?,?,?)");
        $query->execute(array($data['id_tiket'], $data['id_event'], $data['kategori'], $data['harga'], $data['jumlah']));
        $query->closeCursor();
        unset($data);
    }

    public function tambah_pengguna($data)
    {
        $query = $this->conn->prepare("insert ignore into event (id_pengguna, nama, username, email, no_telp, password) values (?,?,?,?,?,?)");
        $query->execute(array($data['id_pengguna'], $data['nama'], $data['username'], $data['email'], $data['no_telp'], $data['password']));
        $query->closeCursor();
        unset($data);
    }

    public function tambah_pesanan($data)
    {
        $query = $this->conn->prepare("insert ignore into event (id_pesanan, id_pengguna, id_event, id_tiket1, jumlah_tiket1, id_tiket2, jumlah_tiket2, id_tiket3, jumlah_tiket3, id_tiket4, jumlah_tiket4, total_harga, tgl_pemesanan) values (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $query->execute(array($data['id_pesanan'], $data['id_pengguna'], $data['id_event'], $data['id_tiket1'], $data['jumlah_tiket1'], $data['id_tiket2'], $data['jumlah_tiket2'], $data['id_tiket3'], $data['jumlah_tiket3'], $data['id_tiket4'], $data['jumlah_tiket4'], $data['total_harga'], $data['tgl_pemesanan']));
        $query->closeCursor();
        unset($data);
    }

    // ==================================== UBAH DATA ====================================

    public function ubah_event($data)
    {
        try {
            $query = $this->conn->prepare("UPDATE event SET nama_event=?, harga_awal=?, tanggal=?, jam=?, venue=?, deskripsi=? WHERE id_event=?");
            $query->execute(array($data['nama_event'], $data['harga_awal'], $data['tanggal'], $data['jam'], $data['venue'], $data['deskripsi'], $data['id_event']));
            $query->closeCursor();
            unset($data);
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            // Handle any database-related errors here.
            // You can log the error, display a user-friendly message, or take appropriate action.
        }
    }

    public function ubah_tiket($data)
    {
        try {
            $query = $this->conn->prepare("UPDATE tiket SET id_event=?, kategori=?, harga=?, jumlah=?  WHERE id_tiket=?");
            $query->execute(array($data['id_event'], $data['kategori'], $data['harga'], $data['jumlah'], $data['id_tiket']));
            $query->closeCursor();
            unset($data);
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            // Handle any database-related errors here.
            // You can log the error, display a user-friendly message, or take appropriate action.
        }
    }

    public function ubah_pengguna($data)
    {
        try {
            $query = $this->conn->prepare("UPDATE event SET nama=?, username=?, email=?, no_telp=?, password=? WHERE id_pengguna=?");
            $query->execute(array($data['nama'], $data['username'], $data['email'], $data['no_telp'], $data['password'], $data['id_pengguna']));
            $query->closeCursor();
            unset($data);
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            // Handle any database-related errors here.
            // You can log the error, display a user-friendly message, or take appropriate action.
        }
    }

    public function ubah_pesanan($data)
    {
        try {
            $query = $this->conn->prepare("UPDATE event SET id_pengguna=?, id_event=?, id_tiket1=?, jumlah_tiket1=?, id_tiket2=?, jumlah_tiket2=?, id_tiket3=?, jumlah_tiket3=?, id_tiket4=?, jumlah_tiket4=?, total_harga=?, tgl_pemesanan=? WHERE id_pesanan=?");
            $query->execute(array($data['id_pengguna'], $data['id_event'], $data['id_tiket1'], $data['jumlah_tiket1'], $data['id_tiket2'], $data['jumlah_tiket2'], $data['id_tiket3'], $data['jumlah_tiket3'], $data['id_tiket4'], $data['jumlah_tiket4'], $data['total_harga'], $data['tgl_pemesanan'], $data['id_pesanan']));
            $query->closeCursor();
            unset($data);
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            // Handle any database-related errors here.
            // You can log the error, display a user-friendly message, or take appropriate action.
        }
    }

    // ==================================== HAPUS DATA ====================================

    public function hapus_event($id_event)
    {
        $query = $this->conn->prepare("delete from event where id_event=?");
        $query->execute(array($id_event));
        $query->closeCursor();
        unset($id_event);
    }

    public function hapus_tiket($id_tiket)
    {
        $query = $this->conn->prepare("delete from tiket where id_tiket=?");
        $query->execute(array($id_tiket));
        $query->closeCursor();
        unset($id_tiket);
    }

    public function hapus_pengguna($id_pengguna)
    {
        $query = $this->conn->prepare("delete from pengguna where id_pengguna=?");
        $query->execute(array($id_pengguna));
        $query->closeCursor();
        unset($id_pengguna);
    }

    public function hapus_pesanan($id_pesanan)
    {
        $query = $this->conn->prepare("delete from pesanan where id_pesanan=?");
        $query->execute(array($id_pesanan));
        $query->closeCursor();
        unset($id_pesanan);
    }
}
