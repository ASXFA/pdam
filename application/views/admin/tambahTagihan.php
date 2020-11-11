<?php 
    if ($this->session->flashdata('pesanInformasi')) {
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
            title: '<?= $this->session->flashdata('pesanInformasi') ?>'
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
                    title: '<?= $this->session->flashdata('pesanInformasi') ?>'
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
                <h1>Tambah Tagihan Baru</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?= base_url() ?>">Dashboard</a></li>
                    <li><a href="<?= base_url('tagihan') ?>">Tagihan</a></li>
                    <li class="active">Tambah Tagihan Baru</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<?php 
    $no_rekening = '';
    $nama = '';
    $alamat = '';
    $no_hp = '';
    $mtr_lama = '';
    $mtr_baru = '';
    $volume = '';
?>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Tambah Tagihan Baru</strong>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('tagihan/aksi_tambah') ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">No Rekening</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="no_rekening" name="no_rekening" class="form-control" readonly>
                                        <input type="text" id="pelanggan_id" name="pelanggan_id" class="form-control" hidden>
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
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Bulan</label>
                                    <div class="col-sm-10">
                                        <select name="periode" class="form-control">
                                            <option value="Januari">Januari</option>
                                            <option value="Februari">Februari</option>
                                            <option value="Maret">Maret</option>
                                            <option value="April">April</option>
                                            <option value="Mei">Mei</option>
                                            <option value="Juni">Juni</option>
                                            <option value="Juli">Juli</option>
                                            <option value="Agustus">Agustus</option>
                                            <option value="Sepetember">Sepetember</option>
                                            <option value="Oktober">Oktober</option>
                                            <option value="November">November</option>
                                            <option value="Desember">Desember</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Tahun</label>
                                    <div class="col-sm-10">
                                        <select name="tahun" class="form-control">
                                            <?php for($i = 2015; $i<2050; $i++){ ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Mtr Lama</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="mtr_lama" class="form-control" id="mtr_lama" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Mtr Baru</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="mtr_baru" class="form-control" id="mtr_baru">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Volume</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="volume" class="form-control" id="volume" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Detail</label>
                                    <div class="col-sm-10">
                                        <table class="table table-bordered">
                                            <thead>
                                                <th>Harga (Rp)</th>
                                                <th>Beban (Rp)</th>
                                                <th>Total (Rp)</th>
                                            </thead>
                                            <tbody>
                                                <td id="tbHarga"><h4>0</h4></td>
                                                <td id="tbBeban"><h4>0</h4></td>
                                                <td id="tbTotal"><h4>0</h4></td>
                                                <input type="text" id="total" name="total" hidden>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" id="btnSimpan" disabled class="btn btn-primary btn-sm">Simpan</button>
                                        <a href="" class="btn btn-danger btn-sm">Batal</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
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
                                                    url:'<?= base_url('tagihan/getPelanggan') ?>',
                                                    data:{id:id},
                                                    success:function(response){
                                                        $('#pelanggan_id').val(response.pelanggan_id);
                                                        $('#no_rekening').val(response.no_rekening);
                                                        $('#nama').val(response.nama);
                                                        $('#alamat').val(response.alamat);
                                                        $('#no_hp').val(response.no_hp);
                                                        $('#mtr_lama').val(response.mtr_lama);
                                                        $('#golongan').attr('value',response.golongan);
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
    $('#mtr_baru').change(function(){
        var mtr_lama = $('#mtr_lama').val();
        var mtr_baru = $('#mtr_baru').val();
        var volume = mtr_baru - mtr_lama;
        $('#volume').val(volume);
        var harga = 0;
        var beban = 0;
        var total = 0;
        var golongan = $('#golongan').val();

        $.ajax({
            method:'POST',
            dataType:'JSON',
            url:'<?= base_url('tagihan/ambilGolLevel') ?>',
            data:{golId:golongan,volume:volume},
            success:function(datas){
                harga += datas.harga;
                beban += parseInt(datas.beban);
                total += (beban + harga); 
                // masukan ke input
                $('#tbHarga').html('<h3>'+harga+'</h3>');
                $('#tbBeban').html('<h3>'+beban+'</h3>');
                $('#tbTotal').html('<h3>'+total+'</h3>');
                $('#total').val(total);
                $('#btnSimpan').removeAttr('disabled','disabled');
            }
        })
    })
</script>
