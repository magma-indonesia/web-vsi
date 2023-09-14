'use strict';

var CollabHandler = {
    construct: function (options) {
        const $ = options.o;
        var handler = {
            _initialize: function () {
                var self = this;
            },
            _clickListener: function () {
                var self = this;

                var dynamicPicWrapper = $('.dynamic-pic');
                var x = 1;

                dynamicPicWrapper.on('click', '.add_button', function (e) {
                    if (x < options.maxPicField) {
                        x++;
                        $(this).closest('.dynamic-pic').append(self._dynamicPicFieldTemplate());
                    }
                });

                dynamicPicWrapper.on('click', '.remove_button', function (e) {
                    e.preventDefault();
                    $(this).closest('.dynamic-pic').remove();
                    x--;
                });

                var dynamicInvolvedWrapper = $('.dynamic-involved');
                var y = 1;

                dynamicInvolvedWrapper.on('click', '.add_button_involved', function (e) {
                    if (y < options.maxInvolvedField) {
                        y++;
                        $(this).closest('.dynamic-involved').append(self._dynamicInvolvedFieldTemplate());
                    }
                });

                dynamicInvolvedWrapper.on('click', '.remove_button_involved', function (e) {
                    e.preventDefault();
                    $(this).closest('.dynamic-involved').remove();
                    y--;
                });

                $('#gov-type').on('change', function (e) {
                    if ($(this).val() != 'gov') {
                        $('#org-under').show();
                    } else {
                        $('#org-under').hide();
                    }
                });

                $('#kategori').on('change', function (e) {
                    if ($(this).val() == '14') {
                        $('#scope-other').show();
                    } else {
                        $('#scope-other').hide();
                    }
                });
            },
            _dynamicPicFieldTemplate: function () {
                return '' +
                    '<div class="dynamic-pic">\n' +
                    '   <div class="col-md-2">\n' +
                    '       <div class="event_booking_field">\n' +
                    '           <select class="small">\n' +
                    '               <option>Mr.</option>\n' +
                    '               <option>Ms.</option>\n' +
                    '               <option>Mrs.</option>\n' +
                    '               <option>Dr.</option>\n' +
                    '               <option>Prof.</option>\n' +
                    '           </select>\n' +
                    '       </div>\n' +
                    '   </div>\n' +
                    '   <div class="col-md-3">\n' +
                    '       <div class="event_booking_field">\n' +
                    '           <input name="f_name" type="text" placeholder="Nama Depan">\n' +
                    '       </div>\n' +
                    '   </div>\n' +
                    '   <div class="col-md-3">\n' +
                    '       <div class="event_booking_field">\n' +
                    '           <input name="m_name" type="text" placeholder="Nama Tengah">\n' +
                    '       </div>\n' +
                    '   </div>\n' +
                    '   <div class="col-md-3">\n' +
                    '       <div class="event_booking_field">\n' +
                    '           <input name="l_name" type="text" placeholder="Nama Belakang">\n' +
                    '       </div>\n' +
                    '   </div>\n' +
                    '   <div class="col-md-1">\n' +
                    '       <div class="event_booking_field">\n' +
                    '           <button class="button btn-danger btn-lg remove_button" type="button"><i class="fa fa-minus"></i></button>\n' +
                    '       </div>\n' +
                    '   </div>\n' +
                    '   <div class="col-md-5">\n' +
                    '       <div class="event_booking_field">\n' +
                    '           <input name="email" type="email" placeholder="Email">\n' +
                    '       </div>\n' +
                    '   </div>\n' +
                    '   <div class="col-md-6">\n' +
                    '       <div class="event_booking_field">\n' +
                    '           <input name="organisasi" type="text" placeholder="Institusi">\n' +
                    '       </div>\n' +
                    '   </div>\n' +
                    '</div>';
            },
            _dynamicInvolvedFieldTemplate: function () {
                return '' +
                    '<div class="dynamic-involved">\n' +
                    '   <div class="col-md-2">\n' +
                    '       <div class="event_booking_field">\n' +
                    '           <select class="small">\n' +
                    '               <option>Mr.</option>\n' +
                    '               <option>Ms.</option>\n' +
                    '               <option>Mrs.</option>\n' +
                    '               <option>Dr.</option>\n' +
                    '               <option>Prof.</option>\n' +
                    '           </select>\n' +
                    '       </div>\n' +
                    '   </div>\n' +
                    '   <div class="col-md-3">\n' +
                    '       <div class="event_booking_field">\n' +
                    '           <input name="f_name" type="text" placeholder="Nama Depan">\n' +
                    '       </div>\n' +
                    '   </div>\n' +
                    '   <div class="col-md-3">\n' +
                    '       <div class="event_booking_field">\n' +
                    '           <input name="m_name" type="text" placeholder="Nama Tengah">\n' +
                    '       </div>\n' +
                    '   </div>\n' +
                    '   <div class="col-md-3">\n' +
                    '       <div class="event_booking_field">\n' +
                    '           <input name="l_name" type="text" placeholder="Nama Belakang">\n' +
                    '       </div>\n' +
                    '   </div>\n' +
                    '   <div class="col-md-1">\n' +
                    '       <div class="event_booking_field">\n' +
                    '           <button class="button btn-danger btn-lg remove_button_involved" type="button"><i class="fa fa-minus"></i></button>\n' +
                    '       </div>\n' +
                    '   </div>\n' +
                    '   <div class="col-md-5">\n' +
                    '       <div class="event_booking_field">\n' +
                    '           <input name="email" type="email" placeholder="Email">\n' +
                    '       </div>\n' +
                    '   </div>\n' +
                    '   <div class="col-md-6">\n' +
                    '       <div class="event_booking_field">\n' +
                    '           <input name="organisasi" type="text" placeholder="Institusi">\n' +
                    '       </div>\n' +
                    '   </div>\n' +
                    '</div>';
            },
            init: function () {
                var self = this;
                self._initialize();
                self._clickListener();
            }
        };
        return handler;
    }
};
