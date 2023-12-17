// 権限変更ボタン押下
$(function (){
    $(".btn-primary").click(function(){
        if(confirm("このユーザーの権限を変更します。")){

        }else{

            return false;
        }
    });
});

// 削除ボタン押下
$(function (){
    $(".btn-dell").click(function(){
        if(confirm("このユーザーを削除しますか？")){

        }else{

            return false;
        }
    });
});
