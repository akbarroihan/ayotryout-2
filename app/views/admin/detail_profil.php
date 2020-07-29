<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content" style="padding: 40px;">
                    <div class="row">
                        <h2 class="baris-tengah">Profile User</h2>
                    </div>
                    <div class="row">
                        <label>Username</label>
                        <div class="alert alert-info">
                            <?= $_SESSION['username'];?>
                        </div>
                    </div>
                    <div class="row">
                        <label>Email</label>
                        <div class="alert alert-info">
                            <?= $_SESSION['email'];?>
                        </div>
                    </div>
                    <div class="row">
                        <label>No Telp.</label>
                        <div class="alert alert-info">
                            <?= $_SESSION['telepon'];?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>