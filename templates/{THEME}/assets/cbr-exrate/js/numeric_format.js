/**
* use
jQuery(document).ready(function($) {
    $('p.nead-formatting').numeric_format({thSep:' ', dcSep:','});
});
wersion: 0.1.3
url: https://github.com/avil13/jQuery-numeric_format/ 
*/

(function($) {
    $.fn.numeric_format = function(options) {
        if (this === undefined) {
            return ("error");
        }

        var settings = $.extend({
            'thSep': ' ', // Проверка указания разделителя разрядов
            'dcSep': ',', // Проверка указания десятичного разделителя,
            'watch': false
        }, options);



        var Do = function(el) {

            var str = $(el).html().toString();

            var val = str.replace(/[^\d\.\,]/g, "");

            while (val[val.length - 1] === '.' || val[val.length - 1] === ',') {
                val = val.substring(0, val.length - 1);
            }

            var res = val.toString();
            var lZero = (val < 0); // Признак отрицательного числа

            // Определение длины форматируемой части
            var fLen = res.lastIndexOf('.'); // До десятичной точки
            fLen = (fLen > -1) ? fLen : res.length;

            // Выделение временного буфера
            settings.tmpRes = res.substring(fLen);
            var cnt = -1;
            for (var ind = fLen; ind > 0; ind--) {
                cnt++; // Формируем временный буфер

                if (((cnt % 3) === 0) && (ind !== fLen) && (!lZero || (ind > 1))) {
                    settings.tmpRes = settings.thSep + settings.tmpRes;
                }

                settings.tmpRes = res.charAt(ind - 1) + settings.tmpRes;
            }

            var r = str.replace(new RegExp(val, 'g'), settings.tmpRes.replace('.', settings.dcSep));

            $(el).html(r);

            if (settings.watch) {
                $(el).bind('DOMSubtreeModified', function() {

                    return (function(self) {
                        var opt;

                        if (opt === undefined) {
                            opt = settings;
                            opt.watch = false;
                            console.table([opt]);
                            $(self).numeric_format(opt);
                            console.log( self );
                        }
                    })(this);

                });
            }
        };


        for (var i = this.length - 1; i >= 0; i--) {
            Do(this[i]);
        }

    };
})(jQuery);
