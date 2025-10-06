<?php $this->layout = 'master';?>

<?php $this->start('css')?>
<link rel="stylesheet" href="css/my_home.css">
<?php $this->end()?>

<?php $this->assign('title', "Adicionar nova Marca"); ?>

<?php $this->start('header');?>
<?php echo $this->element('header'); ?>
<?php $this->end();?>

<?php $this->start('footer') ?>
<?= $this->element('footer') ?>
<?php $this->end() ?>

<?php $this->start('js');?>
  <script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
  </script>
<?php $this->end();?>

<section>
  <h1>Adicionar Marca</h1>
  <div>
    <label for="logo_file">
      <picture>
        <img src="" alt="">
      </picture>
    </label>
  </div>
  <form method="post">
    <fieldset
      class="mb-3">
      <label 
        for="name"
        class="form-label">
        Nome
      </label>
      <input 
        type="text"
        name="name"
        id="name" 
        class="form-control"
        placeholder="Nome da Marca"
        aria-label="Nome da Marca"
        data-bs-toggle="tooltip"
        data-bs-title="Alterar o nome da Marca">
    </fieldset>
    <button 
      class="btn text-bg-primary"
      data-bs-toggle="tooltip"
      data-bs-title="Adicionar Marca">
      Adicionar
    </button>
  </form>
</section>