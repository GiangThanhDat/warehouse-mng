/// <reference path="../../assets/admin/libs/angular/angular.js" />
(function () {
    //wmws : warehouse management website system
    angular.module('wmws_app', ["ngCookies"]).directive('format', ['$filter', function ($filter) {
        return {
            require: '?ngModel',
            link: function (scope, elem, attrs, ctrl) {
                console.log((scope, elem, attrs, ctrl));
                if (!ctrl) return;
    
                ctrl.$formatters.unshift(function (a) {
                    return $filter(attrs.format)(ctrl.$modelValue)
                });
    
                elem.bind('keyup', function(event) {
                    var plainNumber = elem.val().replace(/[^\d|\-+|\.+]/g, '');
                    elem.val($filter(attrs.format)(plainNumber));
                });
            }
        };
    }]);
})();