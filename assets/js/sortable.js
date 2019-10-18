/* ========================================================================
 * sortable.js
 * Page/renders: components-sortable.html
 * Plugins used: jQuery UI
 * ======================================================================== */

'use strict';

(function (factory) {
    if (typeof define === 'function' && define.amd) {
        define([
            'jquery-ui'
        ], factory);
    } else {
        factory();
    }
}(function () {

    $(function () {
        // Sortable list
        // ================================
        $('#sortable-list').sortable();
        $('#sortable-list').disableSelection();

        // Sortable grid
        // ================================
        $('#sortable-panel').sortable({
            connectWith: '.panel',
            items: '.panel', 
            opacity: 0.8,
            coneHelperSize: true,
            placeholder: 'ui-sortable-placeholder',
            forcePlaceholderSize: true,
            tolerance: 'pointer',
            helper: 'clone',
            cancel: '.panel-sortable-empty',
            revert: 250,
            update: function(b, c) {
                if (c.item.prev().hasClass('panel-sortable-empty')) {
                    c.item.prev().before(c.item);
                }                    
            }
        });
    });
}));