$(document).ready(function() {
    var degrees = 0;
    // CIN 1
    $('.imgCinFace1').click(function rotateMe(e) {
        degrees += 90;
        //$('.imgCinFace1').addClass('rotated'); // for one time rotation
        $('.imgCinFace1').css({
            'transform': 'rotate(' + degrees + 'deg)',
            '-ms-transform': 'rotate(' + degrees + 'deg)',
            '-moz-transform': 'rotate(' + degrees + 'deg)',
            '-webkit-transform': 'rotate(' + degrees + 'deg)',
            '-o-transform': 'rotate(' + degrees + 'deg)'
        });
    })

    // CIN 2
    $('.imgCinFace2').click(function rotateMe(e) {
        degrees += 90;
        $('.imgCinFace2').css({
            'transform': 'rotate(' + degrees + 'deg)',
            '-ms-transform': 'rotate(' + degrees + 'deg)',
            '-moz-transform': 'rotate(' + degrees + 'deg)',
            '-webkit-transform': 'rotate(' + degrees + 'deg)',
            '-o-transform': 'rotate(' + degrees + 'deg)'
        });
    })

    // CIN 2
    $('.imgFiche').click(function rotateMe(e) {
        degrees += 90;
        $('.imgFiche').css({
            'transform': 'rotate(' + degrees + 'deg)',
            '-ms-transform': 'rotate(' + degrees + 'deg)',
            '-moz-transform': 'rotate(' + degrees + 'deg)',
            '-webkit-transform': 'rotate(' + degrees + 'deg)',
            '-o-transform': 'rotate(' + degrees + 'deg)'
        });
    })

    // CIN 2
    $('.imgPhoto').click(function rotateMe(e) {
        degrees += 90;
        $('.imgPhoto').css({
            'transform': 'rotate(' + degrees + 'deg)',
            '-ms-transform': 'rotate(' + degrees + 'deg)',
            '-moz-transform': 'rotate(' + degrees + 'deg)',
            '-webkit-transform': 'rotate(' + degrees + 'deg)',
            '-o-transform': 'rotate(' + degrees + 'deg)'
        });
    })
});