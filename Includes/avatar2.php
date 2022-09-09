<?php
include "../Crud/conexao.php";
$id = $_GET['id'];




$sql2 = "SELECT vl_ecopoints from usuario WHERE id = '$id'";
$sql2 = $pdo->prepare($sql2);
$sql2->execute();
$dado2 = $sql2->fetch();
$ecopoints = $dado2['vl_ecopoints'];
?>
<?php
if ($ecopoints >= 200) :
    echo $ecopoints;
    $sql = "UPDATE usuario SET vl_ecopoints = $ecopoints - 200 WHERE id = '$id'";
    $sql = $pdo->prepare($sql);
    $sql->execute();

    $sql = "UPDATE usuario SET foto_obtida2='img/avatares/avatar2.jpg' WHERE id = '$id'";
    $sql = $pdo->prepare($sql);
    $sql->execute();

    
 header('Location: ../index.php'); 

?>

<?php else : ?>
    <script>
        window.alert('Quantidade de ecopoints insuficientes!')
        window.location.href = "http://localhost/xampp/29-11-21%20-%20Almost%20there!/floresta.php";

    </script>
    <!-- <a href="../floresta.php" onload="window.alert('Tem certeza que deseja exclui o comentario?');"></a> -->

<?php
endif;
?>



