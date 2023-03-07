<!-- IF ADMIN -->
<?php if ($auth->is_admin): ?>

    <h3><?= __("Tulemused") ?></h3>
    <div class="responsive">
        <table class="table table-bordered results table-box">
            <tr>
                <th>Nimi</th>
                <th>Isikukood</th>
                <th>T. test (punktid)</th>
                <th>Küsimusi</th>
                <th>P. test (punktid)</th>
                <th>Kokku (punktid)</th>
                <th>Kuupäev</th>
                <th>Korduv</th>
                <th>Kustuta</th>
            </tr>
            <?php foreach ($results as $result): ?>
                <tr id="row-<?= $result['user_id']; ?>">
                    <td><?= $result['firstname'] . ' ' . $result['lastname'] ?></td>
                    <td><?= $result['social_id'] ?></td>
                    <td>
                        <?php if ($result['theoretical_points'] == -1): ?>
                            <span class="not-graded">Tegemata</span>
                        <?php else: ?>
                            <?= $result['theoretical_points'] ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($result['nr_of_questions'] == 0): ?>
                            Korduv
                        <?php else: ?>
                            <?= $result['nr_of_questions'] ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($result['practical_points'] == -2): ?>
                            <span class="not-graded">Tegemata</span>
                        <?php elseif ($result['practical_points'] == -1): ?>
                            <span class="not-graded">Hindamata</span>
                        <?php else: ?>
                            <?= $result['practical_points'] ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $result['sum'] ?> / <?= $result['nr_of_questions'] + 10 ?></td>
                    <td><?= date("d.m.Y", strtotime($result['date'])); ?></td>
                    <td>
                        <?php if ($result['practical_points'] != -2 && $result['practical_points'] != -2): ?>
                            <button type="button"
                                    data-toggle="modal" data-target=".confirm-allow-again"
                                    id="<?= $result['user_id']; ?>" class="allowAgain">Luba
                            </button>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="#" data-toggle="modal" data-target=".confirm-delete"
                           id="delete-<?= $result['user_id']; ?>" class="del-icon">
                            <img src="images/trash.png" height="20" alt="trash">
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>

    <?php if (empty($results)): ?>
        <h4>Pole midagi kuvada</h4>
    <?php else: ?>
        <button type="button" id="pushToLog" data-toggle="modal" data-target=".confirm">Tühjenda</button>
        <span id="pushToLog-successful" class="edit-successful">Muutmine edukas</span>
        <span id="pushToLog-error" class="edit-error">Muutmine ebaõnnestus</span>
    <?php endif; ?>

    <!-- PUSH TO LOG MODAL -->
    <div class="modal fade confirm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Oled sa kindel, et soovid tabelit tühjendada? Tagasiteed ei ole!</h4>
                </div>
                <div class="modal-footer">
                    <button id="yes-log" type="button" class="btn btn-default" data-dismiss="modal">Jah</button>
                    <button id="no-log" type="button" class="btn btn-primary" data-dismiss="modal">Ei</button>
                </div>
            </div>
        </div>
    </div>

    <!-- DELETE ONE ROW MODAL -->
    <div class="modal fade confirm-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Oled sa kindel, et soovid antud sissekannet kustutada?</h4>
                </div>
                <div class="modal-footer">
                    <button id="yes-delete" type="button" class="btn btn-default" data-dismiss="modal">Jah</button>
                    <button id="no-delete" type="button" class="btn btn-primary" data-dismiss="modal">Ei</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ALLOW TO TAKE THE TEST AGAIN MODAL -->
    <div class="modal fade confirm-allow-again">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Oled sa kindel, et soovid antud isikut uuesti testile lubada?</h4>
                </div>
                <div class="modal-footer">
                    <button id="yes-allow" type="button" class="btn btn-default" data-dismiss="modal">Jah</button>
                    <button id="no-allow" type="button" class="btn btn-primary" data-dismiss="modal">Ei</button>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>