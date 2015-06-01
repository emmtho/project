<?php
namespace Anax\CommentDB;

/**
 * Model for Comments.
 *
 */
class CommentDB extends \Anax\MVC\CDatabaseModel
{
    public function setupComment(){

        $this->db->setVerbose(false);

        $this->db->dropTableIfExists('commentdb')->execute();

        $this->db->createTable(
            'commentdb',
            [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'content'   =>  ['text', 'not null'],
                'userID'       =>  ['integer(11)'],
                'answerID'     => ['integer(11)'],
                'timestamp' =>  ['datetime'],
            ]
        )->execute();

        $this->db->insert(
        'commentdb',
            ['content', 'userID', 'answerID', 'timestamp']
        );

        $now = date('Y-m-d H:i:s');

        $this->db->execute([
            'Comment test',
            '8',
            '1',
            $now,
        ]);
    }

    public function findByUser($id = null)
    {
        $this->db->select('*')
                 ->from("commentdb")
                 ->where("userId = ?");
        $this->db->execute([$id]);
        return $this->db->fetchAll();
    }
}
