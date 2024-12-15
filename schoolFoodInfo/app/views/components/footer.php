<div class="well card-footer">
    <span class="float-right">ForCap poslovne rešitve d.o.o. Vse pravice pridržane.</span>
</div>

<script src="<?= SCRIPT_URL ?>jquery.min.js"></script>
<script src="<?= SCRIPT_URL ?>bootstrap.min.js"></script>
<script src="<?= SCRIPT_URL ?>jquery.dataTables.min.js"></script>
<script src="<?= SCRIPT_URL ?>dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function () {
        $("#flash-msg").delay(7000).fadeOut("slow");
        $("#example").DataTable();
    });
</script>
