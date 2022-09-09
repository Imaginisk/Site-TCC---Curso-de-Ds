<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/main.css" />
    <title>Ecodoor</title>
  </head>
  <body>
    
    <!-- Header -->
    <!-- Navbar -->
    <div class="header">
      <div>
        <nav id="navbar" class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand" href="home.php"
            ><img style="border-radius: 50%; height: 80px; object-fit: cover;" src="img/LogoEcodoor3.jpg" alt="" /></a>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="home.php"
                  >Home <span class="sr-only">(current)</span></a
                >
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="floresta.php">Floresta Virtual</a>
              </li>
             
               
                   <?php
                      if(isset($_SESSION['idusuario']) || isset($_SESSION['idadm']) || isset($_SESSION['idOng'])){
                        include "logadoNav.php";
                        
                      }else{
                        include "deslogadoNav.php";
                        
                      }
                  ?>
                  <?php  
                        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
                            $url = "https://";   
                        else  
                            $url = "http://";   
                        // Append the host(domain name, ip) to the URL.   
                        $url.= $_SERVER['HTTP_HOST'];   
                        
                        // Append the requested resource location to the URL   
                        $url.= $_SERVER['REQUEST_URI'];    
                          
                      ?>   
                      <!-- <?php //if($url == "http://06c5-2804-3660-649-9700-758f-864f-f3ac-3925.ngrok.io/xamp/30-11-21%20-%20E%20nunca%20%c3%a9%20um%20adeus!/index.php") : ?> -->
                        <?php if(isset($_SESSION['idusuario']) || isset($_SESSION['idadm']) ) : ?>
                            <li>
                              <button onclick="mostrarPesquisa()" id="btnMostrar" class="btn btn-primary">Realizar pesquisa</button>
                          </li>
                        <?php endif ?>
                      <?php //endif ?>
            </ul>
            <form id="pesquisa1" style="visibility: hidden;"action="" class="form-inline my-2 my-lg-0" method="GET">
                  <div class="dropdown">
                                  <button  class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Pesquisar por tag
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                    <div class="form-check">
                                          <input class="form-check-input" type="radio" value="Meio-ambiente" name="tag" id="flexRadioDefault1" checked>
                                          <label class="form-check-label" for="flexRadioDefault1">
                                            Meio-ambiente
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" value="Ecologia" type="radio" name="tag" id="flexRadioDefault2" >
                                          <label class="form-check-label" for="flexRadioDefault2">
                                            Ecologia
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" value="Reciclagem" type="radio" name="tag" id="flexRadioDefault3" >
                                          <label class="form-check-label" for="flexRadioDefault3">
                                            Reciclagem
                                          </label>
                                        </div>
                                    </ul>
                                  </div>
                  <button class="btn btn-danger my-2 my-sm-0" style="margin-right: 10px;" type="submit">Procurar</button>
              </form>
              <form id="pesquisa2" style="visibility: hidden;"  class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" name="q" placeholder="Pesquisar por titulo" aria-label="Procurar">
                <button class="btn btn-danger my-2 my-sm-0"  type="submit">Procurar</button>
              </form>
              <form id="pesquisa3" style="visibility: hidden;" method="GET" class="form-inline my-2 my-lg-0" action="perfilBusca.php">
                <input class="form-control mr-sm-2" type="search" name="UserOng" placeholder="Pesquisar usuario ou Ong" aria-label="Procurar">
                <button class="btn btn-danger my-2 my-sm-0"  type="submit">Procurar</button>
              </form>
            <?php if(isset($_SESSION['idusuario']) || isset($_SESSION['idadm']) ) : ?>
              <?php 
                include "Crud/conexao.php";
                  $id = $_SESSION['idusuario'];
                  $sql = "select * from usuario where id=$id";
                  $sql = $pdo->prepare($sql);
                  $sql->execute();
                  $dado = $sql->fetch();
                ?>
                  <h5 id="nomeusuarioLogado" style="display: inline-block;"><?php echo $_SESSION['nome']??"" . " " . $_SESSION['sobrenome']??""; ?>/Ecopoints: <?php echo $dado['vl_ecopoints']??"X";?></h5>
            <?php elseif(isset($_SESSION['idOng'])) : ?>
              <h5><?php echo $_SESSION['nome'] . "/Ecopoint: X" ?></h5>
            <?php endif; ?>
          </div>
        </nav>
      </div>
    </div>
    <script>
      function mostrarPesquisa(){
        let elem = document.getElementById("nomeusuarioLogado");
        if (typeof elem != "undefined") {
          elem.remove(elem);
        }
        let pesquisa1 = document.getElementById("pesquisa1");
        pesquisa1.style.visibility = "visible";
        let pesquisa2 = document.getElementById("pesquisa2");
        pesquisa2.style.visibility = "visible";
        let btn = document.getElementById("btnMostrar");
        pesquisa3.style.visibility = "visible";
        btn.style.visibility = "hidden";
      }
    </script>
    