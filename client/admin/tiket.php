<?php
error_reporting(1);
include "../Client.php";

$no = 1;
$data_tiket = $abc->tampil_semua_tiket();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - TicketEase</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../style/style.css" />
</head>

<body style="background-color: #EFFEFF;">
    <nav class="navbar navbar-expand-lg border-bottom sticky-top" style="background-color: #304F6D;">
        <div class="container py-1">
            <button class="btn me-4" style="background-color: #EFFEFF;" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                <i class="bi bi-list"></i>
            </button>

            <a class="navbar-brand text-white" href="../index.php">TicketEase</a>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <form class="" role="search">
                    <input class="form-control me-2" style="width: 500px;" type="search" id="searchInput" placeholder="Cari Event" aria-label="Search" autocomplete="off" />
                </form>
            </div>
        </div>
    </nav>

    <aside class="offcanvas offcanvas-start border-top" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel" style="margin-top: 64px; width: 250px;">
        <div class="offcanvas-body">
            <a href="../index.php" class="btn btn-outline-secondary w-100 mb-2">Dashboard</a>
            <a href="event.php" class="btn btn-outline-secondary w-100 mb-2">Daftar Event</a>
            <a href="tiket.php" class="btn w-100 mb-2 text-white" style="background-color: #304F6D;">Daftar Tiket</a>
            <a href="pengguna.php" class="btn btn-outline-secondary w-100 mb-2">Daftar Pengguna</a>
            <a href="pesanan.php" class="btn btn-outline-secondary w-100 mb-2">Daftar Pesanan</a>
        </div>
    </aside>

    <main class="container" style="min-height: 60vh;">
        <h3 class="pt-5">Daftar Tiket</h3>
        <p class="pb-3">Kelola tiket sesuai dengan event yang ada.</p>
        <button type="button" class="btn mb-3 text-white" style="background-color: #E07D54;" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Tiket</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama Event</th>
                    <th scope="col">Kategori Tiket</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah Tiket</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data_tiket as $tiket) :
                ?>
                    <tr>
                        <td scope="col"><?= $no++ ?></td>
                        <td scope="col"><?= $tiket->nama_event ?></td>
                        <td scope="col"><?= $tiket->kategori ?></td>
                        <td scope="col">Rp<?= number_format($tiket->harga, 0, ',', ',') ?></td>
                        <td scope="col"><?= $tiket->jumlah ?></td>
                        <td scope="col">
                            <div class="d-flex justify-content-around gap-2">
                                <a href="#" class="btn btn-warning btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $tiket->id_tiket ?>">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <div class="modal fade" id="editModal<?= $tiket->id_tiket ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Tiket</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="user d-flex flex-column gap-2" action="../prosestiket.php" method="post">
                                                    <input type="hidden" name="aksi" value="ubah" />
                                                    <input type="hidden" class="form-control" name="id_tiket" value="<?= $tiket->id_tiket ?>">
                                                    <div class="form-group">
                                                        <select class="form-select" aria-label="Nama Event" name="id_event" required>
                                                            <?php
                                                            $data_event = $abc->tampil_semua_event();
                                                            foreach ($data_event as $event) :
                                                            ?>
                                                                <option value="<?= $event->id_event ?>" <?= ($event->id_event == $tiket->id_event) ? 'selected' : ''; ?>><?= $event->nama_event ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Kategori" name="kategori" value="<?= $tiket->kategori ?>" required>
                                                    </div>
                                                    <div class=" form-group">
                                                        <input type="number" class="form-control" placeholder="Harga" name="harga" value="<?= $tiket->harga ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="number" class="form-control" placeholder="Jumlah" name="jumlah" value="<?= $tiket->jumlah ?>" required>
                                                    </div>
                                                    <button type="submit" name="tambah" class="btn p-2 mt-3 fw-semibold text-white" style="background-color: #E07D54;">
                                                        Edit
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-danger btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $tiket->id_tiket ?>">
                                    <i class="bi bi-trash"></i>
                                </a>
                                <div class="modal fade" id="hapusModal<?= $tiket->id_tiket ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Yakin mau dihapus?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">Pilih "Hapus" jika kamu yakin untuk menghapus tiket <?= $tiket->kategori ?> "<?= $tiket->nama_event ?>".</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                <a class="btn btn-dark" href="../prosestiket.php?aksi=hapus&id_tiket=<?= $tiket->id_tiket ?>">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </main>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Beneran mau keluar?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Pilih "Logout" jika kamu ingin mengakhiri sesimu.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                    <a class="btn btn-dark" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Tiket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="user d-flex flex-column gap-2" action="../prosestiket.php" method="post">
                        <input type="hidden" name="aksi" value="tambah" />
                        <div class="form-group">
                            <select class="form-select" aria-label="Nama Event" name="id_event" required>
                                <option>Pilih Event</option>
                                <?php
                                $data_event = $abc->tampil_semua_event();
                                foreach ($data_event as $event) :
                                ?>
                                    <option value="<?= $event->id_event ?>"><?= $event->nama_event ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Kategori" name="kategori" required>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="Harga" name="harga" required>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="Jumlah" name="jumlah" required>
                        </div>
                        <button type="submit" name="tambah" class="btn p-2 mt-3 fw-semibold text-white" style="background-color: #E07D54;">
                            Tambah
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-5 text-light" style="height: 14rem; background-color: #304F6D;">
        <div class="d-flex justify-content-around pt-5">
            <div class="col-md-4 col-5">
                <h1>TicketEase</h1>
                <p>
                    TicketEase is a event discovery with on-demand ticket order services. Now you can buy your tickets easily through TicketEase!
                </p>
            </div>
            <div class="col-md-4 col-5">
                <h3>Discover More!</h3>
            </div>
        </div>
    </footer>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        function cariTiket() {
            var input = document.getElementById("searchInput").value.toLowerCase();
            var rows = document.getElementsByTagName("tr");

            for (var i = 1; i < rows.length; i++) {
                var row = rows[i];
                var namaEvent = row.getElementsByTagName("td")[1].textContent.toLowerCase();

                if (namaEvent.indexOf(input) > -1) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            }
        }

        document.getElementById("searchInput").addEventListener("input", cariTiket);
    </script>
</body>

</html>