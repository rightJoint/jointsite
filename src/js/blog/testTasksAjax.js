function checkBrackets()
{
    $.get(jointAppLangSl+"/blog/testTask/parse-brackets",
        "testBrackets=on&"+$('.brackets-test form').serialize(),
        function (data) {
            if(data.viewData.checkResult == 1){
                $('.brackets-test form .brackets-test-result').removeClass('fail');
                $('.brackets-test form .brackets-test-result').addClass('ok');
                $('.brackets-test form .brackets-test-result').html(data.viewData.restext);
            }else{
                $('.brackets-test form .brackets-test-result').removeClass('ok');
                $('.brackets-test form .brackets-test-result').addClass('fail');
                $('.brackets-test form .brackets-test-result').html(data.viewData.restext);
            }
        }
    );
}

function calcAlvasarCode()
{
    $.get(jointAppLangSl+"/blog/testTask/alvasarcode",
        "testAlvasar=on&"+$('.alvasar-test form').serialize(),
        function (data) {
            $('.alvasar-test form .alvasar-code-result span.code-value').html(data.viewData.resultCode);
        }
    );
}