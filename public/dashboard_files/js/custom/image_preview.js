// image preview
$(".image").change(function () {

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.image-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }

});




	

$(".image-0").change(function () {

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.image-preview-0').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }

});


$(".image-1").change(function () {

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.image-preview-1').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }

});
