<hr>

<h2>Comments</h2>

<?php if (is_array($comments)) : ?>
<div class='comments'>
<?php foreach ($comments as $id => $comment) : ?>
<h4>Comment #<?=$id?></h4>

<p><?=$comment["name"],  date("Y-m-d H:i:s", $comment["timestamp"])?></p>
<p><?=$comment["content"]?></p>
<?php endforeach; ?>
</div>
<?php endif; ?>
