<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Neptun Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card mt-3">
          <div class="card-header">
            <h4 class="text-center">Detyre shtepie 1</h4>
          </div>
        </div>
      </div>

      <!-- Brand List  -->
      <div class="col-md-3">
        <form action="" method="GET">
          <div class="card shadow mt-3">
            <div class="card-header">
              <h5>Filtro sipas vitit
                <button type="submit" class="btn btn-primary btn-sm float-end">Kërko</button>
              </h5>
            </div>
            <div class="card-body">
              <h6>Vitet </h6>
              <hr>
              <?php
              $lidhja = mysqli_connect("localhost", "root", "", "neptunshop"); //lidhja me db
              $muaj_query = "SELECT * FROM `a_muajt` ORDER BY `a_muajt`.`muaj_id` ASC"; // ketu behet paraqitja e muajve nga databaza e muajve ne rendin rrites
              $muaj_query_run  = mysqli_query($lidhja, $muaj_query); //ketu behet afishimi i reyultatit pasi behet lidhja
              if (mysqli_num_rows($muaj_query_run) > 0) { //kontrollojme nese numri i rreshtave ne tabelen ku po bejme query eshte bosh
                foreach ($muaj_query_run as $lista_viteve) {
                  $perzgjedhur = []; //ketu ruajme vlerat e viteve te perygjedhur ne checkbox
                  if (isset($_GET['muaj_id'])) {
                    $perzgjedhur = $_GET['muaj_id'];
                  }
              ?>
                  <div>
                    <input type="checkbox" name="muaj_id[]" value="<?= $lista_viteve['muaj_id']; ?>" <?php if (in_array($lista_viteve['muaj_id'], $perzgjedhur)) {
                                                                                                        echo "perzgjedhur";
                                                                                                      } ?> />
                    <?= $lista_viteve['muaj_emer']; ?>
                  </div>
              <?php
                }
              } else {
                echo "Nuk kemi vite";
              }
              ?>
            </div>
          </div>
        </form>
      </div>

      <!-- Brand Items - produktet -->
      <div class="col-md-9 mt-3">
        <div class="card ">
          <div class="card-body row">
            <?php
            if (isset($_GET['muaj_id'])) {
              $produkte_perzgjedhur = [];
              $produkte_perzgjedhur = $_GET['muaj_id'];

              foreach ($produkte_perzgjedhur as $rreshti_produktit) {
                $produktet = "SELECT * FROM a_viti WHERE id_viti IN ($rreshti_produktit) ORDER BY `a_viti`.`sasia_produktit` DESC";
                $produktet_run = mysqli_query($lidhja, $produktet);
                if (mysqli_num_rows($produktet_run) > 0) {
                  foreach ($produktet_run as $proditems) :
            ?>
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th class="text-center">Viti</th>
                          <th class="text-center">Emri i Produktit</th>
                          <th class="text-center">Sasia e Produktit</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th class="text-center"><?= $proditems['viti_produktit'] ?></th>
                          <td class="text-center"><?= $proditems['emri_produktit']; ?></td>
                          <td class="text-center"><?= $proditems['sasia_produktit']; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  <?php

                  endforeach;
                }
              }
            } else {
              $produktet = "SELECT * FROM a_viti";
              $produktet_run = mysqli_query($lidhja, $produktet);
              if (mysqli_num_rows($produktet_run) > 0) {
                foreach ($produktet_run as $proditems) :
                  ?>
                  <div class="col-md-4 mt-3">
                    <div class="border p-2">
                      <h6><?= $proditems['emri_produktit']; ?></h6>
                    </div>
                  </div>
            <?php
                endforeach;
              } else {
                echo "Nuk gjetem produkte";
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>