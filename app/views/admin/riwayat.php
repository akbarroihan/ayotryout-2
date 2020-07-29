<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="row">
                        <?php Flasher::flash(); ?>
                    </div>
                    <div class="ibox-title">
                        <div class="col-sm-9">
                            <h3>Daftar Riwayat User </h3>
                        </div>
                        <?php
                        ?>

                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <!-- Tabel Jenis Soal -->
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Terakhir dikerjakan</th>
                                            <th>Token</th>
                                            <th>Email</th>
                                            <th>Benar</th>
                                            <th>Salah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data['data_riwayat'] as $riwayat) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td>
                                                    <?= $riwayat['tanggal']; ?>
                                                </td>
                                                <td>
                                                    <?= $riwayat['token']; ?>
                                                </td>
                                                <td>
                                                    <?= $riwayat['email']; ?>
                                                </td>
                                                <td>
                                                    <?= $riwayat['benar']; ?>
                                                </td>
                                                <td>
                                                    <?= $riwayat['salah']; ?>
                                                </td>
                                                <td>
                                                    <button type="button"  class="btn btn-outline btn-info tampilDetailRiwayat" data-toggle="modal" data-target="#modalDetailRiwayat" data-id="<?= $riwayat['id_user']; ?>=<?= $riwayat['token']; ?>">Detail</button>
                                                </td>
                                            </tr>
                                        <?php
                                        endforeach;
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
</div>

<!-- Modal -->
<div class="modal fade" id="modalDetailRiwayat" role="dialog">
    <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" id="judulModal">Detail Riwayat User</h3>
            </div>
            <div class="modal-body">
                <!-- <table>
                    <tbody>
                        <tr>
                            <td>
                                Email:
                            </td>
                            <td>
                                lorem
                            </td>
                        </tr>
                    </tbody>
                </table> -->
                <div id="headDetailRiwayat">

                </div>
                <div class="row">
                    <h4 style="text-align: center;">Progress Pengerjaan</h4>
                </div>
                <hr>
                <div class="row" style="padding-left: 20px; padding-right: 20px;">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <!-- Tabel Jenis Soal -->
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Jenis Soal</th>
                                    <th>Sudah Dikerjakan</th>
                                </tr>
                            </thead>
                            <tbody id="tabelDetailRiwayatAdmin">
                                
                            </tbody>

                        </table>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
</div>