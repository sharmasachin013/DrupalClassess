<?php 

namespace Drupal\product\Services;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\product\ProductDetailsInterface;
use Drupal\file\Entity\File;

/**
 * @todo Add class description.
 */
final class ProductDetails {


  protected  $entity;
  protected $messenger;
  //protected MessengerInterface $messenger;
  /**
   * Constructs a ProductDetails object.
   */
  public function __construct(
    EntityTypeManagerInterface $entityTypeManager,
    MessengerInterface $messenger
    ){
    $this->entity = $entityTypeManager;
    $this->messenger = $messenger;
  }

  /**
   * {@inheritdoc}
   */
  public function productDetails($id) {
   $node = $this->entity->getStorage('node')->load($id);
   $logo = $node->get('field_logo');
   $img = $node->get('field_image_product');
   $img2 = $node->get('field_img2');
   foreach ($logo as $item){
      $file_id = $item->target_id;
    }
     foreach ($img as $item){
      $img = $item->target_id;
    }

    foreach ($img2 as $item){
      $img2 = $item->target_id;
    }
   
  $file = File::load($file_id);
  $uri = $file->getFileUri();
  $realpath = \Drupal::service('file_system')->realpath($uri);
  
  
  $file_1 = File::load($img);
  $uri_1 = $file_1->getFileUri();
  $realpath_1 = \Drupal::service('file_system')->realpath($uri_1);

  $file_2 = File::load($img2);
  $uri_2 = $file_2->getFileUri();
  $realpath_2 = \Drupal::service('file_system')->realpath($uri_2);

  $path = str_replace($_SERVER['DOCUMENT_ROOT'] . '/', '', $realpath);
  $path = '/'.$path;
 
  $path_1 = str_replace($_SERVER['DOCUMENT_ROOT'] . '/', '', $realpath_1);
  $path_1 = '/'.$path_1;

  
  $path_2 = str_replace($_SERVER['DOCUMENT_ROOT'] . '/', '', $realpath_2);
  $path_2 = '/'.$path_2;


  $data['logo'] = $path;
  $data['image'] = $path_1;
  $data['image1'] = $path_2;
  
  return $data;
  
  //$this->messenger->addMessage(t("Demo!!!"));
    // @todo Place your code here.
  }

}
