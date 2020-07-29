<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">

                    <?php
                    //Halaman tambah file
                    if ($data['type'] == 'tambah') :
                    ?>
                        <div class="ibox-title">
                            <h5>Tambah Soal <?php
                                            if ($data['data_sub']['sub'] != $data['data_sub']['nm_jenis']) {
                                                echo $data['data_sub']['nm_jenis'] . " (" . $data['data_sub']['sub'] . ")";
                                            } else {
                                                echo $data['data_sub']['sub'];
                                            }  ?> </h5>
                        </div>
                        <div class="ibox-content">
                            <div class="container">
                                <div class="wrapper wrapper-content animated fadeInRight">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="<?= BASEURL; ?>/admin/set_soal/i/<?= $data['data_sub']['id_sub']; ?>" enctype="multipart/form-data" class="form-horizontal" method="POST">
                                                <div class="row">
                                                    <label>Soal</label>
                                                    <input type="hidden" name="id_sub" value="<?= $data['data_sub']['id_sub']; ?>">
                                                    <textarea name="isi" class="form-control"></textarea>
                                                    <br />
                                                    <label>Upload File</label>
                                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                        <div class="form-control" data-trigger="fileinput">
                                                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                            <span class="fileinput-filename"></span>
                                                        </div>
                                                        <span class="input-group-addon btn btn-default btn-file">
                                                            <span class="fileinput-new">Select file</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="file" name="file" />
                                                        </span>
                                                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                    </div>
                                                    <br />

                                                    <label>Pilihan Benar</label>
                                                    <select class="form-control" name="true">
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="C">C</option>
                                                        <option value="D">D</option>
                                                        <option value="E">E</option>
                                                    </select>
                                                    <hr>
                                                    <br />
                                                    <label>Pilihan A</label>
                                                    <textarea name="pil_a" class="form-control"></textarea>
                                                    <br />
                                                    <label>Poin Benar A</label>
                                                    <input type="number" name="score_a" class="form-control">
                                                    <hr>
                                                    <br />
                                                    <label>Pilihan B</label>
                                                    <textarea name="pil_b" class="form-control"></textarea>
                                                    <br />
                                                    <label>Poin Benar B</label>
                                                    <input type="number" name="score_b" class="form-control">
                                                    <hr>
                                                    <br />
                                                    <label>Pilihan C</label>
                                                    <textarea name="pil_c" class="form-control"></textarea>
                                                    <br />
                                                    <label>Poin Benar C</label>
                                                    <input type="number" name="score_c" class="form-control">
                                                    <hr>
                                                    <br />
                                                    <label>Pilihan D</label>
                                                    <textarea name="pil_d" class="form-control"></textarea>
                                                    <br />
                                                    <label>Poin Benar D</label>
                                                    <input type="number" name="score_d" class="form-control">
                                                    <hr>
                                                    <br />
                                                    <label>Pilihan E</label>
                                                    <textarea name="pil_e" class="form-control"></textarea>
                                                    <br />
                                                    <label>Poin Benar E</label>
                                                    <input type="number" name="score_e" class="form-control">
                                                    <div class="modal-footer">
                                                        <button type="button" onclick="location.href='javascript:history.go(-1)'" class="btn" data-dismiss="modal" aria-hidden="true">
                                                            Batal
                                                        </button>
                                                        <button class="btn btn-success" name="tambah_soal" type="submit">
                                                            Tambah
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php
                    endif;
                    //Halaman ubah file
                    if ($data['type'] == 'ubah') : ?>
                        <div class="ibox-title">
                            <h5>Ubah Soal <?php
                                            if ($data['data_sub']['sub'] != $data['data_sub']['nm_jenis']) {
                                                echo $data['data_sub']['nm_jenis'] . " (" . $data['data_sub']['sub'] . ")";
                                            } else {
                                                echo $data['data_sub']['sub'];
                                            }  ?> </h5>
                        </div>
                        <div class="ibox-content">
                            <div class="container">
                                <div class="wrapper wrapper-content animated fadeInRight">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="<?= BASEURL; ?>/admin/set_soal/u/<?= $data['data_sub']['id_sub']; ?>" enctype="multipart/form-data" class="form-horizontal" method="POST">
                                                <div class="row">
                                                    <label>Soal</label>
                                                    <input type="hidden" name="id_sub" value="<?= $data['data_sub']['id_sub']; ?>">
                                                    <input type="hidden" name="id_soal" value="<?= $data['data_soal']['id_soal']; ?>">
                                                    <textarea name="isi" class="form-control"><?= $data['data_soal']['isi']; ?></textarea>
                                                    <br />
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>Gambar tersimpan</label>
                                                            <input type="hidden" name="file_lama" value="<?= $data['data_soal']['file']; ?>">
                                                            <img alt="image" class="img-responsive" width="300px" src="<?= APPURL . "/" . $data['data_soal']['file']; ?>">
                                                            <?php
                                                            if (strpos($data['data_soal']['file'], 'file-upload/') !== false && $data['data_soal']['file'] != null) {
                                                            ?>
                                                                <button class="btn" id="hapus_gambar" name="hapus_gambar" style="float: intial;" type="button">
                                                                    Hapus
                                                                </button>
                                                                <script>
                                                                    var btn = document.getElementById('hapus_gambar');
                                                                    btn.onclick = function() {
                                                                        if (confirm('Anda yakin ingin menghapus gambar ini?')) {
                                                                            window.location.href = '<?= BASEURL; ?>/admin/set_soal/dimg/<?= $data['data_soal']['id_sub'] ?>/<?= $data['data_soal']['id_soal']; ?>';
                                                                        }
                                                                    }
                                                                </script>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="col-sm-3">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <label>Ubah gambar tersimpan? (jika tidak, biarkan kosong)</label>
                                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                        <div class="form-control" data-trigger="fileinput">
                                                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                            <span class="fileinput-filename"></span>
                                                        </div>
                                                        <span class="input-group-addon btn btn-default btn-file">
                                                            <span class="fileinput-new">Select file</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="file" name="file" />
                                                        </span>
                                                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                    </div>
                                                    <br />

                                                    <label>Pilihan Benar</label>
                                                    <select class="form-control" name="true" id="true">
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="C">C</option>
                                                        <option value="D">D</option>
                                                        <option value="E">E</option>
                                                    </select>
                                                    <script>
                                                        document.getElementById('true').value = "<?= $data['data_soal']['true']; ?>";
                                                    </script>
                                                    <hr>
                                                    <br />
                                                    <label>Pilihan A</label>
                                                    <textarea name="pil_a" class="form-control"><?= htmlspecialchars($data['data_soal']['pil_a']); ?></textarea>
                                                    <br />
                                                    <label>Poin Benar A</label>
                                                    <input type="number" name="score_a" class="form-control" value="<?= $data['data_soal']['score_a']; ?>">
                                                    <hr>
                                                    <br />
                                                    <label>Pilihan B</label>
                                                    <textarea name="pil_b" class="form-control"><?= htmlspecialchars($data['data_soal']['pil_b']); ?></textarea>
                                                    <br />
                                                    <label>Poin Benar B</label>
                                                    <input type="number" name="score_b" class="form-control" value="<?= $data['data_soal']['score_b']; ?>">
                                                    <hr>
                                                    <br />
                                                    <label>Pilihan C</label>
                                                    <textarea name="pil_c" class="form-control"><?= htmlspecialchars($data['data_soal']['pil_c']); ?></textarea>
                                                    <br />
                                                    <label>Poin Benar C</label>
                                                    <input type="number" name="score_c" class="form-control" value="<?= $data['data_soal']['score_c']; ?>">
                                                    <hr>
                                                    <br />
                                                    <label>Pilihan D</label>
                                                    <textarea name="pil_d" class="form-control"><?= htmlspecialchars($data['data_soal']['pil_d']); ?></textarea>
                                                    <br />
                                                    <label>Poin Benar D</label>
                                                    <input type="number" name="score_d" class="form-control" value="<?= $data['data_soal']['score_d']; ?>">
                                                    <hr>
                                                    <br />
                                                    <label>Pilihan E</label>
                                                    <textarea name="pil_e" class="form-control"><?= htmlspecialchars($data['data_soal']['pil_e']); ?></textarea>
                                                    <br />
                                                    <label>Poin Benar E</label>
                                                    <input type="number" name="score_e" class="form-control" value="<?= $data['data_soal']['score_e']; ?>">
                                                    <div class="modal-footer">
                                                        <button type="button" onclick="location.href='javascript:history.go(-1)'" class="btn" data-dismiss="modal" aria-hidden="true">
                                                            Batal
                                                        </button>
                                                        <button class="btn btn-success" name="ubah_soal" type="submit">
                                                            Ubah
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php
                    endif;
                    //Halaman tambah soal ke token
                    if ($data['type'] == 'tambah_by_token') : ?>
                        <div class="ibox-title">
                            <h5>Tambah Soal <?php
                                            if ($data['data_sub']['sub'] != $data['data_sub']['nm_jenis']) {
                                                echo $data['data_sub']['nm_jenis'] . " (" . $data['data_sub']['sub'] . ")";
                                            } else {
                                                echo $data['data_sub']['sub'];
                                            }  ?>
                                ke dalam token <?= $data['token']['token'] ?>
                            </h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <form action="<?= BASEURL; ?>/admin/token/<?= $data['data_sub']['jenjang'] ?>/i/<?= $data['token']['token'] ?>=<?= $data['data_sub']['id_sub'] ?>" method="post">
                                    <table class="table table-striped">
                                        <!-- Tabel Jenis Soal -->
                                        <thead>
                                            <tr>
                                                <th class="col-md-1">Nomor</th>
                                                <th class="col-md-6">Soal Tes</th>
                                                <th class="col-md-1">Jawaban</th>
                                                <th class="col-md-1">Waktu</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <input type="hidden" name="id_token" value="<?= $data['token']['id_token']; ?>">
                                            <!-- Isi konten disini -->
                                            <?php
                                            $no = 1;
                                            foreach ($data['data_soal'] as $soal) : ?>
                                                <tr>
                                                    <td class="col-md-1"><input type="checkbox" name="id_soal[]" value="<?= $soal['id_soal']; ?>"></td>
                                                    <td class="col-md-6"><?= $soal['isi']; ?></td>
                                                    <td class="col-md-1"><?= $soal['true']; ?></td>
                                                    <td class="col-md-1"><?= $soal['waktu']; ?> Menit</td>
                                                </tr>
                                            <?php endforeach; ?>

                                        </tbody>
                                    </table>
                                    <div class="modal-footer">
                                        <button type="button" onclick="location.href='javascript:history.go(-1)'" class="btn" data-dismiss="modal" aria-hidden="true">
                                            Batal
                                        </button>
                                        <button class="btn btn-success" name="tambah_soal_token" type="submit">
                                            Tambah
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>