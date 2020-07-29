<div class="container">
    <div class="row">
        <h2 class="baris-tengah"><strong>Selamat Datang Admin</strong></h2>
        <h3 class="baris-tengah">___________</h3>
        <h3 class="baris-tengah">Selamat Mengelola Konten</h3>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        <!-- Bagian Index Level 1 -->
                        <?php
                        if (isset($data['jenjang'])) {
                            foreach ($data['jenjang'] as $jenjang) :
                        ?>
                                <div class="col-lg-4">
                                    <a href="<?= BASEURL; ?>/admin/index/<?= strtolower($jenjang['jenjang']); ?>" style="display: block;">
                                        <div class="widget style1 navy-bg klik">
                                            <area href="soal/list_soal_mtk.html">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <i class="fa fa-pencil fa-5x"></i>
                                                </div>
                                                <div class="col-xs-8 text-right">
                                                    <span> Kelola konten </span>
                                                    <h2 class="font-bold"><?= strtoupper($jenjang['jenjang']); ?></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php

                            endforeach;
                            // Bagian Index Level 2
                        } else if (isset($data['kombinasi_jenis_soal'])) {
                            foreach ($data['kombinasi_jenis_soal'] as $kombinasi) :
                                if ($kombinasi['nm_jenis'] != $kombinasi['sub']) {


                                ?>

                                    <div class="col-lg-6">
                                        <a href="<?= BASEURL; ?>/admin/soal/<?= $kombinasi['id_sub'];?>" style="display: block;">
                                            <div class="widget style1 navy-bg klik">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <i class="fa fa-pencil fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-8 text-right">
                                                        <?php 
                                                        if (isset($data['list_soal'])){
                                                            foreach($data['list_soal'] as $count):
                                                                if($count['id_sub'] == $kombinasi['id_sub']){
                                                                    echo "<span> Jumlah Soal : ".$count['n_id_sub']." soal </span>";
                                                                    
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
                                        <a href="<?= BASEURL; ?>/admin/soal/<?= $kombinasi['id_sub'];?>" style="display: block;">
                                            <div class="widget style1 navy-bg klik">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <i class="fa fa-pencil fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-8 text-right">
                                                        <?php 
                                                        if (isset($data['list_soal'])){
                                                            foreach($data['list_soal'] as $count):
                                                                if($count['id_sub'] == $kombinasi['id_sub']){
                                                                    echo "<span> Jumlah Soal : ".$count['n_id_sub']." soal </span>";
                                                                }
                                                            endforeach;
                                                        } else {
                                                            
                                                            echo "<span> Jumlah Soal : null Soal </span>";
                                                        }
                                                        ?><h2 class="font-bold"><?= $kombinasi['nm_jenis'] ; ?></h2>
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
                        <!-- <div class="col-lg-4">
                            <a href="<?= BASEURL; ?>/admin/index/sma" style="display: block;">
                                <div class="widget style1 lazur-bg klik">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <i class="fa fa-pencil fa-5x"></i>
                                        </div>
                                        <div class="col-xs-8 text-right">
                                            <span> Kelola konten </span>
                                            <h2 class="font-bold">SMA</h2>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a href="<?= BASEURL; ?>/admin/index/stan" style="display: block;">
                                <div class="widget style1 yellow-bg klik">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <i class="fa fa-pencil fa-5x"></i>
                                        </div>
                                        <div class="col-xs-8 text-right">
                                            <span> Kelola konten </span>
                                            <h2 class="font-bold">STAN</h2>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>