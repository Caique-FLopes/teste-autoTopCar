<?php $this->layout = 'master';?>

<?php $this->start('css')?>
<link rel="stylesheet" href="css/my_home.css">
<?php $this->end()?>

<?php $this->assign('title', 'Sei la po'); ?>

<?php $this->start('header');?>
<?php echo $this->element('header'); ?>
<?php $this->end();?>

<ul>
  <?php foreach($marcas as $marca): ?>
      <li><?= $marca->name ?></li>
  <?php endforeach; ?>
</ul>
  


<?php $this->start('js')?>
<script>
</script>
<?php $this->end()?>