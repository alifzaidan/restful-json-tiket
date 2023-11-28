<?php
error_reporting(1);
include "Client.php";
?>

<!doctype html>
<html>

<head>
    <title>Web Service Client</title>
</head>

<body>
    <a href="?page=home">Home</a> | <a href="?page=tambah">Tambah Data</a> | <a href="?page=daftar-data">Data Server</a>
    <br /><br />

    <fieldset>
        <?php
        if ($_GET['page'] == 'tambah') {
        ?>
            <legend>Tambah Data</legend>
            <form name="form" method="POST" action="proses.php">
                <input type="hidden" name="aksi" value="tambah" />
                <label>ID Barang</label>
                <input type="text" name="id_barang" />
                <br />
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" />
                <br />
                <label>Stok Barang</label>
                <input type="text" name="stok_barang" />
                <br />
                <label>Harga Satuan</label>
                <input type="text" name="harga_satuan" />
                <br />
                <button type="submit" name="simpan">Simpan</button>
            </form>
        <?php
        } elseif ($_GET['page'] == 'ubah') {
            $id_barang = $_GET['id_barang'];
            $r = $abc->tampil_event($id_barang);
        ?>
            <legend>Ubah Data</legend>
            <form name="form" method="post" action="proses.php">
                <input type="hidden" name="aksi" value="ubah" />
                <input type="hidden" name="id_barang" value="<?= $r->id_barang ?>" />
                <label>ID Barang</label>
                <input type="text" name="id_barang" value="<?= $r->id_barang ?>" disabled>
                <br />
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" value="<?= $r->nama_barang ?>" />
                <br />
                <label>Stok Barang</label>
                <input type="text" name="stok_barang" value="<?= $r->stok_barang ?>" />
                <br />
                <label>Harga Satuan</label>
                <input type="text" name="harga_satuan" value="<?= $r->harga_satuan ?>" />
                <br />
                <button type="submit" name="ubah">Ubah</button>
            </form>
        <?php
            unset($r);
        } elseif ($_GET['page'] == 'daftar-data') {
        ?>
            <legend>Daftar Data Server</legend>
            <table border="1">
                <tr>
                    <th width="5%">No</th>
                    <th width="10%">ID Barang</th>
                    <th width="20%">Nama Barang</th>
                    <th width="10%">Harga Awal</th>
                    <th width="15%">Tanggal</th>
                    <th width="15%">Jam</th>
                    <th width="15%">Venue</th>
                    <th width="15%">Deskripsi</th>
                    <th width="8%">Aksi</th>
                </tr>
                <?php
                $no = 1;
                $data_array = $abc->tampil_semua_event();
                foreach ($data_array as $r) {
                ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $r->id_event ?></td>
                        <td><?= $r->nama_event ?></td>
                        <td><?= $r->harga_awal ?></td>
                        <td><?= $r->tanggal ?></td>
                        <td><?= $r->jam ?></td>
                        <td><?= $r->venue ?></td>
                        <td><?= $r->deskripsi ?></td>
                        <td>
                            <a href="?page=ubah&id_event=<?= $r->id_event ?>">
                                <button type="button">Ubah</button>
                            </a>
                            <a href="proses.php?aksi=hapus&id_event=<?= $r->id_event ?>" onclick="return confirm('Apakah Anda ingin menghapus data ini?')">
                                <button type="button">Hapus</button>
                            </a>
                        </td>
                    </tr>
                <?php
                    $no++;
                }
                unset($data_array, $r);
                ?>
            </table>
        <?php
        } else {
        ?>
            Aplikasi sederhana ini menggunakan RESTFUL dengan format data JSON (JavaScript Object Notation).
            <legend>Home</legend>
        <?php
        }
        ?>
    </fieldset>
</body>

</html>