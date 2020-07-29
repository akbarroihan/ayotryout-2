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
                            <h3>Data Akun User </h3>
                            <h5>Jumlah : <?=$data['jumlah_user'];?> User</h5>
                        </div>
                        <div class="col-sm-3">
                            <form action="<?= BASEURL; ?>/admin/akun/c" method="post">
                                <div class="input-group">
                                    <input type="text" placeholder="Search" name="cari_akun" class="input-sm form-control"><span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            Cari
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <!-- Tabel Jenis Soal -->
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>No.Telp</th>
                                            <th>Konfirmasi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Isi konten disini -->

                                        <?php
                                        if (isset($data['data_user'])) {

                                            $no = 1;
                                            foreach ($data['data_user'] as $data_user) : ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $data_user['username']; ?></td>
                                                    <td><?= $data_user['email']; ?></td>
                                                    <td><?= $data_user['telepon']; ?></td>
                                                    <td><?php if($data_user['konfirmasi']){
                                                        echo 'Ya';
                                                    } else {
                                                        echo 'Tidak';
                                                    } ?></td>
                                                    <td><a type="button" data-toggle="modal" data-target="#modalEdit" data-id="<?= $data_user['id_user']; ?>" class="tampilModalUbah">Edit</a> | <a href="<?= BASEURL; ?>/admin/akun/d/<?= $data_user['id_user']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">Hapus</a> </td>
                                                </tr>
                                        <?php endforeach;
                                        } ?>

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
<div class="modal fade" id="modalEdit" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="judulModal">Ubah data</h4>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL; ?>/admin/akun/u" method="POST">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id_user" name="id_user" value="">
                        <label for="email">Alamat e-mail:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon:</label>
                        <input type="number" class="form-control" id="telepon" name="telepon">
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" required="">
                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group">
                        <label for="konfirmasi">Konfirmasi:</label>
                        <select class="form-control m-b" id="konfirmasi" name="konfirmasi">
                            <option value=1>Ya</option>
                            <option value=0>Tidak</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="buttonUbah" class="btn btn-w-m btn-primary">Ubah</button>
                </form>

            </div>
        </div>

    </div>
</div>