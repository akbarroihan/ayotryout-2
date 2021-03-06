    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>
                <img class="logo-name" src="img/logo/small-ayotryout.jpg" style="width: 300px; height: 150px ;"></img>
            </div>
            <br />
            <h3><strong>Buat Akun Ayotryout.id</strong></h3>
            <div class="row">
                <?php Flasher::flash(); ?>
            </div>
                </form>
                    <form action="<?= BASEURL; ?>/register/cekregister" method="POST" name="form-register" id="form-register" autocomplete="off">
                    <!-- <input type="hidden" name="form-name" value="form-register"> -->
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nama" required="">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required="">
                    </div>
                    <div class="form-group">
                        <input type="number" name="telepon" class="form-control" placeholder="No. Telp" required="">
                    </div>
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username" required="">
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" autocomplete="new-password" required="">
                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" id="re-password" name="re-password" class="form-control" placeholder="Ulangi Password" autocomplete="new-password" required="">
                        <span toggle="#re-password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>

                    <h3><strong> - Pembayaran - </strong></h3>
                    <div class="form-group">
                    <select name="pilihan _jenjang" id="pilihan_jenjang" class="form-control" required>
                        <option value="">- Pilih -</option>
                        <option biaya="5000" value="sd">SD</option>
                        <option biaya="10000" value="sma">SMA</option>
                        <option biaya="25000" value="stan_ptkin">STAN/PTKIN</option>
                    </select>
                    
                    </div>

                    <div class="form-group">
                        <select name="metode_bayar" id="metode_bayar" class="form-control" required>
                            <option value="">- Pilih -</option>
                            <option value="VC">VISA</option>
                            <option value="BK">BCA Klik Play</option>
                        </select>
                    </div>

                    <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Rp. </span>
                        <input type="number" id="biaya" min="0" step="any" class="form-control" name="biaya" placeholder="Biaya yang diperlukan" aria-describedby="addon-wrapping" disabled>
                        <span class="input-group-addon">,00</span>
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> <strong> Setuju terhadap
                                persyaratan dan kebijakan</strong>
                        </label></div>
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">Daftar</button>
                    <p class="text-muted text-center"><small><strong>Sudah Punya Akun?</strong></small></p>
                    <a class="btn btn-sm btn-white btn-block" href="<?= BASEURL ?>/login">Login</a>
                </form>
            <p class="m-t"> <small>ayotryout.id &copy; 2020</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/design.js"></script>
    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
 
        $("#pilihan_jenjang").on("change", function(){
        // ambil nilai
        var biaya = $("#pilihan_jenjang option:selected").attr("biaya");
        // pindahkan nilai ke input
        $("#biaya").val(biaya);
        });

        });
    </script>
</body>

</html>