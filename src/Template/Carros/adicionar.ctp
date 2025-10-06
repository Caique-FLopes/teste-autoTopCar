<?php $this->layout = 'master';?>

<?php $this->start('css')?>
<link rel="stylesheet" href="css/my_home.css">
<?php $this->end()?>

<?php $this->assign('title', "Adicionar novo Carro"); ?>

<?php $this->start('header');?>
<?php echo $this->element('header'); ?>
<?php $this->end();?>

<?php $this->start('footer') ?>
<?= $this->element('footer') ?>
<?php $this->end() ?>

<?php $this->start('js');?>
  <script>
    document.querySelector('#images').addEventListener('change', ({target}) =>{
        const imgAtual = document.querySelector('form img');
        var reader = new FileReader();
        reader.onload = function(e) {
          imgAtual.setAttribute('src', e.target.result);
        } 
        reader.readAsDataURL(target.files[0]);
    })

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
  </script>
<?php $this->end();?>

<section>
  <h1>Adicionar Carro</h1>

  <form method="post" enctype="multipart/form-data">
    <fieldset>
      <label for="images">
        <img src="https://placehold.co/300x200?text=Adicionar+Imagens" alt="" id="preview">
      </label>
      <input type="file" id="images" name="image" hidden>
    </fieldset>
    <fieldset
      class="mb-3">
      <label 
        for="model"
        class="form-label">
        Modelo
      </label>
      <input 
        type="text"
        name="model"
        id="model" 
        class="form-control"
        placeholder="Nome do modelo"
        aria-label="Nome do modelo"
        data-bs-toggle="tooltip"
        data-bs-title="Adicione o nome do modelo">
    </fieldset>
    <fieldset
      class="mb-3">
      <label 
        for="year"
        class="form-label">
        Ano
      </label>
      <input 
        type="number"
        min="1900"
        max="2025"
        placeholder="AAAA"
        name="year"
        id="year" 
        class="form-control"
        placeholder="Ano de lançamento"
        aria-label="Ano de lançamento"
        data-bs-toggle="tooltip"
        data-bs-title="Adicionar o Ano de lançamento">
    </fieldset>
    <fieldset
      class="form-floating mb-3">
      <select 
        name="marca_id" 
        class="form-select" 
        id="floatingSelect" 
        aria-label="Marca do carro"
        data-bs-toggle="tooltip"
        data-bs-title="Selecione a marca do carro">
        <option selected>Selecione a marca</option>
        <?php foreach($marcas as $marca): ?>
          <option value="<?= $marca->id ?>"><?= $marca->name ?></option>
        <?php endforeach; ?>
      </select>
      <label 
        for="marca_id"
        class="form-label">
        Marca
      </label>
    </fieldset>
    <fieldset
      class="mb-3">
      <label 
        for="placa"
        class="form-label">
        Placa
      </label>
      <input 
        type="text"
        placeholder="Placa do Carro"
        name="placa"
        id="placa" 
        class="form-control"
        placeholder="Placa do Veiculo"
        aria-label="Placa do Veiculo"
        data-bs-toggle="tooltip"
        data-bs-title="Adicionar o Placa do Veiculo">
    </fieldset>
    <button 
      class="btn text-bg-primary"
      data-bs-toggle="tooltip"
      data-bs-title="Adicionar Carro">
      Adicionar
    </button>
  </form>
</section>