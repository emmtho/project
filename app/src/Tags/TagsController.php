<?php

namespace Anax\Tags;

/**
 * To make tags for the questions
 *
 */
class TagsController implements \Anax\DI\IInjectionAware
{
  use \Anax\DI\TInjectable;

  public function setupAction(){
    $this->initialize();
    $this->tags->setupTags();
    $this->theme->setTitle('Återställ databasen');
    $this->views->addString('<h1>Återställ databasen</h1><p>Nu är databasen återställd.</p>');
  }

  public function initialize()
    {
        $this->tags = new \Anax\Tags\Tags();
        $this->tags->setDI($this->di);
        $this->question = new \Anax\Question\Question();
        $this->question->setDI($this->di);
    }

  public function indexAction($limit=null,$sort=null){
    $this->initialize();
        $all = $this->tags->findAllTag($limit,$sort);


        $this->views->add('tags/index', [
                'tags' => $all,
            ], 'sidebar'
        );
  }

  public function viewAction()
    {
        $this->initialize();
        $all = $this->tags->findAllTag();
        $this->theme->setTitle('Taggar');
        $this->views->add('tags/list', [
            'tags' => $all,
        ]);
    }

    public function visaAction()
        {
            $this->initialize();
            $all = $this->tags->findAll();
            $this->theme->setTitle('Taggar');
            $this->views->add('tags/list', [
                'tags' => $all,
            ]);
        }

    public function tagAction($tag = null)
        {

            $this->initialize();
            $this->theme->setTitle('Tagg');
            $questions = $this->question->findByTag($tag);
            $this->views->add('tags/view', [
                'tags'       => $tag,
                'questions' => $questions,
            ]);
        }
        
}
