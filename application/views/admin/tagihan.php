<?php 
    if ($this->session->flashdata('pesanTagihan')) {
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
            title: '<?= $this->session->flashdata('pesanTagihan') ?>'
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
                    title: '<?= $this->session->flashdata('pesanTagihan') ?>'
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
                <h1>Data Tagihan</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?= base_url() ?>">Dashboard</a></li>
                    <li class="active">Data Tagihan</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Data Tagihan</strong>
                        <?php 
                            if ($this->session->userdata('level') != 2) {
                        ?>  
                            <span class="float-right"><a href="<?= base_url('tagihan/tambah') ?>" class="btn btn-primary btn-sm" title="Tambah Tagihan"><i class="fa fa-plus"></i></a></span>
                            <?php
                            }
                        ?>
                    </div>
                    <div class="card-body">
                        <?php 
                            if ($this->session->userdata('level') != 2) {
                                ?>
                                <div class="card">
                                    <div class="card-body">
                                        <form action="" method="get">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <select name="tahun" id="tahun" class="form-control">
                                                    <option hidden>Semua</option>
                                                    <?php for($i=2010; $i<=2050; $i++){ ?>
                                                        <option value="<?= $i ?>" <?php if(isset($tahun)){ if($tahun == $i){echo "selected";}} ?> ><?= $i ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <select name="bulan" class="form-control">
                                                    <option hidden>Semua</option>
                                                    <option value="Januari" <?php if(isset($bulan)){ if($bulan == "Januari"){echo "selected";}} ?>>Januari</option>
                                                    <option value="Februari" <?php if(isset($bulan)){ if($bulan == "Februari"){echo "selected";}} ?>>Februari</option>
                                                    <option value="Maret" <?php if(isset($bulan)){ if($bulan == "Maret"){echo "selected";}} ?>>Maret</option>
                                                    <option value="April" <?php if(isset($bulan)){ if($bulan == "April"){echo "selected";}} ?>>April</option>
                                                    <option value="Mei" <?php if(isset($bulan)){ if($bulan == "Mei"){echo "selected";}} ?>>Mei</option>
                                                    <option value="Juni" <?php if(isset($bulan)){ if($bulan == "Juni"){echo "selected";}} ?>>Juni</option>
                                                    <option value="Juli" <?php if(isset($bulan)){ if($bulan == "Juli"){echo "selected";}} ?>>Juli</option>
                                                    <option value="Agustus" <?php if(isset($bulan)){ if($bulan == "Agustus"){echo "selected";}} ?>>Agustus</option>
                                                    <option value="Sepetember" <?php if(isset($bulan)){ if($bulan == "Sepetember"){echo "selected";}} ?>>Sepetember</option>
                                                    <option value="Oktober" <?php if(isset($bulan)){ if($bulan == "Oktober"){echo "selected";}} ?>>Oktober</option>
                                                    <option value="November" <?php if(isset($bulan)){ if($bulan == "November"){echo "selected";}} ?>>November</option>
                                                    <option value="Desember" <?php if(isset($bulan)){ if($bulan == "Desember"){echo "selected";}} ?>>Desember</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <select name="status_tagihan" class="form-control">
                                                    <option hidden>Semua</option>
                                                    <option value="0"  <?php if(isset($status_tagihan)){ if($status_tagihan == 0){echo "selected";}} ?>>Belum Bayar</option>
                                                    <option value="1"  <?php if(isset($status_tagihan)){ if($status_tagihan == 1){echo "selected";}} ?>>Lunas</option>
                                                </select>
                                            </div>

                                            <input type="text" name="filter" value="filter" hidden>

                                            <div class="col-md-1">
                                                <button type="submit" class="btn btn-primary d-inline"><i class="fa fa-search"></i></button>
                                            </div>
                                            <div class="col-md-2">
                                                <?php 
                                                    if (isset($_GET['filter'])) {
                                                        $bulanf = $_GET['bulan'];
                                                        $tahunf = $_GET['tahun'];
                                                        $status_tagihanf = $_GET['status_tagihan'];
                                                ?>
                                                    <a href="<?= base_url('tagihan/printPDFFilter/'.$bulanf.'/'.$tahunf.'/'.$status_tagihanf) ?>" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> Export Pdf</a>
                                                <?php
                                                    }else{                                            
                                                ?>
                                                <a href="<?= base_url('tagihan/printPDF') ?>" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> Export Pdf</a>
                                                <?php 
                                                    } 
                                                ?>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>No.Rek</th>
                                            <th>Pelanggan</th>
                                            <th>total</th>
                                            <th>Periode</th>
                                            <th>Tahun</th>
                                            <th>Status Tagihan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tagihan">
                                    <?php 
                                        if (isset($tagihan_filter)) {
                                    ?>
                                        <?php $no=1; foreach($tagihan_filter as $tf): ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td>
                                                    <?php 
                                                        foreach($pelanggan as $p):
                                                            if ($p->id == $tf->pelanggan_id) {
                                                                echo $p->no_rekening;
                                                            }
                                                            endforeach
                                                            ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        foreach($pelanggan as $p):
                                                            if ($p->id == $tf->pelanggan_id) {
                                                                echo $p->nama;
                                                            }
                                                        endforeach
                                                    ?>
                                                </td>
                                                <td>Rp. <?= number_format($tf->total) ?></td>
                                                <td><?= $tf->periode ?></td>
                                                <td><?= $tf->tahun ?></td>
                                                <td>
                                                    <?php 
                                                        if ($tf->status_tagihan == 0) {
                                                            echo "<span class='badge badge-danger p-2'> BELUM BAYAR </span>";
                                                        }else{
                                                            echo "<span class='badge badge-success p-2'> LUNAS </span>";
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                <?php 
                                                
                                                    foreach($pembayaran as $p): 
                                                        if($p->tagihan_id == $tf->id){
                                                        if($tf->status_tagihan == 1){
                                                ?>
                                                    <a target="_blank" href="<?= base_url('pembayaran/invoice/'.$p->id) ?>" class="btn btn-warning btn-sm"><i class="fa fa-print" title="cetak" ></i></a>
                                                        <?php }} endforeach ?>
                                                    <a href="" data-toggle="modal" data-target="#detailModal<?= $tf->id ?>" class="btn btn-warning btn-sm">Detail</a>
                                                </td>
                                            </tr>
                                        <?php $no++; endforeach; 
                                        }else{
                                    ?>
                                    <?php $no=1; foreach($tagihan as $tf): ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td>
                                                    <?php 
                                                        foreach($pelanggan as $p):
                                                            if ($p->id == $tf->pelanggan_id) {
                                                                echo $p->nama;
                                                            }
                                                        endforeach
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        foreach($pelanggan as $p):
                                                            if ($p->id == $tf->pelanggan_id) {
                                                                echo $p->no_rekening;
                                                            }
                                                        endforeach
                                                    ?>
                                                </td>
                                                <td>Rp. <?= number_format($tf->total) ?></td>
                                                <td><?= $tf->periode ?></td>
                                                <td><?= $tf->tahun ?></td>
                                                <td>
                                                    <?php 
                                                        if ($tf->status_tagihan == 0) {
                                                            echo "<span class='badge badge-danger p-2'> BELUM BAYAR </span>";
                                                        }else{
                                                            echo "<span class='badge badge-success p-2'> LUNAS </span>";
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                <?php 
                                                    foreach($pembayaran as $p): 
                                                        if($p->tagihan_id == $tf->id){
                                                        if($tf->status_tagihan == 1){
                                                ?>
                                                    <a target="_blank" href="<?= base_url('pembayaran/invoice/'.$p->id) ?>" class="btn btn-warning btn-sm"><i class="fa fa-print" title="cetak"></i></a>
                                                        <?php }} endforeach ?>
                                                    <a href="" data-toggle="modal" data-target="#detailModal<?= $tf->id ?>" class="btn btn-warning btn-sm">Detail</a>
                                                </td>
                                            </tr>
                                        <?php $no++; endforeach; }?>
                                    </tbody>
                                </table>
                        <?php
                            }else{
                        ?>
                            <table id="bootstrap-data-table-export" class="table table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Periode</th>
                                    <th>Tahun</th>
                                    <th>Penggunaan</th>
                                    <th>Jumlah Tagihan</th>
                                    <th>Status Pembayaran</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                            foreach($tagihan2 as $t):
                                    ?>
                                                    <tr>
                                                        <td><?= $no ?></td>
                                                        <td><?= $t->periode ?></td>
                                                        <td><?= $t->tahun ?></td>
                                                        <td><?= $t->volume ?> M<sup>3</sup></td>
                                                        <td>Rp. <?= number_format($t->total) ?></td>
                                                        <td>
                                                            <?php 
                                                                if ($t->status_tagihan == 1) {
                                                                    echo "<span class='badge badge-success'>LUNAS </span>";
                                                                }else{
                                                                    echo "<span class='badge badge-danger'>BELUM LUNAS </span>";
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                foreach($pembayaran as $p): 
                                                                    if($p->tagihan_id == $t->id){
                                                                ?>
                                                                <a target="_blank" href="<?= base_url('pembayaran/invoice/'.$p->id) ?>" class="btn btn-warning btn-sm"><i class="fa fa-print" title="cetak" ></i> Cetak</a>
                                                                <?php 
                                                                    }
                                                                    endforeach
                                                                ?>
                                                            
                                                        </td>
                                                    </tr>
                                    <?php
                                            $no++;
                                        endforeach;
                                    ?>
                                </tbody>
                            </table>
                            <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
<!-- Modal Edit -->
<?php 
    if ($this->session->userdata('level') != 2) {
    foreach($tagihan as $t): 
        foreach($pelanggan as $p):
            if ($p->id == $t->pelanggan_id) {
                $no_rekening = $p->no_rekening;
                $nama = $p->nama;
                $alamat = $p->alamat;
                $no_hp = $p->no_hp;
            }
        endforeach;
?>
<div class="modal fade" id="detailModal<?=  $t->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Tagihan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">No Rekening</label>
                                            <input type="text" id="no_rekening" name="no_rekening" class="form-control" value="<?= $no_rekening ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Nama</label>
                                            <input type="text" id="nama" class="form-control" value="<?= $nama ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Alamat</label>
                                            <textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control" readonly><?= $alamat ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">HP</label>
                                            <input type="text" id="no_hp" value="<?= $no_hp ?>" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Bulan</label>
                                            <input type="text" id="bulan" value="<?= $t->periode ?>" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Tahun</label>
                                            <input type="text" class="form-control" value="<?= $t->tahun ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Mtr Lama</label>
                                            <input type="number" name="mtr_lama" class="form-control" id="mtr_lama" value="<?= $t->mtr_lama ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Mtr Baru</label>
                                            <input type="number" name="mtr_baru" class="form-control" value="<?= $t->mtr_baru ?>" id="mtr_baru" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Volume</label>
                                            <input type="number" name="volume" class="form-control" id="volume" value="<?= $t->volume ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Total Tagihan</label>
                                            <h3>Rp. <?= number_format($t->total) ?></h3>
                                        </div>
                                        <div class="form-group mt-3">
                                                <?php 
                                                    if ($t->status_tagihan == 0) {
                                                        echo "<span class='badge badge-danger p-2'> BELUM BAYAR </span>";
                                                    }else{
                                                        echo "<span class='badge badge-success p-2'> LUNAS </span>";
                                                    }
                                                ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; }?>