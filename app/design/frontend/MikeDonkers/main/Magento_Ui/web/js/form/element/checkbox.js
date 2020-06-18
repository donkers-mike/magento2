define(["Magento_Ui/js/form/element/abstract", "domReady!"], function (
    Abstract
) {
    "use strict";

    return Abstract.extend({
        defaults: {
            visible: false,
            modules: {
                postcode: "${ $.parentName }.postcode",
            },
        },
        initialize: function () {
            this._super();
            this.setVisible(false);
        },

        afterRender: function () {
            let self = this;
            if (this.postcode().hasData()) {
                this.setVisible(!!self.postcode().validate().valid);
            }

            this.postcode().value.subscribe(function (value) {
                self.setVisible(!!self.postcode().validate().valid);
            });
        },
    });
});
