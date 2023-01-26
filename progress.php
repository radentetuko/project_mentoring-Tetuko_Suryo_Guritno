<?php
session_start();
include "db.php";
$data = $_SESSION['status_login'];
echo "<script>console.log( '{$data}' )</script>";
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="index.php"</script>';
};
?>


<!DOCTYPE html>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Project Mentoringe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style/Progress.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>

    <main>
        <div class="container">
            <h3 class="my-3 text-center">Project Mentoring</h3>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-info mb-3" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop">Tambah Data<i class="bi bi-plus-circle ms-1"></i></button>


            <!-- Modal Tambah -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <div class="mb-2">
                                    <label for="nama" class="col-form-label">Project Name</label>
                                    <input type="text" class="form-control" name="nama">
                                </div>
                                <div class="mb-2">
                                    <label for="client" class="col-form-label">Client</label>
                                    <input type="text" class="form-control" name="client">
                                </div>
                                <div class="mb-2">
                                    <label for="project" class="col-form-label">Project Leader</label>
                                    <input type="text" class="form-control" name="project">
                                </div>
                                <div class="mb-2">
                                    <label for="mulai" class="col-form-label">Start Date</label>
                                    <input type="date" class="form-control" name="mulai">
                                </div>
                                <div class="mb-2">
                                    <label for="akhir" class="col-form-label">End Date</label>
                                    <input type="date" class="form-control" name="akhir">
                                </div>
                                <div class="mb-2">
                                    <label for="progres" class="col-form-label">Progress</label>
                                    <input type="text" class="form-control" name="progres">
                                </div>
                                <button type="submit" class="btn btn-primary" name="tambah_data"
                                    style="background-color: #B09C66 !important;border-color: #B09C66 !important;">Tambah</button>
                            </form>
                            <?php
                            if (isset($_POST['tambah_data'])) {
                                $nama = ($_POST['nama']);
                                $client = ucwords($_POST['client']);
                                $project = ucwords($_POST['project']);
                                $mulai = ($_POST['mulai']);
                                $akhir = ($_POST['akhir']);
                                $progres = ($_POST['progres']);

                                $insert = mysqli_query($con, "INSERT INTO progress Values ( null, '" . $nama . "', '" . $client . "', '" . $project . "', '" . $mulai . "', '" . $akhir . "', '" . $progres . "')");

                                if ($insert) {
                                    echo '<script>window.location="progress.php"</script>';
                                } else {
                                    echo 'gagal ' . mysqli_error($con);
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>



            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Project Name</th>
                            <th scope="col">Client</th>
                            <th scope="col">Project Leader</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Progress</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $progress = mysqli_query($con, "SELECT * FROM progress ORDER BY id_progress DESC");
                        while ($row = mysqli_fetch_array($progress)) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $no++ ?></th>
                            <td><?php echo $row['nama'] ?> </td>
                            <td><?php echo $row['client'] ?> </td>
                            <td><?php echo $row['project'] ?> </td>
                            <td><?php echo $row['mulai'] ?> </td>
                            <td><?php echo $row['akhir'] ?> </td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        aria-label="Example with label" style='width: <?php echo $row['progres'] ?>%;'
                                        aria-valuenow=" <?php echo $row['progres'] ?>" aria-valuemin="0"
                                        aria-valuemax="100">
                                        <?php echo $row['progres'] ?>%
                                    </div>
                                </div>
                            </td>
                            <td style="width: 160px;"><a role=" button" class="btn btn-warning me-2"
                                    data-bs-toggle="modal" data-bs-target="#data<?= $no ?>">Edit<i></i></a><a
                                    role="button" class="btn btn-danger " data-bs-toggle="modal"
                                    data-bs-target="#hapus<?= $no ?>">Hapus<i></i></a>
                            </td>
                        </tr>


                        <!-- Modal Ubah -->
                        <div class="modal fade" id="data<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <input type="hidden" class="form-control" name="id_prgs"
                                                value="<?php echo $row['id_progress'] ?>">
                                            <div class="mb-2">
                                                <label for="nama" class="col-form-label">Project Name</label>
                                                <input type="text" class="form-control" name="nama"
                                                    value="<?php echo $row['nama'] ?>">
                                            </div>
                                            <div class="mb-2">
                                                <label for="client" class="col-form-label">Client</label>
                                                <input type="text" class="form-control" name="client"
                                                    value="<?php echo $row['client'] ?>">
                                            </div>
                                            <div class="mb-2">
                                                <label for="project" class="col-form-label">Project Leader</label>
                                                <input type="text" class="form-control" name="project"
                                                    value="<?php echo $row['project'] ?>">
                                            </div>
                                            <div class="mb-2">
                                                <label for="mulai" class="col-form-label">Start Date</label>
                                                <input type="date" class="form-control" name="mulai"
                                                    value="<?php echo $row['mulai'] ?>">
                                            </div>
                                            <div class="mb-2">
                                                <label for="akhir" class="col-form-label">End Date</label>
                                                <input type="date" class="form-control" name="akhir"
                                                    value="<?php echo $row['akhir'] ?>">
                                            </div>
                                            <div class="mb-2">
                                                <label for="progres" class="col-form-label">Progress</label>
                                                <input type="text" class="form-control" name="progres"
                                                    value="<?php echo $row['progres'] ?>">
                                            </div>
                                            <button type="submit" class="btn btn-primary" name="edit_data"
                                                style="background-color: #B09C66 !important;border-color: #B09C66 !important;">
                                                Edit</button>
                                        </form>
                                        <?php
                                            if (isset($_POST['edit_data'])) {
                                                $nama = ($_POST['nama']);
                                                $client = ucwords($_POST['client']);
                                                $project = ucwords($_POST['project']);
                                                $mulai = ($_POST['mulai']);
                                                $akhir = ($_POST['akhir']);
                                                $progres = ($_POST['progres']);

                                                $update = mysqli_query($con, "UPDATE progress SET nama = '{$nama}', client = '{$client}', project = '{$project}', mulai = '{$mulai}' , akhir = '{$akhir}', progres = '{$progres}'WHERE id_progress = '$_POST[id_prgs]' ");

                                                if ($update) {
                                                    echo '<script>window.location="progress.php"</script>';
                                                } else {
                                                    echo 'gagal ' . mysqli_error($con);
                                                }
                                            }
                                            ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Modal Hapus -->
                        <div class="modal fade" id="hapus<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <input type="hidden" class="form-control" name="id_prgs"
                                                value="<?php echo $row['id_progress'] ?>">
                                            <p class="mb-4">
                                                <b>Apakah anda yakin menghapus data ini?</b>
                                            </p>
                                            <button type="submit" class="btn btn-danger"
                                                name="hapus_data">Hapus</button>
                                        </form>
                                        <?php
                                            if (isset($_POST['hapus_data'])) {

                                                $delete = mysqli_query($con, "DELETE FROM progress WHERE id_progress = '$_POST[id_prgs]' ");

                                                if ($delete) {
                                                    echo '<script>window.location="progress.php"</script>';
                                                } else {
                                                    echo 'gagal ' . mysqli_error($con);
                                                }
                                            }
                                            ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>