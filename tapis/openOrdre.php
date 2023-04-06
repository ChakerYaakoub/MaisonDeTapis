<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['admin'])|| $_SESSION['admin']==false ||$_SESSION['admin']==1||$_SESSION['admin']==2){//  .. dhhhar
    
    header("location:compte.php") ;
    die();}
?>

<html>

<head>
    <title> Open Ordre </title>
    <meta charset="utf-8">
    <meta name="description" content="maison de tapis ">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="searchcss1.css">
    <link rel="stylesheet" href="home.css">


    
    <script src="pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
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


    <section class="panier" id="invoice">

    <?php
    if( empty($_GET['OrderIdUser'] )) {
        $_page=$_SERVER["HTTP_REFERER"] ; 
        header('refresh:3 ; url= '.$_page) ;
       echo" <center>
        <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' >OrderIdUser est manquante</b>
    </center>" ;
    die () ; }

    $OrderIdUser=$_GET['OrderIdUser'] ;


    $con=mysqli_connect("localhost" ,"root", "", "tapis") ;

if(!$con)  {
   header('refresh:2;url=addpiece.php');
   echo" <center>
   <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  > problème de connexion de données</b>
</center>" ;
die () ;

  }

    
$sql=" select* from OrderUser where OrderIdUser='$OrderIdUser'" ;
$result=mysqli_query($con,$sql) ;

// if retutne errer alor on a a syntax error in the query :

if(!$result)  {  $_page=$_SERVER["HTTP_REFERER"] ; 
 header('refresh:3 ; url= '.$_page) ;
     echo" <center>
    <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Problème d'exécution de requête! 7 </b>
</center>" ;
die () ; }
$row=mysqli_fetch_assoc($result);
$UOrderDone=$row['UOrderDone'];

    ?>


    
     <center>
        <table style="width: 97%; border:0; margin-right:40px;">
            <tr>
                <td style=" border:0; "> 
                   <center><img src="photo/brand.png"  width="150px" height="150px"></center> 
                </td>
                <td style=" border:0;">
                  <center> <h style='font-size: 30px;
            
            line-height: normal;    color: black;
             '>Facture d'achat </h><h style='font-size: 30px;
            
            line-height: normal;    color: #ca1c72;
             '> <center> Ordre numéro  '' <?php echo $row['OrderIdUser'] ;?> ''</center>  </h></center> 
                </td>
                <td style=" border:0;">
                   <center> <b>date:</b> <?php echo(strftime("%m/%d/%Y")); ?></center>  
                </td>
            </tr>
        </table></center>
            
          

      <center> <table style="width: 65%; ">
        <caption> <br> <b style="color: rgb(61, 33, 33); letter-spacing:4px;">  ADRESSE  DE  LIVRAISON <br> <br></b></caption>
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
              
        
   $sql=" select *  from OrderTapis where OrderIdTapis='$OrderIdUser' " ;
   $result=mysqli_query($con,$sql) ;
   if(!$result)  { $_page=$_SERVER["HTTP_REFERER"] ; 
    header('refresh:3 ; url= '.$_page) ;
        echo" <center>
       <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Problème d'exécution de requête!  </b>
   </center>" ;
   die () ;}
   
   if(mysqli_num_rows($result)==0) {
    echo" <center>somthing wrong  </center> <br>";

}else{

    
echo"
<center>
    <table style='width:88%;'>
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
echo"</table > </center> <br>";


echo"
<center>
    <table style='border: 0; width: 90%; margin-left: 115px;padding-right: 20px; '>
        <tr>
            <td style='border: 0; width: 46%;'>
                Votre score/points : <b> ".$UserPoint." points</b> <br>
                Vous gagnez <b>".$Allpoint." points </b> en commandant ces produits . <br>La livraison : <b>3$</b> pour chaque produit " ;
                
                if($UserPoint>=100 || $Allpoint>=100 ) {
                    echo"  Félicitations..
                <b>Livraison gratuite</b> de votre commande et vous recevrez un <b>cadeau</b> à la livraison .. </td>";
                } 


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

</td>
</tr>

</table></center> <br><br>
";
echo"  <br><center><table style='border:0; width:90%;'><tr><td style='border:0;padding-top:20px;'> <img src='photo/sig.png'  width='300px' height='100px'>
";

 echo"</td><td style='border:0; padding-left:15% ;padding-bottom:20px;'>";

echo" <br><table style='width: 100%; '>
<tr>
    <td style='color: black;'>
        <center>
            <b>La signature du destinataire</b> 
        </center>
    </td>
</tr>

<tr>
    <td> <br>
        <center>
       <b>......................................</b> 
        </center> <br>
    </td>
</tr>
</table>"; 
echo"</td></tr></table> </center>";


echo" <center><h1 style='font-family: Valentine; color: #490d2b;'> Merci de votre confiance en nos produits</h1></center>";
echo" <center style='color: #777;'>© Maisons Du Tapis 2021 -  Aide et contact/ Téléphone : 096171180632 - Courriel : MaisonDuTapis@hotmail.com </center> ";





}

        
        ?></section class="panier"> <hr> <br>

        <section>
            <table style="width:100%; ">
                <tr>
                    <td>
                        <?php
                        if($UOrderDone==0) {
    echo"
    <table style='width: 70%; border:solid 1pt #d6d4d4; margin-left:20px; '>
        <tr>
            <td style='color: black; border:solid 1pt #d6d4d4;'>
                <center> 
                    <b>Confirmer le processus de livraison</b> 
                </center>
            </td>
        </tr>

        <tr>
            <td border:solid 1pt #d6d4d4;>
                <center>
                    <a href='openOrdre.php?OrderIdUser=$OrderIdUser'><img src='photo/0.png' width='50px' height='50px'></a> 
                    <a href='ordreDOne.php?UOrderDone=1&OrderIdUser=$OrderIdUser'> <img src='photo/1.png' width='50px' height='50px'></a>
                </center>
            </td>
        </tr>
        <tr>
            <td style='color:#490d2b; border:solid 1pt #d6d4d4;'>
                <center> <b > Pas encore livré .. ✖ </b> </center>
            </td>
        </tr>
    </table>
";
}else{
    echo"
    <table style='width: 70%; border:solid 1pt #d6d4d4; margin-left:20px;  '>
        <tr>
            <td style='color: black; border:solid 1pt #d6d4d4;'>
                <center> 
                    <b>Confirmer le processus de livraison</b> 
                </center>
            </td  >
        </tr>

        <tr>
            <td style=' border:solid 1pt #d6d4d4;'>
                <center>
                <img src='photo/1.png' width='50px' height='50px'>
                </center>
            </td>
        </tr>
        <tr>
            <td style='color: #ca1c72;  border:solid 1pt #d6d4d4;'>
                <center> <b> Le produit a été livré avec succès ✔ </b></center>
            </td>
        </tr>
    </table>
";


}
                        
                        ?>
                    </td>
                    <td style='padding-left:18%;'>
                    <br>
    <center > <b style='color:#7e1d42;'> Imprimer ces informations au  pdf format:</b> <br> <br><button class="btn btn-primary" id="download" style='    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;color:white; background-color:#2196f3;'> download pdf</button></center> 
    <br>
                    </td>
                </tr>
            </table>
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