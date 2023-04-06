<!DOCTYPE html>
<?php
session_start();
if(!isset($_POST['submit']) ){   header("location:panier.php") ;}



?>

<html>

<head>
    <title> save compte  </title>
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


    <section>
        <?php 
        if(!isset($_SESSION['admin'])){
    
            echo" <center>
            <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Vous devez de connecter d'abord </b>
        </center>" ;
            header('refresh:2;url=compte.php');
            die(); }
        
        if(!isset($_POST['submit']) ){  header('url=pieces.php');}
         if(!isset($_SESSION['admin'])){
    
    echo" <center>
    <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Vous devez de connecter d'abord </b>
</center>" ;
    header('refresh:2;url=compte.php');
    die(); }

    if( empty($_POST['CuserId'] )||empty($_POST['CIdTapis'] )||empty($_POST['quantite'] )) {
    $_page=$_SERVER["HTTP_REFERER"] ; 
    header('refresh:3 ; url= '.$_page) ;
   echo" <center>
    <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' >Certaines informations sont manquantes</b>
</center>" ;
die () ; }

$CuserId=$_POST['CuserId'] ;
$CIdTapis=$_POST['CIdTapis'] ;
$quantite=$_POST['quantite'] ;


$con=mysqli_connect("localhost" ,"root", "", "tapis") ;

 if(!$con)  {
    $_page=$_SERVER["HTTP_REFERER"] ; 
    header('refresh:3 ; url= '.$_page) ;
    echo" <center>
    <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  > problème de connexion de données</b>
</center>" ;
die () ;}


$sql=" select *  from panier where CuserId='$CuserId' and CIdTapis='$CIdTapis'" ;


// for execute the query "sql" from the connection "con"
$result=mysqli_query($con,$sql) ;

// if retutne errer alor on a a syntax error in the query :

   if(!$result)  {  $_page=$_SERVER["HTTP_REFERER"] ; 
    header('refresh:3 ; url= '.$_page) ; 
        echo" <center>
       <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Problème d'exécution de requête! </b>
   </center>" ;
   die () ;
   } 

   if(mysqli_num_rows($result)==0) {
    $sql=" insert into panier(CuserId,CIdTapis,quantite) values('$CuserId','$CIdTapis', '$quantite')" ; 
}else{
    $row=mysqli_fetch_array($result) ;
    $quantite=$quantite+$row['quantite'] ;
    $sql=" select *  from tapis where IdTapis='$CIdTapis'" ;
    $result=mysqli_query($con,$sql) ;
    $result=mysqli_query($con,$sql) ;

// if retutne errer alor on a a syntax error in the query :

   if(!$result)  {  $_page=$_SERVER["HTTP_REFERER"] ; 
    header('refresh:3 ; url= '.$_page) ; 
        echo" <center>
       <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Problème d'exécution de requête! </b>
   </center>" ;
   die () ;
   } 
   $row=mysqli_fetch_array($result) ;
   if($row['stock']<$quantite){
    $_page=$_SERVER["HTTP_REFERER"] ; 
    header('refresh:5 ; url= '.$_page) ; 
        echo" <br><br><br><br><br><br><center>
       <b style=' background-color:red; color:white; font-size:24px;' >  (".$row['stock'].") pièces de ce produit sont en stock, et votre commande complète pour ce produit est de (".$quantite.")pièces, 
       nous ne pouvons donc pas répondre au nombre dont vous avez besoin,<br> Il n'y a pas assez de produits en stock. <br> désolé pour cela </b></center>" ;
   die () ;

   }
    
    $sql=" update panier set quantite='$quantite'where CIdTapis='$CIdTapis' and CuserId='$CuserId' " ;
}
$result=mysqli_query($con,$sql) ;

// if retutne errer alor on a a syntax error in the query :

   if(!$result)  { $_page=$_SERVER["HTTP_REFERER"] ; 
    header('refresh:3 ; url= '.$_page) ;
        echo" <center>
       <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Problème d'exécution de requête!  </b>
   </center>" ;
   die () ;
   } else{
       echo" <br> <br> <br> <br>  <center><h style='font-size: 30px;
       padding:30px;
       line-height: normal;    color: #ca1c72;
       margin-bottom: 22px; '>Produit ajouté au panier avec succès </h></center> <br> <br> ";

       echo"
       <center>
       <table>
    <tr>
        <td>
            <form action='form.php' method='GET'>
            <input type='number' name='IdTapis' value='$CIdTapis'  hidden>

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
            <form action='panier.php' method='POST'>
                <input type='submit' value='Valider  mon  panier  '  style='width: 100%; font-weight: 400;
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
   }


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