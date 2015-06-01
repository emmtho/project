<hr>
<div class='comment'>
<?php //var_dump($shows); die(); ?>
<h3>Fråga: <?=$questions->title?></h3>
<p><?=$questions->content?></p>
<p><?=$questions->name?></p>
<p><?=$questions->timestamp?></p>


<h3>Svaren: </h3>
<?php foreach ($answers as $answer) : ?>
  <?php if($answer->questionID === $questions->id){ ?>
  <?php //var_dump($answer); die(); ?>
<p><?=$answer->content?></p>
<p><?=$answer->name?></p>
<p><?=$answer->timestamp?></p>
<td><a class='td' href='<?=$this->url->create( 'commentdb/add/'. $answer->id)?>'>Kommentera</a></td>
<br><b>Kommentarer: </b>
<?php foreach ($comments as $comment) : ?>
  <?php if($answer->id === $comment->answerID){ ?>
  <p><?=$comment->content?></p>
  <p><?=$comment->timestamp?></p>
  <?php } ?>
<?php endforeach; ?>
<p>----------------------------------------</p>
<?php } ?>
<?php endforeach; ?>
</div>
