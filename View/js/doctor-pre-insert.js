"use strict";


(function () {

    let checkAmka = function (amka) {
        let testAmka = /^\d{11}$/;
        return !testAmka.test(amka) ? true : false;
    }


    $("#savebutton").on("click", function (ev) {
        if (checkAmka($("#inputAmka").val())) {
            $(".error").empty();
            $(".error").append(
                `<div class='alert alert-danger text-center' role='alert'>AMKA must be 11 digits</div>`
            );
            return false;
        }

        return true;
    });

    $("#cancelbutton").on("click", function (ev) {
        window.location.href = "doctor.php";
    });

})();
