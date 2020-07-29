<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="<?= BASEURL; ?>/img/logo/ayotryout.png">
    <title>ayotryout.id</title>
    <link href="<?= BASEURL; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/css/animate.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/css/plugins/codemirror/codemirror.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/css/style.css" rel="stylesheet">

</head>

<body class="top-navigation">

    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom white-bg">
                <nav class="navbar navbar-static-top navbar-fixed-top" role="navigation">
                    <!-- header -->
                    <div class="navbar-header">
                        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                            <i class="fa fa-reorder"></i>
                        </button>
                        <a href="<?= BASEURL;?>/user/<?= strtolower($_SESSION['jenjang']);?> " class="navbar-brand">_ayotryout.id</a>
                    </div>
                    <div class="navbar-collapse collapse" id="navbar">
                        <ul class="nav navbar-nav">
                            <!-- <li>
                                <a aria-expanded="false" role="button" href="<?= BASEURL; ?>/user/profil"><?= $_SESSION['username']; ?> berhasil login</a>
                            </li> -->
                            <li>
                                <a aria-expanded="false" role="button" href="<?= BASEURL; ?>/user/profil"> Profil Saya</a>
                            </li>
                            <li>
                                <a aria-expanded="false" role="button" href="<?= BASEURL; ?>/user/histori"> Histori Ujian </a>
                            </li>
                            <li>
                                <a type="button" data-toggle="modal" data-target="#modalPetunjuk">Petunjuk Pengerjaan</a>
                            </li>
                        </ul>
                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <a href="<?= BASEURL; ?>/login/logout">
                                    <i class="fa fa-sign-out"></i> Log out
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <br /><br />
            </div>
            <div class="wrapper wrapper-content">


                <!-- Modal -->
                <div class="modal fade" id="modalPetunjuk" role="dialog">
                    <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" id="judulModal">Ubah data</h4>
                            </div>
                            <div class="modal-body">
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
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                            </div>
                        </div>

                    </div>
                </div>