<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Carros Controller
 *
 */
class CarrosController extends AppController
{
  private function _getCarros($id = null){
    $tableCarros = TableRegistry::getTableLocator('default')->get('carros');

    if($id) return $tableCarros->get($id);

    $tableSituacoes = TableRegistry::getTableLocator('default')->get('situacoes');
    $ids = $tableSituacoes->find()->select(['id_item'])->where(['description' => 'active', 'table_item' => 'carros']);
    return $tableCarros->find()->where(['id IN' => $ids]);
  }

  private function _insertCarro($data){
    $tableCarros = TableRegistry::getTableLocator('default')->get('carros');
    $tableSituacoes = TableRegistry::getTableLocator('default')->get('situacoes');

    try {
      $newCarro =  $tableCarros->newEntity($data);
      $tableCarros->saveOrFail($newCarro);
      $newSituacao = $tableSituacoes->newEntity(['id_item' => $newCarro->id, 'table_item' => 'carros']);
      $tableSituacoes->saveOrFail($newSituacao);
      return $newCarro;
    } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
      var_dump( $e->getEntity());
    }
  }

  private function _deleteCarro($id){
    $tableSituacoes = TableRegistry::getTableLocator('default')->get('situacoes');
    $tableSituacoes->updateAll(['description' => 'deleted'],['id_item' => $id, 'table_item' => 'carros']); 
    $this->redirect(['_name' => 'carros.index']);
  }

  private function _updateCarro($id, $data){
    $tableCarros = TableRegistry::getTableLocator('default')->get('carros');

    $tableCarros->updateAll($data, ['id ='=> $id]);
    $this->redirect(['_name' => 'marcas.index']);
  }

  private function _getMarcasAtivas(){
    $tableSituacoes = TableRegistry::getTableLocator('default')->get('situacoes');
    $tableMarcas = TableRegistry::getTableLocator('default')->get('marcas');

    $ids = $tableSituacoes->find()->select(['id_item'])->where(['description' => 'active', 'table_item' => 'marcas']);
    return $tableMarcas->find()->where(['id IN' => $ids]);
  }

  private function _insertImage($data){
    $tableImages = TableRegistry::getTableLocator('default')->get('images');
    $tableSituacoes = TableRegistry::getTableLocator('default')->get('situacoes');
    try {
      $newImage =  $tableImages->newEntity($data);
      $tableImages->saveOrFail($newImage);
      $newSituacao = $tableSituacoes->newEntity(['id_item' => $newImage->id, 'table_item' => 'images']);
      $tableSituacoes->saveOrFail($newSituacao);
      return $newImage;
    } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
      var_dump( $e->getEntity());
    }
  }

  private function _getImageUrlForCar( $carId)
  {
    $Situacoes = TableRegistry::getTableLocator('default')->get('situacoes');
    $Images    = TableRegistry::getTableLocator('default')->get('images');

    // subquery: imagens ativas
    $idsSub = $Situacoes->find()
        ->select(['id_item'])
        ->where(['description' => 'active', 'table_item' => 'images'])
        ->enableAutoFields(false);

    $img = $Images->find()
        ->select(['url_image'])
        ->where([
            'id IN'       => $idsSub,
            'id_item'     => $carId,
            'table_item'  => 'carros',
        ])
        ->first();

    return $img->url_image ?? null;
  }

  public function index(){
    $carros = $this->_getCarros();
    $this->set(compact('carros'));
  }

  public function singular($id)
  {
      $carro = $this->_getCarros((int)$id);
      $slug  = "{$carro->model} {$carro->year}";

      $imageUrl = $this->_getImageUrlForCar((int)$id);

      $this->set(compact('carro', 'slug', 'imageUrl'));
  }

  public function adicionar(){
    $marcas = $this->_getMarcasAtivas();

    if ($this->request->is('post')) {
        $data = $this->request->getData();
        $file = $data['image'];

        if (!empty($file) && isset($file['tmp_name']) && $file['error'] === UPLOAD_ERR_OK) {
            $relativeDir = 'uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m');
            $absoluteDir = WWW_ROOT . $relativeDir;

            if (!is_dir($absoluteDir) && !mkdir($absoluteDir, 0755, true)) {
                $this->Flash->error('Não foi possível criar o diretório de uploads.');
                return $this->set(compact('marcas'));
            }

            $allowedExt  = ['jpg','jpeg','png','gif','webp'];
            $allowedMime = ['image/jpeg','image/png','image/gif','image/webp'];
            $ext  = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $mime = $file['type'];

            if (!in_array($ext, $allowedExt, true) || !in_array($mime, $allowedMime, true)) {
                $this->Flash->error('Tipo de arquivo não permitido.');
                return $this->set(compact('marcas'));
            }
            if (@getimagesize($file['tmp_name']) === false) {
                $this->Flash->error('O arquivo enviado não é uma imagem válida.');
                return $this->set(compact('marcas'));
            }

            $base   = pathinfo($file['name'], PATHINFO_FILENAME);
            $slug   = $this->_slugify($base) ?: 'image';
            $fname  = $slug . '-' . bin2hex(random_bytes(8)) . '.' . $ext;

            $destAbs = $absoluteDir . DIRECTORY_SEPARATOR . $fname;
            $destRel = str_replace(DIRECTORY_SEPARATOR, '/', $relativeDir . '/' . $fname);

            if (!move_uploaded_file($file['tmp_name'], $destAbs)) {
                $this->Flash->error('Erro ao mover o arquivo para o destino.');
                return $this->set(compact('marcas'));
            }

            $scheme  = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
            $host    = $_SERVER['HTTP_HOST'] ?? 'localhost';
            $webroot = rtrim($this->request->getAttribute('webroot') ?? '/', '/');
            $publicUrl = $scheme . '://' . $host . $webroot . '/' . ltrim($destRel, '/');

            $carroInserido = $this->_insertCarro($data);
            $this->_insertImage([
              'url_image' => $publicUrl,
              'id_item' => $carroInserido->id,
              'table_item' => 'carros',
            ]);
        }
    }

    $this->set(compact('marcas'));
  }

  private function _slugify( $text)
  {
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);
      $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
      $text = preg_replace('~[^-\w]+~', '', $text);
      $text = trim($text, '-');
      $text = preg_replace('~-+~', '-', $text);
      return strtolower($text);
  }


  public function editar($id){
    $marcas = $this->_getMarcasAtivas();
    $carroAtual = $this->_getCarros($id);
    
    $slug = "{$carroAtual->model} {$carroAtual->year}";

    if($this->getRequest()->is('delete')){
      $this->_deleteCarro($id);
    }

    if($this->getRequest()->is('post')){
      $this->_updateCarro($id, $this->getRequest()->getData());
    }

    $this->set(compact('carroAtual', 'slug', 'marcas'));
  }
}
