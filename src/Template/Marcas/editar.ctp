<?php
/** @var \App\Model\Entity\Marca $marcaAtual */
$this->layout = 'master';
$this->assign('title', h($marcaAtual->name));
?>

<?php $this->start('css') ?>
<link rel="stylesheet" href="/css/my_home.css">
<?php $this->end() ?>

<?php $this->start('header') ?>
<?= $this->element('header') ?>
<?php $this->end() ?>

<section>
  <div>
    <label for="logo_file">
      <picture>
        <img id="logoPreview"
             src="<?= $marcaAtual->logo ? $this->Url->build('/' . h($marcaAtual->logo)) : '/img/placeholder.png' ?>"
             alt="<?= h($marcaAtual->name) ?>"
             style="max-width:200px">
      </picture>
      <h1><?= h($marcaAtual->name) ?></h1>
    </label>

    <form id="marcaForm"
          action="<?= $this->Url->build(['_name' => 'marcas.editar', $marcaAtual->id]) ?>"
          method="post"
          enctype="multipart/form-data">
      
      <input type="hidden" name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken') ?>">

      <input type="hidden" name="_method" id="_method" value="POST">

      <fieldset class="mb-3">
        <label for="name" class="form-label">Marca</label>
        <input 
          type="text"
          name="name"
          id="name"
          class="form-control"
          placeholder="Nome da Marca"
          aria-label="Nome da Marca"
          data-bs-toggle="tooltip"
          data-bs-title="Alterar o nome da Marca"
          value="<?= h($marcaAtual->name) ?>">
      </fieldset>

      <input type="file" name="logo_file" id="logo_file" accept="image/*" hidden>

      <div class="d-flex justify-content-between">
        <button 
          type="submit"
          class="btn text-bg-success"
          data-bs-toggle="tooltip"
          data-bs-title="Salvar Alterações"
          name="action"
          value="save">
          Salvar
        </button>

        <button 
          type="submit"
          class="btn text-bg-danger"
          data-bs-toggle="tooltip"
          data-bs-title="Excluir Marca"
          name="action"
          value="delete"
          onclick="return prepareDelete(event);">
          Excluir
        </button>
      </div>
    </form>
  </div>
</section>

<?php $this->start('js') ?>
<script>

  function prepareDelete(e) {
    e.preventDefault(); 
    if (!confirm('Deseja excluir esta marca? Esta ação não pode ser desfeita.')) {
      return false;
    }

    document.getElementById('_method').value = 'DELETE';

    let input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'action';
    input.value = 'delete';
    document.getElementById('marcaForm').appendChild(input);

    document.getElementById('marcaForm').submit();
    return true;
  }

  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
  const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
<?php $this->end() ?>
