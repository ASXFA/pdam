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
                <h1>Data Laporan Pembayaran</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?= base_url() ?>">Dashboard</a></li>
                    <li class="active">Data Laporan Pembayaran</li>
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
                        <strong class="card-title">Data Laporan Pembayaran</strong>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="get">
                                <div class="row">
                                    <div class="col-md-2">
                                        <select name="tahun" id="tahun" class="form-control">
                                            <option>Semua</option>
                                            <?php for($i=2010; $i<=2050; $i++){ ?>
                                                <option value="<?= $i ?>" <?php if(isset($_GET['tahun'])){ if($_GET['tahun'] == $i){echo "selected";}} ?>><?= $i ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="bulan" class="form-control">
                                            <option>Semua</option>
                                            <option value="1" <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 1){echo "selected";}} ?>>Januari</option>
                                            <option value="2" <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 2){echo "selected";}} ?> >Februari</option>
                                            <option value="3" <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 3){echo "selected";}} ?> >Maret</option>
                                            <option value="4" <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 4){echo "selected";}} ?>>April</option>
                                            <option value="5" <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 5){echo "selected";}} ?>>Mei</option>
                                            <option value="6" <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 6){echo "selected";}} ?>>Juni</option>
                                            <option value="7" <?php if(isset($bula_GET['bulan'])){ if($_GET['bulan'] == 7){echo "selected";}} ?>>Juli</option>
                                            <option value="8" <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 8){echo "selected";}} ?>>Agustus</option>
                                            <option value="9" <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 9){echo "selected";}} ?>>Sepetember</option>
                                            <option value="10" <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 10){echo "selected";}} ?>>Oktober</option>
                                            <option value="11" <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 11){echo "selected";}} ?>>November</option>
                                            <option value="12" <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 12){echo "selected";}} ?>>Desember</option>
                                        </select>
                                    </div>

                                    <input type="text" name="filter" value="filter" hidden>

                                    <div class="col-md-1 mr-3">
                                        <button type="submit" class="btn btn-primary d-inline">Tampilkan</button>
                                    </div>
                                    <?php if(isset($_GET['filter'])){ ?>
                                    <div class="col-md-1">
                                        <a href="<?= base_url('pembayaran/printPdfFilter/'.$_GET['bulan'].'/'.$_GET['tahun']) ?>" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> Ekspor Ke PDF</a>
                                    </div>
                                    <?php } ?>
                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">Untuk Cetak Laporan Pembayaran</h4> 
                                    <p>Pilih Tahun dan atau Bulan yang diperlukan untuk mencetak data berdasarkan bulan dan atau tanggal yang anda butuhkan. kemudian klik Tampilkan. Lalu ekspor untuk mengunduhnya sebagai ekstensi PDF </p>
                                </div>
                            </div>
                        </div>
                        <?php if(isset($pembayaran)){ ?>
                            <table id="bootstrap-data-table-export" class="table table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Pelanggan</th>
                                    <th>Volume Pemakaian</th>
                                    <th>Periode</th>
                                    <th>Total Tagihan</th>
                                    <th>Dibayar Pada</th>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach($pembayaran as $p): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td>
                                            <?php  
                                                foreach($pelanggan as $pel):
                                                    if ($pel->id == $p->pelanggan_id) {
                                                        echo $pel->nama;
                                                    }
                                                endforeach;
                                            ?>
                                        </td>
                                        <?php  
                                            foreach($tagihan as $t):
                                                if ($t->id == $p->tagihan_id) {
                                                    echo "<td>".$t->volume." M<sup>3</sup></td>";
                                                    echo "<td>".$t->periode."</td>";
                                                    echo "<td> Rp. ".number_format($t->total)."</td>";
                                                }
                                            endforeach;
                                        ?>
                                        <td><?= date('d F Y H:i:s', strtotime($p->created_at)) ?></td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
