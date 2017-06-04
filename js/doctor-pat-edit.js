


"use strict";

(function () {

    let lessThan = function (x) {
        return function (y) {
            return y < x;
        }
    };

    let notEqualsWith = function (x) {
        return function (y) {
            return x !== y;
        }
    };

    let err = function (el, x) {
        return el + ` must be longer than ${x} characters`;
    }

    let checkAmka = function (amka) {
        let testAmka = /^\d{11}$/;
        return !testAmka.test(amka) ? true : false;
    }

    let checkInput = function (...params) {
        let errors = [];

        params.map(el => console.log(el));

        lessThan(2)(params[0]["value"].length) ? errors.push(err(params[0]["key"], 2)) : undefined;
        lessThan(2)(params[1]["value"].length) ? errors.push(err(params[1]["key"], 2)) : undefined;
        checkAmka(params[2]["value"]) ? errors.push(params[2]["key"] + " must be exactly 11 digits") : undefined;

        $(".error").empty();
        errors.forEach(error => {
            $(".error").append(
                `<div class='alert alert-danger text-center' role='alert'>${error}</div>`
            );
        });



        return errors.length === 0 ? true : false;
    }


    $("#cancelbutton").on("click", function (ev) {
        window.location.href = "doctor.php";
    });

    $("#savebutton").on("click", function (ev) {
        return checkInput(...$.makeArray($(".form-input input")).map(el => ({
            key: $(el).attr("placeholder"),
            value: $(el).val()
        })));
    });



})();
