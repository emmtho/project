<?php

namespace Anax\Comment;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class CommentsInSession implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;



    /**
     * Add a new comment.
     *
     * @param array $comment with all details.
     *
     * @return void
     */
    public function add($comment, $pageName)
    {
        $comments = $this->session->get('comments', []);
        $comments[$pageName][] = $comment;
        $this->session->set('comments', $comments);
    }

    public function edit($id, $pageName, $comment){
      $comments = $this->session->get('comments', []);
      $comments[$pageName][$id] = $comment;
      $this->session->set('comments', $comments);
    }


    /**
     * Find and return all comments.
     *
     * @return array with all comments.
     */
    public function findAll($pageName)
    {
        $comments = $this->session->get('comments', []);
        if(isset($comments[$pageName])) {
             return $comments[$pageName];
         }
    }

    public function find($id, $pageName){
      $comments = $this->session->get('comments', []);
      $comment = $comments[$pageName][$id];
      return $comment;
    }


    /**
     * Delete all comments.
     *
     * @return void
     */
    public function deleteAll($pageName)
    {
        $comments = $this->session->get('comments', []);
        unset($comments[$pageName]);
        $this->session->set('comments', $comments);
    }


    public function delete($id, $pageName){
        $comments = $this->session->get('comments', []);
        unset($comments[$pageName][$id]);
        $this->session->set('comments', $comments);

    }
}
