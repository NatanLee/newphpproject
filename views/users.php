<div class="sad">
    <?php
    /**@var \App\modules\User [] $users */
    foreach ($users as $user) : ?>
        <h1><?= $user->login ?></h1>
    <?php endforeach;?>
</div>
<script>
    var a = {};
</script>
