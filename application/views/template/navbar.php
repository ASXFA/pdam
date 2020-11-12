<div id="right-panel" class="right-panel">
<!-- Header-->
<header id="header" class="header">

    <div class="header-menu">

        <div class="col-sm-7">
            <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
            <div class="header-left">
                <!-- <button class="search-trigger"><i class="fa fa-search"></i></button> -->
            </div>
        </div>

        <div class="col-sm-5">
            <div class="user-area dropdown float-right">
                <h6 class="p-2">Login Sebagai : <?= $this->session->userdata('nama') ?> - <?php if($this->session->userdata('level')==0){echo "Administrasi";}else if($this->session->userdata('level')==1){echo "Petugas";}else{echo "Users";} ?> </h6>
            </div>
        </div>
    </div>

</header><!-- /header -->
<!-- Header-->
