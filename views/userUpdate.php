<?php /**@var \App\modules\User $user */?>
<h2>Обновить пользователя</h2>

<form action="?c=user&a=update&id=<?= $user->id ?>" method="post">
    <input type="text" name="login" value="<?= $user->login ?>">
    <input type="text" name="password">
    <input type="submit">
</form>