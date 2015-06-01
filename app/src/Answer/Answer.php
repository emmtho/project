<?php
namespace Anax\Answer;

/**
 * Model for Comments.
 *
 */
class Answer extends \Anax\MVC\CDatabaseModel
{
  public function setupAnswer(){

            $this->db->setVerbose(false);

            $this->db->dropTableIfExists('answer')->execute();

            $this->db->createTable(
                'answer',
                [
                    'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                    'content'   =>  ['text', 'not null'],
                    'userID' => ['integer(11)'],
                    'questionID' => ['integer(11)'],
                    'timestamp' =>  ['datetime'],
                ]
            )->execute();

            $this->db->insert(
            'answer',
                ['content', 'userID', 'questionID', 'timestamp']
            );

            $now = date('Y-m-d H:i:s');

            $this->db->execute([
                'Detta är ett test utav svar.',
                '8',
                '1',
                $now,
            ]);
      }

      public function findAllbyId($id){
            $this->db->select('q.*,a.*, u.name')
                        ->from('question AS q')
                        ->leftJoin('answer AS a','q.id = a.questionID')
                        ->leftJoin('user AS u','u.id = a.userID')
                        ->where('q.id = ?');
            $this->db->execute([$id]);
            return $this->db->fetchAll();
      }

      public function findByUser($id = null){
            $this->db->select('*')
                      ->from('answer')
                      ->where('userId = ?');
            $this->db->execute([$id]);
            return $this->db->fetchAll();
       }


}
