$(function() {
    if($('select[name="slider"]').val() == '1') {
        $('#sliderTypeDiv').fadeIn(600);
    } else {
        $('#sliderTypeDiv').hide();
    }
    $('select[name="slider"]').change(function(){
        if($('select[name="slider"]').val() == '1') {
            $('#sliderTypeDiv').fadeIn(600);
        } else {
            $('#sliderTypeDiv').hide();
        }
    });

});

$(function() {
    if($('select[name="headerBgStatus"]').val() == '1') {
        $('#imageInput2').fadeIn(600);
    } else {
        $('#imageInput2').hide();
    }
    $('select[name="headerBgStatus"]').change(function(){
        if($('select[name="headerBgStatus"]').val() == '1') {
            $('#imageInput2').fadeIn(600);
        } else {
            $('#imageInput2').hide();
        }
    });

});

$(function() {
    if($('select[name="loginBgStatus"]').val() == '1') {
        $('#imageInput3').fadeIn(600);
        $('#imageInput4').hide();
    } else {
        $('#imageInput4').fadeIn(600);
        $('#imageInput3').hide();
    }
    $('select[name="loginBgStatus"]').change(function(){
        if($('select[name="loginBgStatus"]').val() == '1') {
            $('#imageInput3').fadeIn(600);
            $('#imageInput4').hide();
        } else {
            $('#imageInput4').fadeIn(600);
            $('#imageInput3').hide();
        }
    });

});

$(function() {
    if($('select[name="sidebar"]').val() == '1') {
        $('#sidebarDiv').fadeIn(600);
    } else {
        $('#sidebarDiv').hide();
    }
    $('select[name="sidebar"]').change(function(){
        if($('select[name="sidebar"]').val() == '1') {
            $('#sidebarDiv').fadeIn(600);
        } else {
            $('#sidebarDiv').hide();
        }
    });
});

$(function() {
    if($('select[name="discord"]').val() == '1') {
        $('#discordDiv').fadeIn(600);
    } else {
        $('#discordDiv').hide();
    }
    $('select[name="discord"]').change(function(){
        if($('select[name="discord"]').val() == '1') {
            $('#discordDiv').fadeIn(600);
        } else {
            $('#discordDiv').hide();
        }
    });
});

$(function() {
    if($('select[name="slice"]').val() == '1') {
        $('#sliceDiv').fadeIn(600);
    } else {
        $('#sliceDiv').hide();
    }
    $('select[name="slice"]').change(function(){
        if($('select[name="slice"]').val() == '1') {
            $('#sliceDiv').fadeIn(600);
        } else {
            $('#sliceDiv').hide();
        }
    });
});

function addMenu(formID)
{

    var form = $(formID).serialize();

    $.ajax({
        url: 'classes/ajax/Menu.php?type=add',
        data: form,
        type: 'POST',
        dataType: 'JSON',
        success: function(response){
            if (response == "1") {

                alert("Lütfen giriş yapınız.");
            
            }else if (response == "2"){

                alert("Lütfen boş alan bırakmayınız.");
            
            }else if (response == "3"){

                alert("Hata! Yetkiliyle iletişime geçiniz.")

            }else {

                if (response['rType']=="add"){

                    var html = '<li class="dd-item" data-id="'+response['id']+'"><div class="dd-handle"><div class="dd-handle-left"><i class="mdi '+response['icon']+'"></i>'+response['heading']+'</div><div class="dd-handle-right"><a onclick="editMenu('+response['id']+')" class="btn btn-sm btn-success text-white" href="javascript:;" data-toggle="tooltip" data-placement="top" data-id="'+response['id']+'" title="" data-original-title="Düzenle"><i class="bx bxs-edit-alt"></i></a> <a onclick="deleteMenu('+response['id']+')" class="btn btn-sm btn-danger" data-id="'+response['id']+'" href="javascript:;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"><i class="bx bx-trash-alt"></i></a></div></div></li>';

                    $('#nestable-list').append(html);

                    $("#id").val('');
                    $("#type").val('0');
                    $("#heading").val('');
                    $("#icon").val('');
                    $("#link").val('');
                    $("#tab").val('0');
                    $("#addButton").html('Ekle');

                }else if (response['rType']=="update"){

                    var html = '<i class="mdi '+response['icon']+'"></i>'+response['heading'];
                    $('.dd-item[data-id='+response['id']+'] > .dd-handle .dd-handle-left').html(html);

                    $("#id").val('');
                    $("#type").val('0');
                    $("#heading").val('');
                    $("#icon").val('');
                    $("#link").val('');
                    $("#tab").val('0');
                    $("#addButton").html('Ekle');

                }else{

                    alert('Hata! Yetkiliyle iletişime geçiniz.');

                }

            }
        }
    });

}


 $(document).ready(function()
{

    var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

    $('#nestable').nestable({
        group: 1,
        maxDepth: 2
    })
    .on('change', updateOutput);

    updateOutput($('#nestable').data('output', $('#nestable-output')));

    $('.dd').on('change', function() {
     
        var dataString = { 
            data : $("#nestable-output").val(),
        };

        $.ajax({
            type: "POST",
            url: "classes/ajax/Menu.php?type=update",
            data: dataString,
            cache : false,
            success: function(data){
                //console.log(data);
            },
            error: function(xhr, status, error) {
                alert(error);
            }
        });

    });

});

function editMenu(id)
{

    $.ajax({
        url: 'classes/ajax/Menu.php?type=read',
        data: {id : id},
        type: 'POST',
        dataType: 'JSON',
        success: function(response){
            $("#id").val(response['id']);
            $("#type").val(response['type']);
            $("#heading").val(response['heading']);
            $("#icon").val(response['icon']);
            $("#link").val(response['link']);
            $("#tab").val(response['tab']);
            $("#addButton").html('Düzenle');
        },
        error: function(xhr, status, error) {
            alert(error);
        }
    });

}

function deleteMenu(id)
{

    var x = confirm('Silmek istediğinize emin misiniz?');

    if (x) {

        $.ajax({
            url: 'classes/ajax/Menu.php?type=delete',
            data: {id : id},
            type: 'POST',
            success: function(e){
                $('li[data-id=' + id + ']').fadeOut(600);
            },
            error: function(xhr, status, error) {
                alert(error);
            }
        });

    }

}