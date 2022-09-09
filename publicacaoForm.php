<?php
  include __DIR__.'/includes/header.php';
?>
    <!-- Fim do Header -->
    <!-- Conteudo principal -->

    <!-- Slide Menu -->
    <div class="cssgrid">
      <!-- Posts -->
      <form id="publicacaoForm" action="">
        <h1>Criar publicação</h1>
        <button><a href="index.php">X</a></button>
        <hr />
        <label class="mt-2" for="">Título</label>
        <input type="text" />
        <label for="">Conteudo</label>
        <textarea
          class="mt-2"
          placeholder="Conteudo"
          name=""
          id=""
          cols="30"
          rows="10"
        ></textarea>
        <hr />
        <h5 class="mt-2">Adicionar a sua publicação</h5>
        <p>Imagem</p>
        <hr />
        <div class="btn btn-primary mt-4">Criar publicação</div>
      </form>
      <!-- Ranking -->
      <div id="ranking"></div>
    </div>
    <!-- Footer -->

  <?php
    include __DIR__.'/includes/footer.php';
  ?>