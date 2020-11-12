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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">No Rekening</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="no_rekening" name="no_rekening" value="<?= $this->session->userdata('no_rekening') ?>" class="form-control" readonly>
                                            <input type="text" id="pelanggan_id" name="pelanggan_id" class="form-control" hidden>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="nama" value="<?= $this->session->userdata('nama') ?>" class="form-control" readonly>
                                            <input type="text" id="golongan" class="form-control" hidden>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                        <textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control" readonly><?= $pelanggan->alamat ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">HP</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="no_hp" class="form-control" value="<?= $pelanggan->no_hp ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Bulan</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="no_hp" class="form-control" value="<?= $tagihan2->periode ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Tahun</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="no_hp" class="form-control" value="<?= $tagihan2->tahun ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Mtr Lama</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="mtr_lama" class="form-control" id="mtr_lama" value="<?= $tagihan2->mtr_lama ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Mtr Baru</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="mtr_baru" class="form-control"  value="<?= $tagihan2->mtr_baru ?>" id="mtr_baru" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Volume Pemakaian</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="volume" class="form-control" id="volume" value="<?= $tagihan2->volume ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Detail</label>
                                        <div class="col-sm-10">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <th>Total (Rp)</th>
                                                </thead>
                                                <tbody>
                                                    <td id="tbTotal"><h4><?="Rp. ".number_format($tagihan2->total) ?></h4></td>
                                                    <input type="text" id="total" name="total" hidden>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
