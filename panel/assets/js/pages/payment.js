function copyCommands(type = 0, list = false, table = false) {

    if (type == 0){

        var html = '<tr><td class="text-center"><input type="text" class="form-control" name="realname[]" placeholder="Hesap sahibinin adını soyadını giriniz."></td><td class="text-center"><input type="text" class="form-control" name="bankname[]" placeholder="Bankanızın adınızı giriniz."></td><td class="text-center"><input type="text" class="form-control" name="iban[]" placeholder="IBAN giriniz."></td><td><a onclick="copyCommands(\'2\', this, \'#bankAccTable\')" class="btn btn-sm btn-rounded-circle btn-danger"><i class="bx bx-trash-alt"></i></a></td></tr>';
        $(list + ' tr:last').after(html);

    }else if (type == 1){

        var html = '<tr><td class="text-center w-100"><input type="text" class="form-control" name="paymentData[]" placeholder="İninal barkod numaranızı giriniz."></td><td><a onclick="copyCommands(\'2\', this, \'#ininalTable\')" class="btn btn-sm btn-rounded-circle btn-danger"><i class="bx bx-trash-alt"></i></a></td></tr>';
        $(list + ' tr:last').after(html);

    }else if (type == 2){

        if($(table).find("tbody tr").length > 1){
            $(list).closest('tr').remove();
        }else{
            $(list).closest('tr').find("input").val("");
        }

    }else if (type == 3){

        var html = '<tr><td class="text-center w-100"><input type="text" class="form-control" name="paymentData[]" placeholder="Papara numaranızı giriniz."></td><td><a onclick="copyCommands(\'2\', this, \'#paparaTable\')" class="btn btn-sm btn-rounded-circle btn-danger"><i class="bx bx-trash-alt"></i></a></td></tr>';
        $(list + ' tr:last').after(html);

    }

}