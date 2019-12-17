var ComponentsBootstrapTouchSpin = function() {

    var handleDemo = function() {

        $("#touchspin_1").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });

        $("#touchspin_2").TouchSpin({
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });

        $("#touchspin_3").TouchSpin({
            verticalbuttons: true
        });

        $("#touchspin_4").TouchSpin({
            verticalbuttons: true,
            verticalupclass: 'glyphicon glyphicon-plus',
            verticaldownclass: 'glyphicon glyphicon-minus'
        });

        $("#touchspin_5").TouchSpin();

        $("#touchspin_6").TouchSpin({
            min: 1,
            max: 1000000000,
            buttondown_class: "btn grey-salsa",
            buttonup_class: "btn grey-salsa"
        });

        $("#touchspin_7").TouchSpin({
            initval: 40,
            buttondown_class: "btn grey-salsa",
            buttonup_class: "btn grey-salsa",
        });

        $("#touchspin_8").TouchSpin({
            postfix: "a button",
            postfix_extraclass: "btn red"
        });

        $("#touchspin_9").TouchSpin({
            postfix: "a button",
            postfix_extraclass: "btn green"
        });

        $("#touchspin_10").TouchSpin({
            buttondown_class: "btn default",
            buttonup_class: "btn default",
            prefix: "pre",
            postfix: "post"
        });

        

    }

    return {
        //main function to initiate the module
        init: function() {
            handleDemo();
        }
    };

}();

jQuery(document).ready(function() {
    ComponentsBootstrapTouchSpin.init();
});