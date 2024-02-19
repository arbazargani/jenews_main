/**
 * Created by beporsam.ir on 2/22/2020.
 */
$(document).ready(function() {
    $("#StartDate").datepicker({
            changeMonth: true,
            changeYear: true,
            format: "yyyy/mm/dd l",
            minDate:new Date()
    }
    );




   
    $("#FromDate").datepicker({
        changeMonth: true,
        changeYear: true,
        format: "yyyy/mm/dd l"
    });
    $("#presentDate").datepicker({
        changeMonth: true,
        changeYear: true, yearRange: '1360',
        format: "yyyy/mm/dd l"
    });


    $("#EndDate").datepicker({
        changeMonth: true,
        changeYear: true, yearRange: '1360',
        minDate:  new Date()
    });
});



/********full config datepicker-----------------*/
/*
$(document).ready(function () {
    $("#example1").pDatepicker({
        persianDigit: true,
        viewMode: false,
        position: "auto",
        autoClose: false,
        format: false,
        observer: false,
        altField: false,
        inputDelay: 800,
        formatter: function (unixDate) {
            var self = this;
            var pdate = new persianDate(unixDate);
            pdate.formatPersian = false;
            return pdate.format(self.format);
        },
        altFormat: 'unix',
        altFieldFormatter: function (unixDate) {
            var self = this;
            var thisAltFormat = self.altFormat.toLowerCase();
            if (thisAltFormat === "gregorian" | thisAltFormat === "g") {
                return new Date(unixDate);
            }
            if (thisAltFormat === "unix" | thisAltFormat === "u") {
                return unixDate;
            } else {
                return new persianDate(unixDate).format(self.altFormat);
            }
        },
        onShow: function (self) {
        },
        onHide: function (self) {
        },
        onSelect: function (unixDate) {
            return this;
        },
        navigator: {
            enabled: true,
            text: {
                btnNextText: "<",
                btnPrevText: ">"
            },
            onNext: function (navigator) {
                //log("navigator next ");
            },
            onPrev: function (navigator) {
                //log("navigator prev ");
            },
            onSwitch: function (state) {
                // console.log("navigator switch ");
            }
        },
        toolbox: {
            enabled: true,

            text: {
                btnToday: "امروز"
            },
            onToday: function (toolbox) {
                //log("toolbox today btn");
            }
        },
        timePicker: {
            enabled: false,
            showSeconds: true,
            showMeridian: true,
            scrollEnabled: true
        },
        dayPicker: {
            enabled: true,
            scrollEnabled: true,
            titleFormat: 'YYYY MMMM',
            titleFormatter: function (year, month) {
                if (this.datepicker.persianDigit == false) {
                    window.formatPersian = false;
                }
                var titleStr = new persianDate([year, month]).format(this.titleFormat);
                window.formatPersian = true;
                return titleStr
            },
            onSelect: function (selectedDayUnix) {
                //log("daypicker month day :" + selectedDayUnix);
            }

        },
        monthPicker: {
            enabled: true,
            scrollEnabled: true,
            titleFormat: 'YYYY',
            titleFormatter: function (unix) {
                if (this.datepicker.persianDigit == false) {
                    window.formatPersian = false;
                }
                var titleStr = new persianDate(unix).format(this.titleFormat);
                window.formatPersian = true;
                return titleStr

            },
            onSelect: function (monthIndex) {
                //log("daypicker select day :" + monthIndex);
            }
        },
        yearPicker: {
            enabled: true,
            scrollEnabled: true,
            titleFormat: 'YYYY',
            titleFormatter: function (year) {
                var remaining = parseInt(year / 12) * 12;
                return remaining + "-" + (remaining + 11);
            },
            onSelect: function (monthIndex) {
                //log("daypicker select Year :" + monthIndex);
            }
        },
        onlyTimePicker: false,
        justSelectOnDate: true,
        minDate: false,
        maxDate: false
    });
});
/******************************************************/