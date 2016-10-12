<nav class="navbar navbar-inverse navbar-fixed-top">
 <div class="container-fluid">
   <div class="navbar-header">
     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
       <span class="sr-only">Toggle navigation</span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
     </button>
     <a class="navbar-brand" href="#">Lijsten<?php echo (!empty($_SESSION['database'])?" - ".str_replace("cms_","",$_SESSION['database']):"") ?></a>
   </div>
   <div id="navbar" class="navbar-collapse collapse">
     <ul class="nav navbar-nav navbar-right">
       <li><a href="?changeProject">Project wisselen</a></li>
       <li><a href="http://cms.lionhead.nl">Terug naar CMS</a></li>
       <li><a href="?kill">Uitloggen</a></li>
     </ul>
   </div>
 </div>
</nav>

<div class="container-fluid">
 <div class="row">
   <div class="col-md-2 sidebar">
     <ul class="nav nav-sidebar">
       <li><a href="/">Overzicht</a></li>
       <li><a href="#">Nieuwe lijst</a></li>
       <li><hr /></li>

       <?php

       if( !empty($_SESSION['database']) ){

         $lijsten = $lijst->returnLijsten($_SESSION['database']);

        }

        if( !empty( $lijsten ) ){

          foreach( $lijsten as $lijst ){

            if( !in_array( $lijst['table_name'], $doNotDisplay) ){

              echo "<li>
                      <a href=\"/showcontents/".$lijst['table_name'].".html\">".$lijst['table_name']."</a>
                    </li>";
            }

          }

        }

       ?>

     </ul>
   </div>

   <div class="col-md-10 main">

     <?php

      if(!isset( $_SESSION['database'] ) || empty( $_SESSION['database'] )){

        include('pages/databases.php');

      }else{

        include('pages/lijsten.php');

      }

     ?>

   </div>
 </div>
</div>
