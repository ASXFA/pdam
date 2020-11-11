<?php 
    if ($this->session->flashdata('pesanGolongan')) {
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
            title: '<?= $this->session->flashdata('pesanGolongan') ?>'
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
                    title: '<?= $this->session->flashdata('pesanGolongan') ?>'
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
                <h1>Data Golongan</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?= base_url() ?>">Dashboard</a></li>
                    <li class="active">Data Golongan</li>
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
                        <strong class="card-title">Data Golongan</strong>
                        <span class="float-right"><a href="" data-toggle="modal" data-target="#tambahModal" class="btn btn-primary btn-sm" title="Tambah Data"><i class="fa fa-plus"></i></a></span>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Nama Golongan</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no=1;
                                    foreach($golongan as $g):
                                ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $g->kode ?></td>
                                    <td><?= $g->nama ?></td>
                                    <td>
                                        <table class="table table-bordered">
                                            <?php 
                                                if (isset($golongan_level)) {
                                                foreach($golongan_level as $gl ):
                                                    if ($gl->golongan_id == $g->id) {
                                            ?>
                                                        <tr>
                                                            <td>Level <?= $gl->level ?></td>
                                                            <?php 
                                                                foreach($level as $l):
                                                                    if ($l->id == $gl->deskripsi) {
                                                                        echo "<td>";
                                                                        if ($l->operand != "") {
                                                                            echo $l->operand;
                                                                        }
                                                                        echo $l->nilai_awal;
                                                                        if ($l->nilai_akhir != 0) {
                                                                            echo " - ".$l->nilai_akhir;
                                                                        }
                                                                        echo " M<sup>3</sup>";
                                                                    } 
                                                                    echo "</td>";
                                                                endforeach;
                                                            ?>
                                                            <td>Rp. <?= number_format($gl->harga) ?></td>
                                                        </tr>
                                            <?php
                                                    }
                                                endforeach;
                                                }
                                            ?>
                                            <tr>
                                                <td>Beban</td>
                                                <td>Rp. <?= number_format($g->beban) ?> / Bulan</td>
                                            </tr>
                                            <tr>
                                                <td>Tempo</td>
                                                <td colspan="3"><?= "Tanggal ".$g->tempo ?> Setiap Bulan</td>
                                            </tr>
                                            <tr>
                                                <td>Denda</td>
                                                <td colspan="3">Rp.<?= number_format($g->denda) ?> / Bulan</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <?php 
                                            if ($g->status == 1) {
                                                echo "<span class='badge badge-success p-2'> AKTIF </span>";
                                            }else{
                                                echo "<span class='badge badge-danger p-2'> BELUM AKTIF </span>";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            if ($g->status == 0) {
                                        ?>
                                                <a href="<?= base_url('golongan/gantiStatus/'.$g->id.'/1') ?>" id="btnStatus<?= $no ?>" class="btn btn-success btn-sm" title="Ganti Status Aktif"><i class="fa fa-check"></i></a>
                                        <?php
                                            }else{
                                        ?>
                                                <a href="<?= base_url('golongan/gantiStatus/'.$g->id.'/0') ?>" id="btnStatus<?= $no ?>" class="btn btn-danger btn-sm" title="Ganti Status Aktif"><i class="fa fa-times"></i></a>
                                        <?php
                                            }
                                        ?>
                                        <script src="<?= base_url('assets/') ?>vendors/jquery/dist/jquery.min.js"></script>
                                        <script>
                                            $('#btnStatus<?= $no ?>').on('click', function (e) {
                                                e.preventDefault();
                                                const url = $(this).attr('href');
                                                swal.fire({
                                                    title: 'Ganti Status Pelanggan ?',
                                                    text: 'Status akan berubah menjadi Aktif !',
                                                    icon: 'info',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#3085d6',
                                                    cancelButtonColor: '#d33',
                                                    confirmButtonText: 'Yakin, Ganti !'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        window.location.href = url;   
                                                    }
                                                });
                                            });
                                        </script>
                                        <a href="" data-toggle="modal" data-target="#editModal<?= $g->id ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="<?= base_url('golongan/hapus/'.$g->id) ?>" id="btnHapus<?=$no ?>" class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash"></i></a>
                                        <script src="<?= base_url('assets/') ?>vendors/jquery/dist/jquery.min.js"></script>
                                        <script>
                                            $('#btnHapus<?= $no ?>').on('click', function (e) {
                                                e.preventDefault();
                                                const url = $(this).attr('href');
                                                swal.fire({
                                                    title: 'Yakin menghapus data ?',
                                                    text: 'Data akan terhapus secara permanen !',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#3085d6',
                                                    cancelButtonColor: '#d33',
                                                    confirmButtonText: 'Yakin, Hapus !'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        window.location.href = url;   
                                                    }
                                                });
                                            });
                                        </script>
                                    </td>
                                </tr>
                                <?php $no++; endforeach;  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Golongan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('golongan/tambah') ?>" method="post">
            <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-control-label">Kode</label>
                                <input type="text" class="form-control" name="kode">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Nama Golongan</label>
                                <input type="text" class="form-control" name="nama_golongan">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Beban</label>
                                <input type="text" class="form-control" name="beban">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-control-label">Tempo (Tanggal)</label>
                                <input type="number" class="form-control" min="0" max="30" name="tempo">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Denda (PerBulan)</label>
                                <input type="number" class="form-control" min="0" name="denda">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" id="btnTambahLevel" class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus"></i> Tambah Form Level</button>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label form-control-label">Level</label>
                                                <select name="level[]" id="" class="form-control">
                                                    <?php for($i=1; $i<=10; $i++){ ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>   
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Harga Per Level</label>
                                                <input type="number" name="harga_level[]" class="form-control">
                                            </div>                   
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Deksripsi</label>
                                                <select name="deskripsi[]" id="" class="form-control">
                                                    <?php foreach($level as $l): ?>
                                                    <option value="<?= $l->id ?>">
                                                        <?php 
                                                            if ($l->operand != "") {
                                                                echo $l->operand;
                                                            }
                                                            echo $l->nilai_awal;
                                                            if ($l->nilai_akhir != 0) {
                                                                echo " - ".$l->nilai_akhir;
                                                            }
                                                            echo " M<sup>3</sup>";
                                                        ?>
                                                    </option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tambahLevel">
                                
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit -->
<?php foreach($golongan as $g): ?>
<div class="modal fade" id="editModal<?= $g->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('golongan/edit/'.$g->id) ?>" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-control-label">Kode</label>
                                <input type="text" class="form-control" name="kode" value="<?= $g->kode ?>">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Nama Golongan</label>
                                <input type="text" class="form-control" name="nama_golongan" value="<?= $g->nama ?>">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Beban</label>
                                <input type="text" class="form-control" name="beban" value="<?= $g->beban ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-control-label">Tempo (Tanggal)</label>
                                <input type="number" class="form-control" min="0" max="30" name="tempo" value="<?= $g->tempo ?>">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Denda (PerBulan)</label>
                                <input type="number" class="form-control" min="0" name="denda" value="<?= $g->denda ?>">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <?php 
                                $no = 1;
                                foreach($golongan_level as $gl): 
                                    if ($gl->golongan_id == $g->id) {
                            ?>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="label form-control-label">Level</label>
                                                            <input type="text" value="<?= $gl->id ?>" name="ids[]" hidden>
                                                            <select name="level[]" id="" class="form-control">
                                                                <?php for($i=1; $i<=10; $i++){ ?>
                                                                <option value="<?= $i ?>" <?php if($gl->level == $i){echo "selected";} ?> ><?= $i ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>   
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Harga Per Level</label>
                                                            <input type="number" name="harga_level[]" value="<?= $gl->harga ?>" class="form-control">
                                                        </div>                   
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Deksripsi</label>
                                                            <select name="deskripsi" id="" class="form-control">
                                                                <?php foreach($level as $l): ?>
                                                                <option value="<?= $l->id ?>" <?php if($l->id == $gl->deskripsi){echo "selected";} ?>>
                                                                    <?php 
                                                                        if ($l->operand != "") {
                                                                            echo $l->operand;
                                                                        }
                                                                        echo $l->nilai_awal;
                                                                        if ($l->nilai_akhir != 0) {
                                                                            echo " - ".$l->nilai_akhir;
                                                                        }
                                                                        echo " M<sup>3</sup>";
                                                                    ?>
                                                                </option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            <?php
                                    }
                                    $no++;
                                endforeach;
                            ?>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach ?>
<script src="<?= base_url('assets/') ?>vendors/jquery/dist/jquery.min.js"></script>
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script> -->
<script>
    var count = 1;
    $('#btnTambahLevel').click(function(){
        if (count == 3) {
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
                title: 'Anda tidak bisa menambah form lagi'
            })
        }else{
            $.ajax({
                method:"GET",
                dataType:"JSON",
                url:"<?= base_url('level/getLevelJson') ?>",
                success:function(response){
                    var html ='' ; 
                    html += "<div class='card'>";
                    html += "<div class='card-body'>";
                    html += "<div class='row'>";
                    html += "<div class='col-md-6'>";
                    html += "<div class='form-group'>";
                    html += "<label class='form-control-label'>Level</label>";
                    html += "<select class='form-control' name='level[]'>";
                    html += "<option value='1'>1</option>";
                    html += "<option value='2'>2</option>";
                    html += "<option value='3'>3</option>";
                    html += "<option value='4'>4</option>";
                    html += "<option value='5'>5</option>";
                    html += "<option value='6'>6</option>";
                    html += "<option value='7'>7</option>";
                    html += "<option value='8'>8</option>";
                    html += "<option value='9'>9</option>";
                    html += "<option value='9'>10</option>";
                    html += "</select>";
                    html += "</div>";
                    html += "<div class='form-group'>";
                    html += "<label class='form-control-label'>Harga Per Bulan</label>";
                    html += "<input type='number' name='harga_level[]' class='form-control'>";
                    html += "</div>";
                    html += "</div>";
                    html += "<div class='col-md-6'>";
                    html += "<div class='form-group'>";
                    html += "<label class='form-control-label'>Deskripsi</label>";
                    html += "<select name='deskripsi[]' class='form-control'>";
                    var j= 0;
                    for(j; j<response.length; j++){
                        if (response[j].operand == null) {
                            html += "<option value='"+response[j].id+"'>"+response[j].nilai_awal+" - "+response[j].nilai_akhir+" M<sup>3</sup> </option>";
                        }else if(response[j].nilai_akhir == 0){
                            html += "<option value='"+response[j].id+"'>"+response[j].operand+" "+response[j].nilai_awal+" M<sup>3</sup> </option>";
                        }else{
                            html += "<option value='"+response[j].id+"'>"+response[j].operand+" "+response[j].nilai_awal+" - "+response[j].nilai_akhir+" M<sup>3</sup> </option>";
                        }
                    }
                    html += "</select>";
                    html += "</div>";
                    html += "</div>";
                    html += "</div>";
                    html += "</div>";
                    html += "</div>";

                    $('#tambahLevel').append(html);
                    var id = '#editor'+count;
                    count += 1;

                }
            })
        }
    })
</script>