<h1><?=$title?></h1>
<?php if(isset($output)) : ?>
<?=$output?>
<?php endif; ?>
<table>

    <?php foreach ($users as $user) : ?>
        <?php if ($user->active != 0) : ?>
            <caption><b>Aktiva</b></caption>
            <tr>
                <th>Id</th>
                <th>Acronym</th>
                <th>Name</th>
                <th>Mail</th>
                <th>Status</th>
            </tr>
        <?php break; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php foreach ($users as $user) : ?>

    <?php if ($user->active != 0 ) : ?>
    <tr>
        <td><a class='td' href='<?=$this->url->create( 'users/id/'.$user->id )?>'><?=$user->id?></a></td>
        <td><a class='td' href='<?=$this->url->create( 'users/id/'.$user->id )?>'><?=$user->acronym?></a></td>
        <td><a class='td' href='<?=$this->url->create( 'users/id/'.$user->id )?>'><?=$user->name?></a></td>
        <td><a class='td' href='<?=$this->url->create( 'users/id/'.$user->id )?>'><?=$user->email?></a></td>
        <td><a class='td' href='<?=$this->url->create( 'users/id/'.$user->id )?>'>Aktiverad:<?=$user->active?></a></td>
        <td><a href='<?=$this->url->create( 'users/delete/'.$user->id )?>' title='Ta bort användaren helt'>Radera</a></td>
        <td><a href='<?=$this->url->create('users/update/'.$user->id )?>' title='Updatera användaren'>Updatera användaren</a></td>
        <td><a href='<?=$this->url->create('users/deactivateUser/'.$user->id )?>' title='Inaktivera användaren'>Inaktivera användaren</a></td>
        <td><a href='<?=$this->url->create('users/softdeleteuser/'.$user->id )?>' title='Gör en soft delete på användaren'>Soft delete</a></td>
    </tr>
    <?php endif; ?>
<?php endforeach; ?>

</table>

<hr>
<table>
    <?php foreach ($users as $user) : ?>
        <?php if ($user->deactivate != 0) : ?>
            <caption><b>Inaktiva</b></caption>
            <tr>
                <th>Id</th>
                <th>Acronym</th>
                <th>Name</th>
                <th>Mail</th>
                <th>Status</th>
            </tr>
            <?php break; ?>
      <?php endif; ?>
    <?php endforeach; ?>


<?php foreach ($users as $user) : ?>
    <?php if ($user->deactivate != 0 ) : ?>
    <tr>
        <td><a class='td' href='<?=$this->url->create( 'users/id/'.$user->id )?>'><?=$user->id?></a></td>
        <td><a class='td' href='<?=$this->url->create( 'users/id/'.$user->id )?>'><?=$user->acronym?></a></td>
        <td><a class='td' href='<?=$this->url->create( 'users/id/'.$user->id )?>'><?=$user->name?></a></td>
        <td><a class='td' href='<?=$this->url->create( 'users/id/'.$user->id )?>'><?=$user->email?></a></td>
        <td><a class='td' href='<?=$this->url->create( 'users/id/'.$user->id )?>'>Deaktiverad:<?=$user->deactivate?></a></td>
        <td><a href='<?=$this->url->create( 'users/delete/'.$user->id )?>' title='Ta bort användaren helt'>Radera</a></td>
        <td><a href='<?=$this->url->create('users/update/'.$user->id )?>' title='Updatera användaren'>Updatera användaren</a></td>
        <td><a href='<?=$this->url->create('users/activate/'.$user->id )?>' title='Aktivera användaren'>Aktivera användaren</a></td>
        <td><a href='<?=$this->url->create('users/softdeleteuser/'.$user->id )?>' title='Gör en soft delete på användaren'>Soft delete</a></td>
    </tr>
    <?php endif; ?>
<?php endforeach; ?>
 </table>

 <hr>
<table>
    <?php foreach ($users as $user) : ?>
        <?php if ($user->deleted != 0) : ?>
            <caption><b>Placerade i papperskorgen</b></caption>
            <tr>
                <th>Id</th>
                <th>Acronym</th>
                <th>Name</th>
                <th>Mail</th>
                <th>Status</th>
            </tr>
            <?php break; ?>
      <?php endif; ?>
    <?php endforeach; ?>


<?php foreach ($users as $user) : ?>
    <?php if ($user->deleted != 0) : ?>
    <tr>
        <td><a class='td' href='<?=$this->url->create( 'users/id/'.$user->id )?>'><?=$user->id?></a></td>
        <td><a class='td' href='<?=$this->url->create( 'users/id/'.$user->id )?>'><?=$user->acronym?></a></td>
        <td><a class='td' href='<?=$this->url->create( 'users/id/'.$user->id )?>'><?=$user->name?></a></td>
        <td><a class='td' href='<?=$this->url->create( 'users/id/'.$user->id )?>'><?=$user->email?></a></td>
        <td><a class='td' href='<?=$this->url->create( 'users/id/'.$user->id )?>'>Raderade: <?=$user->deleted?></a></td>
        <td><a href='<?=$this->url->create( 'users/delete/'.$user->id )?>' title='Ta bort användaren helt'>Radera</a></td>
        <td><a href='<?=$this->url->create('users/update/'.$user->id )?>' title='Updatera användaren'>Updatera användaren</a></td>
        <td><a href='<?=$this->url->create('users/undosoftdeleteuser/'.$user->id )?>' title='Gör om en soft delete på användaren'>Återställ användaren</a></td>
    </tr>
    <?php endif; ?>
<?php endforeach; ?>
 </table>

 <?php if(isset($output)) : ?>
 <?=$output?>
 <?php endif; ?>
 <hr>
<p><a href='<?=$this->url->create('')?>'>Home</a>
<a href='<?=$this->url->create( 'users/list' )?>'>Visa alla</a>
<a href='<?=$this->url->create( 'users/active' )?>'>Visa aktiva användare</a>
<a href='<?=$this->url->create( 'users/deactivate' )?>'>Visa deaktiverade användare</a>
<a href='<?=$this->url->create( 'users/deleted' )?>'>Visa användare i papperskorgen</a>
</p>
