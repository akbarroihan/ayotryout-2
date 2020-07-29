<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">

                    <div class="row">
                        <?php Flasher::flash(); ?>
                    </div>
                    <?php

                    if (isset($data['type']) && $data['type'] == 'list_soal_by_token') {
                        //list dengan token
                    ?>

                        <div class="ibox-title">
                            <h3>Data Soal <?php
                                            if ($data['data_sub']['sub'] != $data['data_sub']['nm_jenis']) {
                                                echo $data['data_sub']['nm_jenis'] . " (" . $data['data_sub']['sub'] . ")";
                                            } else {
                                                echo $data['data_sub']['nm_jenis'];
                                            }
                                            ?>
                            </h3>
                            <h5>
                                <table>
                                    <tr>
                                        <td>Token : </td>
                                        <td><?= $data['token']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah : </td>
                                        <td><?= $data['jumlah_soal']['n_soal']; ?> Soal</td>
                                    </tr>
                                </table>
                            </h5>
                            <div class="ibox-tools">
                                <a class="btn btn-primary" type="button" href="<?= BASEURL; ?>/admin/token/<?= $data['data_sub']['jenjang'] ?>/add-soal/<?= $data['token'] ?>=<?= $data['data_sub']['id_sub'] ?>"><i class="fa fa-plus"></i>Tambah
                                    Soal</a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <!-- Tabel Jenis Soal -->
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">Nomor</th>
                                            <th class="col-md-6">Soal Tes</th>
                                            <th class="col-md-1">Jawaban</th>
                                            <th class="col-md-1">Waktu</th>
                                            <th class="col-md-1">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Isi konten disini -->
                                        <?php
                                        $no = 1;
                                        foreach ($data['data_soal'] as $soal) : ?>
                                            <tr>
                                                <td class="col-md-1"><?= $no++; ?></td>
                                                <td class="col-md-6"><?= $soal['isi']; ?></td>
                                                <td class="col-md-1"><?= $soal['true']; ?></td>
                                                <td class="col-md-1"><?= $soal['waktu']; ?> Menit</td>
                                                <td class="col-md-1">

                                                    <button type="button" class="btn btn-outline btn-danger" name="hapus_soal_token" id="hapus_soal_token<?= $soal['id_tokensoal'] ?>">Hapus</button>

                                                    <script>
                                                        var btn = document.getElementById('hapus_soal_token<?= $soal['id_tokensoal'] ?>');
                                                        btn.onclick = function() {
                                                            if (confirm('Apakah anda yakin ingin menghapus data ini?')) {
                                                                window.location.href = '<?= BASEURL ?>/admin/token/<?= $data['data_sub']['jenjang'] ?>/d-ts/<?= $data['token'] ?>=<?= $data['data_sub']['id_sub'] ?>=<?= $soal['id_tokensoal'] ?>';
                                                            }
                                                        }
                                                    </script>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php
                    } else {
                        //list tanpa token
                    ?>
                        <div class="ibox-title">
                            <h3>Data Soal <?php
                                            if ($data['jenis_soal']['sub'] != $data['jenis_soal']['nm_jenis']) {
                                                echo $data['jenis_soal']['nm_jenis'] . " (" . $data['jenis_soal']['sub'] . ")";
                                            } else {
                                                echo $data['jenis_soal']['nm_jenis'];
                                            }
                                            ?></h3>
                            <h5>Jumlah : <?= $data['jumlah_soal']; ?> Soal</h5>
                            <div class="ibox-tools">
                                <a class="btn btn-primary" type="button" href="<?= BASEURL; ?>/admin/soal/<?= $data['jenis_soal']['id_sub']; ?>/i"><i class="fa fa-plus"></i>Tambah
                                    Soal</a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <!-- Tabel Jenis Soal -->
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">Nomor</th>
                                            <th class="col-md-6">Soal Tes</th>
                                            <th class="col-md-1">Jawaban</th>
                                            <th class="col-md-1">Waktu</th>
                                            <th class="col-md-2">Pembahasan</th>
                                            <th class="col-md-1">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Isi konten disini -->
                                        <?php
                                        $no = 1;
                                        foreach ($data['soal'] as $soal) : ?>
                                            <tr>
                                                <td class="col-md-1"><?= $no++; ?></td>
                                                <td class="col-md-6"><?= $soal['isi']; ?></td>
                                                <td class="col-md-1"><?= $soal['true']; ?></td>
                                                <td class="col-md-1"><?= $soal['waktu']; ?> Menit</td>
                                                <td class="col-md-2"><a href="<?= BASEURL; ?>/admin/pembahasan/detail/<?= $soal['id_soal']; ?>">pembahasan</a>
                                                </td>
                                                <td class="col-md-1"><a type="button" href="<?= BASEURL; ?>/admin/soal/<?= $soal['id_sub']; ?>/u/<?= $soal['id_soal']; ?>" id="ubahSoal">Edit</a> | <a href="<?= BASEURL; ?>/admin/set_soal/d/<?= $soal['id_sub']; ?>/<?= $soal['id_soal']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">Hapus</a> </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>