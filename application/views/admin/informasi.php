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
                <h1>Data Informasi</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?= base_url() ?>">Dashboard</a></li>
                    <li class="active">Data Informasi</li>
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
                        <strong class="card-title">Data Informasi</strong>
                        <span class="float-right"><a href="" data-toggle="modal" data-target="#tambahModal" class="btn btn-primary btn-sm" title="Tambah Data"><i class="fa fa-plus"></i></a></span>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Dibuat Oleh</th>
                                    <th>Dibuat Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no=1;
                                    foreach($informasi as $in):
                                ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><a href=""><?= $in->judul ?></a></td>
                                    <td width="30%"><?= $in->deskripsi ?></td>
                                    <td>
                                        <?php 
                                            // foreach($users as $u):
                                                //     if ($u->id == $in->created_by) {
                                                    //         echo $u->nama." | ";
                                                    //         if ($u->level == 1) {
                                                        //             echo "Administration";
                                                        //         }else if($u->level == 2){
                                                            //             echo "Petugas";
                                                            //         }
                                                            //     }
                                                            // endforeach;
                                                            echo $in->created_by;
                                        ?>
                                    </td>
                                    <td><?= date('d F Y H:i:s',strtotime($in->created_at)) ?></td>
                                    <td>
                                        <?php 
                                            if ($in->status == 1) {
                                                echo "<span class='badge badge-success p-2'> AKTIF </span>";
                                            }else{
                                                echo "<span class='badge badge-danger p-2'> BELUM AKTIF </span>";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            if ($in->status == 0) {
                                        ?>
                                                <a href="<?= base_url('informasi/gantiStatus/'.$in->id.'/1') ?>" id="btnStatus<?= $no ?>" class="btn btn-success btn-sm" title="Ganti Status Aktif"><i class="fa fa-check"></i></a>
                                        <?php
                                            }else{
                                        ?>
                                                <a href="<?= base_url('informasi/gantiStatus/'.$in->id.'/0') ?>" id="btnStatus<?= $no ?>" class="btn btn-danger btn-sm" title="Ganti Status Aktif"><i class="fa fa-times"></i></a>
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
                                        <a href="" data-toggle="modal" data-target="#editModal<?= $in->id ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="<?= base_url('informasi/hapus/'.$in->id) ?>" id="btnHapus<?=$no ?>" class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash"></i></a>
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
                <form action="<?= base_url('informasi/tambah') ?>" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="form-control-label">Judul</label>
                                <input type="text" class="form-control" name="judul">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Deskripsi</label>
                                <textarea name="deskripsi" id="editorTambah" cols="30" rows="10" class="form-control"></textarea>
                                <script src="<?= base_url('assets/ckeditor5/build/ckeditor.js') ?>"></script>
                                <script>
                                    ClassicEditor
                                        .create( document.querySelector( '#editorTambah' ),{
                                            toolbar: {
                                                    items: [
                                                        'Heading',
                                                        '|',
                                                        'bold',
                                                        'italic',
                                                        'bulletedList',
                                                        'numberedList',
                                                        'superscript',
                                                        '|',
                                                        'undo',
                                                        'redo'
                                                    ]
                                                },
                                                language: 'id'
                                        })
                                        .catch( error => {
                                            console.error( error );
                                        } );

                                </script>
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
<!-- Modal Edit -->
<?php foreach($informasi as $in): ?>
<div class="modal fade" id="editModal<?=  $in->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('informasi/edit/'.$in->id) ?>" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="form-control-label">Judul</label>
                                <input type="text" class="form-control" name="judul" value="<?= $in->judul ?>">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Deskripsi</label>
                                <textarea name="deskripsi" id="editorEdit" cols="30" rows="10" class="form-control"><?= $in->deskripsi ?></textarea>
                                <script src="<?= base_url('assets/ckeditor5/build/ckeditor.js') ?>"></script>
                                <script>
                                    ClassicEditor
                                        .create( document.querySelector( '#editorEdit' ),{
                                            toolbar: {
                                                    items: [
                                                        '|',
                                                        'bold',
                                                        'italic',
                                                        'bulletedList',
                                                        'numberedList',
                                                        'superscript',
                                                        '|',
                                                        'undo',
                                                        'redo'
                                                    ]
                                                },
                                                language: 'id'
                                        })
                                        .catch( error => {
                                            console.error( error );
                                        } );

                                </script>
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