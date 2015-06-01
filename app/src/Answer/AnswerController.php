<?php

namespace Anax\Answer;

/**
 * To make question to the page
 *
 */
class AnswerController implements \Anax\DI\IInjectionAware
{
  use \Anax\DI\TInjectable;

  public function setupAction(){
    $this->initialize();
    $this->answer->setupAnswer();
    $this->theme->setTitle('Återställ databasen');
    $this->views->addString('<h1>Återställ databasen</h1><p>Nu är databasen återställd.</p>');
  }

  public function initialize()
  {
      $this->answer = new \Anax\Answer\Answer();
      $this->answer->setDI($this->di);
  }

  public function addAction(){
    //$this->id = $id;
    //var_dump($id);
    //die();
    $this->initialize();
    $form = $this->form;

          $form = $form->create([], [
              'content' => [
                  'type'        => 'text',
                  'label'       => 'Content',
                  'required'    => true,
                  'placeholder' => 'content',
                  'validation'  => ['not_empty'],
              ],
              'submit' => [
                  'type'      => 'submit',
                  'callback'  => function($form) {

                  $now = date('Y-m-d H:i:s');

                  $this->answer->save([
                    'content'   => $form->Value('content'),
                    'userID'       => $this->session->get('id'),
                    'questionID'  => $this->session->get('questionID'),
                    'timestamp' => $now,
                  ]);

                  return true;
              }
          ],

      ]);

      // Check the status of the form
      $status = $form->check();

      if ($status === true) {
         $url = $this->url->create('question/show/' . $this->session->get('questionID'));
         $this->response->redirect($url);

      } else if ($status === false) {
          $url = $this->url->create('commentdb');
         $this->response->redirect($url);
      }


      $this->theme->setTitle("Lägg till kommentar");

      $this->views->add('commentdb/add', [
          'content' =>$form->getHTML(),
          'title' => '<h2>Skapa en ny kommentar</h2>',
      ]);
  }

}
