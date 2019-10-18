<!-- ============================================================== -->
<!-- Right sidebar -->
<!-- ============================================================== -->
<!-- .right-sidebar  -->
<!-- ============================================================== -->
<!-- End Right sidebar -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer">
    Powered by © <a href="https://www.gm-thai.com/" target="_blank">APS</a>  2017 - 2018, V.2.0-UX All right reserved.
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>

<?php
echo $this->assets->js('jquery.slimscroll.js');
echo $this->assets->js('waves.js');
echo $this->assets->js('sidebarmenu.js');

echo $this->assets->plugins_js('sticky-kit-master/dist/sticky-kit.min.js');
echo $this->assets->plugins_js('sparkline/jquery.sparkline.min.js');

echo $this->assets->js('custom.min.js');

echo $this->assets->plugins_js('styleswitcher/jQuery.style.switcher.js');

echo $this->assets->plugins_js('datatables/jquery.dataTables.min.js');

echo $this->assets->js('fancybox/dist/jquery.fancybox.js');
echo $this->assets->plugins_js('parsley.min.js');

if (isset($plugins_js)) {
    foreach ($plugins_js as $link_plugins_js) {
        echo $this->assets->plugins_js($link_plugins_js);
    }
}
if (isset($js)) {
    foreach ($js as $link_js) {
        echo $this->assets->js($link_js);
    }
}
?>
<script>
    $('.mydatepicker').datepicker({
        toggleActive: true, 
        format: 'yyyy-mm-dd'
    }).on('changeDate', function(e){
        $(this).datepicker('hide');
    });

    function clickIE() {
        if (document.all) {
            return false;
        }
    }
    function clickNS(e) {
        if (document.layers || (document.getElementById && !document.all)) {
            if (e.which === 2 || e.which === 3) {
                return false;
            }
        }
    }
    if (document.layers) {
        document.captureEvents(Event.MOUSEDOWN);
        document.onmousedown = clickNS;
    } else {
        document.onmouseup = clickNS;
        document.oncontextmenu = clickIE;
    }
    document.oncontextmenu = new Function("return false");
</script>

<script>
    var service_base_url = $('#service_base_url').val();
    $(document).ready(function () {
        $('.fancybox').fancybox({
            padding: 0,
            helpers: {
                title: {
                    type: 'outside'
                }
            }
        });
    });

    $(document).ready(function () {
        $('.table-datatable').DataTable();
    });

    $('input:text').blur(function () {
        var n = $(this).val().search("<");
        if (n > -1) {
            $(this).val('')
        }
    })
    $('textarea').blur(function () {
        var n = $(this).val().search("<");
        if (n > -1) {
            $(this).val('')
        }
    })

</script>

</body>

</html>
