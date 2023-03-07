<!-- IF ADMIN -->
<?php if ($auth->is_admin): ?>

    <div class="theoretical-container">

        <h3><?= __("Teoreetilised küsimused") ?></h3>

        <h4>Otsing</h4>
        <input type="text" id="search-theoretical" onkeyup="searchFilterTheoretical()"
               placeholder="&#128269; Otsi pealkirja järgi...">
        <br>
        <br>
        <button type="button" data-toggle="modal" data-target="#add" class="btn btn-primary">Lisa küsimus</button>
        <hr class="blue-hr">

        <!-- main questions -->
        <?php foreach ($questions as $question): ?>
            <div class="table-box">
                <form method="POST" id="form[<?= $question['question_id'] ?>]" class="form">
                    <table class="table table-bordered theoretical table-old">

                        <tr class="question-head">
                            <td class="question-heading"><input name="question[<?= $question['question_id'] ?>]"
                                                                class="questions" type="text"
                                                                value="<?= $question['question'] ?>"></td>
                        </tr>

                        <?php foreach ($question['answers'] as $answer): ?>
                            <tr>
                                <td><input name="answers[<?= $answer['id'] ?>]" class="answers" type="text"
                                           value="<?= $answer['text'] ?>"></td>
                            </tr>
                        <?php endforeach ?>
                        <tr>
                            <td>
                                <a href="" class="btn btn-info btn-lg form-button editTheoretical">Muuda</a>
                                <a href="" class="btn btn-info btn-lg form-button deleteTheoretical" data-toggle="modal"
                                   data-target=".confirm">Kustuta</a>
                                <span id="success[<?= $question['question_id'] ?>]]"
                                      class="edit-successful">Muutmine edukas
                                </span>
                                <span id="error[<?= $question['question_id'] ?>]]"
                                      class="edit-error">
                                    Muutmine ebaõnnestus
                                </span>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        <?php endforeach ?>
    </div>

    <!-- DELETE QUESTION MODAL -->
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

    <!-- ADD NEW QUESTION MODAL -->
    <div class="modal fade" id="add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Küsimuse lisamine</h4>
                </div>
                <div class="modal-body">
                    <!-- add new question -->
                    <div class="table-box">
                        <form method="POST" id="add-new-form" class="form">
                            <table class="table table-bordered theoretical">
                                <tr class="question-head">
                                    <td class="question-heading"><input name="question" class="questions" type="text"
                                                                        placeholder="PEALKIRI" value=""></td>
                                </tr>
                                <tr>
                                    <td><input name="correct" class="answers" placeholder="Valik 1 (ÕIGE)" type="text"
                                               value=""></td>
                                </tr>
                                <tr>
                                    <td><input name="wrong1" class="answers" type="text" placeholder="Valik 2" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <td><input name="wrong2" class="answers" type="text" placeholder="Valik 3" value="">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <span id="error-adding">Kõik väljad peavad olema täidetud!</span>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" type="button" class="btn btn-danger">Sulge</button>
                    <button type="button" class="btn btn-primary addTheoretical">Lisa</button>
                </div>
            </div>
        </div>
    </div><

    <br>
    <br>
    <br>

<?php endif; ?>