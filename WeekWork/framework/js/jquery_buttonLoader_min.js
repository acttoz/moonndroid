/*A jQuery plugin which add loading indicators into buttons
* By Minoli Perera
* MIT Licensed.
*/
!function(t){t.fn.buttonLoader=function(a){var s=t(this);"start"==a&&("disabled"==t(s).attr("disabled")&&e.preventDefault(),t(".has-spinner").attr("disabled","disabled"),t(s).attr("data-btn-text",t(s).text()),t(s).html('<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>저장중..'),t(s).addClass("active")),"stop"==a&&(t(s).html(t(s).attr("data-btn-text")),t(s).removeClass("active"),t(".has-spinner").removeAttr("disabled"))}}(jQuery);
