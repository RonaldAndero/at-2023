<!-- IF ADMIN -->
<?php if ($auth->is_admin): ?>

    <h3><?= __("Logi") ?></h3>
    <div class="responsive">

        <h5>Otsing</h5>
        <input type="text" id="search-log" onkeyup="searchFilterLog()" placeholder="&#128269; Otsi inimest...">
        <br>
        <table class="table table-bordered results table-box" id="sort-log">
            <thead id="log-head">
            <tr>
                <th>Nimi <span class="sort-right">&#x21D5;</span></th>
                <th>Isikukood <span class="sort-right">&#x21D5;</span></th>
                <th>T. test (punktid) <span class="sort-right">&#x21D5;</span></th>
                <th>Küsimusi <span class="sort-right">&#x21D5;</span></th>
                <th>P. test (punktid) <span class="sort-right">&#x21D5;</span></th>
                <th>Kuupäev <span class="sort-right">&#x21D5;</span></th>
                <th>Kokku (punktid) <span class="sort-right">&#x21D5;</span></th>
            </tr>
            </thead>
            <?php foreach ($resultsLog as $resultLog): ?>
                <tr>
                    <td><?= $resultLog['firstname'] . ' ' . $resultLog['lastname'] ?></td>
                    <td><?= $resultLog['social_id'] ?></td>
                    <td>
                        <?php if ($resultLog['theoretical_points'] == -1): ?>
                            <span class="not-graded">Tegemata</span>
                        <?php else: ?>
                            <?= $resultLog['theoretical_points'] ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($resultLog['nr_of_questions'] == 0): ?>
                            Korduv
                        <?php else: ?>
                            <?= $resultLog['nr_of_questions'] ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($resultLog['practical_points'] == -2): ?>
                            <span class="not-graded">Tegemata</span>
                        <?php elseif ($resultLog['practical_points'] == -1): ?>
                            <span class="not-graded">Hindamata</span>
                        <?php else: ?>
                            <?= $resultLog['practical_points'] ?>
                        <?php endif; ?>
                    </td>
                    <td><?= date("d.m.Y", strtotime($resultLog['date']));; ?></td>
                    <td><?= $resultLog['sum'] ?> / <?= $resultLog['nr_of_questions'] + 10 ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
        <?php if (empty($resultsLog)): ?>
            <h4>Pole midagi kuvada</h4>
        <?php endif; ?>
    <br>
    <br>
    <br>

    <script>

        // make table sortable
        $(document).ready(function () {
            $("#sort-log").tablesorter();
        });

    </script>

<?php endif; ?>