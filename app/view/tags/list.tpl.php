<h3>Alla Taggar</h3>

<?php if (is_array($tags)) : ?>
<?php foreach ($tags as $tag) : ?>
<div class="wrap box">
  <?php //var_dump($tag);die();?>
<b><a href="<?=$this->url->create( 'tags/tag/'.$tag->tagName)?>"> #<?=$tag->tagName?> </a></b>
</div>
<?php endforeach; ?>
<?php endif; ?>
