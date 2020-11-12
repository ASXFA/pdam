<?php 
    if ($this->session->flashdata('pesanDashboard')) {
        if ($this->session->flashdata('kondisi')=="1") {
    ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: '<?= $this->session->flashdata('pesanDashboard') ?>'
        })
    </script>
    <?php
        }else{
    ?>
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'error',
                    title: '<?= $this->session->flashdata('pesanDashboard') ?>'
                })
            </script>
    <?php
        }
    }
?>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
<?php 
    if ($this->session->userdata('level')==2) {
?>
        <div class="col-lg-12 col-md-6">
            <h3>Hallo, <?= $this->session->userdata('nama') ?>. Selamat datang diaplikasi Rekening Air.</h3>
            <br>
            <p>Untuk mengecek tagihan air anda perbulan silahkan klik menu tagihan disebelah kiri ...</p>
        </div>
<?php
    }else{
?>
       <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-one">
                    <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                    <div class="stat-content dib">
                        <div class="stat-text">Data Pelanggan</div>
                        <div class="stat-digit"><?= $pelanggan ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-one">
                    <div class="stat-icon dib"><i class="ti-user text-success border-success"></i></div>
                    <div class="stat-content dib">
                        <div class="stat-text">Data Users</div>
                        <div class="stat-digit"><?= $users ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-one">
                    <div class="stat-icon dib"><i class="ti-list text-warning border-warning"></i></div>
                    <div class="stat-content dib">
                        <div class="stat-text">Data Tagihan</div>
                        <div class="stat-digit"><?= $tagihan ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-one">
                    <div class="stat-icon dib"><i class="ti-file text-danger border-danger"></i></div>
                    <div class="stat-content dib">
                        <div class="stat-text">Data Golongan</div>
                        <div class="stat-digit"><?= $golongan ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
?>
    <?php foreach($informasi as $in): ?>
        <div class="col-lg-12">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading"><?= $in->judul ?></h4>
                <hr>
                <?= $in->deskripsi ?>
            </div>
        </div>
    <?php endforeach; ?>
</div> <!-- .content -->
<!-- /#right-panel -->

<!-- Right Panel -->

