/**
 * Created by Renee on 2/16/2017.
 */


// MAIN COMPONENTS
// SOME SCRIPTS ARE LOCATED IN THE SPECIFIC VIEW

// ********************** IMPORT ISIKUKOOD.JS DIRECTLY ******************************//
// import isikukood.min.js file directly here (javascript social id validation)
!function (a) {
    function b(a) {
        "use strict";
        this.code = a, this.getControlNumber = function () {
            for (var a, b = [1, 2, 3, 4, 5, 6, 7, 8, 9, 1], c = [3, 4, 5, 6, 7, 8, 9, 1, 2, 3], d = 0, e = 0; e < 10; e++)d += this.code.charAt(e) * b[e];
            if (a = d % 11, d = 0, 10 === a) {
                for (e = 0; e < 10; e++)d += this.code.charAt(e) * c[e];
                a = d % 11, 10 === a && (a = 0)
            }
            return a
        }, this.validate = function () {
            if (11 !== this.code.length)return !1;
            var b = this.getControlNumber(a);
            if (b !== parseInt(this.code.charAt(10)))return !1;
            var c = Number(this.code.substr(1, 2)), d = Number(this.code.substr(3, 2)), e = Number(this.code.substr(5, 2)), f = this.getBirthday();
            return c === f.getFullYear() % 100 && f.getMonth() + 1 === d && e === f.getDate()
        }, this.getGender = function () {
            var a = this.code.charAt(0), b = "";
            switch (a) {
                case"1":
                case"3":
                case"5":
                    b = "male";
                    break;
                case"2":
                case"4":
                case"6":
                    b = "female";
                    break;
                default:
                    b = "unknown"
            }
            return b
        }, this.getAge = function () {
            return Math.floor(((new Date).getTime() - this.getBirthday().getTime()) / 864e5 / 365.25)
        }, this.getBirthday = function () {
            var a = parseInt(this.code.substring(1, 3)), b = parseInt(this.code.substring(3, 5).replace(/^0/, "")) - 1, c = this.code.substring(5, 7).replace(/^0/, ""), d = this.code.charAt(0);
            return a += "1" === d || "2" === d ? 1800 : "3" === d || "4" === d ? 1900 : "5" === d || "6" === d ? 2e3 : 2100, new Date(a, b, c)
        }
    }

    function c(a) {
        console.error(a)
    }

    b.generate = function (a) {
        "use strict";
        a = a || {};
        var d, e, f, g = a.gender || (0 === Math.round(Math.random()) ? "male" : "female"), h = "", i = ["00", "01", "02", "22", "27", "37", "42", "47", "49", "52", "57", "60", "65", "70", "95"];
        if ("female" !== g && "male" !== g)throw new c('gender param accepts only "male" or "female" values.');
        if (d = a.birthYear ? a.birthYear : Math.round(100 * Math.random() + 1900 + ((new Date).getFullYear() - 2e3)), e = a.birthMonth ? a.birthMonth : Math.floor(12 * Math.random()) + 1, a.birthDay) f = a.birthDay; else {
            var j = new Date(d, e, 0).getDate();
            f = Math.floor(Math.random() * j) + 1
        }
        return "male" === g && d >= 1800 && d <= 1899 ? h += "1" : "female" === g && d >= 1800 && d <= 1899 ? h += "2" : "male" === g && d >= 1900 && d <= 1999 ? h += "3" : "female" === g && d >= 1900 && d <= 1999 ? h += "4" : "male" === g && d >= 2e3 ? h += "5" : "female" === g && d >= 2e3 && (h += "6"), h += parseInt(d, 0).toString().substring(2, 4), h += 1 === e.toString().length ? "0" + e : e, h += 1 === f.toString().length ? "0" + f : f, h += i[Math.floor(Math.random() * i.length)], h += Math.floor(10 * Math.random()), h += new b(h).getControlNumber()
    }, "undefined" != typeof module && module.exports ? module.exports = b : a.Isikukood = b
}(this);


// ********************** MAIN FUNCTIONS ******************************//
// count unanswered questions
function countUnansweredQuestions(count) {
    var questionCount = count;
    var numberOfCheckedRadio = $('input:radio:checked').length;
    if (numberOfCheckedRadio != questionCount && (questionCount - numberOfCheckedRadio) !== 1) {
        $('#checked').html("Sul on " + (questionCount - numberOfCheckedRadio) + " vastamata küsimust");
    } else if ((questionCount - numberOfCheckedRadio) === 1) {
        $('#checked').html("Sul on " + (questionCount - numberOfCheckedRadio) + " vastamata küsimus");
    } else {
        $('#checked').hide();
    }
}


// ********************** WELCOME PAGE ******************************//
// welcome page login
$('#btnLogin').on('click', function (event) {
    event.preventDefault();
    console.log('clicked');

    $.post('welcome/register', {
        "firstName": $("#firstName").val(),
        "lastName": $("#lastName").val(),
        "social_id": $("#social_id").val(),
        "password": $("#password").val()
    }, function (res) {
        if (res == 'ok') {
            window.location.href = 'test';
        } else {
            alert(res);
        }
    });
});

// ********************** MAIN BUTTONS ******************************//
$(document).ready(function () {

    // clear any input that might have been saved via browser itself earlier
    $('input:text').val("");
    $('input:password').val("");

    // send theoretical quiz
    $("#yes-theoretical").click(function () {
        $("#quiz").submit();
    });

    // send practical test
    $("#yes-practical").click(function () {
        $("#target").submit();
    });

    // ********************** THEORETICAL TEST PAGE ******************************//
    // check the entire answer text boxes when clicked
    $('input').click(function () {
        $('input').each(function () {
            $('input').closest('li').removeClass("active-answer");
        });

        $('input:checked').each(function () {
            $('input:checked').closest('li').addClass("active-answer");
        });
    });

});

// disable login button by default
$('#btnLogin').prop('disabled', true);

// define limits
var lowerLimitName = 2;
var upperLimitName = 50;
var lowerLimitLastname = 2;
var upperLimitLastname = 50;

// define variables
var firstnameLength;
var lastnameLength;
var socialID;

// live user validation feedback
$(".validate-new-user").keyup(function () {

    var firstname = document.forms["register"]["firstName"].value;
    var lastname = document.forms["register"]["lastName"].value;
    var social = document.forms["register"]["social_id"].value;
    var pin = document.forms["register"]["password"].value;
    var ik = new Isikukood(social);

    // check if firstname is too short or too long
    if (firstname.length < lowerLimitName && firstname.length != 0) {
        $("#firstName").addClass("border-red no-outline");
        firstnameLength = false;
    } else if (firstname.length > upperLimitName) {
        $("#firstName").addClass("border-red no-outline");
        firstnameLength = false;
    } else if (firstname.length == 0) {
        $("#firstName").removeClass("border-red no-outline");
        $('#btnLogin').prop('disabled', true);
    } else {
        $("#firstName").removeClass("border-red no-outline");
        firstnameLength = true;
    }

    // check if lastname is too short or too long
    if (lastname.length < lowerLimitLastname && lastname.length != 0) {
        $("#lastName").addClass("border-red no-outline");
        lastnameLength = false;
    } else if (lastname.length > upperLimitLastname) {
        $("#lastName").addClass("border-red no-outline");
        lastnameLength = false;
    } else if (lastname.length == 0) {
        $("#lastName").removeClass("border-red no-outline");
        $('#btnLogin').prop('disabled', true);
    } else {
        $("#lastName").removeClass("border-red no-outline");
        lastnameLength = true;
    }

    // validate social id... isikukood.min.js needs to be imported before this file
    if (!(ik.validate()) && social != 0) {
        $("#social_id").addClass("border-red no-outline");
        socialID = false;
    } else if (social == 0) {
        $("#social_id").removeClass("border-red no-outline");
        $('#btnLogin').prop('disabled', true);
    } else {
        $("#social_id").removeClass("border-red no-outline");
        socialID = true;
    }

    // if password is not numeric
    if (!($.isNumeric(pin)) && pin != 0) {
        $("#password").addClass("border-red no-outline");
    } else {
        $("#password").removeClass("border-red no-outline");
    }

    // if all is well (including pin is not empty), enable the button
    if (firstnameLength === true && lastnameLength === true && socialID === true && pin != 0 &&
        $.isNumeric(pin)) {
        $('#btnLogin').prop('disabled', false);
    } else {
        $('#btnLogin').prop('disabled', true);
    }

});

