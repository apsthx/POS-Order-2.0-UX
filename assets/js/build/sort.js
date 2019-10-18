var service_base_url = $('#service_base_url').val();

$(function () {
    $("#sortable-groupmenu-list").sortable({
        update: function () {
            var data = $("#sortable-groupmenu-list").sortable("serialize");
            var url = service_base_url + 'admin/groupmenu/sortgroupmenumap';
            $.post(url, data, function () {
 
            });
        }
    });
});

$(function () {
    $("#sortable-menu-list").sortable({
        update: function () {
            var data = $("#sortable-menu-list").sortable("serialize");
            var url = service_base_url + 'admin/groupmenu/sortmenumap';
            $.post(url, data, function () {
 
            });
        }
    });
});