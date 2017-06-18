"use strict";

(function () {


    $("#cancelbutton").on("click", function (ev) {
        window.location.href = "index.php";
    });

    $("#changebutton").on("click", function (ev) {
        $(".error").empty();
        if ($("#inputPassword1").val().length < 5) {
            let error = "Password must be at least 5 characters long";
            $(".error").append(
                `<div class='alert alert-danger text-center' role='alert'>${error}</div>`
            );
            return false;
        } else if ($("#inputPassword1").val() !== $("#inputPassword2").val()) {
            let error = "Password Mismatch";
            $(".error").append(
                `<div class='alert alert-danger text-center' role='alert'>${error}</div>`
            );
            return false;
        }
        return true;
    });
})();
