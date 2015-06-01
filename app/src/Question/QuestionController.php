<?php

namespace Anax\Question;

/**
 * To make question to the page
 *
 */
class QuestionController implements \Anax\DI\IInjectionAware
{
  use \Anax\DI\TInjectable;

  public function setupAction(){
    $this->initialize();
    $this->question->setupQuestion();
    $this->theme->setTitle('Återställ databasen');
    $this->views->addString('<h1>Återställ databasen</h1><p>Nu är databasen återställd.</p>');
  }

  public function indexAction($limit=null,$sort=null)
    {
        $this->initialize();
        $all = $this->question->findAll($limit,$sort);
        $this->views->add('question/index', [
            'questions' => $all,
        ]);
    }


  public function addAction(){
    $this->initialize();
    $form = $this->form;
    $this->theme->setTitle("Lägg till fråga");

          $form = $form->create([], [
              'title' => [
                  'type'        => 'text',
                  'label'       => 'Titel:',
                  'required'    => true,
                  'placeholder' => 'Title',
                  'validation'  => ['not_empty'],
              ],
              'content' => [
                  'type'        => 'text',
                  'label'       => 'Content',
                  'required'    => true,
                  'placeholder' => 'content',
                  'validation'  => ['not_empty'],
              ],
              'tags' => [
                      'type'        => 'text',
                      'label'       => 'Taggar(Sepparera taggarna med ",")',
                      'required'    => true,
                      'validation'  => ['not_empty'],
                  ],
              'submit' => [
                  'type'      => 'submit',
                  'callback'  => function($form) {

                  $now = date('Y-m-d H:i:s');

                  $this->question->save([
                    'title'      => $form->Value('title'),
                    'content'   => $form->Value('content'),
                    'userID'       => $this->session->get('id'),
                    'timestamp' => $now,
                  ]);
                  $this->db->select('id')
                      ->from('question')
                      ->orderby('id DESC')
                      ->limit(1);
                  $this->db->execute();
                  $this->db->fetchInto($this);

                  $this->tag->saveTag($form->Value('tags'), $this->id);
                  return true;
              }
          ],

      ]);

      // Check the status of the form
      $status = $form->check();

      if ($status === true) {
         $url = $this->url->create('question');
         $this->response->redirect($url);

      } else if ($status === false) {
          $url = $this->url->create('question');
         $this->response->redirect($url);
      }

      $this->views->add('question/add', [
          'content' =>$form->getHTML(),
          'title' => '<h2>Skapa en ny fråga</h2>',
      ]);
  }

  public function initialize()
  {
      $this->question = new \Anax\Question\Question();
      $this->question->setDI($this->di);
      $this->users = new \Anax\Users\User();
      $this->users->setDI($this->di);
      $this->answers = new \Anax\Answer\Answer();
      $this->answers->setDI($this->di);
      $this->comments = new \Anax\CommentDB\CommentDB();
      $this->comments->setDI($this->di);
      $this->tag = new \Anax\Tags\Tags();
      $this->tag->setDI($this->di);
  }

  public function viewAction()
  {
      $this->initialize();
      $this->theme->setTitle('Frågor');
      $all = $this->question->findAllById();
      $this->views->add('question/views', [
          'views' => $all,
      ]);
  }

  public function showAction($id){
    $this->theme->setTitle('Specific fråga');
    $this->initialize();
    $all = $this->question->findById($id);
    $users = $this->users->find($all->userID);
    $answers = $this->answers->findAllById($all->id);
    $this->session->set('questionID',$all->id);
    $comments = $this->comments->findAll();
    //var_dump($all);
    //die();
    $this->views->add('question/show', [
        'questions' => $all,
        'users' => $users,
        'answers'=> $answers,
        'comments'=> $comments,
    ]);

    $this->dispatcher->forward([
      'controller' => 'answer',
      'action'     => 'add',
    ]);
  }


  public function editAction($id)
  {
      $this->initialize();

      $form = $this->form;

      $question = $this->question->find($id);

      $form = $form->create([], [
          'title' => [
              'type'        => 'text',
              'label'       => 'Titel:',
              'required'    => true,
              'placeholder' => 'Title',
              'validation'  => ['not_empty'],
              'value'       => $question->title,
          ],
          'content' => [
              'type'        => 'text',
              'label'       => 'Content',
              'required'    => true,
              'placeholder' => 'content',
              'validation'  => ['not_empty'],
              'value'       => $question->content,
          ],
          'submit' => [
              'type'      => 'submit',
              'callback'  => function($form) use ($question) {

             $now = date('Y-m-d H:i:s');

          $this->question->save([
              'id'        => $question->id,
              'title'      => $form->Value('title'),
              'content'   => $form->Value('content'),
              'timestamp' => $now,
                  ]);

          return true;
          }
          ],

      ]);

      // Check the status of the form
      $status = $form->check();

      if ($status === true) {
           $url = $this->url->create('question');
           $this->response->redirect($url);

      } else if ($status === false) {
          header("Location: " . $_SERVER['PHP_SELF']);
          exit;
      }

          $this->theme->setTitle("Uppdatera en fråga");


          $this->views->add('question/edit', [
              'content' =>$form->getHTML(),
              'title' => '<h2>Uppdatera en fråga</h2>',
          ]);

  }

  public function removeAction($id=null)
  {
      $this->initialize();
      if (!isset($id)) {
          die("Missing id");
      }

      $res = $this->question->delete($id);

      $url = $this->url->create('question');
      $this->response->redirect($url);
  }
}
