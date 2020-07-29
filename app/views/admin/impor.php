<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="row">
                        <?php Flasher::flash(); ?>
                    </div>
                    <div class="ibox-title">
                        <h5>Impor Soal <?= strtoupper($data['jenjang']); ?> </h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Pilih file (.xls) untuk diupload</label>
                                <form action="<?= BASEURL; ?>/admin/uploadExcel/<?= $data['jenjang'] ?>" method="post" enctype="multipart/form-data">
                                    <div class="input-group">
                                        <input type="file" name="file" data-icon="false" class="input-sm form-control">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-sm btn-primary">Go!</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <!-- Isi konten Table -->
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Mata Pelajaran</th>
                                        <th>Jumlah Soal</th>
                                        <th>Waktu Pengerjaan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($data['list_soal'])) {
                                        $no = 1;
                                        foreach ($data['list_soal'] as $list_soal) :
                                    ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?php
                                                    if ($list_soal['sub'] != $list_soal['nm_jenis']) {
                                                        echo $list_soal['nm_jenis'] . " (" . $list_soal['sub'] . ")";
                                                    } else {
                                                        echo $list_soal['sub'];
                                                    }
                                                    ?></td>
                                                <td><?= $list_soal['n_id_sub']; ?></td>
                                                <td><?= $list_soal['waktu']; ?> Menit</td>
                                                <td>
                                                    <button type="button" id="lihat<?= $list_soal['id_sub']; ?>" class="btn btn-outline btn-info">Lihat daftar soal</button>
                                                    <!-- <a href="<?= BASEURL; ?>/admin/soal/<?= $list_soal['id_sub']; ?>">Lihat daftar soal</a>  -->
                                                    |
                                                    <button type="button" id='hapus<?= $list_soal['id_sub']; ?>' class="btn btn-outline btn-danger">Hapus semua soal</button>
                                                </td>
                                                <script>
                                                    var lihat = document.getElementById('lihat<?= $list_soal['id_sub']; ?>');
                                                    var hapus = document.getElementById('hapus<?= $list_soal['id_sub']; ?>');
                                                    lihat.onclick = function() {
                                                        window.location.href = '<?= BASEURL; ?>/admin/soal/<?= $list_soal['id_sub']; ?>';
                                                    }
                                                    hapus.onclick = function() {
                                                        if (confirm('Apakah anda yakin ingin menghapus semua isi data ini?')) {
                                                            window.location.href = '<?= BASEURL; ?>/admin/soal/<?= $list_soal['id_sub']; ?>/truncate-all';
                                                        }
                                                    }
                                                </script>
                                            </tr>
                                    <?php
                                        endforeach;
                                    }
                                    ?>

                                </tbody>
                                <!-- Isi konten -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>