let selectedDir = '';

$(document).ready(() => {
    checkConf();

    /* on click on get folder list */
    $('#getScanDir').click( () => {
        $.ajax({
            url:"php/scanDir.php"
        }).done(dirList => {
            $("#serverDirList").empty().append(dirList);
        });
    });

    /* on read Dir click, retrieve images */
    $('#readDir').click( () => {
        $("#step1").toggle();
        $("#step2").toggle();
        $.ajax({
            url:"php/scanDir.php"
        }).done(dirList => {
            $("#serverDirList").empty().append(dirList);
        });
    });

    $('#bckToStep1').click( () => {
        $("#step2").toggle();
        $("#step1").toggle();
    });

});

// toggle sublist on server dir list
$(document).on('click','#serverDirList ul li',function(e){
    e.preventDefault();
    e.stopPropagation();
    $('#serverDirList a').removeClass('selected light-green lighten-3');
    $(this).children("a").addClass('selected light-green lighten-3');
    $(this).children("ul").slideToggle();

    selectedDir = $(this).children('a').attr('id');
    console.log(selectedDir);
});


/* Checks basic configuration */
var checkConf = () => {
    $.ajax({
        url:"php/checkConf.php"
    }).done(result => {
        result = $.parseJSON(result);
        if(result.scanDir.error){
            $('#checkingConf').removeClass("yellow").addClass("red");
            $('#checkingConf').append(`<p class="white">Following errors were found:<br> ${result.scanDir.errMessage}</p>`);
            console.log(result.scanDir.errMessage);
        }else{
            $('#checkingConf').removeClass("yellow").addClass("light-green").delay(4000).fadeToggle("fast");
        }
    });
};