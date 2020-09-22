// タブ
$(function(){
    $('.recruit-tab1').click(function (){
        $('.recruit-tab2').removeClass('active');
        $('#panel-parttime').removeClass('active');
        $('#panel-fulltime').removeClass('active');
        $('#panel-parttime').addClass('active');
        $('.recruit-tab1').addClass('active');
        
    });
});

$(function(){
    $('.recruit-tab2').click(function (){
        $('.recruit-tab1').removeClass('active');
        $('#panel-fulltime').removeClass('active');
        $('#panel-parttime').removeClass('active');
        $('#panel-fulltime').addClass('active');
        $('.recruit-tab2').addClass('active');
    });
});