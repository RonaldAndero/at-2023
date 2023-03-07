<!-- IF ADMIN -->
<?php if ($auth->is_admin): ?>

    <h3><?= __("Seaded") ?></h3>
    <div class="settings-box">

        <h4>Teoreetiliste küsimuste arv testis</h4>
        <form method="POST" id="editQuestionCount">
            <select name="nr_of_questions" class="settings-selection">
                <?php for ($i = 1; $i <= $totalQuestions; $i++): ?>
                    <option value="<?= $i; ?>"
                        <?= ($i == $settings['nr_of_questions']) ? 'selected' : ''; ?> >
                        <?= $i; ?>
                    </option>
                <?php endfor ?>
            </select>
            <a href="" class="btn btn-info btn-lg form-button editQuestionCount settings-btn">Muuda</a>
            <span id="editQuestionCount-successful" class="edit-successful">Muutmine edukas</span>
            <span id="editQuestionCount-error" class="edit-error">Muutmine ebaõnnestus</span>
        </form>
        <hr class="settings-hr">

        <h4>Testi PIN-kood</h4>
        <form action="#">
            <input type="text" name="password" id="generatedPassword" value="<?= $settings['pwd'] ?>">
            <input type="button" class="btn btn-info btn-lg form-button settings-btn" id="generatePassword"
                   value="Genereeri">
        </form>
        <hr class="settings-hr">

        <h4>Testi avamine määratud ajaperioodiks (tunnid)</h4>
        <form method="POST" id="openTest">
            <select name="test_hours" class="settings-selection">
                <?php for ($i = 2; $i <= 8; $i++): ?>
                    <option value="<?= $i; ?>" <?= ($i == 4) ? 'selected' : ''; ?>><?= $i; ?></option>
                <?php endfor ?>
            </select>
            <a href="" class="btn btn-info btn-lg form-button openTest settings-btn">Ava</a>
            <a href="" class="btn btn-info btn-lg form-button closeTest settings-btn">Sulge</a>
            <span id="openTest-successful" class="edit-successful">Muutmine edukas</span>
            <span id="openTest-error" class="edit-error">Muutmine ebaõnnestus</span>
        </form>

        <span id="liveTime"><?= $time['time'] > 0 ? $time['time'] : 'Test on suletud' ?></span>
        <hr class="settings-hr">

        <h4>HTML koodi valideerimine W3C API kaudu</h4>
        <form method="POST" id="validationOption">
            <select name="validationOption" class="settings-selection">
                <option value="1" <?= ($settings['htmlvalidator'] == 1) ? 'selected' : ''; ?>>Jah</option>
                <option value="0" <?= ($settings['htmlvalidator'] == 0) ? 'selected' : ''; ?>>Ei</option>
            </select>
            <a href="" class="btn btn-info btn-lg form-button validationOption settings-btn">Muuda</a>
            <span id="validationOption-successful" class="edit-successful">Muutmine edukas</span>
            <span id="validationOption-error" class="edit-error">Muutmine ebaõnnestus</span>
        </form>
        <hr class="settings-hr">

        <h4>HTML-i reaalajas eelvaade praktilise ülesande juures</h4>
        <form method="POST" id="liveOption">
            <select name="liveOption" class="settings-selection">
                <option value="1" <?= ($settings['livehtml'] == 1) ? 'selected' : ''; ?>>Jah</option>
                <option value="0" <?= ($settings['livehtml'] == 0) ? 'selected' : ''; ?>>Ei</option>
            </select>
            <a href="" class="btn btn-info btn-lg form-button liveOption settings-btn">Muuda</a>
            <span id="liveOption-successful" class="edit-successful">Muutmine edukas</span>
            <span id="liveOption-error" class="edit-error">Muutmine ebaõnnestus</span>
        </form>
        <hr class="settings-hr">

        <h4>Avalik pingerida</h4>
        <form method="POST" id="scoreOption">
            <select name="scoreOption" class="settings-selection">
                <option value="1" <?= ($settings['scores'] == 1) ? 'selected' : ''; ?>>Jah</option>
                <option value="0" <?= ($settings['scores'] == 0) ? 'selected' : ''; ?>>Ei</option>
            </select>
            <select name="scorePrivateOption" class="settings-selection">
                <option value="1" <?= ($settings['scores_private'] == 1) ? 'selected' : ''; ?>>Nimi peidetud</option>
                <option value="0" <?= ($settings['scores_private'] == 0) ? 'selected' : ''; ?>>Nimi nähtav</option>
            </select>
            <a href="" class="btn btn-info btn-lg form-button scoreOption settings-btn">Muuda</a>
            <span id="scoreOption-successful" class="edit-successful">Muutmine edukas</span>
            <span id="scoreOption-error" class="edit-error">Muutmine ebaõnnestus</span>
        </form>
        <hr class="settings-hr">

        <h4>Administraatori parooli vahetamine</h4>

        <button id="changePassword" class="btn btn-info btn-lg form-button settings-btn"
                data-target="#password-modal" data-toggle="modal">
            Muuda
        </button>
        <span class="edit-successful changePassword-successful">Muutmine edukas</span>
        <span class="edit-error changePassword-error">Muutmine ebaõnnestus</span>

        <!-- PASSWORD CHANGE MODAL -->
        <div class="modal fade" id="password-modal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Parooli vahetamine</h4>
                        <span class="edit-successful changePassword-successful">Muutmine edukas</span>
                        <span class="edit-error changePassword-error">Muutmine ebaõnnestus</span>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="passwordForm">
                            <input type="password" class="input-lg form-control" name="old-password" id="old-password"
                                   placeholder="Vana parool" autocomplete="off">
                            <hr>
                            <input type="password" class="input-lg form-control new-password" name="password1"
                                   id="password1" placeholder="Uus parool" autocomplete="off">
                            <div class="row passwordform-text">
                                <div class="col-sm-6">
                                    <span id="8char" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>
                                    Vähemalt 8 tähemärki pikk<br>
                                    <span id="ucase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>
                                    Vähemalt üks suurtäht
                                </div>
                                <div class="col-sm-6">
                                    <span id="lcase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>
                                    Vähemalt üks väike tähemärk<br>
                                    <span id="num" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>
                                    Vähemalt üks number
                                </div>
                            </div>
                            <input type="password" class="input-lg form-control new-password" name="password2"
                                   id="password2" placeholder="Uus parool uuesti" autocomplete="off">
                            <div class="row passwordform-text">
                                <div class="col-sm-12">
                                    <span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>
                                    Parooli ühtivus
                                </div>
                            </div>
                            <input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg"
                                   id="submit-new-password"
                                   data-loading-text="Changing Password..." value="Vaheta parooli">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>

    <script>

        $(document).ready(function () {

            // refresh live time
            refreshTime();

            // live password validation
            validatePassword();

        });

    </script>

<?php endif; ?>