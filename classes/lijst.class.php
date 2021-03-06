<?php

  class Lijst{

    /**************************************************************

        __construct - constructor

    **************************************************************/
    public function __construct(){

      require_once('conf.php');
      require_once('db.class.php');
      $db = new Database(DBNAME,DBUSER,DBPASS);
      global $db;
      $this->db = $db;

      $this->fileroot = "";
      $this->imageroot = IMAGEROOT;
      $this->linkroot = "http://".str_replace("cms_","", $_SESSION['database']).".lcms.lionhead.nl";

    }


    /**************************************************************

        returnLijsten( $databaseNaam ) - Retourneer een lijst
        van alle tabllen in een bepaalde database

    **************************************************************/
    public function returnLijsten( $databaseName ){

      $lijsten = $this->db->queryarray("SELECT
                                     table_name
                                   FROM
                                     information_schema.tables
                                   WHERE
                                     TABLE_SCHEMA=?
                                   ", array($databaseName));

      return $lijsten;

    }


    /**************************************************************

        returnListMakeUp( $tableName ) - Retourneer een
        overzicht van de datatypen en overige attributen
        in een tabel

    **************************************************************/
    public function returnListMakeUp( $database, $tableName ){

      $makeup = $this->db->queryarray("SELECT  * FROM information_schema.columns WHERE table_schema=? AND table_name=?", array($database, $tableName));

      return $makeup;

    }


    /**************************************************************

        returnListContents( $tableName, $sortBy(optional), $sortType(optional) )
        Geef alle rijen die in de tabel voorkomen terug

    **************************************************************/
    public function returnListContents( $tableName, $sortBy=NULL, $sortType=NULL ) {

      if( !empty( $sortBy ) ){
        $items = $this->db->queryarray("SELECT * FROM ".$tableName." ORDER BY ".$sortBy." ".$sortType);
      }else{
        $items = $this->db->queryarray("SELECT * FROM ".$tableName);
      }

      return $items;

    }


    /**************************************************************

        createQuery( $type, $table, $queryData ) - Maak een
        valide SQL-query van een set met querydata

    **************************************************************/
    public function createQuery( $type, $table, $queryData){

      switch($type){

        case 'insert':

          $qry = "INSERT INTO ".$table." (";
          foreach( $queryData as $key=>$value ){

            $qry.= $key.", ";

          }

          $qry = substr($qry, 0, -2).") VALUES (";

          foreach( $queryData as $key=>$value ){

            $qry.= "'".$value."', ";

          }

          $qry = substr($qry, 0, -2).")";

          break;

      }

      return $qry;

    }


    /**************************************************************

        handleUploadedImage( $file, $projectName ) - upload
        een toegevoegde afbeelding naar de juiste map

    **************************************************************/
    public function handleUploadedImage( $file, $projectName ){

      $fileExt = explode(".", $file['name']);

      $name = md5($file['name'].time()).".".$fileExt[1];

      if( !file_exists( $this->imageroot.$projectName.'/images/'.$name ) ){

        if( move_uploaded_file( $file['tmp_name'], $this->imageroot.$projectName.'/images/'.$name ) == true){
          return( $name );
        }else{
          echo "Er is iets fout gegaan bij het uploaden!";
          exit;
        }

      }

    }


    /**************************************************************

        handleUploadedFile( $file, $projectName ) - upload
        een toegevoegd bestand naar de juiste map

    **************************************************************/
    public function handleUploadedFile( $file, $projectName ){

      $fileExt = explode(".", $file['name']);

      $name = md5($file['name'].time()).".".$fileExt[1];

      if( !file_exists( $this->imageroot.$projectName.'/downloads/'.$name ) ){

        if( move_uploaded_file( $file['tmp_name'], $this->imageroot.$projectName.'/downloads/'.$name ) == true){
          return( $name );
        }else{
          echo "Er is iets fout gegaan bij het uploaden!";
          exit;
        }

      }

    }


    /**************************************************************

        insertNewRow( $table, $data ) - Voeg een nieuwe rij toe
        aan de opgegeven tabel

    **************************************************************/
    public function insertNewRow( $table, $data ){

      if( $this->db->queryinsert( $table, $data ) == true ){
        return true;
      }else{
        return false;
      }

    }


    /**************************************************************

        lookupFile( $project, $filename ) - Zoek een bestand
        dat geupload is binnen het project op en Retourneer
        de benodigde informatie om het weer te geven

    **************************************************************/
    public function lookupFile( $project, $filename ){

      if( is_file( $this->imageroot.$project.'/downloads/'.$filename ) ){
        return array('type'=>'download', 'link'=>$this->linkroot."/downloads/".$filename);
      }elseif( is_file( $this->imageroot.$project.'/images/'.$filename ) ){
        return array('type'=>'image', 'link'=>$this->linkroot."/images/".$filename);
      }

    }


    /**************************************************************

        editRow( $table, $id, $data ) - Bewerk een bestaand
        rij in een tabel

    **************************************************************/
    public function editRow( $table, $id, $data ){

      $query = "UPDATE ".$table." SET ";

      foreach( $data as $key=>$value ){

        $query .= $key."='".$value."', ";

      }

      $query = substr( $query, 0, -2 );

      $query .= " WHERE id=".$id;

      if( $this->db->queryupdate($query) == true){
        return true;
      }else{
        return false;
      }

    }

  }

?>
