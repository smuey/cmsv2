<?php

  if( !empty( $_GET['tableName'] ) && !empty( $_GET['editableRow'] ) ){

      $layout = $lijst->returnListMakeUp($_SESSION['database'], $_GET['tableName']);

      if( isset( $_POST ) && !empty( $_POST ) ){

        $editId = $_POST['id'];

        unset( $_POST['id'] );

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

        foreach( $_POST as $key=>$value ){
          if( $value == 'on' ){
            $_POST[$key] = 1;
          }elseif( $value == 'off' ){
            $_POST[$key] == 0;
          }
        }

        //  Voeg tenslotte de nieuwe rij toe aan de tabel
        if( $lijst->editRow( $_GET['tableName'], $editId, $_POST ) == true ){

          header('Location: /showcontents/'.$_GET['tableName'].".html");
          exit;

        }else{



        }

      }else{

        $rowData =  $db->queryrow("SELECT * FROM ".$_GET['tableName']." WHERE id=?", array( $_GET['editableRow'] ));

        echo "<h1>Rij aanpassen</h1>
              <form method=\"post\" enctype=\"multipart/form-data\">";

        foreach( $layout as $row ){

          if( $row['COLUMN_NAME'] != 'id' ){

            switch( $row['DATA_TYPE'] ){

              case 'bool':
              case 'tinyint':
                $input = "<input type=\"checkbox\" name=\"".$row['COLUMN_NAME']."\" class=\"form-check-input\" ".( $rowData[$row['COLUMN_NAME']] == 1?"checked=\"checked\"":"" )." />";
                break;

              case 'text':
                $input = "<div id=\"".$row['COLUMN_NAME']."\" class=\"tinyarea\">".$rowData[$row['COLUMN_NAME']]."</div>";
                break;

              default:

                if( $row['COLUMN_NAME'] == 'date' || $row['COLUMN_NAME'] == 'datum' ){
                  $input = "<input class=\"form-control datepicker\" type=\"text\" name=\"".$row['COLUMN_NAME']."\" value=\"".$rowData[$row['COLUMN_NAME']]."\" />";
                }elseif( $row['COLUMN_NAME'] == 'afbeelding' || $row['COLUMN_NAME'] == 'download' || $row['COLUMN_NAME'] == 'image'  || $row['COLUMN_NAME'] == 'file'){
                  $input = "<input type=\"file\" class=\"form-control-file\" name=\"".$row['COLUMN_NAME']."\" value=\"".$rowData[$row['COLUMN_NAME']]."\" >";
                  //  Als er een item geupload is, toon dan een link naar het bestand in kwestie
                  if( !empty( $rowData[$row['COLUMN_NAME']] ) ){
                    //  Controleer of het om een afbeelding of download gaat
                    $uplFile = $lijst->lookupFile( str_replace("cms_","",$_SESSION['database']), $rowData[$row['COLUMN_NAME']] );
                    if( $uplFile['type'] == 'image' ){
                      echo "<div class=\"form-group row\">
                              <label class=\"col-xs-2 col-form-label\">Geuploade afbeelding</label>
                              <div class=\"col-xs-8\">
                                <img style=\"max-width: 600px;\" src=\"".$uplFile['link']."\" />
                              </div>
                            </div>";

                      echo "<input type=\"hidden\" name=\"".$row['COLUMN_NAME']."\" value=\"".$rowData[$row['COLUMN_NAME']]."\" />";

                      echo "<div class=\"alert alert-warning\"><strong>Let op!</strong> Bij het hieronder kiezen van een nieuwe afbeelding, zal de bestaande afbeelding overschreven worden</div>";
                    }else{
                      echo "<div class=\"form-group row\">
                              <label class=\"col-xs-2 col-form-label\">Geupload bestand</label>
                              <div class=\"col-xs-8\">
                                <a target=\"_blank\" href=\"".$uplFile['link']."\">".$uplFile['link']."</a>
                              </div>
                            </div>";

                      echo "<input type=\"hidden\" name=\"".$row['COLUMN_NAME']."\" value=\"".$rowData[$row['COLUMN_NAME']]."\" />";

                      echo "<div class=\"alert alert-warning\"><strong>Let op!</strong> Bij het hieronder kiezen van een nieuw bestand, zal het bestaande bestand overschreven worden</div>";
                    }
                  }
                }else{
                  $input = "<input class=\"form-control\" type=\"text\" name=\"".$row['COLUMN_NAME']."\" value=\"".$rowData[$row['COLUMN_NAME']]."\" />";
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

        echo "  <input type=\"hidden\" name=\"id\" value=\"".$rowData['id']."\" />";

        echo "  <button type=\"submit\" class=\"btn btn-primary\">Wijzigen</button>";

        echo "</form>";

      }

  }else{

    echo "De door u opgevraagde data kon niet worden gevonden";

  }

?>
