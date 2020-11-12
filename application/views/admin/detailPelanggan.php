<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="30%"><h5>No Rekening</h5></td>
                                    <td><?= $pelanggan->no_rekening ?></td>
                                </tr>
                                <tr>
                                    <td><h5>Nama Pelanggan</h5></td>
                                    <td><?= $pelanggan->nama ?></td>
                                </tr>
                                <tr>
                                    <td><h5>Alamat</h5></td>
                                    <td><?= $pelanggan->alamat ?></td>
                                </tr>
                                <tr>
                                    <td><h5>No Handphone</h5></td>
                                    <td><?= $pelanggan->no_hp ?></td>
                                </tr>
                                <tr>
                                    <td><h5>Golongan</h5></td>
                                    <td><?= $golongan->kode." | ".$golongan->nama ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h6>Riwayat Pembayaran</h6>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Periode</th>
                                    <th>Penggunaan</th>
                                    <th>Jumlah Tagihan</th>
                                    <th>Status Pembayaran</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($pembayaran as $p):
                                            foreach($tagihan as $t):
                                                if ($t->id == $p->tagihan_id) {
                                    ?>
                                                    <tr>
                                                        <td><?= $no ?></td>
                                                        <td><?= $t->periode ?></td>
                                                        <td><?= $t->volume ?> M<sup>3</sup></td>
                                                        <td>Rp. <?= number_format($t->total) ?></td>
                                                        <td>
                                                            <?php 
                                                                if ($t->status_tagihan == 1) {
                                                                    echo "LUNAS";
                                                                }else{
                                                                    echo "BELUM DIBAYAR";
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                        <a target="_blank" href="<?= base_url('pembayaran/invoice/'.$p->id) ?>" class="btn btn-warning btn-sm"><i class="fa fa-print" title="cetak" ></i> Cetak</a>
                                                        </td>
                                                    </tr>
                                    <?php
                                                }
                                            endforeach;
                                            $no++;
                                        endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>