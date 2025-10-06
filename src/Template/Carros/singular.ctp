<?php $this->layout = 'master'; ?>

<?php $this->start('css') ?>
<link rel="stylesheet" href="css/my_home.css">
<?php $this->end() ?>

<?php $this->assign('title', "{$carro->model} {$carro->year}"); ?>

<?php $this->start('header'); ?>
  <?= $this->element('header'); ?>
<?php $this->end(); ?>

<?php $this->start('footer'); ?>
  <?= $this->element('footer'); ?>
<?php $this->end(); ?>

<?php $this->start('js'); ?>
<script>
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
  const tooltipList = [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));
</script>
<?php $this->end(); ?>

<section class="mt-4">
  <h1><?= h($slug) ?></h1>

  <article class="row">
    <div class="col-md-6">
      <picture>
        <?php if (!empty($imageUrl)): ?>
          <img src="<?= h($imageUrl) ?>" alt="<?= h($slug) ?>" class="img-fluid rounded">
        <?php else: ?>
          <img src="/img/placeholder-car.png" alt="Sem imagem" class="img-fluid rounded">
        <?php endif; ?>
      </picture>
    </div>

    <div class="col-md-6">
      <ul class="list-group">
        <li class="list-group-item"><strong>Modelo:</strong> <?= h($carro->model) ?></li>
        <li class="list-group-item"><strong>Ano:</strong> <?= h($carro->year) ?></li>
        <?php if (isset($carro->placa)): ?>
          <li class="list-group-item"><strong>Placa:</strong> <?= h($carro->placa) ?></li>
        <?php endif; ?>
        <?php if (isset($carro->descricao)): ?>
          <li class="list-group-item"><strong>Descrição:</strong> <?= h($carro->descricao) ?></li>
        <?php endif; ?>
      </ul>
    </div>
  </article>
</section>
