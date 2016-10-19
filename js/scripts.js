$(window).load(function(){

})

$(document).ready(function(){

  //  Pop-over initialiseren
  $('[data-toggle="popover"]').popover();

  $('#trash').hide();

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

    var btnindex = $('.removeimg').index(this);

    var remove = confirm("Weet u zeker dat u de afbeelding wilt verwijderen?");

    if( remove == true ){

      $.post("/jq/removeimg.php", {

  			link		:	$(this).attr('data-link'),
        project : $(this).attr('data-project'),
        table   : $(this).attr('data-table'),
        field   : $(this).attr('data-field')

  		}, function(data){

  			if(data!="fout"){

          $('.uplimg').eq(btnindex).fadeOut();

  			}

  		});

    }

  })

  //  Verwijderen van een geupload bestand mogelijk maken
  $('.removefile').click(function(e){

    e.preventDefault();

    var btnindex = $('.removefile').index(this);

    var remove = confirm("Weet u zeker dat u het bestand wilt verwijderen?");

    if( remove == true ){

      $.post("/jq/removefile.php", {

  			link		:	$(this).attr('data-link'),
        project : $(this).attr('data-project'),
        table   : $(this).attr('data-table'),
        field   : $(this).attr('data-field')

  		}, function(data){

  			if(data!="fout"){

          $('.uplfile').eq(btnindex).fadeOut();

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


  /*****************************************************************************

    Code voor het slepen en verwijderen van rijen uit een tabel
    (Gebruikt jQuery UI .draggable() )

  *****************************************************************************/
  var fixHelperModified = function (e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function (index) {
            $(this).width($originals.eq(index).width())
        });
        return $helper;
    };

    $("tbody").sortable({
        activate: function (event, ui) {
          $('#trash').show();
        }
    }, {
        deactivate: function (event, ui) {
          $("#trash").hide();
        }
    }, {cancel: '[contenteditable]'}, {connectWith: '#trash'}, {helper: fixHelperModified});


    $("#trash").droppable({
        accept: "tr",
        hoverClass: "ui-state-hover",
        drop: function (ev, ui) {

            var result = confirm("Weet u zeker dat u deze rij wilt verwijderen?");

            if( result == true ){

              $.post("/jq/removerow.php", {

                project : ui.draggable.attr('data-db'),
                table   : ui.draggable.attr('data-table'),
                id      : ui.draggable.attr('data-id')

          		}, function(data){

          			if(data!="fout"){

                  ui.draggable.remove();

          			}

          		});

            }
        }
    });

    /*****************************************************************************
        / Code voor het verslepen en verwijderen
    *****************************************************************************/

})
