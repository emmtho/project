<div class="users">
<h3>Mest aktiva användarna</h3>
<?php if (is_array($users)) : ?>
<?php foreach ($users as $user) : ?>
<b><a href="<?=$this->url->create( 'users/show/'.$user->id )?>"> #<?=$user->acronym?> </a></b>
<?php endforeach; ?>
<?php endif; ?>
</div>
