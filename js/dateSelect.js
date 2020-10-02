(function($){
    function formSetDay(){
      var lastday = formSetLastDay($('.year').val(), $('.month').val());
      var option = '';
      console.log(lastday);
      for (var i = 1; i <= lastday; i++) {
        if (i === $('.day').val()){
          option += '<option value="' + i + '" selected="selected">' + i + '</option>\n';
        }else{
          option += '<option value="' + i + '">' + i + '</option>\n';
        }
      }
      $('.day').html(option);
    }
  
    function formSetLastDay(year, month){
      var lastday = 
      {
          '01':31,
          '02':28,
          '03':31,
          '04':30,
          '05':31,
          '06':30,
          '07':31,
          '08':31,
          '09':30,
          '10':31,
          '11':30,
          '12':31,
      }
      if ((year % 4 === 0 && year % 100 !== 0) || year % 400 === 0){
        lastday['02'] = 29;
      }
      return lastday[month];
    }
  
    $('.year, .month').change(function(){
      formSetDay();
    });
  })(jQuery);