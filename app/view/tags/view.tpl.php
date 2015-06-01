<?php //var_dump($questions); ?>
<h1> #<?=$tags?> </h1>
<h3>Frågor</h3>
<hr>
<?php foreach ($questions as $question) : ?>
  <?php
      $email = $question->email;
      $default = "http://www.student.bth.se/~emta14/phpmvc/kmom10/webroot/img/anax.png";
      $size = 100;
      $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
      ?>
<p><a href="<?=$this->url->create( 'question/show/'.$question->id )?>"> <?=$question->title?> </a> av <a href='<?=$this->url->create('users/show/'.$question->userID)?>'><?=$question->name?></a><img src="<?php echo $grav_url; ?>" alt="userimage" /></p>
<p><?=$question->timestamp?></p>
<p><?=$question->content?></p>
<?php endforeach;?>
