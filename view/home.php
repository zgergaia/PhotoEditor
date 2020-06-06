<?php

$submit = "onchange=\"this.form.submit()\"";

?>
<form method="post" enctype="multipart/form-data">
    <div class="row m-2">
        <div class="input-group">
            <div class="input-group-prepend">
                <a class="btn btn-outline-info" data-toggle="collapse" href="#Tiptxt" role="button" aria-expanded="false" aria-controls="collapseExample">Tip</a>
            </div>
            <div class="custom-file col-4">
                <input type="file" class="custom-file-input" id="inputGroupFile01" name="image" <?php if(strlen($submit) > 0) echo $submit;?>>
                <label class="custom-file-label w-75" id="browseLabel" for="inputGroupFile01">Choose a File</label>
            </div>
        </div>
        <div class="collapse row ml-1" id="Tiptxt">
            <small class="form-text text-muted">You can only upload jpg, jpeg or png photos</small>
        </div>
        <?php foreach ($errors as $err): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $err ?>
            </div>
        <?php endforeach; ?>
    </div>
</form>