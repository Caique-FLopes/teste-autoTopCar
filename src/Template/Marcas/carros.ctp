<?php $this->layout = 'master';?>

<?php $this->start('css')?>
<link rel="stylesheet" href="css/my_home.css">
<?php $this->end()?>

<?php $this->assign('title', 'Marcas'); ?>

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

<section class="mt-4">
  <h1><?= $marca->name ?></h1>
  <ul class="row justify-content-center align-center gap-3">
    <?php foreach($carros as $carro): ?>
        <li class="card" style="width: 18rem;">
          <img src= class="card-img-top" alt=<?= $carro->name ?>>
          <p><?= $carro->logo_file ?></p>
          <div class="d-flex flex-column gap-2 card-body">
            <h5 class="card-title"><?= "{$carro->model} {$carro->year}" ?></h5>
            <a 
              href=<?= "/carros/{$carro->id}" ?>
              class="btn btn-primary" 
              data-bs-toggle="tooltip"
              data-bs-title="Ver carros deste carro">
              Ver Detalhes
            </a>
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Opções
              </button>
              <ul class="dropdown-menu w-100">
                <li>
                  <a 
                    href="<?= "/marcas/{$carro->marca_id}" ?>"
                    class="dropdown-item"
                    data-bs-toggle="tooltip"
                    data-bs-title="Editar esta marca">
                    Ver Marca
                  </a>
                </li>
                <li><a class="dropdown-item" href="/carros/<?= $carro->id ?>/editar">Editar</a></li>
              </ul>
            </div>
            
          </div>
        </li>
    <?php endforeach; ?>
    
  </ul>
  
</section>
