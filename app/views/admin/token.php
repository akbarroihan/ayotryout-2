<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="row">
                        <?php Flasher::flash(); ?>
                    </div>
                    <div class="ibox-title">
                        <h3>Data Token </h3>
                        <div class="ibox-tools">
                            <button class="btn btn-primary" type="button" name="tambah_token" id="tambah_token"><i class="fa fa-plus"></i>Tambah</button>
                            <script>
                                var btn = document.getElementById('tambah_token');
                                btn.onclick = function() {
                                    window.location.href = '<?= BASEURL; ?>/admin/token/<?= $data['jenjang'] ?>/add-token';
                                }
                            </script>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <!-- Tabel Jenis Soal -->
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Token</th>
                                        <th>List Soal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if ($data['data_tokensoal']) {
                                        foreach ($data['data_tokensoal'] as $tokensoal) :
                                    ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $tokensoal['token'] ?></td>
                                                <td> |
                                                    <?php
                                                    if ($data['data_sub_jenis']) {
                                                        foreach ($data['data_sub_jenis'] as $data_sub) {
                                                    ?>
                                                            <a href="<?= BASEURL; ?>/admin/token/<?= $data_sub['jenjang']; ?>/detail/<?= $tokensoal['token'] ?>=<?= $data_sub['id_sub'] ?>"> <?= $data_sub['sub']; ?></a> |</a>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-outline btn-danger" name="hapus_token" id="hapus_token<?= $tokensoal['id_token'] ?>">Hapus</button>

                                                    <script>
                                                        var btn = document.getElementById('hapus_token<?= $tokensoal['id_token'] ?>');
                                                        btn.onclick = function() {
                                                            if (confirm('Apakah anda yakin ingin menghapus data ini?')) {
                                                                window.location.href = '<?= BASEURL ?>/admin/token/<?= $data['jenjang'] ?>/d-tn/<?= $tokensoal['id_token'] ?>';
                                                            }
                                                        }
                                                    </script>
                                                </td>
                                            </tr>
                                    <?php
                                        endforeach;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>