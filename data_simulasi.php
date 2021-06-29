<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require('header.php');
  ?>

  <link rel="stylesheet" href="css/datatables.css">

  <title>Data Training</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light static-top">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Simulasi</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="data_simulasi.php">Data Training <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container" style='margin-top:90px'>
    <div class="row">
      <div class="col-12 mt-5">
        <h2 class="tebal">List Data Training</h2><br>
        <p class="desc">Berikut ini adalah data training yang digunakan dalam membuat Simulasi prediksi kesehatan baterai pada smartphone menggunakan metode naive bayes.</a></p><br>

        <table id="dataLatih" class="display pt-3 mb-3">
          <thead>
            <tr>
              <th>No</th>
              <th>Sudah Berapa tahun usia smartphone anda sekarang ini ?</th>
              <th>Berapa jam anda menggunakan smartphone dalam 1 hari ?</th>
              <th>Apakah charger yang anda gunakan adalah Original ?</th>
              <th>Berapa persent anda baru mengisi daya baterai ?</th>
              <th>Pernakah anda mengisi daya baterai dan ditinggal tidur sehingga lupa untuk mencabut charger ketika sudah penuh ?</th>
              <th>Bagainama kondisi baterai smarphone anda saat ini ?</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $data = 'data.json';
            $json = file_get_contents($data);
            $hasil = json_decode($json, true);

            $no = 1;
            foreach ($hasil as $hasil) {

              if ($hasil['kondisi'] == 1) {
                $stt = "Kondisi_Baik";
              } else {
                $stt = "Kondisi_Tidak_Baik";
              }

              if ($hasil['pengechasan'] == "20% - 50%") {
                $pengechasan = "20% - 50%";
              } else if ($hasil['pengechasan'] == "0%") {
                $pengechasan = "0%";
              } else if ($hasil['pengechasan'] == "> 50%") {
                $pengechasan = "> 50%";
              }

              if ($hasil['charger'] == "tidak pernah") {
                $charger = "tidak pernah";
              } else if ($hasil['charger'] == "terkadang") {
                $charger = "terkadang";
              } else if ($hasil['charger'] == "pernah") {
                $charger = "pernah";
              }
            ?>

              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $hasil['usia']; ?></td>
                <td><?php echo $hasil['jam']; ?></td>
                <td><?php echo $hasil['original']; ?></td>
                <td><?php echo $pengechasan; ?></td>
                <td><?php echo $charger; ?></td>
                <td><?php
                    if ($stt == "Kondisi_Baik") {
                      echo "<span class='badge badge-success' style='padding:10px'>Kondisi Baterai Baik</span>";
                    } else {
                      echo "<span class='badge badge-danger' style='padding:10px'>Kondisi Baterai Tidak Baik</span>";
                    }
                    ?></td>
              </tr>

            <?php
              $no++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <?php
  require('footer.php');
  ?>

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery.js"></script>
  <script src="jspopper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <script type="text/javascript" src="js/datatables.js"></script>

  <!-- validasi -->
  <script>
    $(document).ready(function() {
      $('.toggle').click(function() {
        $('ul').toggleClass('active');
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#dataLatih').dataTable({
        "pageLength": 50
      });
    });
  </script>

</body>

</html>