<!-- import custom markup JS -->
<script src="assets/js/codemirror.js"></script>
<div id="practical-questions">
    <article>
        <h2 class="toDo">Lahenda järgmised ülesanded:</h2>
        <ul>
            <?php foreach ($practicalQuestions[1] as $practicalQuestion): ?>

                <li>
                    <label>
                        <?= $practicalQuestion ?>
                    </label>
                </li>
            <?php endforeach ?>
        </ul>
    </article>
</div>

<?php if ($this->settings['livehtml'] == 1): ?>
    <div class="row">
        <div class="col-md-6">
            <form action="test/result" method="post" id="target">
                <div class="practical-div">
                    <mark class="practical-heading center">Koodi kirjutamine:</mark>
                </div>
                <textarea wrap="hard" name="validateHTML" id="code" class="validateHTML" cols="20"></textarea>
                <br>
                <input type="hidden" value="Submit">
                <a href="#" id="submit-practical" class="btn btn-info btn-lg" data-toggle="modal"
                   data-target=".confirm">Esita</a>
                <br>
            </form>
        </div>
        <div class="col-md-6">
            <div class="center">
                <div class="preview-div"><h2 class="preview-heading center">Eelvaade:</h2></div>
            </div>
            <iframe id="preview"></iframe>
        </div>
    </div>

    <script>

        // start the live editor magic! :)
        $(document).ready(function () {
            var delay;
            editor.on("change", function () {
                clearTimeout(delay);
                delay = setTimeout(updatePreview, 30);
            });
            function updatePreview() {
                var previewFrame = document.getElementById('preview');
                var preview = previewFrame.contentDocument || previewFrame.contentWindow.document;
                preview.open();
                preview.write(editor.getValue());
                preview.close();
            }

            setTimeout(updatePreview, 30);
        });

    </script>

<?php else: ?>

    <form action="test/result" method="post" id="target">
        <div class="practical-div">
            <mark class="practical-heading center"><h2>Koodi kirjutamine:</h2></mark>
        </div>
        <textarea wrap="hard" name="validateHTML" id="code" class="validateHTML" cols="20"></textarea>
        <br>
        <input type="hidden" value="Submit">
        <a href="#" id="submit-practical" class="btn btn-info btn-lg" data-toggle="modal"
           data-target=".confirm">Esita</a>
        <br>
    </form>
<?php endif; ?>

<!-- CONFIRM MODAL -->
<div class="modal fade confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Oled sa kindel, et soovid esitada lahendust?</h4>
            </div>
            <div class="modal-footer">
                <button id="yes-practical" type="button" class="modal-btn btn btn-primary" data-dismiss="modal">Jah
                </button>
                <button id="no" type="button" class="modal-btn btn btn-primary" data-dismiss="modal">Ei</button>
            </div>
        </div>
    </div>
</div>


<script>

    // initialize codemirror
    var mixedMode = {
        name: "htmlmixed",
        scriptTypes: [{
            matches: /\/x-handlebars-template|\/x-mustache/i,
            mode: null
        },
            {
                matches: /(text|application)\/(x-)?vb(a|script)/i,
                mode: "vbscript"
            }]
    };
    var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        lineNumbers: true,
        mode: mixedMode
    });

</script>