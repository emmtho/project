<hr>

<h2>Frågor</h2>
<?php if (is_array($views)) : ?>
<div class='comment'>
  <?php //var_dump($views); die();?>
<?php foreach ($views as $view) : ?>
  <?php
      $email = $view->email;
      $default = "http://www.student.bth.se/~emta14/phpmvc/kmom10/webroot/img/anax.png";
      $size = 100;
      $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
      ?>
<h4><a href='<?=$this->url->create('question/show/'.$view->id)?>'><?=$view->title?></a> av <a href='<?=$this->url->create('users/show/'.$view->userID)?>'><?=$view->name?></a><img src="<?php echo $grav_url; ?>" alt="userimage" /></h4>
<p><?=$view->timestamp?></p>
<p><?=$view->content?></p>

<?php if($view->acronymId === $this->session->get('id')){ ?>
  <td><a class='td' href='<?=$this->url->create( 'question/edit/'.$view->id )?>'>Editera</a></td>
  <td><a href='<?=$this->url->create( 'question/remove/'.$view->id )?>'>Radera</a></td>
<?php }
 endforeach; ?>
</div>
<?php endif; ?>
