// 管理者　承認ボタン押下時
$(function (){
    $(".btn-primary").click(function(){
        if(confirm("この申請を承認します。")){

        }else{

            return false;
        }
    });
});
// 管理者　否認ボタン押下時
$(function (){
    $(".btn-reject").click(function(){
        if(confirm("この申請を否認します。")){

        }else{

            return false;
        }
    });
});

// ユーザー　削除ボタン押下時
$(function (){
    $(".btn-dell").click(function(){
        if(confirm("この申請を削除しますか？")){

        }else{

            return false;
        }
    });
});
