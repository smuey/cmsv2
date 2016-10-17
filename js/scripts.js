$(window).load(function(){

})

$(document).ready(function(){

  //  Afhandelen van wel/niet selecteren van een checkbox
  $('input[type="checkbox"]').click(function(){

    if( $(this).is(':checked') ){
      $(this).parent().find('input[type="hidden"]').remove();
    }else{
      $(this).parent().append('<input type=\"hidden\" name="'+$(this).attr('name')+'" value="off" />');
    }

  })

  //  Verwijderen van een geuploade afbeelding mogelijk maken
  $('.removeimg').click(function(e){

    e.preventDefault();

    var remove = confirm("Weet u zeker dat u de afbeelding wilt verwijderen?");

    if( remove == true ){

      $.post("/jq/removeimg.php", {
  			link		:	$(this).attr('data')
  		}, function(data){
  			if(data!="fout"){

          

  			}

  		});

    }

  })

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
