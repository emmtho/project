<h1>Ändrad</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Acronym</th>
        <th>Name</th>
        <th>Mail</th>
        <th>Status</th>
        <th>Skapad</th>
    </tr>
    <tr>
        <td><?=$user->id?></td>
        <td><?=$user->acronym?></td>
        <td><?=$user->name?></td>
        <td><?=$user->email?></td>
        <?php if ($user->active != 0) : ?>
            <td>Aktiverad:<?=$user->active?></td>
        <?php endif; ?>
        <?php if ($user->deactivate != 0) : ?>
            <td>Deaktiverad:<?=$user->deactivate?></td>
        <?php endif; ?>
        <td><?=$user->created?></td
    </tr>
 </table>

<p><a href='<?=$this->url->create('users/list')?>'>Återgå till huvudmenyn</a></p>
