<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <h3><strong>Welcome to Ayotryout.id</strong></h3>
        <br />
        <div>
            <img class="logo-name" src="<?= BASEURL ?>/img/logo/small-ayotryout.jpg" style="width: 300px; height: 150px ;"></img>
        </div>
        <br />
        <p>Silahkan Login</p>
        <div class="row">
            <?php Flasher::flash(); ?>
        </div>
        <form action="<?= BASEURL; ?>/login/cekLogin" method="POST" name="form-login" id="form-login" autocomplete="off">
            <input type="hidden" name="form-login" value="form-login">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" required="">
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" autocomplete="new-password" required="">
                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
            <div class="form-group">
                <input type="text" name="token" class="form-control" placeholder="Token" required="">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

            <a href="forgot.html"><small>Lupa password?</small></a>
            <p class="text-muted text-center"><small><strong>Tidak Punya Akun?</strong></small></p>
            <a class="btn btn-sm btn-white btn-block" href="<?= BASEURL ?>/register">Daftar
                Akun</a>
        </form>
        <p> <small>ayotryout.id &copy; 2020</small> </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/design.js"></script>

</body>

</html>