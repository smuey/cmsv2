<?php

  $layout = $lijst->returnListMakeUp($_SESSION['database'], $_GET['tableName']);

  if( isset( $_POST ) && !empty( $_POST ) ){

    //  Afhandelen van geuploade bestanden
    foreach( $_FILES as $fieldName=>$file ){

      if( is_file( $file['tmp_name'] ) ){
        //  Kijk of het een afbeelding is (getimagesize geeft alleen waarden bij een daadwerkelijke afbeelding)
        $size = getimagesize( $file['tmp_name'] );

        //  Als het een afbeelding is
        if( !empty( $size ) ){
          $name = $lijst->handleUploadedImage( $file, str_replace("cms_","",$_SESSION['database'] ));
          $_POST[$fieldName] = $name;

        //  Als het geen afbeelding is
        }else{

          $name = $lijst->handleUploadedFile( $file, str_replace("cms_","",$_SESSION['database'] ) );
          $_POST[$fieldName] = $name;

        }

      }

    }

    //  Voeg tenslotte de nieuwe rij toe aan de tabel
    if( $lijst->insertNewRow( $_GET['tableName'], $_POST ) == true ){

      header('Location: /showcontents/'.$_GET['tableName'].".html");
      exit;

    }else{

      

    }

  }else{

    echo "<h1>Nieuw item toevoegen aan '".$_GET['tableName']."'</h1>
          <form method=\"post\" enctype=\"multipart/form-data\">";

    foreach( $layout as $row ){

      if( $row['COLUMN_NAME'] != 'id' ){

        switch( $row['DATA_TYPE'] ){

          case 'bool':
          case 'tinyint':
            $input = "<input type=\"checkbox\" name=\"".$row['COLUMN_NAME']."\" class=\"form-check-input\" />";
            break;

          case 'text':
            $input = "<div id=\"".$row['COLUMN_NAME']."\" class=\"tinyarea\"></div>";
            break;

          default:

            if( $row['COLUMN_NAME'] == 'date' || $row['COLUMN_NAME'] == 'datum' ){
              $input = "<input class=\"form-control datepicker\" type=\"text\" name=\"".$row['COLUMN_NAME']."\" />";
            }elseif( $row['COLUMN_NAME'] == 'afbeelding' || $row['COLUMN_NAME'] == 'download' || $row['COLUMN_NAME'] == 'image'  || $row['COLUMN_NAME'] == 'file'){
              $input = "<input type=\"file\" class=\"form-control-file\" name=\"".$row['COLUMN_NAME']."\">";
            }else{
              $input = "<input class=\"form-control\" type=\"text\" name=\"".$row['COLUMN_NAME']."\" />";
            }
            break;

        }

        echo "<div class=\"form-group row\">
                <label class=\"col-xs-2 col-form-label\" for=\"".$row['COLUMN_NAME']."\">".$row['COLUMN_NAME']."</label>
                <div class=\"col-xs-8\">
                  ".$input."
                </div>
              </div>";

      }

    }

    echo "  <button type=\"submit\" class=\"btn btn-primary\">Toevoegen</button>";

    echo "</form>";

  }

?>
