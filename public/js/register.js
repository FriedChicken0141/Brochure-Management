// 画像添付時にプレビュー
$('#form-image').on('change', function(){
	var $fr = new FileReader();

	$fr.onload = function(){
		$('#preview').attr('src', $fr.result);
        $('.image-preview').addClass('add-solid');
	}
	$fr.readAsDataURL(this.files[0]);

    });
//　ボタン押下時
$(function (){
    $(".btn-primary").click(function(){
        if(confirm("この内容で登録します。")){

        }else{

            return false;
        }
    });
});
