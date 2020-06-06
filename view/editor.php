<?php
$img_att = "public/{$img_src}";
?>
<script>
    $(document).ready(function () {
        $("#crop_request").click(function () {
            $("#crop_request").fadeOut("fast");
            $("#crop").fadeIn(1250);

            if($('#brightness').is(":visible")){
                $('#brightness_request').toggle();
                $('#brightness').toggle();
                $('#sliderContainer').toggle();
            }
            if($('#contrast').is(":visible")){
                $('#contrast_request').toggle();
                $('#contrast').toggle();
                $('#sliderContainer').toggle();
            }

            $('html, body').animate({
                scrollTop: $("#current_image").offset().top
            }, 2000);

            $('#mode_input').val('crop');
        });
        $("#brightness_request").click(function () {
            $("#brightness_request").fadeOut("fast");
            $("#brightness").fadeIn(1250);

            if($('#crop').is(":visible")){
                $('#crop_request').toggle();
                $('#crop').toggle();
                $('#sliderContainer').toggle();
            }
            if($('#contrast').is(":visible")) {
                $('#contrast_request').toggle();
                $('#contrast').toggle();
                $('#sliderContainer').toggle();
            }
            $("#sliderContainer").fadeIn(1250);

            $('html, body').animate({
                scrollTop: $("#sliderContainer").offset().top
            }, 2000);

            $('#mode_input').val('brightness');
            document.getElementById('slider').name = "brightness";
            document.getElementById('slider').min = -255;
            document.getElementById('slider').max = 255;
        });
        $("#contrast_request").click(function () {
            $("#contrast_request").fadeOut("fast");
            $("#contrast").fadeIn(1250);

            if($('#crop').is(":visible")){
                $('#crop_request').toggle();
                $('#crop').toggle();
                $('#sliderContainer').toggle();
            }
            if($('#brightness').is(":visible")){
                $('#brightness_request').toggle();
                $('#brightness').toggle();
                $('#sliderContainer').toggle();
            }
            $("#sliderContainer").fadeIn(1250);

            $('html, body').animate({
                scrollTop: $("#sliderContainer").offset().top
            }, 2000);

            $('#mode_input').val('contrast');
            document.getElementById('slider').name = "contrast";
            document.getElementById('slider').min = -100;
            document.getElementById('slider').max = 100;
        });
    });
</script>
<form method="post" action="/Editor" class="m-2" id="editor_form">
    <div class="w-75">
        <img id="current_image" src="<?php echo $img_att; ?>">
    </div>

    <button type="button" id="crop_request" class="btn btn-primary mt-2" onclick="get_cropper()">Crop</button>
    <button style="display: none" id="crop" class="btn btn-success mt-2">Crop</button>

    <button type="button" id="brightness_request" class="btn btn-warning mt-2">Brightness</button>
    <button style="display: none" id="brightness" class="btn btn-success mt-2">Brightness</button>

    <button type="button" id="contrast_request" class="btn btn-danger mt-2">Contrast</button>
    <button style="display: none" id="contrast" class="btn btn-success mt-2">Contrast</button>

    <a class="btn btn-info mt-2" href="/" role="button">Upload a new image</a>

    <div style="display: none" id="sliderContainer" class="mt-1">
        <input type="range" id="slider" class="w-25" onchange="update('current_image')" value="0">
        <label for="slider"><span id="slider_value"></label>
    </div>

    <?php if(isset($errors)) foreach ($errors as $err): ?>
        <div class="alert alert-danger mt-2" role="alert">
            <?php echo $err ?>
        </div>
    <?php endforeach; ?>

    <input type="hidden" id="X" name="X" value="">
    <input type="hidden" id="Y" name="Y" value="">
    <input type="hidden" id="Width" name="Width" value="">
    <input type="hidden" id="Height" name="Height" value="">
    <input type="hidden" id="Rotate" name="Rotate" value="">
    <input type="hidden" id="scaleX" name="scaleX" value="">
    <input type="hidden" id="scaleY" name="scaleY" value="">
    <input type="hidden" id="mode_input" name="mode" value="">
    <input type="hidden" name="img_src" value="<?php echo $img_src; ?>">
</form>