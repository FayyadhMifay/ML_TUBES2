<?php

require_once 'autoload.php';

$obj = new Bayes();

$jumTrue = $obj->sumTrue();
$jumFalse = $obj->sumFalse();
$jumData = $obj->sumData();

$a1 = $_POST['usia'];
$a2 = $_POST['jam'];
$a3 = $_POST['original'];
$a4 = $_POST['pengechasan'];
$a5 = $_POST['charger'];

//TRUE
$usia = $obj->probusia($a1,1);
$jam = $obj->probjam($a2,1);
$original = $obj->proboriginal($a3,1);
$pengechasan = $obj->probpengechasan($a4,1);
$charger = $obj->probcharger($a5,1);

//FALSE
$usia2 = $obj->probusia($a1,0);
$jam2 = $obj->probjam($a2,0);
$original2 = $obj->proboriginal($a3,0);
$pengechasan2 = $obj->probpengechasan($a4,0);
$charger2 = $obj->probcharger($a5,0);

//result
$paT = $obj->hasilTrue($jumTrue,$jumData,$usia,$jam,$original,$pengechasan,$charger);
$paF = $obj->hasilFalse($jumTrue,$jumData,$usia2,$jam2,$original2,$pengechasan2,$charger2);

if($a2 == "0%"){
  $a2 = "0%";
}else if($a2 == "> 50%"){
  $a2 = "> 50%";
}

echo "
<div class='jumbotron jumbotron-fluid' id='hslPrekdiksinya'>
  <div class='container'>
    <h1 class='display-4 tebal'>Hasil Prediksi</h1>
  </div>
</div>
";

echo "
<div class='card' style='width: 25rem;'>
  <div class='card-header' style='background-color:#17a2b8;color:#fff'>
    <b>Informasi Calon Pegawai</b>
  </div>
  <ul class='list-group list-group-flush'>
    <li class='list-group-item'>usia : &nbsp;&nbsp;<b>$a1</b></li>
    <li class='list-group-item'>jam : &nbsp;&nbsp;<b>$a2</b></li>
    <li class='list-group-item'>original : &nbsp;&nbsp;<b>$a3</b></li>
    <li class='list-group-item'>pengechasan : &nbsp;&nbsp;<b>$a4</b></li>
    <li class='list-group-item'>charger : &nbsp;&nbsp;<b>$a5</b></li>
  </ul>
</div><br>
<hr>
";

echo "<br>
<table class='table table-bordered' style='font-size:18px;text-align:center'>
  <tr style='background-color:#17a2b8;color:#fff'>
    <th>Jumlah Diterima</th>
    <th>Jumlah Ditolak</th>
    <th>Total Data</th>
  </tr>
  <tr>
    <td>$jumTrue</td>
    <td>$jumFalse</td>
    <td>$jumData</td>
  </tr>
</table>
";

echo "<br>
<table class='table table-bordered' style='font-size:18px;text-align:center'>
  <tr style='background-color:#17a2b8;color:#fff'>
    <th>Kriteria</th>
    <th>Diterima</th>
    <th>Ditolak</th>
  </tr>
  <tr>
    <td>pA</td>
    <td>$jumTrue / $jumData</td>
    <td>$jumFalse / $jumData</td>
  </tr>
  <tr>
    <td>usia</td>
    <td>$usia / $jumTrue</td>
    <td>$usia2 / $jumFalse</td>
  </tr>
  <tr>
    <td>jam Badan</td>
    <td>$jam / $jumTrue</td>
    <td>$jam2 / $jumFalse</td>
  </tr>
  <tr>
    <td>Berat Badan</td>
    <td>$original / $jumTrue</td>
    <td>$original2 / $jumFalse</td>
  </tr>
  <tr>
    <td>Status pengechasan</td>
    <td>$pengechasan / $jumTrue</td>
    <td>$pengechasan2 / $jumFalse</td>
  </tr>
  <tr>
    <td>charger</td>
    <td>$charger / $jumTrue</td>
    <td>$charger2 / $jumFalse</td>
  </tr>
</table>
";

echo "<br>
  <table class='table table-bordered' style='font-size:18px;text-align:center;'>
    <tr style='background-color:#17a2b8;color:#fff'>
      <th>Persentase Kondisi Baterai Baik</th>
      <th>Persentase Kondisi Baterai Tidak Baik</th>
    </tr>
    <tr>
      <td>$paT</td>
      <td>$paF</td>
    </tr>
  </table>
";

$result = $obj->perbandingan($paT,$paF);

if($paT > $paF){
  echo "<br>
  <h3 class='tebal'>PERSENTASE <span class='badge badge-success' style='padding:10px'><b>Kondisi Baterai Baik</b></span> LEBIH BESAR DARI PADA PERSENTASE KONDISI BATERAI TIDAK BAIK</h3><br>";
  echo "<h4><br>Persentase kondisi baterai baik sebanyak : <b>".round($result[1],2)." %</b> <br>Persentase kondisi baterai tidak baik sebanyak : <b>".round($result[2],2)." % </b></h4>";
}else if($paF > $paT){
  echo "<br>
  <h3 class='tebal'>PERSENTASE <span class='badge badge-danger' style='padding:10px'><b>Kondisi Baterai Tidak Baik</b></span> LEBIH BESAR DARI PADA PERSENTASE KONDISI BATERI BAIK</h3><br>";
  echo "<h4><br>Persentase kondisi baterai tidak baik sebanyak : <b>".round($result[1],2)." %</b> <br>Persentase kondisi baterai baik sebanyak : <b>".round($result[2],2)." % </b></h4>";
}


if($result[0] == "KONDISI BATERAI BAIK"){
  echo "
  <div class='alert alert-success mt-5' role='aler'>
    <h4 class='alert-heading'>Kesimpulan : $result[0] </h4>
    <p>Selamat! berdasarkan hasil prediksi, kondisi baterai SmartPhone anda dinyatakan <b>BAIK!</b></p>

  </div>";
}else{
  echo"
  <div class='alert alert-danger mt-5' role='aler'>
  <h4 class='alert-heading'>Kesimpulan : $result[0] </h4>
  <p>Berdasarkan hasil prediksi, kondisi baterai SmartPhone anda dinyatakan <b>TIDAK BAIK!</b></p>
  </div>";
}
