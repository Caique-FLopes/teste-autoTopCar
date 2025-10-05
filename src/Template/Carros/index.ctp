<?php $this->layout = 'master';?>

<?php $this->start('css')?>
<link rel="stylesheet" href="css/my_home.css">
<?php $this->end()?>

<?php $this->assign('title', 'Carros'); ?>

<?php $this->start('header');?>
<?php echo $this->element('header'); ?>
<?php $this->end();?>

<?php $this->start('js');?>
  <script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
  </script>
<?php $this->end();?>

<section class="mt-4">
  <h1>Carros</h1>
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
    <div class="d-flex flex-column align-items-center gap-2 card-body">
      <a 
        href="/carros/adicionar"
        class="btn text-bg-success"
        data-bs-toggle="tooltip"
        data-bs-title="Adicionar nova marca">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
          <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
          <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
        </svg>
        Adicionar
      </a>
    </div>
  </ul>
  
</section>
