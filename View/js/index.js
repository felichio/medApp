
"use strict";



(function () {

    $("#form-control-label").on("click", "a", function (ev) {

        $(".error").hide();

        let id = $(this).attr("id");

        $.get("forms/" + id + ".html")
            .then(form => $(".form-input").html(form));

        return false;
    });




})();
