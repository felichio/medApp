
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

    let checkCode = function (code) {
        let testCode = /^\d{10}$/;
        return !testCode.test(code) ? true : false;
    }

    let checkPrice = function (price) {
        console.log(price);
        let testPrice = /^\d{1,6}([,.]\d{1,3})?$/;
        console.log(testPrice.test(price));
        return !testPrice.test(price) ? true : false;
    }

    let checkInput = function (...params) {
        let errors = [];

        params.map(el => console.log(el));

        lessThan(2)(params[1]["value"].length) ? errors.push(err(params[1]["key"], 2)) : undefined;

        checkCode(params[0]["value"]) ? errors.push(params[0]["key"] + " must be exactly 10 digits") : undefined;
        checkPrice(params[3]["value"]) ? errors.push("Invalid " + params[3]["key"]) : undefined;




        $(".error").empty();
        errors.forEach(error => {
            $(".error").append(
                `<div class='alert alert-danger text-center' role='alert'>${error}</div>`
            );
        });



        return errors.length === 0 ? true : false;
    }

    $("#cancelbutton").on("click", function (ev) {
        window.location.href = "admin.php";
    });

    $("#savebutton").on("click", function (ev) {
        return checkInput(...$.makeArray($(".form-input input")).map(el => ({
            key: $(el).attr("placeholder"),
            value: $(el).val()
        })));
    });

})();
