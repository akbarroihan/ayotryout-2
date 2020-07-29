<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content" style="padding: 25px; margin-top: 45px;">
                    <div class="row">
                        <h1 class="baris-tengah"> Petunjuk mengerjakan Try Out :</h1>
                        
                    </div>
                    <br>
                    <div class="alert alert-info" style="padding: 30px; margin-left:25px;margin-right:25px;">

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
                            <input type="hidden" name="id_sub" value="<?= $data['id_sub'];?>">
                            <button class="btn btn-success" name="first_soal" type="submit">

                                <h3>Mulai Try Out!</h3>

                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>