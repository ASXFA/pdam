<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="<?= base_url('assets/') ?>./">Nama Aplikasi</a>
            <a class="navbar-brand hidden" href="<?= base_url('assets/') ?>./"><img src="<?= base_url('assets/') ?>images/logo2.png" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="<?= base_url() ?>"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>
                <h3 class="menu-title">MENU</h3><!-- /.menu-title -->
                <li>
                    <a href="<?= base_url('tagihan') ?>"> <i class="menu-icon ti-money"></i>Tagihan </a>
                </li>   
                <?php  
                    if($this->session->userdata('level')!=2){
                ?>
                <li>
                    <a href="<?= base_url('pembayaran') ?>"> <i class="menu-icon ti-wallet"></i>Pembayaran </a>
                </li>
                <?php } ?>
                <?php  
                    if($this->session->userdata('level')== 0){
                ?>
                <li class="menu-item-has-children dropdown">
                    <a href="<?= base_url('assets/') ?>#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Master</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-th"></i><a href="<?= base_url('users') ?>">Users</a></li>
                        <li><i class="menu-icon fa fa-th"></i><a href="<?= base_url('golongan') ?>">Golongan</a></li>
                        <li><i class="menu-icon fa fa-th"></i><a href="<?= base_url('pelanggan') ?>">Pelanggan</a></li>
                        <li><i class="menu-icon fa fa-th"></i><a href="<?= base_url('level') ?>">Sistem</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?= base_url('pembayaran/laporan') ?>"> <i class="menu-icon ti-book"></i>Laporan </a>
                </li>
                <li>
                    <a href="<?= base_url('informasi') ?>"> <i class="menu-icon ti-info"></i>Informasi </a>
                </li>
                <?php } ?>
                <h3 class="menu-title">MY ACCOUNT</h3><!-- /.menu-title -->
                <li>
                    <a href="<?= base_url('users/detail/'.$this->session->userdata('id')) ?>"> <i class="menu-icon ti-user"></i>Profil </a>
                </li>
                <li>
                    <a href="<?= base_url('login/logout') ?>"> <i class="menu-icon ti-lock"></i>Logout </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->