$(document).ready(function(){

    // Convert name to slug
    
    var slug = '';
    var slugName = '';
    var slugTitle = '';
    
    $('#name').change(function(){
        slugName = to_slug($('#name').val()) + '-';
        slug = slugName + slugTitle;
        $('#slug').val(slug);
    });
    // Convert title to slug
    $('#title').change(function(){
        slugTitle = to_slug($('#title').val());
        slug = slugName + slugTitle;
        $('#slug').val(slug);
    });

    var editor_config = {
        path_absolute : "/",
        selector: ".tinymce",
        plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code help'
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'mobile/laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        }
    };

    tinymce.init(editor_config);
});

// Build slug string
function to_slug(str){
    str = str.toLowerCase();

    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    str = str.replace(/(đ)/g, 'd');

    str = str.replace(/([^0-9a-z-\s])/g, '');

    str = str.replace(/(\s+)/g, '-');

    str = str.replace(/^-+/g, '');

    str = str.replace(/-+$/g, '');

    // return
    return str;
}

$(document).ready(function(){
    $('.btn-remove').click(function(){
        var id = $(this).data('id');
        var url = $(this).data('url');
        if(confirm('Chắc chắn xóa?')){
             $.ajax({
                method: "get",
                url: url,
                success: function(response){
                    if(response.status == 200 && response.isExist === true){
                        $('.row-' + id).fadeOut();
                    }
                    if(response.status == 200 && response.isExist === false && response.message != ''){
                        alert(response.message);
                    }
                },
                error: function(jqXHR, exception){
                    // console.log(errorHandle(jqXHR, exception));
                }
            });
        }
    })
})