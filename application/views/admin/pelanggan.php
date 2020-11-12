<?php 
    if ($this->session->flashdata('pesanPelanggan')) {
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
            title: '<?= $this->session->flashdata('pesanPelanggan') ?>'
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
                    title: '<?= $this->session->flashdata('pesanPelanggan') ?>'
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
                <h1>Data Pelanggan</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?= base_url() ?>">Dashboard</a></li>
                    <li class="active">Data Pelanggan</li>
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
                        <strong class="card-title">Data Pelanggan</strong>
                        <span class="float-right"><a href="" data-toggle="modal" data-target="#tambahModal" class="btn btn-primary btn-sm" title="Tambah Data"><i class="fa fa-plus"></i></a></span>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No Rekening</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Alamat</th>
                                    <th>Golongan</th>
                                    <th>No HP</th>
                                    <th>Status</th>
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
                                    <td><a href="<?= base_url('pelanggan/detailPelanggan/'.$p->no_rekening) ?>"><?= $p->no_rekening ?></a></td>
                                    <td><?= $p->nama ?></td>
                                    <td><?= $p->alamat ?></td>
                                    <td><?= $p->golongan ?></td>
                                    <td><?= $p->no_hp ?></td>
                                    <td>
                                        <?php 
                                            if ($p->status == 1) {
                                                echo "<span class='badge badge-success p-2'> AKTIF </span>";
                                            }else{
                                                echo "<span class='badge badge-danger p-2'> BELUM AKTIF </span>";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            if ($p->status == 0) {
                                        ?>
                                                <a href="<?= base_url('pelanggan/gantiStatus/'.$p->id.'/1') ?>" id="btnStatus<?= $no ?>" class="btn btn-success btn-sm" title="Ganti Status Aktif"><i class="fa fa-check"></i></a>
                                        <?php
                                            }else{
                                        ?>
                                                <a href="<?= base_url('pelanggan/gantiStatus/'.$p->id.'/0') ?>" id="btnStatus<?= $no ?>" class="btn btn-danger btn-sm" title="Ganti Status Aktif"><i class="fa fa-times"></i></a>
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
                                        <a href="" data-toggle="modal" data-target="#editModal<?= $p->id ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="<?= base_url('pelanggan/delete/'.$p->id) ?>" id="btnHapus<?=$no ?>" class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash"></i></a>
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
                                <?php $no++; endforeach; ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('pelanggan/tambah') ?>" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-control-label">No Rekening</label>
                                <input type="text" class="form-control" id="no_rekening" name="no_rekening" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Nama Pelanggan</label>
                                <input type="text" class="form-control" id="nama" name="nama" readonly required>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="10" rows="2" class="form-control" readonly required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-control-label">No HP</label>
                                <input type="text" class="form-control" id="hp" maxlength="12" name="no_hp" readonly required>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Golongan</label>
                                <select name="golongan" id="golongan" class="form-control" readonly required>
                                    <?php foreach($golongan as $g): ?>
                                    <option value="<?= $g->id ?>"><?= $g->kode." - ".$g->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="btnTambah" disabled class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit -->
<?php foreach($pelanggan as $p): ?>
<div class="modal fade" id="editModal<?=  $p->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('pelanggan/edit/'.$p->id) ?>" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-control-label">No Rekening</label>
                                <input type="text" class="form-control" name="no_rekening" value="<?= $p->no_rekening ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Nama Pelanggan</label>
                                <input type="text" class="form-control" name="nama" value="<?= $p->nama ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Alamat</label>
                                <textarea name="alamat" id="" cols="10" rows="2" class="form-control" required><?= $p->alamat ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-control-label">Golongan</label>
                                <select name="golongan" id="" class="form-control" required>
                                    <?php 
                                        foreach($golongan as $g){
                                    ?>
                                        <option value="<?= $g->id ?>" <?php if($g->id == $p->golongan){ echo "selected"; } ?> ><?= $g->kode." - ".$g->nama ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">No HP</label>
                                <input type="text" class="form-control" maxlength="12" name="no_hp" value="<?= $p->no_hp ?>" required>
                            </div>
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
<script>
    $('#no_rekening').keyup(function(){
        var no_rekening = $('#no_rekening').val();
			if (no_rekening.length < 6) {
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
					icon: 'info',
					title: 'No Rekening minimal 6 Digit'
				})
            }else{
                var norek = $('#no_rekening').val();
                $.ajax({
                    method:'POST',
                    dataType:'JSON',
                    url:'<?= base_url('pelanggan/cekNorekAdm') ?>',
                    data:{norek:norek},
                    success:function(response){
                        if (response.kondisi == 1) {
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
                                title: response.pesan
                            })
                            
                            $('#nama').removeAttr('readonly','readonly');
                            $('#alamat').removeAttr('readonly','readonly');
                            $('#hp').removeAttr('readonly','readonly');
                            $('#golongan').removeAttr('readonly','readonly');
                            $('#btnTambah').removeAttr('disabled','disabled');
                        }else{
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
                                title: response.pesan
                            })
                            $('#nama').attr('readonly','readonly');
                            $('#alamat').attr('readonly','readonly');
                            $('#hp').attr('readonly','readonly');
                            $('#golongan').attr('readonly','readonly');
                        }
                    }
                })
            }
		})
</script>