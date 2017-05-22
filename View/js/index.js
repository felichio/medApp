
"use strict";



(function () {


    let lessThan = function (x) {
        return function (y) {
            return y < x;
        }
    };

    let err = function (el, x) {
        return el + ` must be longer than ${x} characters`;
    }

    let checkInput = function (...params) {
        let errors = [];

        params.map(el => console.log(el));

        lessThan(5)(params[0]["value"].length) ? errors.push(err(params[0]["key"], 5)) : undefined;
        lessThan(2)(params[1]["value"].length) ? errors.push(err(params[1]["key"], 2)) : undefined;
        lessThan(2)(params[2]["value"].length) ? errors.push(err(params[2]["key"], 2)) : undefined;

        errors.map(x => console.log(x));

        return false;

    }

    $("#form-control-label").on("click", "a", function (ev) {

        $(".error").hide();

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
