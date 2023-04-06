<!DOCTYPE html>
<?php
session_start();
if(!isset($_POST['submit']) ){   header("location:panier.php") ;}

if(!isset($_SESSION['admin'])){
    
    echo" <center>
    <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Vous devez de connecter d'abord </b>
</center>" ;
    header('refresh:2;url=compte.php');
    die(); }
?>

<html>

<head>
    <title> commande confirmée </title>
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


    <section class="panier">

    <?php
     
     if(!isset($_SESSION['admin'])){
    
        echo" <center>
        <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Vous devez de connecter d'abord </b>
    </center>" ;
        header('refresh:2;url=compte.php');
        die(); }

        if(empty( $_POST['codePostal']) || empty( $_POST['nom'])|| empty( $_POST['prenom'])
 || empty( $_POST['tel']) || empty( $_POST['addresse'])|| empty( $_POST['ville'])|| empty( $_POST['pays'])|| empty( $_POST['numCarte'])) {
    $_page=$_SERVER["HTTP_REFERER"] ; 
       header('refresh:3 ; url= '.$_page) ;
   echo" <center>
    <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' >Vous devez remplir toutes les informations requises</b>
</center>" ;
die () ; }

if(!empty($_POST['addresse2'])) {
    $addresse2=$_POST['addresse2'] ;
} else{
    $addresse2= 'pas';
}
$codePostal=$_POST['codePostal'] ;

$nom=$_POST['nom'] ;
$prenom=$_POST['prenom'] ;
$tell=$_POST['tel'] ;
$addresse=$_POST['addresse'] ;
$ville=$_POST['ville'] ;
$pays=$_POST['pays'] ;
 
$con=mysqli_connect("localhost" ,"root", "", "tapis") ;

if(!$con)  {
    $_page=$_SERVER["HTTP_REFERER"] ; 
    header('refresh:3 ; url= '.$_page) ;
   echo" <center>
   <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  > problème de connexion de données</b>
</center>" ;
die () ; }

$addresse= mysqli_real_escape_string($con,$addresse);
$tell= mysqli_real_escape_string($con,$tell);
$prenom= mysqli_real_escape_string($con,$prenom);
$nom= mysqli_real_escape_string($con,$nom);
$codePostal= mysqli_real_escape_string($con,$codePostal);
$ville= mysqli_real_escape_string($con,$ville);
$pays= mysqli_real_escape_string($con,$pays);
$addresse2= mysqli_real_escape_string($con,$addresse2);
$OuserId=$_SESSION['userId'];


$sql=" insert into OrderUser(OuserId,nom,prenom,tell,addresse,addresse2,ville,pays,codePostal) 
values('$OuserId','$nom','$prenom','$tell','$addresse','$addresse2','$ville','$pays','$codePostal')" ;

$result=mysqli_query($con,$sql) ;

// if retutne errer alor on a a syntax error in the query :

    if(!$result)  { $_page=$_SERVER["HTTP_REFERER"] ; 
        header('refresh:3 ; url= '.$_page) ;
         echo" <center>
        <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Problème d'exécution de requête! 1 </b>
    </center>" ;
    die () ;
    } 
 
    $sql=" select max(OrderIdUser)  from OrderUser  " ;

    $result=mysqli_query($con,$sql) ;
  
    if(!$result)  {  $_page=$_SERVER["HTTP_REFERER"] ; 
        header('refresh:3 ; url= '.$_page) ;
         echo" <center>
        <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Problème d'exécution de requête! 2 </b>
    </center>" ;
    die () ;
    } 
    
   
     $row=mysqli_fetch_assoc($result);
     $OrderIdUser=$row['max(OrderIdUser)'] ;

     
   $sql=" select *  from panier,tapis,user where userId=CuserId and IdTapis=CIdTapis and CuserId='".$_SESSION['userId']."'" ;
   $result1=mysqli_query($con,$sql) ;
   if(!$result)  { $_page=$_SERVER["HTTP_REFERER"] ; 
    header('refresh:3 ; url= '.$_page) ;
        echo" <center>
       <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Problème d'exécution de requête! 3  </b>
   </center>" ;
   die () ;}
   

   
   for($i=0;$i<mysqli_num_rows($result1); $i++){
    $row=mysqli_fetch_assoc($result1);
    if($row['stock']>=$row['quantite']){

    $OrderIdTapis=$OrderIdUser;
    $IdTapis=$row['IdTapis'] ;
    $userId=$_SESSION['userId'] ;
    $mark=$row['mark'] ;  $mark= mysqli_real_escape_string($con,$mark);
    $piece=$row['piece'] ; $piece= mysqli_real_escape_string($con,$piece);
    $titre=$row['titre'] ; $titre= mysqli_real_escape_string($con,$titre);
    $color=$row['color'] ;$color= mysqli_real_escape_string($con,$color);
    $origine=$row['origine'] ;$origine= mysqli_real_escape_string($con,$origine);
    $ext=$row['ext'] ;$ext= mysqli_real_escape_string($con,$ext);
    $longueur=$row['longueur'] ;
    $largeur=$row['largeur'] ;
    $prix=$row['prix'] ;
    $prixReduit=$row['prix']-($row['prix']*$row['reduit']/100);
    $quantite=$row['quantite'] ;
    $point=$row['point'];
    $livraison=$row['quantite']*3 ;
    $total =$prixReduit*$quantite;
    $Newstock=$row['stock']-$quantite ;
    $Newnbpoint=$row['nbpoint']+($quantite*$row['point']) ;

    
  // write a qwery 
$sql=" insert into OrderTapis (OrderIdTapis,IdTapis,userId,piece,titre,
mark,prix,prixReduit,origine,color,longueur,largeur,quantite,livraison,total,ext,point) 
values('$OrderIdTapis','$IdTapis','$userId','$piece','$titre',
'$mark','$prix','$prixReduit','$origine','$color','$longueur','$largeur','$quantite','$livraison','$total','$ext','$point') " ;

$result=mysqli_query($con,$sql) ;

// if retutne errer alor on a a syntax error in the query :

   if(!$result)  { $_page=$_SERVER["HTTP_REFERER"] ; 
    header('refresh:3 ; url= '.$_page) ;
        echo" <center>
       <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Problème d'exécution de requête! 4</b>
   </center>" ;
   die () ;
   } 

   
   $sql=" update user set nbpoint='$Newnbpoint'where userId='$userId' " ;
   $result=mysqli_query($con,$sql) ;

// if retutne errer alor on a a syntax error in the query :

   if(!$result)  {  $_page=$_SERVER["HTTP_REFERER"] ; 
    header('refresh:3 ; url= '.$_page) ;
        echo" <center>
       <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Problème d'exécution de requête! 5</b>
   </center>" ;
   die () ;
   } 

   $sql=" update tapis set stock='$Newstock'where IdTapis='$IdTapis' " ;
   $result=mysqli_query($con,$sql) ;

// if retutne errer alor on a a syntax error in the query :

   if(!$result)  {  $_page=$_SERVER["HTTP_REFERER"] ; 
    header('refresh:3 ; url= '.$_page) ;
        echo" <center>
       <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Problème d'exécution de requête! 6 </b>
   </center>" ;
   die () ;
   }

if($Newstock==0){
    $sql=" delete from panier where CIdTapis='$IdTapis'" ;


// for execute the query "sql" from the connection "con"
$result=mysqli_query($con,$sql) ;

// if retutne errer alor on a a syntax error in the query :

   if(!$result)  {    $_page=$_SERVER["HTTP_REFERER"] ; 
    header('refresh:3 ; url= '.$_page) ;
        echo" <center>
       <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Problème d'exécution de requête! </b>
   </center>" ;
   die () ;
   } 
}} }
   $userId=$_SESSION['userId'] ;

   $sql=" delete from panier where CuserId='$userId' " ;
   $result=mysqli_query($con,$sql) ;

// if retutne errer alor on a a syntax error in the query :

   if(!$result)  {  $_page=$_SERVER["HTTP_REFERER"] ; 
    header('refresh:3 ; url= '.$_page) ;
        echo" <center>
       <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Problème d'exécution de requête! 7 </b>
   </center>" ;
   die () ;



}
$OuserId=$_SESSION['userId'] ;// htmmml

$sql=" select* from OrderUser where OrderIdUser='$OrderIdUser' and OuserId='$OuserId'" ;
   $result=mysqli_query($con,$sql) ;

// if retutne errer alor on a a syntax error in the query :

   if(!$result)  {  $_page=$_SERVER["HTTP_REFERER"] ; 
    header('refresh:3 ; url= '.$_page) ;
        echo" <center>
       <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Problème d'exécution de requête! 7 </b>
   </center>" ;
   die () ; }
   $row=mysqli_fetch_assoc($result);
   
    
    ?>

    
<br> <br> <br> <br>  <center><h style='font-size: 30px;
            
            line-height: normal;    color: #ca1c72;
             '>Votre demande a été enregistrée avec succès </h></center> <br>
          <center><h>Date approximative de livraison avec ce transporteur est entre 5-6 jours </h></center>  <br>

      <center> <table style="width: 65%; ">
        <caption> <b style="color: rgb(61, 33, 33);"> VOTRE ADRESSE DE LIVRAISON <br></b></caption>
            <tr>
                <td style="color: rgb(20, 16, 16);">
                   <b>Prénom :</b> <?php echo $row['prenom'] ;?>
                </td>
                <td style="color: rgb(20, 16, 16);">
                     <b>Nom  :</b> <?php echo $row['nom'] ;?>
                </td>
            </tr>
            <tr>
                <td style="color: rgb(20, 16, 16);">
                   <b>Téléphone :</b> <?php echo $row['tell'] ;?>
                </td>
                <td style="color: rgb(20, 16, 16);">
                     <b>Adresse  :</b> <?php echo $row['addresse'] ;?>
                </td>
            </tr>
            <tr>
                <td style="color: rgb(20, 16, 16);">
                   <b>Adresse (2) :</b> <?php echo $row['addresse2'] ;?>
                </td>
                <td style="color: rgb(20, 16, 16);">
                     <b>Code postal  :</b> <?php echo $row['codePostal'] ;?>
                </td>
            </tr>
            <tr>
                <td style="color: rgb(20, 16, 16);">
                   <b>Pays :</b> <?php echo $row['pays'] ;?>
                </td>
                <td style="color: rgb(20, 16, 16);">
                     <b>Ville  :</b> <?php echo $row['ville'] ;?>
                </td>
            </tr>
           
           
           
        </table> </center> <br> <center><b>Date de la demande :</b> <?php echo $row['DateUser'] ;?> </center><br>

        <?php

$sql=" select *  from user where  userId='".$_SESSION['userId']."'" ;
$result=mysqli_query($con,$sql) ;
if(!$result)  { $_page=$_SERVER["HTTP_REFERER"] ; 
 header('refresh:3 ; url= '.$_page) ;
     echo" <center>
    <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Problème d'exécution de requête!  </b>
</center>" ;
die () ;}
$row=mysqli_fetch_assoc($result);

$UserPoint=$row['nbpoint'] ;




        
        
   $sql=" select *  from OrderTapis where OrderIdTapis='$OrderIdUser'  and userId='".$_SESSION['userId']."'" ;
   $result=mysqli_query($con,$sql) ;
   if(!$result)  { $_page=$_SERVER["HTTP_REFERER"] ; 
    header('refresh:3 ; url= '.$_page) ;
        echo" <center>
       <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Problème d'exécution de requête!  </b>
   </center>" ;
   die () ;}
   

  

   if(mysqli_num_rows($result)==0) {
       echo" <center>somthing wrong  </center> <br>";

} else{


echo"
   <center>
       <table>
           <tr>
               <th>Produit</th>
               <th>Description</th>
               <th>Marque</th>
               <th>Origine</th>
               <th>Prix unitaire</th>
               <th>Quantité</th>
               <th>Total</th>
                </tr>";

               $ALLToTal=0;
               $Allquantite=0 ;
               $Allpoint=0;
               $livraison=0 ;


   for($i=0;$i<mysqli_num_rows($result); $i++){
    $row=mysqli_fetch_assoc($result);
    
       echo"<tr>";
       echo" <tr>
       <td style='    -webkit-text-size-adjust: 100%;
       -webkit-tap-highlight-color: transparent;
       border-collapse: collapse;
       border-spacing: 0;
       text-align: center;
       color: #777;
       width: 98px;
       aspect-ratio: auto 98 / 98;
       height: 98px;
       box-sizing: border-box;
       margin: 0;
       padding: 0;
       font: inherit;
       font-size: 100%;
       vertical-align: middle;
       border: 1px solid #756767;'>
       <a href='form.php?IdTapis=".$row['IdTapis']."'><img src=";?>'imagesTapis/<?php echo $row['IdTapis'].".".$row['ext']."' width='100px' length='100px'></a>  

       </td>";

       echo" <td>
       <a href='form.php?IdTapis=".$row['IdTapis']."'>
       <center>
           <b> <small>
                   <h style='color: rgb(31, 27, 27);'>".$row['titre']."</h>
               </small></b> </a> <br>
           <small> Coloris : ".$row['color']." </small><br>
           <small> Dimensions : ".$row['longueur']."x".$row['largeur']." cm</small>
       </center> 

   </td>";


   echo"  <td style='padding-bottom: 25px;'>
   <center><small>
           <h style='color: white; background-color: #a1c330; '>".$row['mark']."</h>
       </small></center>
</td> ";
echo"  <td style='padding-bottom: 25px;'>
<center><small>
        <h style='color: white; background-color: #a1c330; '>".$row['origine']."</h>
    </small></center>
</td> ";

$reduit=$row['prixReduit'];

if($reduit<$row['prix']){

echo" <td>
<center>
    <small> Prix conseillé : <strike> ".$row['prix']." $</small> </strike> <br>
    <big>
        <h style='color: #d12463;'><b> ".$reduit."  $</b> </h>
    </big>
</center>
</td>
"; }else{ echo"  <td>
    <center>
        
        <big>
            <h style='color: #d12463;'><b> ".$row['prix']."  $</b> </h>
        </big>
    </center>
    </td>";}
echo"
<td>
    <center>
    ".$row['quantite']."
    </center>

</td>";
$total=$row['total'];

echo"<td>
<center>
    <h style='color: #d12463;'><b>".$total." $</b> </h>
</center>
</td>";


$ALLToTal=$ALLToTal+$total;
$Allquantite=$Allquantite+$row['quantite'] ;
$Allpoint=$Allpoint+$row['point']*$row['quantite'];
$livraison=$livraison+$row['livraison'] ;




     
   } 
   echo"</table> </center> <br>";
   

   echo"
   <center>
       <table style='border: 0; width: 90%; margin-left: 120px;padding-right: 20px; '>
           <tr>
               <td style='border: 0; width: 46%;'>
                   Votre score/points : <b> ".$UserPoint." points</b> <br>
                   Vous gagnez <b>".$Allpoint." points </b> en commandant ces produits que vous pourrez convertir en bon d'achat. <br> " ;
                   
                   if($UserPoint>=100 || $Allpoint>=100 ) {
                       echo"  Félicitations..
                   <b>Livraison gratuite</b> de votre commande et vous recevrez un <b>cadeau</b> à la livraison .. </td>";
                   } else{ echo"Cumulez 100 points pour bénéficier de la <b>livraison gratuite</b> sur toutes vos commandes et
                   des nombreux <b>cadeaux</b> 
                  

                   </td> 
                   
                   
                   ";}
                   


                   if($Allpoint >= 100 || $UserPoint >=100 ) {
                    $livraison=0;}
                  

                    if($Allpoint >= 100 || $UserPoint>=100 ){
                        echo" <td style='border: 0; '>
                   <table style='    background: #fbfbfb;'>
                       <tr>

                           <td style='text-align: right; color: black; '>
                               <b>Total frais de port (TTC) :</b>
                           </td>
                           <td style='width: 124px;'>
                               <b> <center>Livraison offerte !</center> </b>

                           </td>
                       </tr> ";
                    } else{
                        echo" <td style='border: 0; '>
                   <table style='    background: #fbfbfb;'>
                       <tr>

                           <td style='text-align: right; color: black; '>
                               <b>Total frais de port (TTC) :</b>
                           </td>
                           <td style='width: 124px;'>
                               <center>".$livraison."$</center>

                           </td>
                       </tr> ";

                    }
                   
                   
                 


               
              
                       $ALLToTal=$ALLToTal+$livraison;

                       echo"
                       <tr>
                           <td style='text-align: right; padding-top: 20px; padding-bottom: 20px;  '>
                               <b><big>Total</big></b>
                           </td>
                           <td style='background-color: white;'>
                               <center>
                                   <h style='color: #d12463;'><b>".$ALLToTal." $</b></h>
                               </center>

                           </td>
                       </tr>
                   </table>
   </center>
   </td>
   </tr>
  
   </table>
"; }


echo" <br> <br> <br><center>
<table>
<tr>
 <td>
     <form action='pieces.php' method='GET'>
     <input type='number' name='IdTapis'   hidden>

         <input type='submit' value='Continuer mes achats '  style='width: 100%; font-weight: 400;
         font-size: 24px;
         line-height: 24px;
         padding: 10px 0;
         color: #fff;
         font-family: oswald,sans-serif;
         display: block!important;
         -moz-transition: all .3s ease;
         -o-transition: all .3s ease;
         -webkit-transition: all .3s ease;
         transition: all .3s ease; background-color: #6d6d6d;'>
     </form>
 </td>
 <td>
     <form action='commandes.php' method='GET'>
         <input type='submit' value='l’historique / commandes'  style='width: 100%; font-weight: 400;
         font-size: 24px;
         line-height: 24px;
         padding: 10px 0;
         color: #fff;
         font-family: oswald,sans-serif;
         display: block!important;
         -moz-transition: all .3s ease;
         -o-transition: all .3s ease;
         -webkit-transition: all .3s ease;
         transition: all .3s ease;background-color: #a1c330;'>
     </form>
 </td>
</tr>
</table> </center>
<br><br>
";
        
        ?>





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