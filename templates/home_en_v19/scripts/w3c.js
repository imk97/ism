$(document).ready( function() {
    $('inc').click( function() {
        var currentSize;
        var style;
        currentSize = document.querySelector('.u-body')
        style = getComputedStyle(currentSize)
        console.log(style)
        parseInt($())
        if (currentSize <= 20) {
            $('body').css('font-size', currentSize)
        }
    })

    $('dec').click( function() {

        if (currentSize >= 8) {
            $('').css('font-size', currentSize)
        }
    })

    $('default').click(function () {
        $('').css('font-size', '14px;')
    })

    // Thunderbird
    $().click( function () {
        $().css('color', '#bd3b1b')
    })

    // Cherokee
    $().click( function () {
        $().css('color', '#fcdca4')
    })

    // Caper
    $().click( function () {
        $().css('color', '#d3e6a5')
    })

    // Alto
    $().click( function () {
        $().css('color', '#d3d0d0')
    })

    // White
    $().click( function () {
        $().css('color', '#ffffff')
    })
}
    

    

    

    

    

    

    

    
)