<?php
require_once 'autoload.php';

$obj = new Bayes();


$jumTrue = $obj->sumTrue();
$jumFalse = $obj->sumFalse();
$jumData = $obj->sumData();

$a1 = "2 - 3 tahun";
$a2 = "< 6 jam";
$a3 = "iya";
$a4 = "20% - 50%";
$a5 = "tidak pernah";

//TRUE
$usia = $obj->probusia($a1,1);
$pengechasan = $obj->probpengechasan($a2,1);
$jam = $obj->probjam($a3,1);
$charger = $obj->probcharger($a4,1);
$original = $obj->proboriginal($a5,1);

//FALSE
$usia2 = $obj->probusia($a1,0);
$pengechasan2 = $obj->probpengechasan($a2,0);
$jam2 = $obj->probjam($a3,0);
$charger2 = $obj->probcharger($a4,0);
$original2 = $obj->proboriginal($a5,0);

//result
$paT = $obj->hasilTrue($jumTrue,$jumData,$usia,$pengechasan,$jam,$charger,$original);
$paF = $obj->hasilFalse($jumTrue,$jumData,$usia2,$pengechasan2,$jam2,$charger2,$original2);

echo "
======================================<br>
usia : $a1<br>
pengechasan : $a2<br>
jam : $a3<br>
charger : $a4<br>
original : $a5<br>
=======================================<br><br>
";

echo "
======================================<br>
kemungkinan true : <br>
jumlah true : $jumTrue <br>
jumlah data : $jumData <br>
=======================================<br><br>
";

echo "
======================================<br>
kemungkinan false : <br>
jumlah false : $jumFalse <br>
jumlah data : $jumData <br>
=======================================<br><br>
";

echo "
======================================<br>
pATrue : $jumTrue / $jumData<br>
usia true : $usia / $jumTrue <br>
pengechasan true : $pengechasan / $jumTrue <br>
jamn true : $jam / $jumTrue <br>
charger true : $charger / $jumTrue <br>
original true : $original / $jumTrue <br><br>
=======================================<br><br>
";

echo "
======================================<br>
pAFalse : $jumFalse / $jumData<br>
usia false : $usia2 / $jumFalse <br>
pengechasan false : $pengechasan2 / $jumFalse <br>
jamn false : $jam2 / $jumFalse <br>
charger false : $charger2 / $jumFalse <br>
original false : $original2 / $jumFalse <br>
=======================================<br><br>
";

echo "
======================================<br>
presentasi yes : $paT<br>
presentasi no : $paF<br>
=======================================<br><br>
";

if($paT > $paF){
  echo "
  ======================================<br>
  PRESENTASI YES LEBIH BESAR DARI PADA PRESENTASI NO<br>
  =======================================
  <br><br>";
}else if($paF > $paT){
  echo "
  ======================================<br>
  PRESENTASI NO LEBIH BESAR DARI PADA PRESENTASI YES<br>
  =======================================
  <br><br>";
}

// echo $obj->hasilTrue($jumTrue,$jumData,$usia,$pengechasan,$jam,$charger,$original)."<br>";
// echo $obj->hasilFalse($jumTrue,$jumData,$usia2,$pengechasan2,$jam2,$charger2,$original2)."<br><br>";

$result = $obj->perbandingan($paT,$paF);
echo " Status : $result[0] <br>Presentasi kondisi baik sebanyak : ".round($result[1],2)." % <br>Presentasi kondisi tidak baik sebanyak : ".round($result[2],2)." % ";
 ?>
