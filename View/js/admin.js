"use strict";


(function () {

    let hideAll = function (elements) {
        elements.each((index, el) => $(el).hide());
    };

    let panels = $(".mypanel");

    hideAll(panels);


    let pills = $(".nav>li>a");

    // i won't use closure cause panel is already an argument inside first each !!!

    // panels.each((i, panel) => {
    //     pills.each((j, pill) => {
    //         if (i === j) {
    //             $(pill).on("click", function (ev) {
    //                 return (function (panel) {
    //                     hideAll(panels);
    //                     $(panel).show();
    //                 })(panel);
    //             });
    //         }
    //     });
    // });

    panels.each((i, panel) => {
        pills.each((j, pill) => {
            if (i === j) {
                $(pill).on("click", function (ev) {
                    hideAll(panels);
                    $(panel).show();
                    return false;
                });
            }
        });
    });

    let i = parseInt($("#selectedTab").html());

    pills.slice(i - 1, i).trigger("click");

    $(".success").fadeOut(3000);

})();
