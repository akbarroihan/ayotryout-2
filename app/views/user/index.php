<div class="container">
    <div class="row">
        <h2 class="baris-tengah"><strong>Selamat Datang <?= $_SESSION['username']; ?></strong></h2>
        <h3 class="baris-tengah">Token Anda : <?= $_SESSION['token']; ?></h3>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        <!-- Bagian Index Level 1 -->
                        <?php

                        if (isset($data['data_sub'])) {
                            foreach ($data['data_sub'] as $kombinasi) :
                                if ($kombinasi['nm_jenis'] != $kombinasi['sub']) {


                        ?>

                                    <div class="col-lg-6">
                                        <form action="<?= BASEURL; ?>/user/mulai_ujian" id="form-user-lv-1" method="post">
                                            <input type="hidden" name="id_sub" value="<?= $kombinasi['id_sub']; ?>">
                                            <a href="#" style="display: block;" onclick="document.getElementById('form-user-lv-1').submit();">
                                        </form>
                                        <div class="widget style1 lazur-bg klik">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <i class="fa fa-pencil fa-5x"></i>
                                                </div>
                                                <div class="col-xs-8 text-right">
                                                    <?php
                                                    if (isset($data['count_soal'])) {
                                                        foreach ($data['count_soal'] as $count) :
                                                            if ($count['id_sub'] == $kombinasi['id_sub']) {
                                                                echo "<span> Jumlah Soal : " . $count['n_soal'] . " soal </span>";
                                                            }
                                                        endforeach;
                                                    } else {

                                                        echo "<span> Jumlah Soal : null Soal </span>";
                                                    }
                                                    ?>
                                                    <h2 class="font-bold"><?= $kombinasi['nm_jenis'] . " (" . $kombinasi['sub'] . ")"; ?></h2>

                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="col-lg-6">

                                        <form action="<?= BASEURL; ?>/user/mulai_ujian" id="form-user-lv-<?= $kombinasi['id_sub']; ?>" method="post">
                                            <input type="hidden" name="id_sub" value="<?= $kombinasi['id_sub']; ?>">
                                            <a href="#" style="display: block;" onclick="document.getElementById('form-user-lv-<?= $kombinasi['id_sub']; ?>').submit();">
                                        </form>
                                        <div class="widget style1 lazur-bg klik">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <i class="fa fa-pencil fa-5x"></i>
                                                </div>
                                                <div class="col-xs-8 text-right">
                                                    <?php
                                                    if (isset($data['count_soal'])) {
                                                        foreach ($data['count_soal'] as $count) :
                                                            if ($count['id_sub'] == $kombinasi['id_sub']) {
                                                                echo "<span> Jumlah Soal : " . $count['n_soal'] . " soal </span>";
                                                            }
                                                        endforeach;
                                                    } else {
                                                        echo "<span> Jumlah Soal : null Soal </span>";
                                                    }
                                                    ?><h2 class="font-bold"><?= $kombinasi['nm_jenis']; ?></h2>
                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                <?php
                                }
                            endforeach;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reserved -->

<!-- <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content" style="padding: 25px; margin-top: 45px;">
                    <div class="row">
                        <h1 class="baris-tengah"><strong>Selamat Datang <?= $_SESSION['username']; ?></strong></h1>
                        <h2 class="baris-tengah">Token Anda : <?= $_SESSION['token']; ?></h2>
                        
                    </div>
                    <br>
                    <div class="alert alert-info" style="padding: 30px; margin-left:25px;margin-right:25px;">
                        <div class="row">
                            <h2>Petunjuk mengerjakan Try Out :</h2>
                        </div>
                        <div class="row">
                            <p>
                                <ol>
                                    <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Impedit soluta neque reiciendis voluptatibus asperiores id et totam officia eum similique, eius rerum doloremque animi dolore.</li>
                                    <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Impedit soluta neque reiciendis voluptatibus asperiores id et totam officia eum similique, eius rerum doloremque animi dolore.</li>
                                    <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Impedit soluta neque reiciendis voluptatibus asperiores id et totam officia eum similique, eius rerum doloremque animi dolore.</li>
                                    <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Impedit soluta neque reiciendis voluptatibus asperiores id et totam officia eum similique, eius rerum doloremque animi dolore.</li>
                                    <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Impedit soluta neque reiciendis voluptatibus asperiores id et totam officia eum similique, eius rerum doloremque animi dolore.</li>
                                    <li>Perhitungan mundur waktu pengerjaan soal dimulai setelah anda menekan tombol "Mulai Try Out!" </li>
                                </ol>
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form action="<?= BASEURL; ?>/user/ujian" method="POST">

                            <button class="btn btn-success" name="first_soal" type="submit">

                                <h3>Mulai Try Out!</h3>

                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->