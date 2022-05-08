document.getElementById('myForm').addEventListener('submit', function(){
// フォーム送信されると実行される
    var elements = this.elements;
    for (var i = 0; i < elements.length; i++) {
        if (elements[i].type == 'submit') {// type属性値がsubmitの場合
            elements[i].disabled = true;// disabledにする
        }
    }
});
