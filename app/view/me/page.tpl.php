<article class="article1">

<?=$content?>


<?php if(isset($comment)) : ?>
<?=$comment?>
<?php endif; ?>

<?php if(isset($byline)) : ?>
<footer class="byline">
<?=$byline?>
</footer>
<?php endif; ?>

</article>
