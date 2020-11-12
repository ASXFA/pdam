<?php 
    $golongan = $this->golongan_model->getAll()->result();
    $tagihan = $this->tagihan_model->getAll()->result();
    $pelanggan = $this->pelanggan_model->getAll()->result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
	#outtable{
	  	padding: 10px;
	  	border:1px solid #e3e3e3;
	  	width:auto;
	  	border-radius: 5px;
	  }
 
	  .short{
	  	width: 50px;
	  }
 
	  .normal{
	  	width: 150px;
	  }
      table{
      	border-collapse: collapse;
      	font-family: arial;
      	color:#5E5B5C;
      }
 
      thead th{
      	text-align: left;
      	padding: 10px;
      }
 
      tbody td{
      	border-top: 1px solid #e3e3e3;
      	padding: 10px;
      }
 
      tbody tr:nth-child(even){
      	background: #F6F5FA;
      }
 
      tbody tr:hover{
      	background: #EAE9F5
      }
      h3{
          text-align: center;
      }
	</style>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h3>Data Tagihan</h3>
        <div id="outtable">
            <table>
                <thead>
                    <tr>
                        <th class="short">#</th>
                        <th class="normal">No Rek</th>
                        <th class="normal">Nama</th>
                        <th class="normal">Alamat</th>
                        <th class="normal">Periode</th>
                        <th class="normal">Tagihan</th>
                        <th class="normal">Total</th>
                        <th class="normal">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($tagihan as $t): ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $t->no_rekening ?></td>
                        <td><?= $t->nama ?></td>
                        <td><?= $t->alamat ?></td>
                        <td><?= $t->periode ?></td>
                        <td>
                            <table>
                                <tr>
                                    <td>Mtr Lama</td>
                                    <td><?= $t->mtr_lama ?>M<sup>3</sup></td>
                                </tr>
                                <tr>
                                    <td>Mtr Baru</td>
                                    <td><?= $t->mtr_baru ?>M<sup>3</sup></td>
                                </tr>
                                <tr>
                                    <td>Volume</td>
                                    <td><?= $t->volume ?>M<sup>3</sup></td>
                                </tr>
                            </table>
                        </td>
                        <td>Rp. <?= number_format($t->total) ?></td>
                        <td>
                            <?php 
                                if ($t->status_tagihan == 0) {
                                    echo "Belum Dibayar";
                                }else{
                                    echo "Sudah Dibayar";
                                }
                            ?>
                        </td>
                    </tr>
                    <?php $no++; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    </body>
</html>
