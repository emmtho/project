<?php

namespace Anax\Comment;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class CommentController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;



    /**
     * View all comments.
     *
     * @return void
     */
    public function viewAction($pageName)
    {
        $comments = new \Anax\Comment\CommentsInSession();
        $comments->setDI($this->di);

        $all = $comments->findAll($pageName);

        $this->views->add('comment/comments', [
            'comments' => $all,
        ]);
    }

    public function addCAction($id){
      $this->initialize();
      $form = $this->form;

            $form = $form->create([], [
                'name' => [
                    'type'        => 'text',
                    'label'       => 'Name:',
                    'required'    => true,
                    'placeholder' => 'Name',
                    'validation'  => ['not_empty'],
                ],
                'email' => [
                    'type'        => 'text',
                    'required'    => true,
                    'placeholder' => 'email address',
                    'validation'  => ['not_empty', 'email_adress'],
                ],
                'content' => [
                    'type'        => 'text',
                    'label'       => 'Content',
                    'required'    => true,
                    'placeholder' => 'content',
                    'validation'  => ['not_empty'],
                ],
                'web' => [
                    'type'        => 'text',
                    'label'       => 'Web address',
                    'required'    => true,
                    'placeholder' => 'Web address',
                    'validation'  => ['not_empty'],
                ],
                'submit' => [
                    'type'      => 'submit',
                    'callback'  => function($form) {

                    $now = date('Y-m-d H:i:s');

                    $this->comment->save([
                      'name'      => $form->Value('name'),
                      'email'     => $form->Value('email'),
                      'content'   => $form->Value('content'),
                      'web'       => $form->Value('web'),
                      'timestamp' => $now,
                    ]);

                    return true;
                }
            ],

        ]);

        // Check the status of the form
        $status = $form->check();

        if ($status === true) {
           $url = $this->url->create('commentdb');
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


    /**
     * Add a comment.
     *
     * @return void
     */
    public function addAction()
    {
        $isPosted = $this->request->getPost('doCreate');
        $pageName = $this->request->getPost('pageName');
        if (!$isPosted) {
            $this->response->redirect($this->request->getPost('redirect'));
        }

        $comment = [
            'content'   => $this->request->getPost('content'),
            'name'      => $this->request->getPost('name'),
            'web'       => $this->request->getPost('web'),
            'mail'      => $this->request->getPost('mail'),
            'timestamp' => time(),
            'pageName' => $this->request->getPost('pageName'),
            'ip'        => $this->request->getServer('REMOTE_ADDR'),
        ];

        $comments = new \Anax\Comment\CommentsInSession();
        $comments->setDI($this->di);

        $comments->add($comment, $pageName);

        $this->response->redirect($this->request->getPost('redirect'));
    }

    public function editAction($id, $pageName){

      $comments = new \Anax\Comment\CommentsInSession();
      $comments->setDI($this->di);
      //$pageName = $this->request->getPost('pageName');
      $comment = $comments->find($id, $pageName);

        $this->views->add('comment/edit', [
          'id' => $id,
          'content' =>  $comment['content'],
          'mail' => $comment['mail'],
          'name' => $comment['name'],
          'web' => $comment['web'],
          'output' => null,
          'pageName' => $comment['pageName'],
          ]);

    }

    public function saveAction(){
      $comments = new \Anax\Comment\CommentsInSession();
      $comments->setDI($this->di);

      $isPosted = $this->request->getPost('doEdit');
      if ($isPosted) {
        $id = $this->request->getPost('id');
        $pageName = $this->request->getPost('pageName');
        $comment = $comments->find($id, $pageName);
          $comment = [
              'content'   => $this->request->getPost('content'),
              'name'      => $this->request->getPost('name'),
              'web'       => $this->request->getPost('web'),
              'mail'      => $this->request->getPost('mail'),
              'timestamp' => time(),
              'pageName' => $this->request->getPost('pageName'),
              'ip'        => $this->request->getServer('REMOTE_ADDR'),
          ];

          $comments->edit($id, $pageName, $comment);
          $this->response->redirect($this->request->getPost('redirect'));
      }
    }


    /**
     * Remove all comments.
     *
     * @return void
     */
    public function removeAllAction()
    {
        $isPosted = $this->request->getPost('doRemoveAll');

        if (!$isPosted) {
            $this->response->redirect($this->request->getPost('redirect'));
        }

        $comments = new \Anax\Comment\CommentsInSession();
        $comments->setDI($this->di);

        $comments->deleteAll();

        $this->response->redirect($this->request->getPost('redirect'));
    }

    public function removeAction($id, $pageName){
      $comments = new \Anax\Comment\CommentsInSession();
      $comments->setDI($this->di);

      $comments->delete($id, $pageName);

      $this->response->redirect($this->url->create(''));
    }
}
