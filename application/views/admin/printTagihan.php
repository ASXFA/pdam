<?php 
    $golongan = $this->golongan_model->getAll()->result();
    $tagihan = $this->tagihan_model->getAll()->result();
    $pelanggan = $this->pelanggan_model->getAll()->result();
?>
<?php $this->load->view('template/header')  ?>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Data Tagihan <?php if(isset($bulan)){echo $bulan;} if(isset($tahun)){echo $tahun;} if(isset($status_tagihan)){echo $status_tagihan;}  ?></h2>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No.Rek</th>
                            <th>Pelanggan</th>
                            <th>total</th>
                            <th>Periode</th>
                            <th>Tahun</th>
                            <th>Status Tagihan</th>
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
                                                ?>
                                                <tr>
                                                    <td>Nama </td>
                                                    <td><?= $p->nama ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat </td>
                                                    <td><?= $p->alamat ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Hp </td>
                                                    <td><?= $p->no_hp ?></td>
                                                </tr>
                                            <?php
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
                            </tr>
                        <?php $no++; endforeach; 
                        }else{
                    ?>
                    <?php $no=1; foreach($tagihan as $t): ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $t->no_rekening ?></td>
                            <td>
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <td>Nama</td>
                                        <td><?= $t->nama ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td><?= $t->alamat ?></td>
                                    </tr>
                                    <tr>
                                        <td>HP</td>
                                        <td><?= $t->no_hp ?></td>
                                    </tr>
                                </table>
                            </td>
                            <td>Rp. <?= number_format($t->total) ?></td>
                            <td><?= $t->periode ?></td>
                            <td><?= $t->tahun ?></td>
                            <td>
                                <?php 
                                    if ($t->status_tagihan == 0) {
                                        echo "<span class='badge badge-danger p-2'> BELUM BAYAR </span>";
                                    }else{
                                        echo "<span class='badge badge-success p-2'> LUNAS </span>";
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php $no++; endforeach; }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
<?php $this->load->view('template/footer')  ?>
