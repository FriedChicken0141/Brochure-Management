// 画像プレビュー
$('#form-image').on('change', function(){
var $fr = new FileReader();

$fr.onload = function(){
    $('#preview').attr('src', $fr.result);
    $('.image-preview').addClass('add-solid');
}
$fr.readAsDataURL(this.files[0]);
});

// ボタン押下
$(function (){
    $(".btn").click(function(){
        if(confirm("編集を完了しますか？")){

        }else{

            return false;

        }
    });
});
