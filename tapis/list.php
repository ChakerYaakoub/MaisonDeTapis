<!DOCTYPE html>
<?php
session_start();
?>

<html>

<head>
    <title> list TAPIS</title>
    <meta charset="utf-8">
    <meta name="description" content="maison de tapis ">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="searchcss1.css">
    <link rel="stylesheet" href="home.css">
    <style>
        a:link {
            text-decoration: none;
            color: rgb(31, 28, 28);
        }

        a:hover {
            text-decoration: none;
            color: rgb(131, 34, 34);
            font-weight: bold;
        }
    </style>

</head>

<body>

    <header>
        <div class="container">


            <table>
                <tr>
                    <td>
                        <a href="home.php"><img src="photo\brand.png " width='150px' hight='150px' id="logo">
                        </a>
                    </td>

                    <td>


                    <div class="flexsearch" id="search">
                            <div class="flexsearch--wrapper">
                                <form class="flexsearch--form" action="search.php" method="GET">
                                    <div class="flexsearch--input-wrapper">
                                        <input class="flexsearch--input" type="search"
                                            placeholder="Je cherche un produit…" name="search">
                                    </div>
                                    <input class="flexsearch--submit" type="submit" name="submit" value="&#10140;" />
                                </form>
                            </div>
                        </div>




                    </td>

                    <td style="padding-top: 3px; padding-right:15px ;">


                        <a href="https://goo.gl/maps/BrDynxbym1YPUgUd6" style="color:rgb(31, 28, 28) ;top: 2px;"><img
                                src="photo\location.png" width='45px' hight='40px'> <br /> <b> Notre<br /> magazin </b>
                        </a>



                    </td>

                    <td style=" padding-right:15px ;">
                        <a href="panier.php"><img src="photo\panier.jpg " width='50px' hight='55px'> <br /><b>
                                Mon <br /> panier </b> </a> <!-- or 70 70-->


                    </td>
                    <td style=" padding-right:25px ;">
                        <a href="compte.php"><img src="photo\compte.jpeg " width='50px' hight='50px'> <br />
                            <b> Mon <br /> compte </b> </a>


                    </td>




                </tr>
            </table>


        </div>
        <div id="header2">

            <table class="titre">
                <tr>
                    <td> <a href="searchtools.php">OUTILS</a></td>
                    <td> <a href="pieces.php"> PIECE</a></td>
                    <td> <a href="colors.php"> COULEUR</a></td>
                    <td> <a href="marks.php"> MARQUE </a></td>
                    <td> <a href="formTapis.php"> FORME </a></td>


                </tr>
            </table>
        </div>
    </header>


    <section class="listtt">
        <?php


if(isset($_GET['piece'])){

    if(empty($_GET['piece']) ){
        $_page=$_SERVER["HTTP_REFERER"] ;
       
        echo" <center>
         <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' > variable piece is empty</b>
     </center>" ;
      header('refresh:3 ; url= '.$_page) ;
     die () ;}

     $piece=$_GET['piece'] ;
     echo"<br><h > <center> <b style=' font-size: 35px; color: #3c3c3B; padding:20px; text-transform: uppercase;'> TAPIS / ''<h  style='color: rgb(194, 82, 82);'> ".$piece."</h> ''</b></center></h><br>";


     
    $con=mysqli_connect("localhost" ,"root", "", "tapis") ;

    if(!$con)  {
        
   $_page=$_SERVER["HTTP_REFERER"] ; // you can just utilise $_page="login.php"
          
   echo" <center>
    <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' >problème de connexion de données </b>
   </center>" ;
   header('refresh:3 ; url= '.$_page) ;
   die () ;}

   $sql=" select *  from tapis where piece='$piece' " ;


 // for execute the query "sql" from the connection "con"
 $result=mysqli_query($con,$sql) ;

// if retutne errer alor on a a syntax error in the query :

    if(!$result)  { header("refresh:2") ; 
       
    $_page=$_SERVER["HTTP_REFERER"] ; // you can just utilise $_page="login.php"
       
    echo" <center>
     <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' >Problème d'exécution de requête! </b>
 </center>" ;
  header('refresh:3 ; url= '.$_page) ;
 die () ;}

 
 if(mysqli_num_rows($result)==0) {


   
    echo" <h style='padding: 50px'; ><center ><img src="?>'photo\vid1.png' <?php echo" ><center/> <h/> <br>
    <center>
    " ;
  
 }

 else{
     echo"<table style='width: 100%;'>
      <tr>";
     
     $nb=0;

    for($i=0;$i<mysqli_num_rows($result); $i++)
    {
      //get 1 record from the set ($result)
      $row=mysqli_fetch_assoc($result);
      $reduit=$row['prix']-($row['prix']*$row['reduit']/100);
      echo"
      <td style='padding: 10px; width: 25%;' >

      <a href='form.php?IdTapis=".$row['IdTapis']."'>

      <img src=";?>'imagesTapis/<?php echo $row['IdTapis'].".".$row['ext']."'>
      <center>
          <h style='overflow:inherit ;color: #232323;'> <b>".$row['mark']." : </b>".$row['titre']."
          </h>
      </center>
      <br>
      <center><h style='color: #818181;'><strike><b>".$row['prix']." $</b> </strike> </h></center>
      <br>
      <center><h style='color: #ca1c72;'><big> <b>".$reduit." $</b> </big></h></center></a>

  </td>
      
      ";
      $nb=$nb+1;

      if($nb%4==0){
        echo"</tr> <tr>"; }
 }

 if($nb%1==0){
    echo"<td></td> <td></td> <td></td> </tr> "; }

    elseif($nb%2==0){
        echo"<td></td> <td></td> </tr> "; }
        elseif($nb%3==0){
            echo" <td></td> </tr> "; }
            else{
                echo"</tr>" ;
            }

            echo"</table>";



        


    


} }// end of list piece 



if(isset($_GET['color'])){

    if(empty($_GET['color']) ){
        $_page=$_SERVER["HTTP_REFERER"] ;
       
        echo" <center>
         <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' > variable color is empty</b>
     </center>" ;
      header('refresh:3 ; url= '.$_page) ;
     die () ;}

     $color=$_GET['color'] ;
     echo" <br><h > <center> <b style=' font-size: 35px; color: #3c3c3B; padding:20px; text-transform: uppercase;'> TAPIS COULEUR / ''<h  style='color: rgb(194, 82, 82);'> ".$color."</h> ''</b></center></h> <br>";


     
    $con=mysqli_connect("localhost" ,"root", "", "tapis") ;

    if(!$con)  {
        
   $_page=$_SERVER["HTTP_REFERER"] ; // you can just utilise $_page="login.php"
          
   echo" <center>
    <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' >problème de connexion de données </b>
   </center>" ;
   header('refresh:3 ; url= '.$_page) ;
   die () ;}

   $sql=" select *  from tapis where color='$color' " ;


 // for execute the query "sql" from the connection "con"
 $result=mysqli_query($con,$sql) ;

// if retutne errer alor on a a syntax error in the query :

    if(!$result)  { header("refresh:2") ; 
       
    $_page=$_SERVER["HTTP_REFERER"] ; // you can just utilise $_page="login.php"
       
    echo" <center>
     <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' >Problème d'exécution de requête! </b>
 </center>" ;
  header('refresh:3 ; url= '.$_page) ;
 die () ;}

 
 if(mysqli_num_rows($result)==0) {


   
    echo" <h style='padding: 50px'; ><center ><img src="?>'photo\vid1.png' <?php echo" ><center/> <h/> <br>
    <center>
    " ;
  
 }

 else{
     echo"<table style='width: 100%;'>
      <tr>";
     
     $nb=0;

    for($i=0;$i<mysqli_num_rows($result); $i++)
    {
      //get 1 record from the set ($result)
      $row=mysqli_fetch_assoc($result);
      $reduit=$row['prix']-($row['prix']*$row['reduit']/100);
      echo"
      <td style='padding: 10px; width: 25%;' >

      <a href='form.php?IdTapis=".$row['IdTapis']."'>

      <img src=";?>'imagesTapis/<?php echo $row['IdTapis'].".".$row['ext']."'>
      <center>
          <h style='overflow:inherit ;color: #232323;'> <b>".$row['mark']." : </b>".$row['titre']."
          </h>
      </center>
      <br>
      <center><h style='color: #818181;'><strike><b>".$row['prix']." $</b> </strike> </h></center>
      <br>
      <center><h style='color: #ca1c72;'><big> <b>".$reduit." $</b> </big></h></center></a>

  </td>
      
      ";
      $nb=$nb+1;

      if($nb%4==0){
        echo"</tr> <tr>"; }
 }

 if($nb%1==0){
    echo"<td></td> <td></td> <td></td> </tr> "; }

    elseif($nb%2==0){
        echo"<td></td> <td></td> </tr> "; }
        elseif($nb%3==0){
            echo" <td></td> </tr> "; }
            else{
                echo"</tr>" ;
            }

            echo"</table>";



        


    


} }// end off list colorr


if(isset($_GET['mark'])){

    if(empty($_GET['mark']) ){
        $_page=$_SERVER["HTTP_REFERER"] ;
       
        echo" <center>
         <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' > variable mark is empty</b>
     </center>" ;
      header('refresh:3 ; url= '.$_page) ;
     die () ;}

     $mark=$_GET['mark'] ;
     echo"  <br><h > <center> <b style=' font-size: 35px; color: #3c3c3B; padding:20px; text-transform: uppercase;'> TAPIS MARQUE/ ''<h  style='color: rgb(194, 82, 82);'> ".$mark."</h> ''</b></center></h> </br>";


     
    $con=mysqli_connect("localhost" ,"root", "", "tapis") ;

    if(!$con)  {
        
   $_page=$_SERVER["HTTP_REFERER"] ; // you can just utilise $_page="login.php"
          
   echo" <center>
    <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' >problème de connexion de données </b>
   </center>" ;
   header('refresh:3 ; url= '.$_page) ;
   die () ;}

   $sql=" select *  from tapis where mark='$mark' " ;


 // for execute the query "sql" from the connection "con"
 $result=mysqli_query($con,$sql) ;

// if retutne errer alor on a a syntax error in the query :

    if(!$result)  { header("refresh:2") ; 
       
    $_page=$_SERVER["HTTP_REFERER"] ; // you can just utilise $_page="login.php"
       
    echo" <center>
     <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' >Problème d'exécution de requête! </b>
 </center>" ;
  header('refresh:3 ; url= '.$_page) ;
 die () ;}

 
 if(mysqli_num_rows($result)==0) {


   
    echo" <h style='padding: 50px'; ><center ><img src="?>'photo\vid1.png' <?php echo" ><center/> <h/> <br>
    <center>
    " ;
  
 }

 else{
     echo"<table style='width: 100%;'>
      <tr>";
     
     $nb=0;

    for($i=0;$i<mysqli_num_rows($result); $i++)
    {
      //get 1 record from the set ($result)
      $row=mysqli_fetch_assoc($result);
      $reduit=$row['prix']-($row['prix']*$row['reduit']/100);
      echo"
      <td style='padding: 10px; width: 25%;' >

      <a href='form.php?IdTapis=".$row['IdTapis']."'>

      <img src=";?>'imagesTapis/<?php echo $row['IdTapis'].".".$row['ext']."'>
      <center>
          <h style='overflow:inherit ;color: #232323;'> <b>".$row['mark']." : </b>".$row['titre']."
          </h>
      </center>
      <br>
      <center><h style='color: #818181;'><strike><b>".$row['prix']." $</b> </strike> </h></center>
      <br>
      <center><h style='color: #ca1c72;'><big> <b>".$reduit." $</b> </big></h></center></a>

  </td>
      
      ";
      $nb=$nb+1;

      if($nb%4==0){
        echo"</tr> <tr>"; }
 }

 if($nb%1==0){
    echo"<td></td> <td></td> <td></td> </tr> "; }

    elseif($nb%2==0){
        echo"<td></td> <td></td> </tr> "; }
        elseif($nb%3==0){
            echo" <td></td> </tr> "; }
            else{
                echo"</tr>" ;
            }

            echo"</table>";



        


    


} }// end list markk


if(isset($_GET['reduit'])){

    if(empty($_GET['reduit']) ){
        $_page=$_SERVER["HTTP_REFERER"] ;
       
        echo" <center>
         <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' > variable reduit is empty</b>
     </center>" ;
      header('refresh:3 ; url= '.$_page) ;
     die () ;}

     
     echo"  <br><h > <center> <b style=' font-size: 35px; color: #3c3c3B; padding:20px; text-transform: uppercase;'> TAPIS A PRIX ''<h  style='color: rgb(194, 82, 82);'> REDUIT </h> ''</b></center></h><br> <br>";
     echo"<h style=''> <b>PROMOS:</b></h><br><i><h style='font-size: 12px; color: #3c3c3B; background-color:white;'>Pendant les douze mois de l’année, 
     retrouvez ici tous nos tapis en Reduit mais aussi nos <b> déstockage de tapis </b> ! Les conditions générales de vente, de livraison et
      de garantie sont identiques. Seul le prix change, pas la qualité du tapis ni de nos services ! Tous nos <b> tapis a ptix reduit </b> sont référencés dans cette rubrique afin de vous permettre de laisser libre cours à votre imagination sans devoir réfléchir au prix !
      Du tapis en laine en passant par le tapis design, tous nos produits en promotion se trouvent ici !</h> </i><br> <br>
";



     
    $con=mysqli_connect("localhost" ,"root", "", "tapis") ;

    if(!$con)  {
        
   $_page=$_SERVER["HTTP_REFERER"] ; // you can just utilise $_page="login.php"
          
   echo" <center>
    <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' >problème de connexion de données </b>
   </center>" ;
   header('refresh:3 ; url= '.$_page) ;
   die () ;}

   $sql=" select *  from tapis where reduit>0 " ;


 // for execute the query "sql" from the connection "con"
 $result=mysqli_query($con,$sql) ;

// if retutne errer alor on a a syntax error in the query :

    if(!$result)  { header("refresh:2") ; 
       
    $_page=$_SERVER["HTTP_REFERER"] ; // you can just utilise $_page="login.php"
       
    echo" <center>
     <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' >Problème d'exécution de requête! </b>
 </center>" ;
  header('refresh:3 ; url= '.$_page) ;
 die () ;}

 
 if(mysqli_num_rows($result)==0) {


   
    echo" <h style='padding: 50px'; ><center ><img src="?>'photo\vid1.png' <?php echo" ><center/> <h/> <br>
    <center>
    " ;
  
 }

 else{
     echo"<table style='width: 100%;'>
      <tr>";
     
     $nb=0;

    for($i=0;$i<mysqli_num_rows($result); $i++)
    {
      //get 1 record from the set ($result)
      $row=mysqli_fetch_assoc($result);
      $reduit=$row['prix']-($row['prix']*$row['reduit']/100);
      echo"
      <td style='padding: 10px; width: 25%;' >

      <a href='form.php?IdTapis=".$row['IdTapis']."'>

      <img src=";?>'imagesTapis/<?php echo $row['IdTapis'].".".$row['ext']."'>
      <center>
          <h style='overflow:inherit ;color: #232323;'> <b>".$row['mark']." : </b>".$row['titre']."
          </h>
      </center>
      <br>
      <center><h style='color: #818181;'><strike><b>".$row['prix']." $</b> </strike> </h></center>
      <br>
      <center><h style='color: #ca1c72;'><big> <b>".$reduit." $</b> </big></h></center></a>

  </td>
      
      ";
      $nb=$nb+1;

      if($nb%4==0){
        echo"</tr> <tr>"; }
 }

 if($nb%1==0){
    echo"<td></td> <td></td> <td></td> </tr> "; }

    elseif($nb%2==0){
        echo"<td></td> <td></td> </tr> "; }
        elseif($nb%3==0){
            echo" <td></td> </tr> "; }
            else{
                echo"</tr>" ;
            }

            echo"</table>";



        


    


} } // end of list reduit


if(isset($_GET['pascher'])){

    if(empty($_GET['pascher']) ){
        $_page=$_SERVER["HTTP_REFERER"] ;
       
        echo" <center>
         <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' > variable pascher is empty</b>
     </center>" ;
      header('refresh:3 ; url= '.$_page) ;
     die () ;}

     
     echo" </br><h > <center> <b style=' font-size: 35px; color: #3c3c3B; padding:20px; text-transform: uppercase;'> TAPIS '' <h  style='color: rgb(194, 82, 82);'>PAS CHER</h> ''</b></center></h>
             </br> <center> <h style=''font-size:20px;> moins de 50$</h> </center> <br>";

             echo"<h style=''> <b>PROMOS:</b></h><br><i><h style='font-size: 12px; color: #3c3c3B; background-color:white;'>Pendant les douze mois de l’année, 
             retrouvez ici tous nos tapis en promotion mais aussi nos <b> déstockage de tapis </b> ! Les conditions générales de vente, de livraison et
              de garantie sont identiques. Seul le prix change, pas la qualité du tapis ni de nos services ! Tous nos <b> tapis pas chers </b> sont référencés dans cette rubrique afin de vous permettre de laisser libre cours à votre imagination sans devoir réfléchir au prix !
              Du tapis en laine en passant par le tapis design, tous nos produits en promotion se trouvent ici !</h> </i><br> <br>
 ";


     
    $con=mysqli_connect("localhost" ,"root", "", "tapis") ;

    if(!$con)  {
        
   $_page=$_SERVER["HTTP_REFERER"] ; // you can just utilise $_page="login.php"
          
   echo" <center>
    <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' >problème de connexion de données </b>
   </center>" ;
   header('refresh:3 ; url= '.$_page) ;
   die () ;}

   $sql=" select *  from tapis where prix<50 " ;


 // for execute the query "sql" from the connection "con"
 $result=mysqli_query($con,$sql) ;

// if retutne errer alor on a a syntax error in the query :

    if(!$result)  { header("refresh:2") ; 
       
    $_page=$_SERVER["HTTP_REFERER"] ; // you can just utilise $_page="login.php"
       
    echo" <center>
     <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' >Problème d'exécution de requête! </b>
 </center>" ;
  header('refresh:3 ; url= '.$_page) ;
 die () ;}

 
 if(mysqli_num_rows($result)==0) {


   
    echo" <h style='padding: 50px'; ><center ><img src="?>'photo\vid1.png' <?php echo" ><center/> <h/> <br>
    <center>
    " ;
  
 }

 else{
     echo"<table style='width: 100%;'>
      <tr>";
     
     $nb=0;

    for($i=0;$i<mysqli_num_rows($result); $i++)
    {
      //get 1 record from the set ($result)
      $row=mysqli_fetch_assoc($result);
      $reduit=$row['prix']-($row['prix']*$row['reduit']/100);
      echo"
      <td style='padding: 10px; width: 25%;' >

      <a href='form.php?IdTapis=".$row['IdTapis']."'>

                                <img src=";?>'imagesTapis/<?php echo $row['IdTapis'].".".$row['ext']."'>
      <center>
          <h style='overflow:inherit ;color: #232323;'> <b>".$row['mark']." : </b>".$row['titre']."
          </h>
      </center>
      <br>
      <center><h style='color: #818181;'><strike><b>".$row['prix']." $</b> </strike> </h></center>
      <br>
      <center><h style='color: #ca1c72;'><big> <b>".$reduit." $</b> </big></h></center></a>

  </td>
      
      ";
      $nb=$nb+1;

      if($nb%4==0){
        echo"</tr> <tr>"; }
 }

 if($nb%1==0){
    echo"<td></td> <td></td> <td></td> </tr> "; }

    elseif($nb%2==0){
        echo"<td></td> <td></td> </tr> "; }
        elseif($nb%3==0){
            echo" <td></td> </tr> "; }
            else{
                echo"</tr>" ;
            }

            echo"</table>";



        


    


} } // end of list pas chere

if(isset($_GET['form'])){

    if(empty($_GET['form']) ){
        $_page=$_SERVER["HTTP_REFERER"] ;
       
        echo" <center>
         <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' > variable piece is empty</b>
     </center>" ;
      header('refresh:3 ; url= '.$_page) ;
     die () ;}

     $form=$_GET['form'] ;
     echo"<br><h > <center> <b style=' font-size: 35px; color: #3c3c3B; padding:20px; text-transform: uppercase;'> TAPIS / ''<h  style='color: rgb(194, 82, 82);'> ".$form."</h> ''</b></center></h><br>";


     
    $con=mysqli_connect("localhost" ,"root", "", "tapis") ;

    if(!$con)  {
        
   $_page=$_SERVER["HTTP_REFERER"] ; // you can just utilise $_page="login.php"
          
   echo" <center>
    <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' >problème de connexion de données </b>
   </center>" ;
   header('refresh:3 ; url= '.$_page) ;
   die () ;}

   $sql=" select *  from tapis where forme='$form' " ;


 // for execute the query "sql" from the connection "con"
 $result=mysqli_query($con,$sql) ;

// if retutne errer alor on a a syntax error in the query :

    if(!$result)  { header("refresh:2") ; 
       
    $_page=$_SERVER["HTTP_REFERER"] ; // you can just utilise $_page="login.php"
       
    echo" <center>
     <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' >Problème d'exécution de requête! </b>
 </center>" ;
  header('refresh:3 ; url= '.$_page) ;
 die () ;}

 
 if(mysqli_num_rows($result)==0) {


   
    echo" <h style='padding: 50px'; ><center ><img src="?>'photo\vid1.png' <?php echo" ><center/> <h/> <br>
    <center>
    " ;
  
 }

 else{
     echo"<table style='width: 100%;'>
      <tr>";
      
     
     $nb=0;

    for($i=0;$i<mysqli_num_rows($result); $i++)
    {
      //get 1 record from the set ($result)
      $row=mysqli_fetch_assoc($result);
      $reduit=$row['prix']-($row['prix']*$row['reduit']/100);
      echo"
      <td style='padding: 10px; width: 25%;' >

      <a href='form.php?IdTapis=".$row['IdTapis']."'>

      <img src=";?>'imagesTapis/<?php echo $row['IdTapis'].".".$row['ext']."'>
      <center>
          <h style='overflow:inherit ;color: #232323;'> <b>".$row['mark']." : </b>".$row['titre']."
          </h>
      </center>
      <br>
      <center><h style='color: #818181;'><strike><b>".$row['prix']." $</b> </strike> </h></center>
      <br>
      <center><h style='color: #ca1c72;'><big> <b>".$reduit." $</b> </big></h></center></a>

  </td>
      
      ";
      $nb=$nb+1;

      if($nb%4==0){
        echo"</tr> <tr>"; }
 }

 if($nb%1==0){
    echo"<td></td> <td></td> <td></td> </tr> "; }

    elseif($nb%2==0){
        echo"<td></td> <td></td> </tr> "; }
        elseif($nb%3==0){
            echo" <td></td> </tr> "; }
            else{
                echo"</tr>" ;
            }

            echo"</table>";



        


    


} }// end of list form


        
        ?>
<?php
if( isset($_SESSION['admin']) && $_SESSION['admin']==1){// admin
echo"<hr/> 
<center><h> <b>Ajouter une nouvel pièce :</b></h></center>
 <h> <center> <a href='addpiece.php'> <img src="?>'photo\add.png' <?php echo" width='124px' height='60px' ></a></center></h>
  <center><h>Ce champ appartient à l'administrateur</h></center><hr/> ";

} ?>



        

    </section>



    <hr/>

    <section>
        <p style="font-size:xx-large">
            <center>
                À votre souris et bon voyage sur <a href="home.php">MaisonDuTapis.com</a>
            </center>
        </p>
    </section>

    <section id="end">

        <table>
            <tr>
                <td>
                    <a href="tel:+961 71180632"> <img src="photo\phone.jpg " width='65px' hight='65px'> <br /></a>
                    <h1 style="font-size: medium; font-family:cursive;margin: 0;"><i> Conseil et vent </i><br />

                        <small> +961 71180632 </small>
                    </h1>



                </td>

                <td>
                    <a href="retours.php"> <img src="photo\retours.jpg " width='56px' hight='56px'> <br /></a>
                    <h1 style="font-size: medium; font-family:cursive; margin: 0;"><i> Retours gratuits</i><br />

                        <small>pandant 30 jours </small>
                    </h1>


                </td>
                <td>
                    <a href="livraison.php"> <img src="photo\livraison.jpg " width='100px' hight='100px'> <br /></a>
                    <h1 style="font-size: medium; font-family:cursive; margin: 0;"><i> Livraison gratuite</i><br />

                        <small> en magasin </small>
                    </h1>

                </td>

            </tr>
        </table>

    </section>

    <section>

        <p>
            <center>
                <b>
                    <center>De puis 2010 <h style="color: brown;"> MaisonDuTapis.com</h>, spécialiste en tapis design
                </b>
            </center>
            <center>
                MaisonDuTapis.com est un magasin en ligne spécialisé dans la vente de tapis design, tapis contemporains,
                tapis
                enfants<br /> et paillassons.
                Vous découvrirez un très large choix de tapis, soigneusement sélectionnés par notre
                équipe<br /> d’acheteurs professionnels. Des quatre coins du monde, nous dénichons pour vous des
                tapis<br />
                uniques et
                de qualité afin que vous soyez toujours dans les tendances.<br />

                Dans le but de vous aider le plus efficacement possible dans le choix de votre tapis,<br /> des conseils
                vous sont
                fournis par des spécialistes en décoration d’intérieur dans<br /> le but de créer une harmonie dans
                chacune
                des
                pièces de votre habitation.<br /> Que vous recherchiez un tapis de salon, un tapis de chambre<br /> ou
                un
                tapis de
                couloir, <br /> <b style="font-size: 14px;"> <tt> vous y trouverez celui qui fera toute la différence !
                </b> </tt></center>
        </p>
    </section>
    <hr color="brown" size="2px" />

    <section id="fb">
        <table>
            <tr>
                <td>
                    <table>
                        <caption style="float: left;">
                            <center> <big>Modes de paiement</big></center>
                        </caption>
                        <tr>
                            <td> <a href="https://visa-cart.com/"> <img src="photo\visa.webp" width='50px'
                                        hight='50px'></a>
                                <a href="https://www.paypal.com/lb/home"><img src="photo\paypal.webp" width='50px'
                                        hight='50px'></a>

                                <a href="https://www.mastercard.us/en-us.html"> <img src="photo\mastercard.webp"
                                        width='50px' hight='50px'></a>
                            </td>
                        </tr>
                    </table>

                </td>
                <td>

                    <table>

                        <caption style="float: left;">
                            <center> <big> Suivez-nous sur les réseaux !</big></center>
                        </caption>
                        <tr>
                            <td> <a href="https://m.facebook.com/carpetsinlebanon/"><img src="photo\fb.webp"
                                        width='50px' hight='50px'></a>
                                <a href="https://www.instagram.com/lartisandutapis/?hl=en"> <img src="photo\insta.webp"
                                        width='50px' hight='50px'></a>
                            </td>

                        </tr>
                    </table>

                </td>

                <td>

                    <table>

                        <caption style="float: left;">
                            <center> <big> Contactez nous !</big></center>
                        </caption>
                        <tr>
                            <td> <a href=" https://wa.me/+961 71180632"><img src="photo\waths11.png" width='45px'
                                hight='45px'></a>
                    
                   <a href="mailto://maisondutapis@hotmail.com"><img src="photo\mail.png" width='45px'
                        hight='23px'></a></td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>
    </section>

</body>

<footer>
    <h>
        <center> © Maisons Du Tapis 2021 - Classement Référencement Offres - Aide et
            contact - Plan du site - Crédits et mentions légales - Données personnelles - Politique cookies </center>
    </h>



</footer>

</html>