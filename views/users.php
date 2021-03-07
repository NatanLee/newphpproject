<div class="sad">
    <a href="?c=user&a=add">Добавить пользователя</a>

    <?php
    /**@var \App\modules\User [] $users */
    foreach ($users as $user) : ?>
        <h1><?= $user->login ?></h1>
        <p>
            <a href="?c=user&a=one&id=<?= $user->id ?>">
                Подробнее
            </a>
        </p>
    <?php endforeach;?>
</div>

