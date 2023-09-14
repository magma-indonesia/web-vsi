'use strict';

var NominativeViewHandler = {
    construct: function (options) {
        var citySelect;
        var employeeSelect;
        var teamLead;
        var handler = {
            _initialize: function () {
                var self = this;
                console.log(options);

                // disabled all input in all step form
                $('#form-nominative input').prop('disabled', true);
                $('#form-rab input').prop('disabled', true);
                $('#form-rrb input').prop('disabled', true);
            },
            _clickListener: function () {
                var self = this;
            },
            _stepper: function () {
                var self = this;

                var is_async_step = false;

                $('#wizard4').steps({
                    headerTag: 'h3',
                    bodyTag: 'section',
                    autoFocus: true,
                    titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
                    transitionEffect: 2,
                    onStepChanged: function () {
                        $('#loading-spinner').hide();
                    },
                    onStepChanging: function (event, currentIndex, newIndex) {

                        if (is_async_step) {
                            is_async_step = false;
                            //ALLOW NEXT STEP
                            return true;
                        }

                        if (currentIndex < newIndex) {
                            // Step 1 form validation
                            if (currentIndex === 0) {
                                $('#loading-spinner').show();
                                return true;
                            }

                            // Step 2 form validation
                            if (currentIndex === 1) {
                                $('#loading-spinner').show();
                                return true;
                            }
                            // Always allow step back to the previous step even if the current step is not valid.
                        } else {
                            return true;
                        }
                    },
                    onFinished: function (event, currentIndex) {
                        alert('Tidak ada data lagi!');
                    }
                });
            },
            init: function () {
                var self = this;
                self._initialize();
                self._stepper();
                self._clickListener();
            }
        };

        return handler;
    }
};
