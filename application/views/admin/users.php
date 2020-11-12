<?php 
    if ($this->session->flashdata('pesanUsers')) {
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
            title: '<?= $this->session->flashdata('pesanUsers') ?>'
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
                    title: '<?= $this->session->flashdata('pesanUsers') ?>'
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
                <h1>Data Users</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?= base_url() ?>">Dashboard</a></li>
                    <li class="active">Data Users</li>
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
                        <strong class="card-title">Data Users</strong>
                        <span class="float-right"><a href="" data-toggle="modal" data-target="#tambahModal" class="btn btn-primary btn-sm" title="Tambah Data"><i class="fa fa-plus"></i></a></span>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no=1;
                                    foreach($users as $u):
                                ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $u->nama ?></td>
                                    <td><?= $u->username ?></td>
                                    <td>
                                        <?php 
                                            if ($u->level == 0) {
                                                echo "administrasi";
                                            }else if($u->level == 1){
                                                echo "Petugas";
                                            }else{
                                                echo "User";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            if ($u->status == 1) {
                                                echo "<span class='badge badge-success p-2'> AKTIF </span>";
                                            }else{
                                                echo "<span class='badge badge-danger p-2'> BELUM AKTIF </span>";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            if ($u->status == 0) {
                                        ?>
                                                <a href="<?= base_url('users/gantiStatus/'.$u->id.'/1') ?>" id="btnStatus<?= $no ?>" class="btn btn-success btn-sm" title="Ganti Status Aktif"><i class="fa fa-check"></i></a>
                                        <?php
                                            }else{
                                        ?>
                                                <a href="<?= base_url('users/gantiStatus/'.$u->id.'/0') ?>" id="btnStatus<?= $no ?>" class="btn btn-danger btn-sm" title="Ganti Status Aktif"><i class="fa fa-times"></i></a>
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
                                        <a href="" data-toggle="modal" data-target="#editModal<?= $u->id ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="<?= base_url('users/delete/'.$u->id) ?>" id="btnHapus<?=$no ?>" class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash"></i></a>
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
                <form action="<?= base_url('users/tambah') ?>" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-control-label">Nama</label>
                                <input type="text" class="form-control" name="nama">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-control-label">Level</label>
                                <select name="level" id="" class="form-control">
                                    <?php for($i = 0; $i<2; $i++){ ?>
                                    <option value="<?= $i ?>"><?php if($i == 1){echo "Petugas";}else{echo "Administrasi";} ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="btnTambah" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit -->
<?php foreach($users as $u): ?>
<div class="modal fade" id="editModal<?=  $u->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Users</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('users/edit/'.$u->id) ?>" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-control-label">Nama</label>
                                <input type="text" class="form-control" name="nama" value="<?= $u->nama ?>">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?= $u->username ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-control-label">Golongan</label>
                                <select name="level" id="" class="form-control">
                                    <?php for($i = 0; $i<2; $i++){ ?>
                                    <option value="<?= $i ?>" <?php if($i == $u->level){echo "selected";} ?> ><?php if($i == 1){echo "Petugas";}else{echo "Administrasi";} ?></option>
                                    <?php } ?>
                                </select>
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
    $('#username').keyup(function(){
        var username = $('#username').val();
        if (username.length < 8) {
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
                title: 'Username minimal 8 karakter'
            })
            $('#btnTambah').attr('disabled','disabled');
        }else{
            $.ajax({
                method:'POST',
                dataType:'JSON',
                data:{username:username},
                url:'<?= base_url('users/cekUsername') ?>',
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
                        $('#btnTambah').attr('disabled','disabled');
                    }
                }
            })
        }
    })
</script>