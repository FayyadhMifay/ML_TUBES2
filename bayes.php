<?php
class Bayes
{
  private $phone = "data.json";

  function __construct()
  {

  }

  /*================================================================
  FUNCTION SUM TRUE DAN FALSE
  =================================================================*/
  function sumTrue()
  {
    $data = file_get_contents($this->phone);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach($hasil as $hasil)
    {
      if($hasil['kondisi'] == 1){
        $t += 1;
      }
    }

    return $t;
  }

  function sumFalse()
  {
    $data = file_get_contents($this->phone);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach($hasil as $hasil)
    {
      if($hasil['kondisi'] == 0){
        $t += 1;
      }
    }
    return $t;
  }

  function sumData()
  {
    $data = file_get_contents($this->phone);
    $hasil = json_decode($data,true);
    return count($hasil);
  }

  //=================================================================

  /*================================================================
  FUNCTION PROBABILITAS
  =================================================================*/
  function probusia($usia,$kondisi)
  {
    $data = file_get_contents($this->phone);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['usia'] == $usia && $hasil['kondisi'] == $kondisi){
        $t += 1;
      }else if($hasil['usia'] == $usia && $hasil['kondisi'] == $kondisi){
        $t +=1;
      }
    }
    return $t;
  }

  function probpengechasan($pengechasan,$kondisi)
  {
    $data = file_get_contents($this->phone);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['pengechasan'] == $pengechasan && $hasil['kondisi'] == $kondisi){
        $t += 1;
      }else if($hasil['pengechasan'] == $pengechasan && $hasil['kondisi'] == $kondisi){
        $t +=1;
      }
    }
    return $t;
  }

  function probjam($jam,$kondisi)
  {
    $data = file_get_contents($this->phone);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['jam'] == $jam && $hasil['kondisi'] == $kondisi){
        $t += 1;
      }else if($hasil['jam'] == $jam && $hasil['kondisi'] == $kondisi){
        $t +=1;
      }
    }
    return $t;
  }

  function proboriginal($original,$kondisi)
  {
    $data = file_get_contents($this->phone);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['original'] == $original && $hasil['kondisi'] == $kondisi){
        $t += 1;
      }else if($hasil['original'] == $original && $hasil['kondisi'] == $kondisi){
        $t +=1;
      }
    }
    return $t;
  }

  function probcharger($charger,$kondisi)
  {
    $data = file_get_contents($this->phone);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['charger'] == $charger && $hasil['kondisi'] == $kondisi){
        $t += 1;
      }else if($hasil['charger'] == $charger && $hasil['kondisi'] == $kondisi){
        $t +=1;
      }
    }
    return $t;
  }
  //=================================================================

  /*=================================================================
  MARI BERHITUNG
  keterangan parameter :
  $sT   : jumlah data yang bernilai true ( sumTrue )
  $sF   : jumlah data yang bernilai false ( sumFalse )
  $sD   : jumlah data pada data latih ( sumData )
  $pU   : jumlah probabilitas usia ( probusia )
  $pP   : jumlah probabilitas pengechasan ( probpengechasan )
  $pjam  : jumlah probabilitas jam ( projam )
  $pC   : jumlah probabilitas charger ( probcharger )
  $pO   : jumlah probabilitas original (proboriginal )
  ==================================================================*/

  function hasilTrue($sT = 0 , $sD = 0 , $pU = 0 ,$pP = 0, $pjam = 0,$pC = 0, $pO = 0)
  {
    $paTrue = $sT / $sD;
    $p1 = $pU / $sT;
    $p2 = $pP / $sT;
    $p3 = $pjam / $sT;
    $p4 = $pC / $sT;
    $p5 = $pO / $sT;
    $hsl = $paTrue * $p1 * $p2 * $p3 * $p4 * $p5;
    return $hsl;
  }

  function hasilFalse($sF = 0 , $sD = 0 , $pU = 0 ,$pP = 0, $pjam = 0,$pC = 0, $pO = 0)
  {
    $paFalse = $sF / $sD;
    $p1 = $pU / $sF;
    $p2 = $pP / $sF;
    $p3 = $pjam / $sF;
    $p4 = $pC / $sF;
    $p5 = $pO / $sF;
    $hsl = $paFalse * $p1 * $p2 * $p3 * $p4 * $p5;
    return $hsl;
  }

  function perbandingan($pATrue,$pAFalse)
  {
    if($pATrue > $pAFalse){
      $stt = "KONDISI BATERAI BAIK";
      $hitung = ($pATrue / ($pATrue + $pAFalse)) * 100;
      $Kbaik = 100 - $hitung;
    }elseif($pAFalse > $pATrue)
    {
      $stt = "KONDISI BATERAI TIDAK BAIK";
      $hitung = ($pAFalse / ($pAFalse + $pATrue)) * 100;
      $Kbaik = 100 - $hitung;
    }

    $hsl = array($stt,$hitung,$Kbaik);
    return $hsl;
  }
  //=================================================================
}

?>
