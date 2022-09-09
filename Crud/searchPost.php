<?php


if (isset($_POST['q'])) {
    $q = $_POST['q'];
    $query = "SElECT ds_titulo, ds_conteudo, ds_autor, dt_criacao FROM tb_dicas WHERE ds_titulo LIKE :q";
    $q = "%" . $q . "%";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':q', $q);
    $stmt->execute();
    $jml = $stmt->rowCount();

    if ($jml > 0) {
      $no = 1;
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        echo '<div class="card" style="width: 90%; text-align:center; margin: auto; padding: 30px; margin-bottom: 10px;">
       <div class="card-body">
        <h5 class="card-title" style="color: #3a688b;"> <b>' . $no . '- ' . $ds_titulo . '</b></h5> 
       <p class="card-text">' . $ds_conteudo . '</p><br>
       <h6 class="card-subtitle text-muted text-right"><b>Atualização:</b> ' . $dt_criacao . ' &nbsp;&nbsp;
       <b>Especialista:</b> ' . $ds_autor . '</h6>
       </div> </div>';
        $no++;
      }
      echo "</table>";
    } else {
      $q = $_POST['q'];
      echo '<p class="mt-5 mx-auto"> &nbsp;&nbsp; Não há registros para a pesquisa: "<b>' . $q . '</b>."</p> ';
      echo '<div class="row">';
    }
}