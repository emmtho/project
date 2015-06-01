<?php
namespace Anax\Tags;

/**
 * Model for Tags.
 *
 */
class Tags extends \Anax\MVC\CDatabaseModel
{
  public function setupTags(){

            $this->db->setVerbose(false);

            $this->db->dropTableIfExists('tags')->execute();

            $this->db->createTable(
                'tags',
                [
                    'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                    'tagName' => ['varchar(80)'],
                ]
            )->execute();

            $this->db->insert(
            'tags',
                ['tagName']
            );

            $this->db->execute([
                'regler',
            ]);
            $this->db->execute([
                'intresseklubben-anteknar',
            ]);
            $this->db->execute([
                'olika-lag',
            ]);
            $this->db->execute([
                'diskutioner',
            ]);
            $this->db->execute([
                'helt-onodigt',
            ]);
    }

    public function saveTag($tags, $questionId)
    {
        $tags= explode(',', $tags);
        foreach($tags as $tag)
       {
           $tag = str_replace(" ", "", $tag);
           $tag = ucfirst ($tag);
           $this->db->select('tagName')->
           from('tags')->
           where('tagName = ?');
           $this->db->execute([$tag]);
           $res = $this->db->fetchAll();
           if (!$res)
           {
               $this->db->insert(
               'tags',
               ['tagName']
                );
                $this->db->execute([
                $tag
                ]);
            }
            $this->db->select('id')->
            from('tags')->
            where('tagName = ?');
            $this->db->execute([$tag]);
            $this->db->fetchInto($this);
            $this->db->insert(
            'tags2question',
            ['questionValue', 'tagValue']
             );
             $this->db->execute([
             $questionId, $this->id
             ]);
       }
    }

        public function findAllTag($limit = null, $sort = null)
    {
      $this->db->select('*')->from('tags');

      if(!is_null($limit) && !empty($limit))
      {
      $this->db->limit($limit);
      }
      if(!is_null($sort) && !empty($sort))
      {
      $this->db->orderby('rankTag '.$sort);
      }
      $this->db->execute();
      $res = $this->db->fetchAll();
      return $res;

    }
}
