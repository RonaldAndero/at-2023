<?php if ($this->settings['scores'] == 1): ?>

<div id="public-results">
    <h3><?= __("Tulemused") ?></h3>
    <div class="table-box">
        <table class="table table-bordered results">
            <tr>
                <th>Nimi</th>
                <th>Teoreetiline test</th>
                <th>Praktiline test</th>
                <th>Kokku</th>
                <th>Kuupäev</th>
            </tr>
            <?php foreach ($scores as $score): ?>
                <?php if ($score['practical_points'] != -2 && $score['theoretical_points'] != -1): ?>
                    <tr>
                        <?php if ($this->settings['scores_private'] == 1): ?>
                            <td><?= hideString($score['firstname']) . ' ' . hideString($score['lastname']) ?></td>
                        <?php else: ?>
                            <td><?= $score['firstname'] . ' ' . $score['lastname'] ?></td>
                        <?php endif; ?>
                        <td><?= $score['theoretical_points'] ?></td>
                        <td>
                            <?php if ($score['practical_points'] == -1): ?>
                                <span class="not-graded">Hindamata</span>
                            <?php else: ?>
                                <?= $score['practical_points'] ?>
                            <?php endif; ?>
                        </td>
                        <td><?= $score['sum'] ?> / <?= $score['nr_of_questions'] + 10 ?></td>
                        <td><?= date("d.m.Y", strtotime($score['date'])); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach ?>
        </table>
    </div>

    <?php else: ?>

        <div id="public-results">
            <h3>Tulemusi pole kuvada. Proovige hiljem uuesti.</h3>
        </div>

    <?php endif; ?>


