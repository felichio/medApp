"use strict";


(function () {

    let checkAmka = function (amka) {
        let testAmka = /^\d{11}$/;
        return !testAmka.test(amka) ? true : false;
    }

    let checkBoxes = function (boxes) {
        let counter = 0;
        boxes.each((index, el) => {
            $(el).is(":checked") ? counter++ : undefined;
        });
        return counter === 0 ? true : false;
    }


    $("#savebutton").on("click", function (ev) {
        if (checkAmka($("#inputAmka").val())) {
            $(".error").empty();
            $(".error").append(
                `<div class='alert alert-danger text-center' role='alert'>AMKA must be 11 digits</div>`
            );
            return false;
        }

        if (checkBoxes($(":checkbox"))) {
            $(".error").empty();
            $(".error").append(
                `<div class='alert alert-danger text-center' role='alert'>Select at least one Drug</div>`
            );
            return false;
        }




        return true;
    });

    $("#cancelbutton").on("click", function (ev) {
        window.location.href = "doctor.php";
    });

})();
