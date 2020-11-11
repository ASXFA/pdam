<?php 
    if ($this->session->flashdata('pesanLevel')) {
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
            title: '<?= $this->session->flashdata('pesanLevel') ?>'
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
                    title: '<?= $this->session->flashdata('pesanLevel') ?>'
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
                <h1>Data Level</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?= base_url() ?>">Dashboard</a></li>
                    <li class="active">Data Level</li>
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
                        <strong class="card-title">Data Level</strong>
                        <span class="float-right"><a href="" data-toggle="modal" data-target="#tambahModal" class="btn btn-primary btn-sm" title="Tambah Data"><i class="fa fa-plus"></i></a></span>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Operand</th>
                                    <th>Nilai Awal</th>
                                    <th>Nilai Akhir</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; foreach($level as $l): ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $l->operand ?></td>
                                    <td><?= $l->nilai_awal ?></td>
                                    <td><?= $l->nilai_akhir ?></td>
                                    <td>
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
                                    </td>
                                    <td>
                                        <?php 
                                            if ($l->status == 1) {
                                                echo "<span class='badge badge-success p-2'> AKTIF </span>";
                                            }else{
                                                echo "<span class='badge badge-danger p-2'> BELUM AKTIF </span>";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            if ($l->status == 0) {
                                        ?>
                                                <a href="<?= base_url('level/gantiStatus/'.$l->id.'/1') ?>" id="btnStatus<?= $no ?>" class="btn btn-success btn-sm" title="Ganti Status Aktif"><i class="fa fa-check"></i></a>
                                        <?php
                                            }else{
                                        ?>
                                                <a href="<?= base_url('level/gantiStatus/'.$l->id.'/0') ?>" id="btnStatus<?= $no ?>" class="btn btn-danger btn-sm" title="Ganti Status Aktif"><i class="fa fa-times"></i></a>
                                        <?php
                                            }
                                        ?>
                                        <script src="<?= base_url('assets/') ?>vendors/jquery/dist/jquery.min.js"></script>
                                        <script>
                                            $('#btnStatus<?= $no ?>').on('click', function (e) {
                                                e.preventDefault();
                                                const url = $(this).attr('href');
                                                swal.fire({
                                                    title: 'Ganti Status ?',
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
                                        <a href="" data-toggle="modal" data-target="#editModal<?= $l->id ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="<?= base_url('level/hapus/'.$l->id) ?>" id="btnHapus<?=$no ?>" class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash"></i></a>
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
                                <?php $no++; endforeach ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Level</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('level/tambah') ?>" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="form-control-label">operand</label>
                                <select name="operand" id="" class="form-control">
                                    <option hidden>PILIH</option>
                                    <option value=""> Tidak Ada </option>
                                    <option value="<"> < </option>
                                    <option value="=="> == </option>
                                    <option value="<="> <= </option>
                                    <option value=">"> > </option>
                                    <option value=">="> >= </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Nilai Awal</label>
                                <input type="number" class="form-control" name="nilai_awal" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Nilai Akhir</label>
                                <input type="number" class="form-control" name="nilai_akhir">
                            </div>
                        </div>
                    </div>
                    <h5>Note : </h5>
                    <p>1. Operand  = Operasi aritmatika untuk menentukan besar kecila atau sama dengan terhadap nilai awal yang ditentukan</p>
                    <p>2. Nilai Awal  = Nilai awal untuk nilai perbandingan awal  </p>
                    <p>3. Nilai Akhir  = Nilai akhir untuk nilai perbandingan akhir  </p>
                    <p> Operand dan Nilai Akhir bisa dikosongkan bila tidak ingin di isi </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit -->
<?php foreach($level as $l): ?>
<div class="modal fade" id="editModal<?=  $l->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Level</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('level/edit/'.$l->id) ?>" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="form-control-label">operand</label>
                                <select name="operand" id="" class="form-control">
                                    <option value="" <?php if($l->operand == ""){echo "selected"; } ?> > Tidak Ada </option>
                                    <option value="<" <?php if($l->operand == "<"){echo "selected"; } ?>> < </option>
                                    <option value="==" <?php if($l->operand == "=="){echo "selected"; } ?>> == </option>
                                    <option value="<=" <?php if($l->operand == "<="){echo "selected"; } ?>> <= </option>
                                    <option value=">" <?php if($l->operand == ">"){echo "selected"; } ?>> > </option>
                                    <option value=">=" <?php if($l->operand == ">="){echo "selected"; } ?>> >= </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Nilai Awal</label>
                                <input type="number" class="form-control" name="nilai_awal" value="<?= $l->nilai_awal ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Nilai Akhir</label>
                                <input type="number" class="form-control" name="nilai_akhir" value="<?= $l->nilai_akhir ?>">
                            </div>
                        </div>
                    </div>
                    <h5>Note : </h5>
                    <p>1. Operand  = Operasi aritmatika untuk menentukan besar kecila atau sama dengan terhadap nilai awal yang ditentukan</p>
                    <p>2. Nilai Awal  = Nilai awal untuk nilai perbandingan awal  </p>
                    <p>3. Nilai Akhir  = Nilai akhir untuk nilai perbandingan akhir  </p>
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