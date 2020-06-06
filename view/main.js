function get_cropper() {
    const image = document.getElementById('current_image');
    const cropper = new Cropper(image, {
        aspectRatio: 16 / 9,
        crop(event) {
            document.getElementById("X").value = event.detail.x;
            document.getElementById("Y").value = event.detail.y;
            document.getElementById("Width").value = event.detail.width;
            document.getElementById("Height").value = event.detail.height;
            document.getElementById("Rotate").value = event.detail.rotate;
            document.getElementById("scaleX").value = event.detail.scaleX;
            document.getElementById("scaleY").value = event.detail.scaleY;
        },
    });
}

let slider = document.getElementById("slider");
let output = document.getElementById("slider_value");
output.innerHTML = slider.value;

slider.oninput = function() {
    output.innerHTML = this.value;
};

function update(elementID) {
    $.ajax({
        url: '/view/updater.php',
        type: 'POST',
        data: $('form').serialize(),
        success: function (data) {
            document.getElementById(elementID).src = data;
        }
    });
}