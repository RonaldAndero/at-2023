/*
* In case you need the error template to show a fancy warning/error
*/

<?php if (isset($errors)): ?>


    <?php foreach ($errors as $error): ?>

        <div class="alert alert-danger"><?= $error ?></div>

    <?php endforeach; ?>


<?php else: ?>


    Tundmatu viga!


<?php endif; ?>