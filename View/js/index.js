
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

    let checkEmail = function (em) {
        let testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        return !testEmail.test(em) ? true : false;
    }

    let checkAmka = function (amka) {
        let testAmka = /^\d{11}$/;
        return !testAmka.test(amka) ? true : false;
    }

    let checkInput = function (...params) {
        let errors = [];

        params.map(el => console.log(el));

        lessThan(5)(params[0]["value"].length) ? errors.push(err(params[0]["key"], 5)) : undefined;
        lessThan(2)(params[1]["value"].length) ? errors.push(err(params[1]["key"], 2)) : undefined;
        lessThan(2)(params[2]["value"].length) ? errors.push(err(params[2]["key"], 2)) : undefined;
        checkAmka(params[3]["value"]) ? errors.push(params[3]["key"] + " must be exactly 11 digits") : undefined;
        checkEmail(params[4]["value"]) ? errors.push(params[4]["key"] + " is invalid"): undefined;
        lessThan(5)(params[5]["value"].length) ? errors.push(err(params[5]["key"], 5)) : undefined;
        notEqualsWith(params[5]["value"])(params[6]["value"]) ? errors.push("Password mismatch") : undefined;

        errors.map(x => console.log(x));

        $(".error").empty();
        errors.forEach(error => {
            $(".error").append(
                `<div class='alert alert-danger text-center' role='alert'>${error}</div>`
            );
        });



        return errors.length === 0 ? true : false;
    }

    $("#form-control-label").on("click", "a", function (ev) {

        $(".error").empty();

        let id = $(this).attr("id");

        $.get("forms/" + id + ".html")
            .then(form => {
                $(".form-input").html(form);

                id === "register" ? $("#registerbutton").on("click", function () {
                    return checkInput(...$.makeArray($(".form-input input")).map(el => ({
                        key: $(el).attr("placeholder"),
                        value: $(el).val()
                    })));

                }) : false;
            });


        return false;
    });




})();
