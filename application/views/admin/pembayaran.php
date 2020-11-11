<?php 
    if ($this->session->flashdata('pesanPembayaran')) {
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
            title: '<?= $this->session->flashdata('pesanPembayaran') ?>'
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
                    title: '<?= $this->session->flashdata('pesanPembayaran') ?>'
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
                <h1>Pembayaran</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?= base_url() ?>">Dashboard</a></li>
                    <li class="active">Pembayaran</li>
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
                        <strong class="card-title">Pemabayaran</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">No Rekening</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="no_rekening" name="no_rekening" class="form-control" readonly>
                                        <input type="text" id="pelanggan_id" name="pelanggan_id" class="form-control" hidden>
                                        <input type="text" id="tagihan_id" name="tagihan_id" class="form-control" hidden>
                                    </div>
                                    <a href="" data-toggle="modal" data-target="#modalCari" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Cari</a>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="nama" class="form-control" readonly>
                                        <input type="text" id="golongan" class="form-control" hidden>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                       <textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control" readonly></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">HP</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="no_hp" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Tagihan</label>
                                    <div class="col-sm-10">
                                        <table class="table table-bordered">
                                            <thead>
                                                <th>Bulan</th>
                                                <th>Jumlah (Rp)</th>
                                                <th>Denda (Rp)</th>
                                                <th>SubTotal (Rp)</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <p id="bulanTagihan">-</p>
                                                    </td>
                                                    <td>
                                                        <p id="jumlahTagihan">0</p>
                                                    </td>
                                                    <td>
                                                        <p id="dendaTagihan">0</p>
                                                    </td>
                                                    <td>
                                                        <p id="totalTagihan">0</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"><h6>TOTAL</h5></t6>
                                                    <td>
                                                        <p id="totalSemua">0</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Cash</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="cash" class="form-control" value="0" id="cash">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Kembalian</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="kembali" class="form-control" id="kembalian" value="0" readonly>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button id="btnSimpan" disabled class="btn btn-primary btn-sm">Proses</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
<!-- Modal -->
<div class="modal fade" id="modalCari" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No Rekening</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Golongan</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no=1;
                                    foreach($pelanggan as $p):
                                ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><a href=""><?= $p->no_rekening ?></a></td>
                                    <td><?= $p->nama ?></td>
                                    <td><?= $p->golongan ?></td>
                                    <td><?= $p->alamat ?></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" id="pilih<?= $p->id ?>" title="Pilih" data-dismiss="modal">Pilih</button>
                                        <script src="<?= base_url('assets/') ?>vendors/jquery/dist/jquery.min.js"></script>
                                        <script>
                                            $('#pilih<?= $p->id ?>').click(function(){
                                                var id = <?= $p->id ?>;
                                                $.ajax({
                                                    method:'POST',
                                                    dataType:'JSON',
                                                    url:'<?= base_url('pembayaran/getPelanggan') ?>',
                                                    data:{id:id},
                                                    success:function(response){
                                                        if (response.kondisi == 0) {
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
                                                                title: response.pesanPembayaran
                                                            })
                                                        }else{
                                                            $('#tagihan_id').val(response.tagihan_id);
                                                            $('#pelanggan_id').val(response.pelanggan_id);
                                                            $('#no_rekening').val(response.no_rekening);
                                                            $('#nama').val(response.nama);
                                                            $('#alamat').val(response.alamat);
                                                            $('#no_hp').val(response.no_hp);
                                                            $('#bulanTagihan').html(response.periode);
                                                            if (typeof response.denda !== 'undefined') {
                                                                $('#dendaTagihan').html(response.denda);   
                                                                $('#jumlahTagihan').html(response.total);
                                                                var hitungSubTotal = parseInt(response.total) + parseInt(response.denda);
                                                                $('#totalTagihan').html(hitungSubTotal);
                                                                $('#totalSemua').html(formatRupiah(String(hitungSubTotal)))
                                                            }else{
                                                                var totalConv = formatRupiah(response.total,'Rp. ');
                                                                $('#jumlahTagihan').html(response.total);
                                                                $('#totalTagihan').html(response.total);
                                                                $('#totalSemua').html(totalConv);
                                                            }
                                                        }
                                                    }
                                                })
                                            })
                                        </script>
                                    </td>
                                </tr>
                                <?php $no++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/') ?>vendors/jquery/dist/jquery.min.js"></script>
<script>
    $('#cash').keyup(function(){
        var cash = parseInt($('#cash').val());
        var totalSemua = parseInt($('#totalTagihan').text());
        var hitungKembalian = cash - totalSemua;
        $('#kembalian').val(hitungKembalian);
        if (totalSemua!="") {
            $('#btnSimpan').removeAttr('disabled','disabled');
        }
    });
    $('#cash').change(function(){
        var cashes = String($('#cash').val());
        $('#cash').val(formatRupiah(cashes,'Rp. '));
        var kembalian = String($('#kembalian').val());
        $('#kembalian').val(formatRupiah(kembalian,'Rp. '));
    })

    $('#btnSimpan').click(function(){
        var pelanggan_id = $('#pelanggan_id').val();
        var tagihan_id = $('#tagihan_id').val();
        var cash = String($('#cash').val());
        var kembalian = String($('#kembalian').val());

        $.ajax({
            method:'POST',
            dataType:'JSON',
            url:'<?= base_url('pembayaran/tambah') ?>',
            data:{pelanggan_id:pelanggan_id,tagihan_id:tagihan_id,cash:cash,kembalian:kembalian},
            success:function(response){
                if (response.kondisi == '1') {
                    let timerInterval
                    Swal.fire({
                        title: response.pesanPembayaran,
                        html: 'Mohon tunggu ... <b></b>',
                        timer: 4000,
                        timerProgressBar: true,
                        willOpen: () => {
                            Swal.showLoading()
                            timerInterval = setInterval(() => {
                            const content = Swal.getContent()
                            if (content) {
                                const b = content.querySelector('b')
                                if (b) {
                                b.textContent = Swal.getTimerLeft()
                                }
                            }
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                        }).then((result) => {
                        var url='<?= base_url('pembayaran/invoice/') ?>'+response.pembayaran_id;
                        var urlRefresh = '<?= base_url('pembayaran') ?>';

                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.open(url,'_blank');
                            window.location.href = urlRefresh;
                        }else{
                            window.open(url,'_blank');
                            window.location.href = urlRefresh;
                        }
                    })
                }
            }
        })
    })

    function formatRupiah(angka, prefix){
        const neg = angka.startsWith('-');
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        if(neg) rupiah = '-'.concat(rupiah);
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
