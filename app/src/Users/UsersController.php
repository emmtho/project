<?php

namespace Anax\Users;

/**
 * A controller for users and admin related events.
 *
 */
class UsersController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    public function indexAction()
        {
            $this->theme->setTitle('User start page');
            $this->views->add('users/index', [
                'title' => "User start page",
            ]);
        }

    public function showAction($id){
      $this->initialize();

      $user = $this->users->find($id);
      $question = $this->question->findByUser($id);
      $answer = $this->answer->findByUser($id);
      $comment = $this->comment->findByUser($id);

      $this->theme->setTitle("View user with id");
      $this->views->add('users/show', [
        'title' => 'Om användaren',
          'user' => $user,
          'questions' => $question,
          'answers' => $answer,
      ]);
    }

 /**
 * List all users.
 *
 * @return void
 */
public function listAction()
{
    $this->users = new \Anax\Users\User();
    $this->users->setDI($this->di);

    $all = $this->users->findAll();

    $this->theme->setTitle("List all users");
    $this->views->add('users/list-all', [
        'users' => $all,
        'title' => "View all users",
    ]);
}

public function ViewAction($limit=null,$sort=null)
    {
        $this->initialize();
        $all = $this->users->findAll($limit,$sort);
        $this->views->add('users/page', [
            'users' => $all,
        ]);
    }

public function loginAction(){
  //Here starts the rendering phase of the add action
  $this->theme->setTitle("Logga in");
  $form = $this->form;
        $form = $form->create([], [
            'acronym' => [
                'type'        => 'text',
                'label'       => 'Acronym',
                'required'    => true,
                'placeholder' => 'Acronym',
                'validation'  => ['not_empty'],
            ],
            'password' => [
                'type'        => 'password',
                'label'       => 'Password',
                'required'    => true,
                'placeholder' => 'password',
                'validation'  => ['not_empty'],
            ],

            'submit' => [
                'type'      => 'submit',
                'callback'  => function($form) {
                    //$di->session->set('authenticated') =  true;
                    /*if($form->Value('acronym') =="doe" && $form->Value('password') == "doe"){
                      return true;
                    }
                    else{
                    return false;
                  }*/
                    if($this->findUser($form->Value('acronym'), $form->Value('password')) === true){
                        $this->session->set('id',$this->getId($form->Value('acronym')));
                        return true;
                      }
                      else{
                        return false;
                      }
                    }


        ],
    ]);

    $status = $form->check();

    if ($status === true) {
    // What to do if the form was submitted?
       $form->AddOutput("Den nya användaren är nu i användarlistan.");
       $url = $this->url->create('../testIndex.php');
       $this->response->redirect($url);
     }else if ($status === false) {
   // What to do when form could not be processed?
       $form->AddOutput("Den nya användaren las inte till i databasen.");
       $url = $this->url->create('users/login');
       $this->response->redirect($url);
     }

    $formOptions = [
    // 'start'           => false,  // Only return the start of the form element
    // 'columns'           => 1,      // Layout all elements in two columns
    // 'use_buttonbar'   => true,   // Layout consequtive buttons as one element wrapped in <p>
    // 'use_fieldset'    => true,   // Wrap form fields within <fieldset>
    // 'legend'          => isset($this->form['legend']) ? $this->form['legend'] : null,   // Use legend for fieldset
    // 'wrap_at_element' => false,  // Wraps column in equal size or at the set number of elements
    ];

    $this->views->add('users/add', [
        'content' =>$form->getHTML($formOptions),
        'title' => '<h2>Skapa en ny användare</h2>',
    ]);
}

/**
 * Find and return specific.
 *
 * @return this
 */
public function find($id)
{
    $this->db->select()
             ->from($this->getSource())
             ->where("id = ?");

    $this->db->execute([$id]);
    return $this->db->fetchInto($this);
}

public function getId($acronym){
  $this->db->select('id')->from('user')->where("acronym = ?");
  $this->db->execute([$acronym]);
  $user = $this->db->fetchOne();
  return $user->id;
}

public function findUser($acronym, $password){
  $this->db->select("password")->from("user")->where("acronym = ?");
  $this->db->execute([$acronym]);
  $user = $this->db->fetchOne();
  //var_dump($user);
  //die();

  if($user !== false){
    return password_verify($password, $user->password);
    //var_dump(password_verify($password, $user->password));
    //die();
  }
  else{
    return false;
  }
  /*else{
    return false;
  }*/
}

/**
 * List user with id.
 *
 * @param int $id of user to display
 *
 * @return void
 */
public function idAction($id = null)
{
    $this->users = new \Anax\Users\User();
    $this->users->setDI($this->di);

    $user = $this->users->find($id);

    $this->theme->setTitle("View user with id");
    $this->views->add('users/view', [
        'user' => $user,
    ]);
}

/**
 * Initialize the controller.
 *
 * @return void
 */
public function initialize()
{
    $this->users = new \Anax\Users\User();
    $this->users->setDI($this->di);
    $this->answer = new \Anax\Answer\Answer();
    $this->answer->setDI($this->di);
    $this->comment = new \Anax\CommentDB\CommentDB();
    $this->comment->setDI($this->di);
    $this->question = new \Anax\Question\Question();
    $this->question->setDI($this->di);
}

/**
     * Add new user.
     *
     * @param string $acronym of user to add.
     *
     * @return void
     */
    public function addAction($acronym = null)
    {
        $form = $this->form;

              $form = $form->create([], [
                  'acronym' => [
                      'type'        => 'text',
                      'label'       => 'Acronym',
                      'required'    => true,
                      'placeholder' => 'Acronym',
                      'validation'  => ['not_empty'],
                  ],
                  'password' => [
                      'type'        => 'password',
                      'label'       => 'Password',
                      'required'    => true,
                      'placeholder' => 'password',
                      'validation'  => ['not_empty'],
                  ],
                  'name' => [
                      'type'        => 'text',
                      'label'       => 'Name of contact person:',
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
                  'submit' => [
                      'type'      => 'submit',
                      'callback'  => function($form) {

                      $now = date('Y-m-d H:i:s');

                      $this->users->save([
                        'acronym'   => $form->Value('acronym'),
                        'email'     => $form->Value('email'),
                        'name'      => $form->Value('name'),
                        'password'  => password_hash($form->Value('password'), PASSWORD_DEFAULT),
                        'created'   => $now,
                        'active'    => $now,
                      ]);

                      return true;
                  }
              ],

          ]);

          // Check the status of the form
          $status = $form->check();

          if ($status === true) {
       // What to do if the form was submitted?
              $form->AddOutput("Den nya användaren är nu i användarlistan.");
             $url = $this->url->create('users/list');
             $this->response->redirect($url);

          } else if ($status === false) {
        // What to do when form could not be processed?
              $form->AddOutput("Den nya användaren las inte till i databasen.");
              $url = $this->url->create('users/add');
             $this->response->redirect($url);
          }

          //Here starts the rendering phase of the add action
          $this->theme->setTitle("Lägg till användare");

          $formOptions = [
          // 'start'           => false,  // Only return the start of the form element
          // 'columns'           => 1,      // Layout all elements in two columns
          // 'use_buttonbar'   => true,   // Layout consequtive buttons as one element wrapped in <p>
          // 'use_fieldset'    => true,   // Wrap form fields within <fieldset>
          // 'legend'          => isset($this->form['legend']) ? $this->form['legend'] : null,   // Use legend for fieldset
          // 'wrap_at_element' => false,  // Wraps column in equal size or at the set number of elements
          ];

          $this->views->add('users/add', [
              'content' =>$form->getHTML($formOptions),
              'title' => '<h2>Skapa en ny användare</h2>',
          ]);
    }


/**
 * Delete user.
 *
 * @param integer $id of user to delete.
 *
 * @return void
 */
public function deleteAction($id = null)
{
    if (!isset($id)) {
        die("Missing id");
    }

    $res = $this->users->delete($id);

    $url = $this->url->create('users');
    $this->response->redirect($url);
}


/**
 * Delete (soft) user.
 *
 * @param integer $id of user to delete.
 *
 * @return void
 */
public function softDeleteAction($id = null)
{
    if (!isset($id)) {
        die("Missing id");
    }

    $now = gmdate('Y-m-d H:i:s');

    $user = $this->users->find($id);

    $user->deleted = $now;
    $user->save();

    $url = $this->url->create('users/id/' . $id);
    $this->response->redirect($url);
}

/**
 * List all active and not deleted users.
 *
 * @return void
 */
public function activeAction()
{
    $all = $this->users->query()
        ->where('active IS NOT NULL')
        ->andWhere('deleted is NULL')
        ->execute();

    $this->theme->setTitle("Users that are active");
    $this->views->add('users/list-all', [
        'users' => $all,
        'title' => "Users that are active",
    ]);
}

/**
        * Edit user.
        *
        * @param int id of user.
        *
        * @return void
        */
       public function updateAction($id)
       {
           $form = $this->form;

           $user = $this->users->find($id);

           $form = $form->create([], [
               'acronym' => [
                   'type'        => 'text',
                   'label'       => 'Acronym',
                   'required'    => true,
                   'validation'  => ['not_empty'],
                   'value' => $user->acronym,
               ],
               'name' => [
                   'type'        => 'text',
                   'label'       => 'Name of contact person:',
                   'required'    => true,
                   'validation'  => ['not_empty'],
                   'value' => $user->name,
               ],
               'email' => [
                   'type'        => 'text',
                   'required'    => true,
                   'validation'  => ['not_empty', 'email_adress'],
                   'value' => $user->email,
               ],
               'submit' => [
                   'type'      => 'submit',
                   'callback'  => function($form) use ($user) {

                  $now = date('Y-m-d H:i:s');

               $this->users->save([
                    'id'        => $user->id,
                    'acronym'   => $form->Value('acronym'),
                    'email'     => $form->Value('email'),
                    'name'      => $form->Value('name'),
                    'updated'   => $now,
                    'active'    => $now,
                       ]);

               return true;
               }
               ],

           ]);

           // Check the status of the form
           $status = $form->check();

           if ($status === true) {
                $form->AddOutput("Användaren har uppdaterats.");
                $url = $this->url->create('users/id/' . $user->id);
                $this->response->redirect($url);

           } else if ($status === false) {
                   $form->AddOutput("Användaren uppdaterades inte.");
               header("Location: " . $_SERVER['PHP_SELF']);
               exit;
           }

               //Here starts the rendering phase of the update action
               $this->theme->setTitle("Uppdatera en användare");

               $formOptions = [
               // 'start'           => false,  // Only return the start of the form element
               // 'columns'              => 1,      // Layout all elements in two columns
               // 'use_buttonbar'   => true,   // Layout consequtive buttons as one element wrapped in <p>
               // 'use_fieldset'    => true,   // Wrap form fields within <fieldset>
               // 'legend'          => isset($this->form['legend']) ? $this->form['legend'] : null,   // Use legend for fieldset
               // 'wrap_at_element' => false,  // Wraps column in equal size or at the set number of elements
               ];

               $this->views->add('users/edit', [
                   'content' =>$form->getHTML($formOptions),
                   'title' => '<h2>Uppdatera en användare</h2>',
                   'view' => $this->users->findAllById($this->session->get('id')),
               ]);
   }


public function activateAction($id = null) {
        if (!isset($id)) {
            die("Missing id");
        }

        $now = date('Y-m-d H:i:s');

        $user = $this->users->find($id);
                $user->active = $now;
                $user->deactivate = 'null';
                $user->save();
                $feedback = $user->acronym . " är nu aktiverad.";
                 $this->listAction($feedback);
    }

    public function deactivateUserAction($id = null) {
        if (!isset($id)) {
            die("Missing id");
        }

        $now = date('Y-m-d H:i:s');

        $user = $this->users->find($id);
                $user->active = 'null';
                $user->deactivate = $now;
                $user->save();
                $feedback = $user->acronym . " är nu inaktiv.";
                 $this->listAction($feedback);
    }

    public function deactivateAction()
    {
        $all = $this->users->query()
            ->where('deactivate != 0 OR deactivate is NOT NULL')
            ->andWhere('deleted = 0 OR deleted is NULL')
            ->andWhere('active = 0 OR active is NULL')
            ->execute();

        $this->theme->setTitle("Users that are deactivate");
        $this->views->add('users/list-all', [
            'users' => $all,
            'title' => "Users that are deactivate",
        ]);
    }

    public function softdeleteuserAction($id = null)
    {
    if (!isset($id)) {
        die("Missing id");
    }

    $now = date('Y-m-d H:i:s');

    $user = $this->users->find($id);


            $user->deleted = $now;
            $user->active = null;
            $user->deactivate = null;
            $user->save();
            $feedback = $user->acronym . " är nu i papperskorgen.";
            $this->listAction($feedback);
    }

    public function undosoftdeleteuserAction($id = null)
    {
    if (!isset($id)) {
        die("Missing id");
    }

    $now = date('Y-m-d H:i:s');

    $user = $this->users->find($id);


            $user->deleted = null;
            $user->active = $now;
            $user->deactivate = null;
            $user->save();
            $feedback = $user->acronym . " är nu i papperskorgen.";
            $this->listAction($feedback);
    }

    public function deletedAction()
    {
        $all = $this->users->query()
            ->where('deleted != 0 OR deleted is NOT NULL')
            ->andWhere('active = 0 OR active is NULL')
            ->andWhere('deactivate = 0 OR deactivate is NULL')
            ->execute();

        $this->theme->setTitle("Users that are active");
        $this->views->add('users/list-all', [
            'users' => $all,
            'title' => "Användare i papperskorgen",
        ]);
    }

    public function setupAction()
    {
        $this->users->setupUsers();
        $this->theme->setTitle('Återställ databasen');
        $this->views->addString('<h1>Återställ databasen</h1><p>Nu är databasen återställd.</p>');

    }



}
