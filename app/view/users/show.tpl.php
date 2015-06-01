
<?php //var_dump($view); die(); ?>
<?php
    $email = $user->email;
    $default = "http://www.student.bth.se/~emta14/phpmvc/kmom10/webroot/img/anax.png";
    $size = 100;
    $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
?>
<img src="<?php echo $grav_url; ?>" alt="userimage" />
<p>Name: <?=$user->name?></p>
<p>Akronym: <?=$user->acronym?></p>
<p>Email: <?=$user->email?></p>
<p>Medlem sedan <?=$user->created?></p>

<h1>Frågor som användaren har ställt: </h1>
<hr>
<?php //var_dump($questions); die(); ?>
<?php if (is_array($questions)) : ?>
<?php foreach ($questions as $question) : ?>
<div class="wrap">
<h3><a href="<?=$this->url->create( 'question/show/'.$question->id )?>"> <?=$question->title?></a> <?=$question->timestamp?></h3>
<p><?=$question->content?></p>
<p>-------------------------------------------</p>
</div>
<?php endforeach; ?>
<?php endif; ?>

<h2>Svar som användaren har svarat: </h1>
  <hr>
  <?php //var_dump($answers); die(); ?>
  <?php if (is_array($answers)) : ?>
  <?php foreach ($answers as $answer) : ?>
  <div class="wrap">
  <h3><a href="<?=$this->url->create( 'question/show/'.$answer->questionID)?>"> <?=$answer->content?></a> <?=$answer->timestamp?></h3>
  <p>-------------------------------------------</p>
  </div>
  <?php endforeach; ?>
  <?php endif; ?>
