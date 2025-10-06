<?php
/** @var \App\Model\Entity\Carro $carroAtual */
$this->layout = 'master';
$this->assign('title', h($slug));
?>

<?php $this->start('css') ?>
<link rel="stylesheet" href="/css/my_home.css">
<?php $this->end() ?>

<?php $this->start('header') ?>
<?= $this->element('header') ?>
<?php $this->end() ?>

<section>
  <h1>Editar <?= h($slug) ?></h1>
  <div>
    <label for="logo_file">
      <picture>
        <img id="logoPreview"
             alt="<?= h($slug) ?>"
             style="max-width:200px">
      </picture>
      <h1><?= h($slug) ?></h1>
    </label>

    <form
      id="carroForm"
      action="<?= $this->Url->build(['_name' => 'carros.editar', 'id' => $carroAtual->id]) ?>"
      method="post"
      enctype="multipart/form-data">

      <input type="hidden" name="_method" id="_method" value="POST">

      <fieldset class="mb-3">
        <label for="model" class="form-label">Modelo</label>
        <input
          type="text"
          name="model"
          id="model"
          class="form-control"
          placeholder="Nome do modelo"
          aria-label="Nome do modelo"
          data-bs-toggle="tooltip"
          data-bs-title="Adicione o nome do modelo"
          value="<?= h($carroAtual->model) ?>">
      </fieldset>

      <fieldset class="mb-3">
        <label for="year" class="form-label">Ano</label>
        <input
          type="number"
          min="1900"
          max="2025"
          placeholder="AAAA"
          name="year"
          id="year"
          class="form-control"
          aria-label="Ano de lançamento"
          data-bs-toggle="tooltip"
          data-bs-title="Adicionar o Ano de lançamento"
          value="<?= h($carroAtual->year) ?>">
      </fieldset>

      <fieldset class="form-floating mb-3">
        <select
          name="marca_id"
          class="form-select"
          id="marca_id"
          aria-label="Marca do carro"
          data-bs-toggle="tooltip"
          data-bs-title="Selecione a marca do carro">
          <option value="" <?= $carroAtual->marca_id ? '' : 'selected' ?>>Selecione a marca</option>
          <?php foreach ($marcas as $marca): ?>
            <option
              value="<?= $marca->id ?>"
              <?= (int)$marca->id === (int)$carroAtual->marca_id ? 'selected' : '' ?>>
              <?= h($marca->name) ?>
            </option>
          <?php endforeach; ?>
        </select>
        <label for="marca_id" class="form-label">Marca</label>
      </fieldset>

      <fieldset class="mb-3">
        <label for="placa" class="form-label">Placa</label>
        <input
          type="text"
          name="placa"
          id="placa"
          class="form-control"
          aria-label="Placa do Veículo"
          data-bs-toggle="tooltip"
          data-bs-title="Placa do veículo (somente leitura)"
          value="<?= h($carroAtual->placa) ?>"
          readonly>
        <!-- Se preferir manter disabled, espelhe num hidden:
        <input type="hidden" name="placa" value="<?= h($carroAtual->placa) ?>">
        -->
      </fieldset>

      <div class="d-flex justify-content-between">
        <button
          id="save"
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
          data-bs-title="Excluir Carro"
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
  // Validação semelhante à da página de Marcas: só envia se houver alteração
  document.querySelector('#carroForm').addEventListener('submit', (e) => {
    if (document.getElementById('_method').value === 'DELETE') return; // delete passa direto

    e.preventDefault();

    const initial = {
      model: '<?= addslashes((string)$carroAtual->model) ?>',
      year: '<?= addslashes((string)$carroAtual->year) ?>',
      marca_id: '<?= addslashes((string)$carroAtual->marca_id) ?>'
    };

    const current = {
      model: (document.getElementById('model').value || '').trim(),
      year: (document.getElementById('year').value || '').trim(),
      marca_id: (document.getElementById('marca_id').value || '').trim()
    };

    const changed =
      current.model !== initial.model ||
      current.year  !== String(initial.year) ||
      current.marca_id !== String(initial.marca_id);

    if (!current.model) {
      alert('Informe um modelo válido.');
      return;
    }

    if (!changed) {
      alert('Faça alguma alteração antes de salvar.');
      return;
    }

    e.target.submit();
  });

  function prepareDelete(e) {
    e.preventDefault();
    if (!confirm('Deseja excluir este carro? Esta ação não pode ser desfeita.')) {
      return false;
    }
    document.getElementById('_method').value = 'DELETE';
    document.getElementById('carroForm').submit();
    return true;
  }

  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
  const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
</script>
<?php $this->end() ?>
