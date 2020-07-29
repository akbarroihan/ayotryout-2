<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php Flasher::flash(); ?>
            <div class="ibox float-e-margins">
                <?php if ($data['action'] == 'detail') {
                ?>
                    <div class="ibox-content" style="padding:50px;">
                        <div class="row">
                            <h2 class="baris-tengah">Pembahasan</h2>
                        </div>
                        <div class="row">
                            <label>Soal: </label>
                            <div class="alert alert-info">
                                <?= $data['data_soal']['isi']; ?>
                            </div>
                        </div>
                        <div class="row" style="height: 100px;">
                            <label>Jawaban benar: </label>
                            <div class="alert alert-info">
                                <?php

                                if (strtolower($data['data_soal']['true']) == strtolower('a')) {
                                    echo $data['data_soal']['true'] . ". " . $data['data_soal']['pil_a'];
                                } else if (strtolower($data['data_soal']['true']) == strtolower('b')) {
                                    echo $data['data_soal']['true'] . ". " . $data['data_soal']['pil_b'];
                                } else if (strtolower($data['data_soal']['true']) == strtolower('c')) {
                                    echo $data['data_soal']['true'] . ". " . $data['data_soal']['pil_c'];
                                } else if (strtolower($data['data_soal']['true']) == strtolower('d')) {
                                    echo $data['data_soal']['true'] . ". " . $data['data_soal']['pil_d'];
                                } else if (strtolower($data['data_soal']['true']) == strtolower('e')) {
                                    echo $data['data_soal']['true'] . ". " . $data['data_soal']['pil_e'];
                                } ?>
                            </div>
                        </div>
                        <div class="row">
                            <label>Pembahasan</label>
                            <div class="alert alert-info">
                                
                                <?php 
                                if (is_numeric(strpos($data['data_pembahasan']['file'], 'file-upload')) and ($data['data_pembahasan']['file'] != null)) {
                                ?>
                                    <img alt="image" class="img-responsive" width="300px" src="<?= APPURL . "/" . $data['data_pembahasan']['file']; ?>">
                                <?php
                                } else {
                                ?>
                                tidak ada gambar terlampir
                                <?php
                                } ?>
                                <br><hr>
                                <?= $data['data_pembahasan']['isi'];?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="location.href='javascript:history.go(-1)'" class="btn">
                                Batal
                            </button>
                            <button class="btn btn-primary" name="ubah_pembahasan" id="ubah_pembahasan" type="submit">
                                Ubah
                            </button>
                            <script>
                                var btn = document.getElementById('ubah_pembahasan');
                                btn.onclick = function() {
                                    window.location.href = '<?= BASEURL; ?>/admin/pembahasan/detail-u/<?= $data['data_pembahasan']['id_bahas'] ?>';
                                }
                            </script>
                        </div>
                    </div>
                <?php
                //Insert pembahasan
                } else if ($data['action'] == 'insert') {
                ?>
                    <div class="ibox-content" style="padding:50px;">
                        <div class="row">
                            <h2 class="baris-tengah">Pembahasan</h2>
                        </div>
                        <div class="row">
                            <label>Soal: </label>
                            <div class="alert alert-info">
                                <?= $data['data_soal']['isi']; ?>
                            </div>
                        </div>
                        <div class="row" style="height: 100px;">
                            <label>Jawaban benar: </label>
                            <div class="alert alert-info">
                                <?php

                                if (strtolower($data['data_soal']['true']) == strtolower('a')) {
                                    echo $data['data_soal']['true'] . ". " . $data['data_soal']['pil_a'];
                                } else if (strtolower($data['data_soal']['true']) == strtolower('b')) {
                                    echo $data['data_soal']['true'] . ". " . $data['data_soal']['pil_b'];
                                } else if (strtolower($data['data_soal']['true']) == strtolower('c')) {
                                    echo $data['data_soal']['true'] . ". " . $data['data_soal']['pil_c'];
                                } else if (strtolower($data['data_soal']['true']) == strtolower('d')) {
                                    echo $data['data_soal']['true'] . ". " . $data['data_soal']['pil_d'];
                                } else if (strtolower($data['data_soal']['true']) == strtolower('e')) {
                                    echo $data['data_soal']['true'] . ". " . $data['data_soal']['pil_e'];
                                } ?>

                            </div>
                        </div>
                        <form action="<?= BASEURL; ?>/admin/pembahasan/i/<?= $data['data_soal']['id_soal']; ?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <input type="hidden" name="id_soal" value="<?= $data['data_soal']['id_soal']; ?>">
                                <label>Upload Gambar</label>
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
                                <label>Pembahasan</label>
                                <textarea name="isi" class="form-control" placeholder="Isi pembahasan"></textarea>
                                <br />
                            </div>

                            <div class="modal-footer">
                                <button type="button" onclick="location.href='javascript:history.go(-1)'" class="btn">
                                    Batal
                                </button>
                                <button class="btn btn-success" name="tambah_pembahasan" type="submit">
                                    Tambah
                                </button>
                            </div>
                        </form>
                    </div>
                <?php
                //Update pembahasan
                } else if ($data['action'] == 'update') {
                ?>
                    <div class="ibox-content" style="padding:50px;">
                        <div class="row">
                            <h2 class="baris-tengah">Pembahasan</h2>
                        </div>
                        <div class="row">
                            <label>Soal: </label>
                            <div class="alert alert-info">
                                <?= $data['data_soal']['isi']; ?>
                            </div>
                        </div>
                        <div class="row" style="height: 100px;">
                            <label>Jawaban benar: </label>
                            <div class="alert alert-info">
                                <?php

                                if (strtolower($data['data_soal']['true']) == strtolower('a')) {
                                    echo $data['data_soal']['true'] . ". " . $data['data_soal']['pil_a'];
                                } else if (strtolower($data['data_soal']['true']) == strtolower('b')) {
                                    echo $data['data_soal']['true'] . ". " . $data['data_soal']['pil_b'];
                                } else if (strtolower($data['data_soal']['true']) == strtolower('c')) {
                                    echo $data['data_soal']['true'] . ". " . $data['data_soal']['pil_c'];
                                } else if (strtolower($data['data_soal']['true']) == strtolower('d')) {
                                    echo $data['data_soal']['true'] . ". " . $data['data_soal']['pil_d'];
                                } else if (strtolower($data['data_soal']['true']) == strtolower('e')) {
                                    echo $data['data_soal']['true'] . ". " . $data['data_soal']['pil_e'];
                                } ?>

                            </div>
                        </div>
                        <form action="<?= BASEURL; ?>/admin/pembahasan/u/<?= $data['data_pembahasan']['id_bahas']; ?>" method="post" enctype="multipart/form-data">
                            <div class="row">

                                <label>Gambar tersimpan</label>
                                <input type="hidden" name="file_lama" value="<?= $data['data_pembahasan']['file']; ?>">
                                <img alt="image" class="img-responsive" width="300px" src="<?= APPURL . "/" . $data['data_pembahasan']['file']; ?>">
                                <?php
                                if (is_numeric(strpos($data['data_pembahasan']['file'], 'file-upload/')) && $data['data_pembahasan']['file'] != null) {
                                ?>
                                    <button class="btn" id="hapus_gambar" name="hapus_gambar" style="float: intial;" type="button">
                                        Hapus
                                    </button>
                                    <script>
                                        var btn = document.getElementById('hapus_gambar');
                                        btn.onclick = function() {
                                            if (confirm('Anda yakin ingin menghapus gambar ini?')) {
                                                window.location.href = '<?= BASEURL; ?>/admin/pembahasan/dimg/<?= $data['data_pembahasan']['id_bahas']; ?>';
                                            }
                                        }
                                    </script>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="row">
                                <input type="hidden" name="id_soal" value="<?= $data['data_soal']['id_soal']; ?>">
                                <input type="hidden" name="id_bahas" value="<?= $data['data_pembahasan']['id_bahas']; ?>">
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
                                <label>Pembahasan</label>
                                <textarea name="isi" class="form-control" placeholder="Isi pembahasan"><?= $data['data_pembahasan']['isi']; ?></textarea>
                                <br />
                            </div>

                            <div class="modal-footer">
                                <button type="button" onclick="location.href='javascript:history.go(-1)'" class="btn">
                                    Batal
                                </button>
                                <button class="btn btn-success" name="ubah_pembahasan" type="submit">
                                    Ubah
                                </button>
                            </div>
                        </form>
                    </div>
                <?php
                } ?>

            </div>
        </div>
    </div>
</div>