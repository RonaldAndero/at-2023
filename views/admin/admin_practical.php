<!-- IF ADMIN -->
<?php if ($auth->is_admin): ?>

    <h3><?= __("Praktilised ülesanded") ?></h3>
    <div class="practical-box">
        <h4 class="h4-custom">Praktilise ülesande lisamine (ära unusta iga rea lõppu panna semikoolonit!)</h4>
        <input type="text" id="new-title" placeholder="Ülesande pealkiri">
        <br>
        <br>
        <textarea class="practical-description" id="new-description" placeholder=
        "Ülesannete lisamisel tuleb iga ülesanne jaotada punktideks ning iga punkti lõppu tuleb märkida semikoolon.

Näide:
1. Lisa reavahe.;
2. Muuda taust siniseks.;
3. Muuda enda nime suurus 32px.;
"></textarea>
        <br>
        <br>
        <button id="add-practical" class="btn btn-info">Lisa</button>
    </div>
    <br>
    <br>
    <br>

    <?php $x = -1; ?>
    <?php foreach ($practicalQuestions['title'] as $key => $title): ?>
        <div class="practical-box">
            <h4 class="h4-custom">Praktilise ülesande redigeerimine</h4>
            <?php $x++; ?>
            <form action="POST" class="form">
                <input type="text" value="<?= $title; ?>" id="title-<?= $practicalQuestions['id'][$x] ?>">
                <br>
                <br>
                <textarea name="description-<?= $key ?>" id="description-<?= $practicalQuestions['id'][$x] ?>"
                          class="practical-description">
<?= implode(";\n", $practicalQuestions['description'][$key]) . ';' ?>
        </textarea>
            </form>
            <br>
            <button id="edit-<?= $practicalQuestions['id'][$x] ?>" class="btn btn-info editPractical">Muuda</button>
            <button id="delete-<?= $practicalQuestions['id'][$x] ?>" class="btn btn-info deletePractical"
                    data-toggle="modal" data-target=".confirm">Kustuta
            </button>
            <span id="success-<?= $practicalQuestions['id'][$x] ?>" class="edit-successful">Muutmine edukas</span>
            <span id="error-<?= $practicalQuestions['id'][$x] ?>" class="edit-error">Muutmine ebaõnnestus</span>
        </div>
        <br>
        <br>
        <br>
    <?php endforeach ?>

    <!-- DELETE CONFIRMATION MODAL -->
    <div class="modal fade confirm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Oled kindel, et soovid kustutada?</h4>
                </div>
                <div class="modal-footer">
                    <button id="yes" type="button" class="btn btn-default" data-dismiss="modal">Jah</button>
                    <button id="no" type="button" class="btn btn-primary" data-dismiss="modal">Ei</button>
                </div>
            </div>
        </div>
    </div>

    <script>

        // fix multiline
        fixMultiline();

    </script>
<?php endif; ?>