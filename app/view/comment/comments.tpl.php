<hr>

<h2>Comments</h2>

<?php if (is_array($comments)) : ?>
<div class='comments'>
<?php foreach ($comments as $id => $comment) : ?>

<h4><a href="<?=$this->url->create('comment/edit') . '/' . $id . '/' . $comment['pageName']?>"><?=$comment["name"]?></a></h4>
<p><?=$comment["content"]?></p>
<p><?=date("Y-m-d H:i", $comment["timestamp"])?></p>
<form method=post>
  <input type=hidden name="pageName" value="<?=$comment['pageName']?>">
</form>
<p>
    <a href="<?=$this->url->create('comment/remove/' . $id . '/'. $comment['pageName'])?>">Radera</a>
</p>
<?php endforeach; ?>
</div>
<?php endif; ?>
