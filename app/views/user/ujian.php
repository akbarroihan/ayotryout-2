<div class="container">
    <div class="col-md-8">
        <div class="row">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Jenis Soal : <?php
                                                if ($data['current_soal']['sub'] != $data['current_soal']['nm_jenis']) {
                                                    echo $data['current_soal']['nm_jenis'] . " (" . $data['current_soal']['sub'] . ")";
                                                } else {
                                                    echo $data['current_soal']['nm_jenis'];
                                                }
                                                ?></h5>

                            <!-- <div class="ibox-tools">
                                <a href="../../histori/histori.html" type="button" class="btn btn-primary">Selesai</a>
                            </div> -->
                        </div>
                        <div class="ibox-content">
                            <div style="text-align:justify; padding-left:30px">

                                <?= $data['current_soal']['isi']; ?>
                                <hr>
                                <form action="<?= BASEURL; ?>/user/ujian" id="form_soal" method="post">
                                    <input type="radio" id="pil_a" name="pil" value="a">
                                    <label for="pil_a"><?= $data['current_soal']['pil_a'] ?></label><br>
                                    <input type="radio" id="pil_b" name="pil" value="b">
                                    <label for="pil_b"><?= $data['current_soal']['pil_b'] ?></label><br>
                                    <input type="radio" id="pil_c" name="pil" value="c">
                                    <label for="pil_c"><?= $data['current_soal']['pil_c'] ?></label><br>
                                    <input type="radio" id="pil_d" name="pil" value="d">
                                    <label for="pil_d"><?= $data['current_soal']['pil_d'] ?></label><br>
                                    <input type="radio" id="pil_e" name="pil" value="e">
                                    <label for="pil_e"><?= $data['current_soal']['pil_e'] ?></label><br>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="current_index_soal" value="<?= $data['current_index_soal'] ?>">
                                <input type="hidden" name="id_sub" value="<?= $data['id_sub'] ?>">
                                <?php
                                if ($data['prev_soal'] == true) {
                                    //ada tombol sebelumnya
                                ?>
                                    <button type="submit" style="float: left;" name="prev_soal" id="btn-prev_soal" class="btn btn-primary"><i class=" fa fa-arrow-left"></i> Sebelumnya</button>
                                <?php
                                }
                                if ($data['next_soal'] == true) {

                                ?>
                                    <button type="submit" name="next_soal" id="btn-next_soal" class="btn btn-primary">Selanjutnya <i class="fa fa-arrow-right"></i></button>

                                <?php
                                }
                                ?>
                                </form>

                            </div>
                            <!-- Insert Soal Disini -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Waktu anda tersisa : <span id="divCounter"></span></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">

                <!--<script type="text/javascript">
                    if (sessionStorage.getItem("counter")) {
                        if (sessionStorage.getItem("counter") >= 1000) {
                            var value = 0;
                        } else {
                            var value = sessionStorage.getItem("counter");
                        }
                    } else {
                        var value = 0;
                    }
                    document.getElementById('divCounter').innerHTML = value;

                    var counter = function() {
                        if (value >= 1000) {
                            sessionStorage.setItem("counter", 0);
                            value = 0;
                        } else {
                            value = parseInt(value) + 1;
                            sessionStorage.setItem("counter", value);
                        }
                        document.getElementById('divCounter').innerHTML = value;
                    };

                    var interval = setInterval(counter, 1000);
                </script> -->
                <h3 class="baris-tengah" style="margin-bottom:-6px;">Daftar Soal</h3>
                <hr style="margin-bottom:-1px;">
                <div class="table-responsive">
                    <?php
                    $no_sub = 1;
                    if (isset($data['list_sub'])) {
                    ?>
                        <?php
                        //Pembatas tabel tampil daftar soal
                        $arr_awal_baris = array();
                        $times  = 0;
                        $limit = 50;
                        while ($times <= $limit) {
                            array_push($arr_awal_baris, (5 * $times++) + 1);
                        }

                        $arr_akhir_baris = array();
                        $times = 1;
                        while ($times <= $limit) {
                            array_push($arr_akhir_baris, (5 * $times++));
                        }
                        //End pembatas tabel tampil daftar soal

                        foreach ($data['list_sub'] as $list_sub) {
                            if ($list_sub['id_sub'] == $data['current_id_sub']) {


                        ?>
                                <h3 class="baris-tengah"><?= $list_sub['sub']; ?></h3>
                                <table class="baris-tengah table-responsive">
                                    <?php
                                    $no = 1;
                                    $sub_temp_a = "";
                                    $sub_temp_b = "";
                                    echo "<tr>";
                                    foreach ($data['list_soal'] as  $key => $list_soal) {
                                        $sub_temp_b = $list_soal['id_sub'];
                                        if ($list_soal['id_sub'] == $list_sub['id_sub']) {
                                    ?>

                                            <td style="padding: 5px;">
                                                <form action="<?= BASEURL ?>/user/ujian" method="post">
                                                    <input type="hidden" name="current_index_soal" value="<?= $key ?>">
                                                    <button type="submit" name="select_soal" id="btn-<?= $list_soal['id_tokensoal'] ?>" style="border-radius: 5px;" class="btn-block btn-primary m-r-md"><?= $no ?></button>
                                                </form>
                                            </td>
                                <?php
                                            if (in_array($no, $arr_akhir_baris)) {
                                                echo "</tr>";
                                                echo "<tr>";
                                            }
                                            $no++;
                                        }
                                    }
                                    echo "</tr></table>";
                                }
                                ?>
                        <?php
                        }
                    }
                        ?>
                        <script type="text/javascript">
                            // document.getElementById("16").style.background = '#18A689';
                            // document.getElementById("16").style.hover = '#18A689';
                        </script>
                                </table>
                </div>

            </div>
        </div>
    </div>
</div>
</div> <!-- Mainly scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script>
    var now = moment().format('YYYY-MM-DD H:mm:ss');
    var then = moment().add(2, 'minutes');

    // var counter = function() {
    //     // var then = moment('2020-07-15 15:59:00', 'YYYY-MM-DD H:mm:ss').format('YYYY-MM-DD H:mm:ss');
    //     var hour = moment.utc(moment(now, "YYYY-MM-DD H:mm:ss").diff(moment(then, "YYYY-MM-DD H:mm:ss"))).format("H");
    //     var minute = moment.utc(moment(now, "YYYY-MM-DD H:mm:ss").diff(moment(then, "YYYY-MM-DD H:mm:ss"))).format("mm");
    //     var second = moment.utc(moment(now, "YYYY-MM-DD H:mm:ss").diff(moment(then, "YYYY-MM-DD H:mm:ss"))).format("ss");
    //     var count = (parseInt(hour * 60) + parseInt(minute)) + " menit " + second + " detik";
    //     const limit = 14;
    //     if (parseInt(count.substr(count.length - 5, count.length - 3)) >= parseInt(limit)) {
    //         console.log("Habis cuy");
    //     }
    document.getElementById('divCounter').innerHTML = then;
    //     console.log(count);
    // }
    // var interval = setInterval(counter, 1000);
</script>