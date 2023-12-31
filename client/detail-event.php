<?php
error_reporting(1);
include "Client.php";

$id_event = $_GET['id'];
$event = $abc->tampil_event($id_event);

$nama_event = $event->nama_event;
$tanggal = date('d F Y', strtotime($event->tanggal));
$jam = date('H:i', strtotime($event->jam));
$venue = $event->venue;
$teks = $event->deskripsi;
$deskripsi = explode("\n", $teks);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $nama_event ?></title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/bootstrap-icons/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="style/style.css" />
</head>

<body style="background-color: #EFFEFF;">
    <nav class="navbar navbar-expand-lg border-bottom sticky-top text-white" style="background-color: #304F6D;">
        <div class="container py-1">

            <button class="btn me-4" style="background-color: #EFFEFF;" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                <i class="bi bi-list"></i>
            </button>

            <a class="navbar-brand text-white" href="index.php">TicketEase</a>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

            </div>
        </div>
    </nav>

    <aside class="offcanvas offcanvas-start border-top" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel" style="margin-top: 64px; width: 250px;">
        <div class="offcanvas-body">
            <a href="index.php" class="btn w-100 mb-2 text-white" style="background-color: #304F6D;">Dashboard</a>
            <a href="admin/event.php" class="btn btn-outline-secondary w-100 mb-2">Daftar Event</a>
            <a href="admin/tiket.php" class="btn btn-outline-secondary w-100 mb-2">Daftar Tiket</a>
            <a href="admin/pengguna.php" class="btn btn-outline-secondary w-100 mb-2">Daftar Pengguna</a>
            <a href="admin/pesanan.php" class="btn btn-outline-secondary w-100 mb-2">Daftar Pesanan</a>
        </div>
    </aside>

    <main class="container col-md-5 col-12" style="min-height: 60vh;">
        <h1 class="fw-bold pt-5 pb-3"><?= $nama_event ?></h1>
        <p class="m-0 py-1"><i class="bi bi-geo-alt-fill me-2"></i><?= $venue ?></p>
        <p class="m-0 py-1"><i class="bi bi-calendar-event-fill me-2"></i><?= $tanggal ?></p>
        <p class="mb-3 py-1"><i class="bi bi-clock-fill me-2"></i><?= $jam ?></p>
        <div class="card mb-3">
            <div class="card-body">
                <p class="card-text">
                    <?php
                    foreach ($deskripsi as $d) {
                        echo "<p>" . $d . "</p>";
                    }
                    ?>
                </p>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">How to get there</h5>
                <p class="card-text"><i class="bi bi-geo-alt me-2"></i><?= $venue ?></p>
            </div>
        </div>

        <a href="check-availability.php?id=<?= $id_event ?>" class="btn d-flex w-100 p-3 justify-content-between align-items-center fw-semibold text-white" style="background-color: #E07D54;" type="button">
            Check Availability
            <i class="bi bi-arrow-right me-2 fs-5"></i>
        </a>

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
                    <a class="btn btn-dark" href="logout.php">Logout</a>
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
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>