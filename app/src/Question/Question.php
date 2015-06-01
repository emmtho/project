<?php
namespace Anax\Question;

/**
 * Model for Comments.
 *
 */
class Question extends \Anax\MVC\CDatabaseModel
{
  public function setupQuestion(){

            $this->db->setVerbose(false);

            $this->db->dropTableIfExists('question')->execute();

            $this->db->createTable(
                'question',
                [
                    'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                    'content'   =>  ['text', 'not null'],
                    'userID' => ['integer(11)'],
                    'title' => ['varchar(80)'],
                    'timestamp' =>  ['datetime'],
                ]
            )->execute();

            $this->db->insert(
            'question',
                ['content', 'userID', 'title', 'timestamp']
            );

            $now = date('Y-m-d H:i:s');

            $this->db->execute([
                'Question test',
                '8',
                'Test fråga',
                $now,
            ]);
        }

      public function findById($id){
        $this->db->select('q.*,u.name as name, u.id as userID')
                    ->from('question AS q')
                    ->where('q.id = ?')
                    ->leftJoin('user AS u', 'q.userID = u.id');
        $this->db->execute([$id]);
        return $this->db->fetchInto($this);

      }

      public function findAllById(){
        $this->db->select('q.* ,  u.name as name, u.id as acronymId, u.email as email')
            ->from('question AS q')
            ->leftJoin('user AS u', 'q.userId = u.id');
        $this->db->execute();
        return $this->db->fetchAll();
      }

      public function findByTag($tag)
    {
        $this->db->select('id')
                  ->from('tags')
                  ->where("tagName = ?");
        $this->db->execute([$tag]);
        $this->db->fetchInto($this);

        //var_dump($this);
        //die();

         $this->db->select('q.*, u.name as name, u.id as acronymId, u.email as email')
                   ->from('question AS q')
                   ->leftJoin('user AS u', 'q.userId = u.id')
                   ->leftJoin('tags2question AS q2t', 'q.id = q2t.questionValue')
                   ->where("q2t.tagValue = ?");

         $this->db->execute([$this->id]);
         return $this->db->fetchAll();
    }

    public function findByUser($id)
    {
         $this->db->select('*')
                   ->from('question')
                   ->where('userId = ?');
         $this->db->execute([$id]);
         return $this->db->fetchAll();
    }


}
