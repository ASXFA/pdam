
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Registration Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?= base_url('assets/login/') ?>images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>css/main.css">
<!--===============================================================================================-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
	<?php if($this->session->flashdata('kondisi')=='0'){ ?>
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
			title: '<?= $this->session->flashdata('pesanDaftar') ?>'
		})
	</script>
	<?php } ?>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(assets/login/images/bg-01.jpg);">
					<span class="login100-form-title-1">
						DAFTAR
					</span>
				</div>

				<form class="login100-form validate-form" action="<?= base_url('login/aksi_registrasi') ?>" method="post">
					<div class="wrap-input100 validate-input m-b-26" data-validate="No Rek Dibutuhkan">
						<span class="label-input100">No Rek</span>
						<input class="input100 d-inline" type="text" name="no_rekening" id="no_rek" placeholder="Masukan No Rekening">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-26" data-validate="Field Nama dibutuhkan">
						<span class="label-input100">Nama</span>
						<input class="input100" type="text" name="nama" id="nama" placeholder="Masukan Nama" readonly>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-26" data-validate="Username dibutuhkan">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" id="username" placeholder="Masukan Username" readonly>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password dibutuhkan">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" id="pass" placeholder="Masukan password" readonly>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password dibutuhkan">
						<span class="label-input100">Password Konfirmasi</span>
						<input class="input100" type="password" name="confirm" id="confirm" placeholder="Masukan password" readonly>
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn mt-5">
						<button class="btn btn-success mr-3" id="daftar" disabled><i class="fa fa-edit"></i> Daftar</button>
						<a href="#" id="cek" class="btn btn-primary "><i class="fa fa-search"></i> Cek No.Rek</a>
					</div>
					<div class="container-login100-form-btn mt-4">
						Sudah punya akun ? <a href="<?= base_url('login') ?>" class="ml-1"> <u> Login </u></a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="<?= base_url('assets/login/') ?>vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/login/') ?>vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/login/') ?>vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url('assets/login/') ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/login/') ?>vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/login/') ?>vendor/daterangepicker/moment.min.js"></script>
	<script src="<?= base_url('assets/login/') ?>vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/login/') ?>vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/login/') ?>js/main.js"></script>
	<script>
		$('#cek').click(function(){
			var norek = $('#no_rek').val();
			$.ajax({
				method:'POST',
				dataType:'JSON',
				url:'<?= base_url('pelanggan/cekNorek') ?>',
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
						
						$('#nama').val(response.nama);
						$('#username').removeAttr('readonly','readonly');
						$('#no_rek').attr('readonly','readonly');
						$('#daftar').removeAttr('disabled','disabled');
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
						$('#username').attr('readonly','readonly');
						$('#pass').attr('readonly','readonly');
						$('#confirm').attr('readonly','readonly');
					}
				}
			})
		})

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
				console.log(username);
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
							$('#pass').removeAttr('readonly','readonly');
							$('#confirm').removeAttr('readonly','readonly');
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
							$('#pass').attr('readonly','readonly');
							$('#confirm').attr('readonly','readonly');
						}
					}
				})
			}
		})

		$('#confirm').keyup(function(){
			var pass = $('#pass').val();
			var conf = $('#confirm').val();
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
				$('#daftar').removeAttr('disabled','disabled');
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
				$('#daftar').attr('disabled','disabled');
			}
		})
	</script>
</body>
</html>