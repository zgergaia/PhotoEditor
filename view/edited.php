<script>
    $(document).ready(function() {
        $('#dButton').click(function () {
            $('#download').val('<?php echo $img_src; ?>');
            $('#editedForm').submit();
        });
    });
</script>
<form method="post" action="/" id="editedForm">
    <div class="w-75">
        <img id="current_image" src="<?php echo $img_src; ?>">
        <input type="hidden" name="image" value="<?php echo $img_src; ?>">
        <input type="hidden" name="download" id="download" value="">
    </div>
    <button type="submit" class="btn btn-success mt-2">Edit same file again</button>
    <a class="btn btn-info mt-2" href="/" role="button">Upload a new image</a>
    <button type="button" id="dButton" class="btn mt-2"><i class="fa fa-download"></i>Download</button>
</form>