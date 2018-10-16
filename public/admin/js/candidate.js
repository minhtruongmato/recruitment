// Product management
window.onload = function(){
    var url = window.location.origin + '/recruitment/';
    var url_admin = window.location.origin + '/recruitment/admin/';
    // is_discount unchecked by default
    // so we need to disable 2 discount fields too
    // but enable in edit mode, and discount checkbox checked before
    if($('#is_discount').is(':checked')){
        $("#discount_percent").prop('disabled', false);
        $("#discount_price").prop('disabled', false);
    }else{
        $("#discount_percent").prop('disabled', true);
        $("#discount_price").prop('disabled', true);
    }

    // if($('#is_gift').is(':checked')){
    //     $("#gift").prop('disabled', false);
    // }else{
    //     $("#gift").prop('disabled', true);
    // }

    // enable 2 discount fields when is_discount checked, disable again when is_discount uncheck
    $('#is_discount').change(function(){
        if($(this).is(':checked')){
            $("#discount_percent").prop('disabled', false);

            $("#discount_price").prop('disabled', false);
        }else{
            $("#discount_percent").val('');
            $("#discount_percent").prop('disabled', true);

            $("#discount_price").val('');
            $("#discount_price").prop('disabled', true);
        }
    });

}


$('.price_shared').on('input', function(e){        
    $(this).val(formatCurrency(this.value.replace(/[,VNĐ]/g,'')));
}).on('keypress',function(e){
    if(!$.isNumeric(String.fromCharCode(e.which))) e.preventDefault();
}).on('paste', function(e){    
    var cb = e.originalEvent.clipboardData || window.clipboardData;      
    if(!$.isNumeric(cb.getData('text'))) e.preventDefault();
});
function formatCurrency(number){
    var n = number.split('').reverse().join("");
    var n2 = n.replace(/\d\d\d(?!$)/g, "$&,");    
    return  n2.split('').reverse().join('');
}

$('.price_shared').each(function(e){        
    $(this).val(formatCurrency(this.value.replace(/[,VNĐ]/g,'')));
}).on('keypress',function(e){
    if(!$.isNumeric(String.fromCharCode(e.which))) e.preventDefault();
}).on('paste', function(e){    
    var cb = e.originalEvent.clipboardData || window.clipboardData;      
    if(!$.isNumeric(cb.getData('text'))) e.preventDefault();
});
function formatCurrency(number){
    var n = number.split('').reverse().join("");
    var n2 = n.replace(/\d\d\d(?!$)/g, "$&,");    
    return  n2.split('').reverse().join('');
}

$(function(){
    $('.location').select2({
        maximumSelectionLength: 3,
        language: {
            maximumSelected: function (e) {
                var t = "Bạn đã chọn tối đa " + e.maximum + " nơi làm việc";
                e.maximum != 1;
                return t;
            }
        }
    });
    $('.career').select2({
        maximumSelectionLength: 3,
        language: {
            maximumSelected: function (e) {
                var t = "Bạn đã chọn tối đa " + e.maximum + " công việc";
                e.maximum != 1;
                return t;
            }
        }
    });
    $('.field').select2({
        maximumSelectionLength: 3,
        language: {
            maximumSelected: function (e) {
                var t = "Bạn đã chọn tối đa " + e.maximum + " lĩnh vực";
                e.maximum != 1;
                return t;
            }
        }
    });
    $('.position').select2({
        maximumSelectionLength: 3,
        language: {
            maximumSelected: function (e) {
                var t = "Bạn đã chọn tối đa " + e.maximum + " lĩnh vực";
                e.maximum != 1;
                return t;
            }
        }
    });

    $('.language').select2({
        maximumSelectionLength: 3,
        language: {
            maximumSelected: function (e) {
                var t = "Bạn đã chọn tối đa " + e.maximum + " ngoại ngữ";
                e.maximum != 1;
                return t;
            }
        }
    });

    $('.datepicker').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
    })

    $('.specialize-date').datepicker({
        autoclose: true,
        format: " yyyy",  //see there is extra space in format, dont remove it
        viewMode: "years", 
        minViewMode: "years"
    });

    $('.btn-specialize').click(function(){
        var htmlSpecialize = `
                                <div class="col-md-12 multiple-form">
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="school">Trường</label><br>
                                        <input type="text" name="specialize[school][]" class="form-control" placeholder="EX: Đại học Quốc gia Hà Nội">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="col-form-label" for="school">Chuyên ngành</label><br>
                                        <input type="text" name="specialize[name][]" class="form-control" placeholder="EX: Đại học Quốc gia Hà Nội">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="col-form-label" for="school">Trình độ/Bằng cấp</label><br>
                                        <select name="specialize[degree][]" class="form-control">
                                            <option value="">Chọn trình độ học vấn</option>
                                            @if (!empty($education))
                                                @foreach ($education as $key => $value)
                                                    <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                @endforeach
                                            @endif
                                            
                                        </select>
                                    </div>
                                    <div class="col-md-6" style="padding: 0px">
                                        <div class="col-md-6">
                                            <label class="col-form-label" for="school">Từ năm:</label><br>
                                            <input type="text" name="specialize[start_year][]" class="form-control specialize-date" placeholder="EX: 2010">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label" for="school">Đến năm:</label><br>
                                            <input type="text" name="specialize[end_year][]" class="form-control specialize-date" placeholder="EX: 2014">
                                        </div>
                                    </div>
                                    <i class="fa fa-remove specialize-close"></i>
                                </div>
                            `;
        $('#specialize').append(htmlSpecialize);
    })

    $('#specialize').on('click', '.specialize-close', function(){
        if (confirm('Xóa Tab?')) {
            $(this).parent('.multiple-form').remove();
        }
        
    });

    $('.btn-skill').click(function(){
        var name = $('#skill-name').val();
        var rating = $('.skill-rating').val();
        var skillHtml = `
                            <tr>
                                <input type="hidden" name="skill[name][]" value="PHP">
                                <input type="hidden" name="skill[rating][]" value="2">
                                <td class="text-center">1</td>
                                <td>PHP</td>
                                <td class="text-center">
                                    <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                </td>
                                <td class="text-center"><i class="fa fa-remove" aria-hidden="true"></i></td>
                            </tr>
                        `;
    })
})