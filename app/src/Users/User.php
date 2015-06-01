<?php

namespace Anax\Users;

/**
 * Model for Users.
 *
 */
class User extends \Anax\MVC\CDatabaseModel
{
  public function setupUsers(){
      $this->db->setVerbose(false);

      $this->db->dropTableIfExists('user')->execute();

      $this->db->createTable(
          'user',
          [
              'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
              'acronym' => ['varchar(20)', 'unique', 'not null'],
              'email' => ['varchar(80)'],
              'name' => ['varchar(80)'],
              'password' => ['varchar(255)'],
              'created' => ['datetime'],
              'updated' => ['datetime'],
              'deleted' => ['datetime'],
              'active' => ['datetime'],
              'deactivate' => ['datetime']
          ]
      )->execute();

      $this->db->insert(
          'user',
          ['acronym', 'email', 'name', 'password', 'created', 'updated', 'deleted', 'active', 'deactivate' ]
      );

      $now = date('Y-m-d H:i:s');

      $this->db->execute([
          'admin',
          'admin@dbwebb.se',
          'Administrator',
          password_hash('admin', PASSWORD_DEFAULT),
          $now,
          $now,
          'null',
          'null',
          $now
      ]);

      $this->db->execute([
          'doe',
          'doe@dbwebb.se',
          'John/Jane Doe',
          password_hash('doe', PASSWORD_DEFAULT),
          $now,
          $now,
          'null',
          'null',
          $now
      ]);
      }

      public function findAllById($id){
  $this->db->select('q.* ,  u.name as name, u.id as acronymId, u.email as email')
            ->from('question AS q')
            ->leftJoin('user AS u', 'q.userID = u.id');
  $this->db->execute([$id]);
  return $this->db->fetchAll();
}
  }
