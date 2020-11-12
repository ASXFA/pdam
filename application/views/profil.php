<div class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="mx-auto d-block">
                        <img class="rounded-circle mx-auto d-block" src="<?= base_url('assets/') ?>images/admin.png" alt="Card image cap">
                        <h5 class="text-sm-center mt-2 mb-1"><?= $users->nama ?></h5>
                        <div class="location text-sm-center"><?= $users->username ?></div>
                        <div class="location text-sm-center"><?php if($users->level == 0){echo "Administration";}else if($users->level==1){echo "Petugas";}else{echo "Users";} ?></div>
                    </div>
                    <hr>
                    <div class="card-text text-sm-center">
                        <p>User Profil</p>
                    </div>
                </div>
            </div>
        </div>
        <?php if(!isset($pelanggan)){ ?>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Ganti Password</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('users/gantiPassword/'.$this->session->userdata('id')) ?>" method="post">
                        <div class="form-group">
                            <label for="" class="form-control-label">Password Lama</label>
                            <input type="password" id="pswd_lama" name="pass_lama" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">Password Baru</label>
                            <input type="password" id="pswd_baru" name="pass_baru" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">Password Konfirmasi</label>
                            <input type="password" id="pswd_conf" name="pass_conf" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary float-right" id="btnTambah" disabled>Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php }else{ ?>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td width="10%"><h5>No Rekening</h5></td>
                                <td width="1%"> : </td>
                                <td width="20%"><?= $pelanggan->no_rekening ?></td>
                            </tr>
                            <tr>
                                <td width="10%"><h5>Alamat</h5></td>
                                <td width="1%"> : </td>
                                <td width="20%"><?= $pelanggan->alamat ?></td>
                            </tr>
                            <tr>
                                <td width="10%"><h5>Golongan</h5></td>
                                <td width="1%"> : </td>
                                <td width="20%"><?= $pelanggan->golongan ?></td>
                            </tr>
                            <tr>
                                <td width="10%"><h5>No Hp</h5></td>
                                <td width="1%"> : </td>
                                <td width="20%"><?= $pelanggan->no_hp ?></td>
                            </tr>
                            <tr>
                                <td width="10%"><h5>Status</h5></td>
                                <td width="1%"> : </td>
                                <td width="20%"><?php if($pelanggan->status == 0){echo "Belum Aktif";}else{echo "Aktif";} ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php if(isset($pelanggan)){ ?>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Ganti Password</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('users/gantiPassword/'.$this->session->userdata('id')) ?>" method="post">
                        <div class="form-group">
                            <label for="" class="form-control-label">Password Lama</label>
                            <input type="password" id="pswd_lama1" name="pass_lama" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">Password Baru</label>
                            <input type="password" id="pswd_baru1" name="pass_baru" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">Password Konfirmasi</label>
                            <input type="password" id="pswd_conf1" name="pass_conf" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary float-right" id="btnTambah1" disabled>Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<script src="<?= base_url('assets/') ?>vendors/jquery/dist/jquery.min.js"></script>
<script>
    $('#pswd_lama').keyup(function(){
        var pswd = $('#pswd_lama').val();
        $.ajax({
            method:'POST',
            dataType:'JSON',
            url:'<?= base_url('users/cekPassword') ?>',
            data:{pswd:pswd},
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
                    
                    $('#pswd_baru').removeAttr('readonly','readonly');
                    $('#pswd_conf').removeAttr('readonly','readonly');
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
                    $('#pswd_baru').attr('readonly','readonly');
                    $('#pswd_conf').attr('readonly','readonly');
                }
            }
        })
    })
    $('#pswd_lama1').keyup(function(){
        var pswd = $('#pswd_lama1').val();
        $.ajax({
            method:'POST',
            dataType:'JSON',
            url:'<?= base_url('users/cekPassword') ?>',
            data:{pswd:pswd},
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
                    
                    $('#pswd_baru1').removeAttr('readonly','readonly');
                    $('#pswd_conf1').removeAttr('readonly','readonly');
                    $('#btnTambah1').removeAttr('disabled','disabled');
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
                    $('#pswd_baru1').attr('readonly','readonly');
                    $('#pswd_conf1').attr('readonly','readonly');
                    $('#btnTambah1').attr('disabled','disabled');
                }
            }
        })
    })

    $('#pswd_conf').keyup(function(){
        var pass = $('#pswd_baru').val();
        var conf = $('#pswd_conf').val();
        if (conf === pass) {
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
                title: 'Password Cocok!'
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
                title: 'Password Cocok!'
            })
            $('#btnTambah').attr('disabled','disabled');
        }
    })
    $('#pswd_conf1').keyup(function(){
        var pass = $('#pswd_baru1').val();
        var conf = $('#pswd_conf1').val();
        if (conf === pass) {
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
                title: 'Password Cocok!'
            })
            $('#btnTambah1').removeAttr('disabled','disabled');
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
                title: 'Password Cocok!'
            })
            $('#btnTambah1').attr('disabled','disabled');
        }
    })
</script>