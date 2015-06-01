<div class="tags">
<h1>Populäratse taggarna</h1>
<?php if (is_array($tags)) : ?>
<?php foreach ($tags as $tag) : ?>
  <?php var_dump($tag);die();?>
<h2><a href="<?=$this->url->create( 'tags/tag/'.$tag->nameTag )?>"> #<?=$tag->nameTag?> </a></h2>
<?php endforeach; ?>
<?php endif; ?>
</div>
