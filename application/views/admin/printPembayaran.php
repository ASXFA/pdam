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
        <h3>Data Pembayaran <?php if($bulan != "Semua"){
            if ($bulan == 1) {
                echo "Januari";
            }else if ($bulan == 2) {
                echo "Februari";
            }else if ($bulan == 3) {
                echo "Maret";
            }else if ($bulan == 4) {
                echo "April";
            }else if ($bulan == 5) {
                echo "Mei";
            }else if ($bulan == 6) {
                echo "Juni";
            }else if ($bulan == 7) {
                echo "Juli";
            }else if ($bulan == 8) {
                echo "Agustus";
            }else if ($bulan == 9) {
                echo "September";
            }else if ($bulan == 10) {
                echo "Oktober";
            }else if ($bulan == 11) {
                echo "November";
            }else if ($bulan == 12) {
                echo "Desember";
            }
        } ?> <?php if($tahun != "Semua"){echo $tahun;} ?></h3>
        <div id="outtable">
            <table>
                <thead>
                    <tr>
                        <th class="short">#</th>
                        <th class="normal">Pelanggan</th>
                        <th class="normal">No.rek</th>
                        <th class="normal">Alamat</th>
                        <th class="normal">No Hp</th>
                        <th class="normal">Volume Pemakaian</th>
                        <th class="normal">Periode</th>
                        <th class="normal">Total Tagihan</th>
                        <th class="normal">Status Tagihan</th>
                        <th class="normal">Dibayar Pada</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($pembayaran as $p): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <?php  
                            foreach($pelanggan as $pel):
                                if ($pel->id == $p->pelanggan_id) {
                                    echo "<td>".$pel->nama."</td>";
                                    echo "<td>".$pel->no_rekening."</td>";
                                    echo "<td>".$pel->alamat."</td>";
                                    echo "<td>".$pel->no_hp."</td>";
                                }
                            endforeach;
                        ?>
                        <?php  
                            foreach($tagihan as $t):
                                if ($t->id == $p->tagihan_id) {
                                    echo "<td>".$t->volume." M<sup>3</sup></td>";
                                    echo "<td>".$t->periode."</td>";
                                    echo "<td> Rp. ".number_format($t->total)."</td>";
                                    if ($t->status_tagihan == 1) {
                                        echo "<td>LUNAS</td>";
                                    }else{
                                        echo "<td>BELUM LUNAS</td>";
                                    }
                                }
                                
                            endforeach;
                        ?>
                        <td><?= date('d F Y H:i:s', strtotime($p->created_at)) ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    </body>
</html>
