<div class="content">
    <div class="container"> 
        <div class="card">
            <div class="card-header">
                Invoice
                <strong><?php $date = date('d F Y H:i:s', strtotime($pembayaran->created_at)); echo $date; ?></strong> 
                <span class="float-right"> <strong>Status:</strong> <?php if($tagihan->status_tagihan == 1){echo "LUNAS";}else{echo "BELUM LUNAS";} ?> </span>

            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="mb-3">Pelanggan :</h6>
                        <div>
                            <strong><?= $pelanggan->nama ?></strong>
                        </div>
                        <div>
                            <strong><?= $pelanggan->no_rekening ?></strong>
                        </div>
                        <div><?= $pelanggan->alamat ?></div>
                        <div><?= "Hp : ".$pelanggan->no_hp ?></div>
                    </div> 
                </div>
            <div class="table-responsive-sm">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="center">#</th>
                            <th class="text-center">Periode</th>
                            <th class="text-center">Tahun</th>
                            <th class="text-center">Volume</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="center">1</td>
                            <td class="text-center"><?= $tagihan->periode ?></td>
                            <td class="text-center"><?= $tagihan->tahun ?></td>
                            <td class="text-center"><?= $tagihan->volume ?> M<sup>3</sup></td>
                            <td class="text-right">Rp. <?= number_format($tagihan->total) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-5 col-sm-5"></div>
                <div class="col-lg-7 col-sm-5 ml-auto">
                    <table class="table table-clear">
                        <tbody class="text-right">
                            <tr>
                                <td class="left">
                                    <strong>Total</strong>
                                </td>
                                <td class="right">
                                    <strong>Rp. <?= number_format($tagihan->total) ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>Uang yang diberikan</strong>
                                </td>
                                <td class="right">
                                    <strong><?= $pembayaran->cash ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>Kembalian</strong>
                                </td>
                                <td class="right">
                                    <strong><?= $pembayaran->kembalian ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>Dilayani Oleh</strong>
                                </td>
                                <td class="right">
                                    <strong><?= $this->session->userdata('nama') ?></strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/') ?>vendors/jquery/dist/jquery.min.js"></script>
<script>
    window.print();
</script>