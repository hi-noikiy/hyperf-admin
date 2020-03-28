(function ($) {

    var Grid = function () {
        this.selects = {};
    };

    Grid.prototype.select = function (id) {
        this.selects[id] = id;
    };

    Grid.prototype.unselect = function (id) {
        delete this.selects[id];
    };

    Grid.prototype.selected = function () {
        var rows = [];
        $.each(this.selects, function (key, val) {
            rows.push(key);
        });

        return rows;
    };

    $.fn.admin = LA;
    $.admin = LA;
    $.admin.swal = swal;
    $.admin.toastr = toastr;
    $.admin.grid = new Grid();

    $.admin.reload = function () {
        $.pjax.reload('#pjax-container');
        $.admin.grid = new Grid();
    };

    $.admin.redirect = function (url) {
        $.pjax({container:'#pjax-container', url: url });
        $.admin.grid = new Grid();
    };

    $.admin.getToken = function () {
        return $('meta[name="csrf-token"]').attr('content');
    };

    $.admin.loadedScripts = [];

    $.admin.loadScripts = function(arr) {
        var _arr = $.map(arr, function(src) {

            if ($.inArray(src, $.admin.loadedScripts)) {
                return;
            }

            $.admin.loadedScripts.push(src);

            return $.getScript(src);
        });

        _arr.push($.Deferred(function(deferred){
            $(deferred.resolve);
        }));

        return $.when.apply($, _arr);
    }

})(jQuery);