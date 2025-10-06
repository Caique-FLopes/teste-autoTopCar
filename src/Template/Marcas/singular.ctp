<?php $this->layout = 'master';?>

<?php $this->start('css')?>
<link rel="stylesheet" href="css/my_home.css">
<?php $this->end()?>

<?php $this->assign('title', $marca->name); ?>

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
  <div>
    <picture>
      <img src="" alt="">
    </picture>
  </div>
  <article>
    <p><?php //echo $marca->description ?></p>
  </article>
  
</section>
