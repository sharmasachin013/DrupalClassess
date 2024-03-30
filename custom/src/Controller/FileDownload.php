<?php

namespace Drupal\custom\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use symfony\Component\DependencyInjection\containerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Drupal\Core\File\FileSystemInterface;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Egulias\EmailValidator\EmailValidator;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Messenger\MessengerInterface;

class FileDownload extends ControllerBase implements ContainerInjectionInterface { 

    /**
     *  The file system.
     */
    protected FileSystemInterface $fileSystem;
    protected RequestStack $request;
    protected $emailValidator;
    protected $account;
    protected $messenger;

    public function __construct(
      FileSystemInterface $file_system,
      RequestStack $request_stack,
      EmailValidator $email_validator,
      AccountInterface $account,
      MessengerInterface $messenger
      ){
        $this->fileSystem = $file_system;
        $this->request = $request_stack;
        $this->emailValidator = $email_validator;
        $this->account = $account;
        $this->messenger = $messenger;
    }
    /**
     *  {@inheritdoc }
     */
    public static function create(containerInterface $container){
        return new static(
            $container->get('file_system'),
            $container->get('request_stack'),
            $container->get('email.validator'),
            $container->get('current_user'),
            $container->get('messenger')
        );
    }

    public function build() {
        $uri = "public://download.csv";
        $list = ["Sachin", "MCA" ,"Pune", "India"];
         $headers = [
           'Content-Type' => 'text/csv',
           'Content-Disposition' => 'attachment;filename="download.csv"'
        ];
  $csvFile = $this->fileSystem->saveData($list, $uri, FileSystemInterface::EXISTS_REPLACE); 
  $res =  new BinaryFileResponse($csvFile, 200, $headers, TRUE);
  return $res->deleteFileAfterSend(TRUE);

    }
    public function urltest() {

      // $host = $this->request->getParentRequest();
      // echo $host;
      // exit;
        

     // $request = \Drupal::service('request_stack')->getCurrentRequest();
    //   $host = $request->getHost();
    //   $http = $request->getScheme();
    //   $fullUrl = $request->getSchemeAndHttpHost();
    //   $requestUri = $request->getRequestUri();
    //   $queryParameters = $request->query->all();

      //Using The Url Object
      //  $url = new Url('user.logout');
      //  $url = new Url('<current>');
      //  $url = new Url('<none>');
       $url = new Url('<front>');
      //  $url = new Url('<nolink>');
      //  $url = new Url('<button>');
      // $url = new Url('entity.node.canonical', ['node' => 1]);
      //$url->setRouteParameter('action', 'logout');
      $link = new Link('Link', $url);
      $renderable = $link->toRenderable();
      $build['link'] = $renderable;
      return $build;
    }

    public function exampleDi(){
      $uid = $this->account->id();
    if($uid){
        $this->messenger->addMessage(t("Form Submitted By Login User"));
    } else {
        $this->messenger->addMessage(t('Form Submitted By End  User'));
    }

     if (!$this->emailValidator->isValid('test@gmail.com')) {
       $this->messenger->addMessage(t("Invalid Email Id"));
    } else {
      $this->messenger->addMessage(t("Correct Email Id"));

    }

   

     $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;

    }
}