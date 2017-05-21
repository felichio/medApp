
"use strict";



(function () {

    $("#form-control-label").on("click", "a", function (ev) {

        let id = $(this).attr("id");

        $.get("forms/" + id + ".html")
            .then(form => $(".form-input").html(form));

        return false;
    });

})();
