<div class="question">
<h3>Nyaste frågorna</h3>
<?php if (is_array($questions)) : ?>
<?php foreach ($questions as $question) : ?>
<b><a href="<?=$this->url->create( 'question/show/'.$question->id )?>"><?=$question->title?> </a></b><br>
<?php endforeach; ?>
<?php endif; ?>
</div>
