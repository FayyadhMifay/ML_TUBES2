<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require('header.php');
  ?>

  <title>Simulasi Kesehatan Kondisi Baterai Pada SmartPhone</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light static-top">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Simulasi
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="data_simulasi.php">Data Training</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container" style='margin-top:90px'>
    <div class="row">
      <div class="col-12 mt-5">
        
      </div>
    </div>

    <div class="row">
      <div class="col-12 mt-4">
        <h3 class="tebal">Simulasi</h3>
      </div>

      <div class="col-6">
        <form method="POST" class="mt-3">

          <div class="form-group">
            <label for="usia">Sudah Berapa tahun usia smartphone anda sekarang ini ? :</label>
            <select name="usia" id="usia" class="form-control selBox" required="required">
              <option value="" disabled selected>usia</option>
              <option value="< 1 tahun">< 1 tahun</option>
              <option value="2 - 3 tahun">2 - 3 tahun</option>
              <option value="> 4 tahun">> 4 tahun</option>
            </select>
          </div>

          <div class="form-group">
            <label for="usia">Berapa jam anda menggunakan smartphone dalam 1 hari ? :</label>
            <select name="jam" id="jam" class="form-control selBox" required="required">
              <option value="" disabled selected>jam</option>
              <option value="< 6 jam<">< 6 jam</option>
              <option value="6 - 12 jam">6 - 12 jam</option>
              <option value="> 12 jam">> 12 jam</option>
            </select>
          </div>

          <div class="form-group">
            <label for="usia">Apakah charger yang anda gunakan adalah Original ? :</label>
            <select name="original" id="original" class="form-control selBox" required="required">
              <option value="" disabled selected>Original</option>
              <option value="iya">iya</option>
              <option value="tidak">tidak</option>
              
            </select>
          </div>

          <div class="form-group">
            <label for="usia">Berapa persent anda baru mengisi daya baterai ? :</label>
            <select name="pengechasan" id="pengechasan" class="form-control selBox" required="required">
              <option value="" disabled selected>berapa persent</option>
              <option value="0%">0%</option>
              <option value="20% - 50%">20% - 50%</option>
              <option value="> 50%">> 50%</option>
            </select>
          </div>

          <div class="form-group">
            <label for="usia">Pernakah anda mengisi daya baterai dan ditinggal tidur sehingga lupa untuk mencabut charger ketika sudah penuh ? :</label>
            <select name="charger" id="charger" class="form-control selBox" required="required">
              <option value="" disabled selected>tidak pernah</option>
              <option value="tidak pernah">tidak pernah</option>
              <option value="terkadang">terkadang</option>
              <option value="pernah">pernah</option>
            </select>
          </div>

          <div class="form-group">
            <input type="submit" value="Submit" class="btn btn-primary mt-3" id="dor" onclick="return simulasi()" />
          </div>
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col-12 mt-5 mb-5">
        <div id="hasilSIM" style="margin-bottom:30px;">

        </div>
      </div>
    </div>

  </div>

  <?php
  require('footer.php');
  ?>


  <script src="js/jquery.js"></script>
  <script src="jspopper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <!-- validasi -->
  <script>
    $(document).ready(function() {
      $('.toggle').click(function() {
        $('ul').toggleClass('active');
      });
    });
  </script>

  <script>
    function simulasi() {
      var usia = $("#usia").val();
      var pengechasan = $("#pengechasan").val();
      var jam = $("#jam").val();
      var kondisi = $("#kondisi").val();
      var original = $("#original").val();

      //validasi
      var um = document.getElementById("usia");
      var tb = document.getElementById("pengechasan");
      var bb = document.getElementById("jam");
      var sk = document.getElementById("kondisi");
      var pp = document.getElementById("original");

      if (um.selectedIndex == 0) {
        alert("usia Tidak Boleh Kosong");
        return false;
      }

      if (tb.selectedIndex == 0) {
        alert("pengechasan Tidak Boleh Kosong");
        return false;
      }

      if (bb.selectedIndex == 0) {
        alert("jam Tidak Boleh Kosong");
        return false;
      }

      if (sk.selectedIndex == 0) {
        alert("Status kondisi Tidak Boleh Kosong");
        return false;
      }

      if (pp.selectedIndex == 0) {
        alert("original Tidak Boleh Kosong");
        return false;
      }

      //batas validasi

      $.ajax({
        url: 'simulasi.php',
        type: 'POST',
        dataType: 'html',
        data: {
          usia: usia,
          pengechasan: pengechasan,
          jam: jam,
          kondisi: kondisi,
          original: original
        },
        success: function(data) {
          document.getElementById("hasilSIM").innerHTML = data;
        },
      });

      return false;

    }
  </script>

  <script>
    $(document).ready(function() {
      $('#dor').click(function() {
        $('html, body').animate({
          scrollTop: $("#hasilSIM").offset().top
        }, 500);
      });
    });
  </script>
</body>

</html>