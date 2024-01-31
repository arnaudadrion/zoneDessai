jQuery(function($) {

    $("body").on('click', '.getmodal', function(e){
        e.preventDefault();
        var action = $(this).attr("href");
        var jsonData = new Object();
        jsonData.type = $(this).attr("modal-type");
        jsonData.title = $(this).attr("modal-title");
        jsonData.text = $(this).attr("modal-text");
        jsonData.action = action;
        var data = JSON.stringify(jsonData)

        //var formSerialize = $(this).serialize();
        $.post(action, jsonData, function(response){
        },'JSON');
    });

    $("#modal-container").on('click', '.confirmmodal', function(e){
        e.preventDefault();
        var action = $(this).attr("href");
        var jsonData = new Object();
        jsonData.type = 'validate';
        jsonData.action = action;
        var data = JSON.stringify(jsonData)

        $.post(action, jsonData, function(response){
            $('.modal').modal('close');
            $("#modal-container").empty();
            if (typeof window.returnModalEvent=== "function") {
                window.returnModalEvent(response);
            }
        },'JSON');
    });

    window.showModal = function(html) {
        var mo = $(html);
        $('#modal-container').html(mo);
        mo.modal();
        mo.modal('open');
    }


    $( document ).ajaxComplete(function(event, xhr, settings)
    {
        if(xhr.status == 200 && typeof xhr.responseJSON != 'undefined' && typeof xhr.responseJSON.notice != 'undefined')
        {
            showSnackbar(xhr.responseJSON.notice.type, xhr.responseJSON.notice.text);
        }else if(xhr.status == 200 && typeof xhr.responseJSON != 'undefined' && typeof xhr.responseJSON.modal != 'undefined'){
            showModal(xhr.responseJSON.modal.html);
        }
    });

    $('.modal').modal();
    $('ul.tabs').tabs();


    $('select').not($('.widget_children select')).material_select();
    $('input.datepicker').not($('.widget_children input.datepicker')).pickadate({
        format : 'yyyy-mm-dd',
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });
});
