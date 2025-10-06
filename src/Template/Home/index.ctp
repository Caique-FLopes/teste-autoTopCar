<?php $this->layout = 'master';?>

<?php $this->start('css')?>
<link rel="stylesheet" href="css/my_home.css">
<?php $this->end()?>

<?php $this->assign('title', 'AutoTopCar - Inicio'); ?>

<?php $this->start('header');?>
<?php echo $this->element('header'); ?>
<?php $this->end();?>

<?php $this->start('footer') ?>
<?= $this->element('footer') ?>
<?php $this->end() ?>

<section class="">
  <?php foreach($marcas as $marca): ?>
    <div class="d-flex flex-column mb-3 gap-4">
      <h2><?= $marca->name ?></h2>
      <ul class="row justify-content-center align-center gap-3">
        <?php $count = 1; 
          foreach($carros as $carro):
          if($carro->marca_id == $marca->id && $count <=4):
            $count++
           ?>
            <li class="card" style="width: 18rem;">
              <img class="card-img-top" alt="<?= $carro->name ?>">
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
          <?php endif; ?>
        <?php endforeach;?>
      </ul>
      <a href="/marcas/<?= $marca->id ?>/carros" class="btn bg-success text-bg-success align-self-end">Ver mais carros</a>
    </div>
  <?php endforeach; ?>
</section>


<?php $this->start('js')?>
<script>
</script>
<?php $this->end()?>