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
                <nav class="navbar navbar-static-top" role="navigation">
                    <div class="navbar-header">
                        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                            <i class="fa fa-reorder"></i>
                        </button>
                        <a href="<?= BASEURL; ?>/admin" class="navbar-brand">_ayotryout.id</a>
                    </div>
                    <div class="navbar-collapse collapse" id="navbar">
                        <ul class="nav navbar-nav">
                            <li class="active">
                                <a aria-expanded="false" role="button" href=""> <?= $_SESSION['username']; ?> berhasil
                                    login</a>
                            </li>
                            <li>
                                <a aria-expanded="false" role="button" href="<?= BASEURL; ?>/admin/profil"> Profil Saya
                                </a>
                            </li>
                            <li class="dropdown">
                                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Impor Soal <span class="caret"></span></a>
                                <ul role="menu" class="dropdown-menu">
                                    <?php foreach ($data['jenjang_navbar'] as $jenjang) : ?>
                                        <li><a href="<?= BASEURL; ?>/admin/impor/<?= strtolower($jenjang['jenjang']); ?>">Impor soal <?= strtoupper($jenjang['jenjang']); ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Token <span class="caret"></span></a>
                                <ul role="menu" class="dropdown-menu">
                                    <?php
                                    foreach ($data['jenjang_navbar'] as $jenjang) : ?>
                                        <li><a href="<?= BASEURL; ?>/admin/token/<?= strtolower($jenjang['jenjang']); ?>">Token <?= strtoupper($jenjang['jenjang']); ?></a></li>
                                    <?php endforeach; ?>

                                </ul>
                            </li>
                            <li>
                                <a aria-expanded="false" role="button" href="<?= BASEURL; ?>/admin/akun"> Daftar Akun
                                </a>
                            </li>
                            <li class="dropdown">
                                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Daftar Soal <span class="caret"></span></a>
                                <ul role="menu" class="dropdown-menu">
                                    <?php foreach ($data['jenjang_navbar'] as $jenjang) : ?>
                                        <li><a href="<?= BASEURL; ?>/admin/index/<?= strtolower($jenjang['jenjang']); ?>"><?= strtoupper($jenjang['jenjang']); ?></a></li>
                                    <?php endforeach; ?>

                                </ul>
                            </li>
                            <li>
                                <a aria-expanded="false" role="button" href="<?= BASEURL; ?>/admin/riwayat">Riwayat User
                                </a>
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
            </div>
            <div class="wrapper wrapper-content">