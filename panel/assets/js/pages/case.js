$(function() {
    if($('select[name="casePriceStatus"]').val() == '0') {
        $('#caseDuration').fadeIn(600);
        $('#casePrice').hide();
    } else {
        $('#casePrice').fadeIn(600);
        $('#caseDuration').hide();
    }
    $('select[name="casePriceStatus"]').change(function(){
        if($('select[name="casePriceStatus"]').val() == '0') {
            $('#caseDuration').fadeIn(600);
            $('#casePrice').hide();
        } else {
            $('#casePrice').fadeIn(600);
            $('#caseDuration').hide();
        }
    });

});
/*
$(function() {

    if($('select[name="type[]"]').val() == '0') {
        $('select[name="type[]"]').parents('tr').find(".awardCredit").css('display', 'block').find("input").removeAttr('disabled');
        $('select[name="type[]"]').parents('tr').find(".awardProduct").css('display', 'none').find("select").attr('disabled', 'disabled');
        $('select[name="type[]"]').parents('tr').find(".awardPas").css('display', 'none').find("select").attr('disabled', 'disabled');
    } else if($('select[name="type[]"]').val() == '1') {
        $('select[name="type[]"]').parents('tr').find(".awardCredit").css('display', 'none').find("input").attr('disabled', 'disabled');
        $('select[name="type[]"]').parents('tr').find(".awardProduct").css('display', 'block').find("select").removeAttr('disabled');
        $('select[name="type[]"]').parents('tr').find(".awardPas").css('display', 'none').find("select").attr('disabled', 'disabled');
    } else if($('select[name="type[]"]').val() == '2') {
        $('select[name="type[]"]').parents('tr').find(".awardCredit").css('display', 'none').find("input").attr('disabled', 'disabled');
        $('select[name="type[]"]').parents('tr').find(".awardProduct").css('display', 'none').find("select").attr('disabled', 'disabled');
        $('select[name="type[]"]').parents('tr').find(".awardPas").css('display', 'block').find("select").attr('disabled');
    }

});
*/
function copyCommands(type = 1, list = false, table = false) {

    if (type == 1){

        var html = '<tr><td class="text-center"><select name="type[]" onchange="getProducts(this)" class="form-control custom-select"><option value="0">Kredi</option><option value="1">Ürün</option><option value="2">Pas</option></select></td><td class="text-center"><div class="awardCredit"><input type="number" class="form-control" name="award[]" placeholder="Kredi miktarını giriniz."></div><div class="awardProduct" style="display: none;"><select name="award[]" class="form-control custom-select" disabled></select></div><div class="awardPas" style="display: none;"><select name="award[]" class="form-control border-0 custom-select" disabled=""><option>Ödül Yok</option></select></div></td><td class="text-center"><input type="text" class="form-control" name="chance[]" placeholder="Yüzdelik olarak giriniz."></td><td class="text-center"><input type="text" data-toggle="color-picker" class="form-control" placeholder="#000000" name="color[]"></td><td><a onclick="copyCommands(\'2\', this, \'#caseTable\')" class="btn btn-sm btn-rounded-circle btn-danger w-100"><i class="bx bx-trash-alt"></i></a></td></tr>'

        $(list + ' tr:last').after(html);

        $('[data-toggle="color-picker"]').colorpicker({format:"hex"});

    }else if (type == 2){

        if($(table).find("tbody tr").length > 1){
            $(list).closest('tr').remove();
        }else{
            $(list).closest('tr').find("input").val("");
        }

    }

}

function getProducts(select)
{

    if($(select).val() == '0') {
        $(select).parents('tr').find(".awardCredit").css('display', 'block').find("input").removeAttr('disabled');
        $(select).parents('tr').find(".awardProduct").css('display', 'none').find("select").attr('disabled', 'disabled');
        $(select).parents('tr').find(".awardPas").css('display', 'none').find("select").attr('disabled', 'disabled');
    } else if($(select).val() == '1') {
        $(select).parents('tr').find(".awardCredit").css('display', 'none').find("input").attr('disabled', 'disabled');
        $(select).parents('tr').find(".awardPas").css('display', 'none').find("select").attr('disabled', 'disabled');
        $(select).parents('tr').find(".awardProduct").css('display', 'block').find("select").removeAttr('disabled');

        var $selectProducts = $(select).parents('tr').find(".awardProduct").find("select");
        var id = $("select[name='servers']").val();

        $.ajax({
            url: 'classes/ajax/Case.Products.php',
            data: { id : id },
            type: 'POST',
            success: function(data){
                
                $selectProducts.html(data);

            }
        });
    } else if($(select).val() == '2') {
        $(select).parents('tr').find(".awardCredit").css('display', 'none').find("input").attr('disabled', 'disabled');
        $(select).parents('tr').find(".awardProduct").css('display', 'none').find("select").attr('disabled', 'disabled');
        $(select).parents('tr').find(".awardPas").css('display', 'block').find("select").removeAttr('disabled');
    }
    
}