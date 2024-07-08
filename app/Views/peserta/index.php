<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome to CodeIgniter 4!</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-lg justify-content-center">
            <a class="navbar-brand">
                <h5 class="text-align-center">Registration</h5>
            </a>
        </div>
    </nav>

    <main class="container-lg my-5">
        <section>
            <div class="card">
                <div class="card-body">
                    <h5>Daftar Riwayat Hidup</h5>
                    <form enctype="multipart/form-data" action="<?php echo base_url(); ?>/peserta/create" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password">
                        </div>
                        <div class="mb-3">
                            <label for="nomor_ktp" class="form-label">Nomor KTP</label>
                            <input type="text" class="form-control" id="nomor_ktp">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama">
                        </div>
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir">
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <input type="text" class="form-control" id="jenis_kelamin">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat"></textarea>
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Jenjang</th>
                                    <th scope="col">Nama Sekolah</th>
                                    <th scope="col">Lokasi</th>
                                    <th scope="col">Tahun Lulus</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr>
                                    <th scope="row">
                                        <select class="form-select" id="jenjang1">
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA">SMA</option>
                                        </select>
                                    </th>
                                    <td>
                                        <input type="text" class="form-control" id="nama_sekolah1">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="lokasi1">
                                    </td>
                                    <td>
                                        <input type="number" type="text" class="form-control" id="tahun_lulus1">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <select class="form-select" id="jenjang2">
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA">SMA</option>
                                        </select>
                                    </th>
                                    <td>
                                        <input type="text" class="form-control" id="nama_sekolah2">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="lokasi2">
                                    </td>
                                    <td>
                                        <input type="number" type="text" class="form-control" id="tahun_lulus2">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <select class="form-select" id="jenjang3">
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA">SMA</option>
                                        </select>
                                    </th>
                                    <td>
                                        <input type="text" class="form-control" id="nama_sekolah3">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="lokasi3">
                                    </td>
                                    <td>
                                        <input type="number" type="text" class="form-control" id="tahun_lulus3">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>