// MAIN COMPONENTS
// SOME SCRIPTS ARE LOCATED IN THE SPECIFIC VIEW


// ********************** MAIN FUNCTIONS ******************************//
// function to fix multiline placeholder weird behaviour across different browsers
function fixMultiline() {
    $(function () {
        var isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;

        // Disable for chrome which already supports multiline
        if (!(!!window.chrome && !isOpera)) {
            var style = $('<style>textarea[data-placeholder].active { color: grey; }</style>')
            $('html > head').append(style);

            $('textarea[placeholder]').each(function (index) {
                var text = $(this).attr('placeholder');
                var match = /\r|\n/.exec(text);

                if (!match)
                    return;

                $(this).attr('placeholder', '');
                $(this).attr('data-placeholder', text);
                $(this).addClass('active');
                $(this).val(text);
            });

            $('textarea[data-placeholder]').on('focus', function () {
                if ($(this).attr('data-placeholder') === $(this).val()) {
                    $(this).attr('data-placeholder', $(this).val());
                    $(this).val('');
                    $(this).removeClass('active');
                }
            });

            $('textarea[data-placeholder]').on('blur', function () {
                if ($(this).val() === '') {
                    var text = $(this).attr('data-placeholder');
                    $(this).val(text);
                    $(this).addClass('active');
                }
            });
        }
    });
}


// blink success text
function blinkSuccess(successId, errorId) {
    $(errorId).hide();
    $(successId).fadeOut(75).fadeIn(75).animate({opacity: 1}, 500).delay(1000);
}


// blink error text
function blinkError(successId, errorId) {
    $(successId).hide();
    $(errorId).fadeOut(75).fadeIn(75).animate({opacity: 1}, 500).delay(1000);
}


// search filter function in theoretical questions
function searchFilterTheoretical() {
    var filter = $('#search-theoretical').val().toUpperCase();

    $('.questions').each(function () {
        if ($(this).val().toUpperCase().indexOf(filter) > -1) {
            $(this).closest('.table-old').fadeIn('fast');
        } else {
            $(this).closest('.table-old').fadeOut('fast');
        }
    });
}

// search filter function in log page
function searchFilterLog() {
    var filter = $('#search-log').val().toUpperCase();

    $('tr:not(:first-child)').each(function () {
        if ($(this).html().toUpperCase().indexOf(filter) > -1) {
            $(this).fadeIn('fast');
        } else {
            $(this).fadeOut('fast');
        }
    });
}


// fancy grading in grading page
function fancyGrading() {
    // make the first items active
    $('ul#myTabs li:first').addClass('active');
    $('.tab-content .tab-pane:first').addClass('in active');

    // display preview window on click
    $(".practical-text").on('click', function (event) {
        event.preventDefault();
    });

    // fancy grading
    $('label').on('click', function (event) {

        $(this).closest('.btn-group').find('.active').removeClass('active focus');
        $(this).prop('checked', true);
        $(this).addClass('active focus');
        var id = $(this).find(':input').attr('name');
        var value = $('.active>input[name=' + id + ']').val();

        $.post('admin/gradePractical', {'user_id': id, 'grade': value},
            function (res) {
                if (res == 'ok') {
                    // remove not graded class, hide it, change value, add class and fade it in (in pillar title)
                    $('.not-graded-' + id).removeClass('not-graded').addClass('graded').hide().html('Hinnatud: "' + value + '"').fadeIn();
                    // same as above but for the pillar data (next to grades)
                    $('.bottom-not-graded-' + id).removeClass('not-graded').addClass('graded-green').hide().html('Hinnatud');
                    // change the grade in the title should it be changed
                    $('#graded-' + id).html('"' + value + '"');
                    // blink the graded text when a change is made
                    $('.graded-green').fadeOut('fast').fadeIn('fast');
                } else {
                    alert(res);
                }
            });

    })
}


// live time interval in settings page
function refreshTime() {
    // refresh time
    setInterval(function () {
        $.post('admin/liveTime', 'test',
            function (res) {
                console.log(res);
                if (res != 0) {
                    $('#liveTime').html(res);
                } else {
                    $('#liveTime').html('Test on suletud').fadeIn('fast');
                }
            });
    }, 1000);
}


// validate password change in settings page
function validatePassword() {
    // declare global variables needed for password validation
    var length;
    var upper;
    var lower;
    var number;
    var match;

    // disable the password change button by default
    $('#submit-new-password').prop('disabled', true);

    // changing password
    $(".new-password").keyup(function () {
        var ucase = new RegExp("[A-Z]+");
        var lcase = new RegExp("[a-z]+");
        var num = new RegExp("[0-9]+");

        if ($("#password1").val().length >= 8) {
            $("#8char").removeClass("glyphicon-remove");
            $("#8char").addClass("glyphicon-ok");
            $("#8char").css("color", "#00A41E");
            length = true;
        } else {
            $("#8char").removeClass("glyphicon-ok");
            $("#8char").addClass("glyphicon-remove");
            $("#8char").css("color", "#FF0004");
            length = false;
        }

        if (ucase.test($("#password1").val())) {
            $("#ucase").removeClass("glyphicon-remove");
            $("#ucase").addClass("glyphicon-ok");
            $("#ucase").css("color", "#00A41E");
            upper = true;
        } else {
            $("#ucase").removeClass("glyphicon-ok");
            $("#ucase").addClass("glyphicon-remove");
            $("#ucase").css("color", "#FF0004");
            upper = false;
        }

        if (lcase.test($("#password1").val())) {
            $("#lcase").removeClass("glyphicon-remove");
            $("#lcase").addClass("glyphicon-ok");
            $("#lcase").css("color", "#00A41E");
            lower = true;
        } else {
            $("#lcase").removeClass("glyphicon-ok");
            $("#lcase").addClass("glyphicon-remove");
            $("#lcase").css("color", "#FF0004");
            lower = false;
        }

        if (num.test($("#password1").val())) {
            $("#num").removeClass("glyphicon-remove");
            $("#num").addClass("glyphicon-ok");
            $("#num").css("color", "#00A41E");
            number = true;
        } else {
            $("#num").removeClass("glyphicon-ok");
            $("#num").addClass("glyphicon-remove");
            $("#num").css("color", "#FF0004");
            number = false;
        }

        if ($("#password1").val() == $("#password2").val() && $("#password1").val().length !== 0) {
            $("#pwmatch").removeClass("glyphicon-remove");
            $("#pwmatch").addClass("glyphicon-ok");
            $("#pwmatch").css("color", "#00A41E");
            match = true;
        } else {
            $("#pwmatch").removeClass("glyphicon-ok");
            $("#pwmatch").addClass("glyphicon-remove");
            $("#pwmatch").css("color", "#FF0004");
            match = false;
        }

        // disable button if any of the checks are not true
        if (length === true && upper === true && lower === true && number === true && match === true) {
            $('#submit-new-password').prop('disabled', false);
        } else {
            $('#submit-new-password').prop('disabled', true);
        }
    });
}


$(document).ready(function () {

    // initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // clear any input that might have been saved via browser itself earlier
    $('#username').val("");
    $('#password').val("");

    // ********************** THEORETICAL PAGE ******************************//
    // theoretical questions ajax edit
    $(".editTheoretical").click(function (event) {
        event.preventDefault();

        var id1 = $(this).closest('form').find('.edit-successful');
        var id2 = $(this).closest('form').find('.edit-error');
        var data = $(this).closest('form').serialize();

        $.post('admin/editTheoretical', data,
            function (res) {
                if (res == 'ok') {
                    blinkSuccess(id1, id2);
                } else {
                    blinkError(id1, id2);
                }
            });
    });


    // theoretical questions ajax delete
    $(".deleteTheoretical").click(function (event) {
        event.preventDefault();

        var selectorForm = $(this).closest('form').attr('id');
        var id1 = ($(document.getElementById(selectorForm)));
        var data = $(this).closest('form').serialize();

        $("#yes").click(function () {
            console.log(id1);
            $.post('admin/deleteTheoretical', data,
                function (res) {
                    if (res == 'ok') {
                        $(id1).hide();
                    } else {
                        console.log('Error deleting entry.');
                    }
                });
        });
    });


    // add theoretical questions
    $(".addTheoretical").click(function (event) {
        event.preventDefault();
        var data = $('#add-new-form').serialize();

        // every time user clicks the button the error text opacity is restored to its default value
        $('#error-adding').css('opacity', '0');

        $.post('admin/addTheoretical', data,
            function (res) {
                if (res == 'ok') {
                    window.location.reload();
                } else {
                    $('#error-adding').css('opacity', '1');
                }
            });
    });


    // ********************** SETTINGS PAGE ******************************//
    // change nr of questions setting
    $(".editQuestionCount").click(function (event) {
        event.preventDefault();

        var id1 = '#editQuestionCount-successful';
        var id2 = '#editQuestionCount-error';
        var data = $(this).closest('form').serialize();

        $.post('admin/editQuestionCount', data,
            function (res) {
                if (res == 'ok') {
                    blinkSuccess(id1, id2);
                } else {
                    blinkError(id1, id2);
                }
            });
    });


    // generate password
    $('#generatePassword').on('click', function (event) {
        event.preventDefault();

        $.post('admin/generatePassword', {password: this.value}, function (res) {
            $('#generatedPassword').val(res);
        });

        return false;
    });


    // open test
    $(".openTest").click(function (event) {
        event.preventDefault();

        var id1 = '#openTest-successful';
        var id2 = '#openTest-error';
        var data = $(this).closest('form').serialize();

        $.post('admin/openTest', data,
            function (res) {
                if (res == 'ok') {
                    blinkSuccess(id1, id2);
                } else {
                    blinkError(id1, id2);
                }
            });
    });


    // close test
    $(".closeTest").click(function (event) {
        event.preventDefault();

        var id1 = '#openTest-successful';
        var id2 = '#openTest-error';
        var data = $(this).closest('form').serialize();

        $.post('admin/closeTest', data,
            function (res) {
                if (res == 'ok') {
                    blinkSuccess(id1, id2);
                } else {
                    blinkError(id1, id2);
                }
            });
    });


    // html validation option
    $(".validationOption").click(function (event) {
        event.preventDefault();

        var id1 = '#validationOption-successful';
        var id2 = '#validationOption-error';
        var data = $(this).closest('form').serialize();

        $.post('admin/validationOption', data,
            function (res) {
                if (res == 'ok') {
                    blinkSuccess(id1, id2);
                } else {
                    blinkError(id1, id2);
                }
            });
    });


    // live html option
    $(".liveOption").click(function (event) {
        event.preventDefault();

        var id1 = '#liveOption-successful';
        var id2 = '#liveOption-error';
        var data = $(this).closest('form').serialize();

        $.post('admin/liveOption', data,
            function (res) {
                if (res == 'ok') {
                    blinkSuccess(id1, id2);
                } else {
                    blinkError(id1, id2);
                }
            });
    });


    // live results (scores) option
    $(".scoreOption").click(function (event) {
        event.preventDefault();

        var id1 = '#scoreOption-successful';
        var id2 = '#scoreOption-error';
        var data = $(this).closest('form').serialize();

        $.post('admin/scoreOption', data,
            function (res) {
                if (res == 'ok') {
                    blinkSuccess(id1, id2);
                } else {
                    blinkError(id1, id2);
                }
            });
    });

    // change password
    $('#submit-new-password').on('click', function (event) {
        event.preventDefault();

        var id1 = '.changePassword-successful';
        var id2 = '.changePassword-error';
        var data = $(this).closest('form').serialize();

        $.post('admin/changePassword', data,
            function (res) {
                if (res == 'ok') {
                    blinkSuccess(id1, id2);
                } else {
                    blinkError(id1, id2);
                }
            });
    });


    // ********************** PRACTICAL PAGE ******************************//
    // practical questions ajax edit
    $(".editPractical").click(function (event) {
        event.preventDefault();

        // get id's and data
        var practicalID = $(this).attr('id').replace('edit-', '');
        var descriptionID = '#description-' + practicalID;
        var data = $(descriptionID).val();
        var practicalTitle = $('#title-' + practicalID).val();

        // error and success id's
        var id1 = '#success-' + practicalID;
        var id2 = '#error-' + practicalID;

        // post to php
        $.post('admin/editPractical',
            {
                'practical_id': practicalID,
                'practical_text': data,
                'practical_title': practicalTitle
            },
            function (res) {
                if (res == 'ok') {
                    blinkSuccess(id1, id2);
                } else {
                    blinkError(id1, id2);
                }
            });
    });


    // delete practical task
    $(".deletePractical").click(function (event) {
        event.preventDefault();

        var practicalId = $(this).attr('id').replace('delete-', '');

        $("#yes").click(function () {
            $.post('admin/deletePractical', {'practical_id': practicalId},
                function (res) {
                    if (res == 'ok') {
                        window.location.reload();
                    } else {
                        console.log(res);
                    }
                });
        });
    });


    // add practical task
    $("#add-practical").click(function (event) {
        event.preventDefault();
        var practicalTitle = $('#new-title').val();
        var practicalText = $('#new-description').val();

        $.post('admin/addPractical',
            {
                'practical_title': practicalTitle,
                'practical_text': practicalText
            },
            function (res) {
                if (res == 'ok') {
                    window.location.reload();
                } else {
                    alert(res);
                }
            });
    });


    // ********************** INDEX PAGE ******************************//
    // allow user to take the test again in case of error or change of heart
    $(".allowAgain").click(function () {
        var id = this.id;

        $("#yes-allow").click(function () {
            $.post('admin/allowAgain', {'user_id': id},
                function (res) {
                    if (res == 'ok') {
                        window.location.reload();
                    } else {
                        alert(res);
                    }
                });
        });
    });


    // allow admin to delete files from result page and push them to the log table
    $("#pushToLog").click(function () {

        var id1 = '#pushToLog-successful';
        var id2 = '#pushToLog-error';

        $("#yes-log").click(function () {
            $.post('admin/pushToLog',
                function (res) {
                    if (res == 'ok') {
                        blinkSuccess(id1, id2);
                        window.location.reload();
                    } else {
                        blinkError(id1, id2);
                    }
                });

        });
    });

    // allow admin to delete files from result page and push them to the log table
    $(".del-icon").click(function (event) {
        event.preventDefault();

        // remove delete- and get only the id
        var id = $(this).attr('id').replace('delete-', '');

        $("#yes-delete").click(function () {
            $.post('admin/deleteResult', {'user_id': id},
                function (res) {
                    if (res == 'ok') {
                        $('#row-' + id).fadeOut();
                    } else {
                        console.log(res);
                    }
                });
        });
    });

});
