// 画像プレビュー
$('#form-image').on('change', function(){
	var $fr = new FileReader();

	$fr.onload = function(){
		$('#preview').attr('src', $fr.result);
	}
	$fr.readAsDataURL(this.files[0]);
    });

// 申請ボタン押下時
$(function (){
    $(".btn").click(function(){
        if(confirm("この内容で再申請しますか？")){

        }else{

            return false;

        }
    });
});
