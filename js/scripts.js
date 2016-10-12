$(window).load(function(){

})

$(document).ready(function(){

  //  Maak een gecombineerd invul/dropdown-blok van #dbchoice
  $('#dbchoice').selectize();

  tinymce.init({
    selector: '.tinyarea',
    inline: true
  });

  $.datepicker.setDefaults( $.datepicker.regional[ "nl" ] );

  $(function(){
    $('.datepicker').datepicker({
      dateFormat: 'yy-mm-dd',
      changeMonth: true,
      changeYear: true}
    );
  });

  $(function(){
    $.datepicker.regional['nl'] = {
            closeText: 'Sluiten',
            prevText: '&lt;',
            nextText: '&gt;',
            currentText: 'Vandaag',
            monthNames: ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'],
            monthNamesShort: ['jan', 'feb', 'maa', 'apr', 'mei', 'jun', 'jul', 'aug', 'sep', 'okt', 'nov', 'dec'],
            dayNames: ['zondag', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag'],
            dayNamesShort: ['zon', 'maa', 'din', 'woe', 'don', 'vri', 'zat'],
            dayNamesMin: ['zo', 'ma', 'di', 'wo', 'do', 'vr', 'za'],
            weekHeader: 'Wk',
            dateFormat: 'dd-mm-yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''};

    $.datepicker.setDefaults( $.datepicker.regional[ "nl" ] );
  });

  $('.editlink').click(function(){
    window.location = $(this).data("href");
  })

})
