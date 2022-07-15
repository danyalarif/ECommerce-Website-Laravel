$('input').click(function(e) {
    var txt = $(this).attr('placeholder')
    if (txt == undefined)
        return
    if (txt.length == 0)
        return
    $(this).attr('placeholder', '')
    var parent = $(this).parent()
    parent.attr('data-after', txt)
});

$('input').focus(function(e) {
    var txt = $(this).attr('placeholder')
    if (txt == undefined)
        return
    if (txt.length == 0)
        return
    $(this).attr('placeholder', '')
    var parent = $(this).parent()
    parent.attr('data-after', txt)
});