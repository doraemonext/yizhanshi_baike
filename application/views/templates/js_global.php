<script type="text/javascript" src="<?=base_url('js/plugins/jquery-form/jquery.form.js')?>"></script>
<script>
jQuery(document).ready(function() {
    $(".dropdown-menu li a").click(function(){
        $("#dropdown-category").text($(this).text());
        $("#category").attr("value", $(this).data("category"));
    });
});
</script>