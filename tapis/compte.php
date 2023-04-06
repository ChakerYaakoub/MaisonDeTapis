<!DOCTYPE html>
<?php
session_start();
?>
<html>

<head>
    <title> compte </title>
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


    <section class="compte" style="font-family:Arial,sans-serif;; margin: 20px;  background-image: url(photo/bbbbb1.jpg) ; ">
    <?php

    if(!isset($_SESSION['admin'])){

        echo"


    

        <table style='width: 100%;'>
            <tr>
                <td>
                    <form method='POST' action='logintapis.php' style='height: 100%;'>
                        <fieldset>
                            <table>
                                <tr>
                                    <td style='font-size: 20px; font-weight:lighter;'> Déjà client ?</td>
                                </tr>
                                <tr>
                                    <td>Connectez-vous ici pour poursuivre votre shopping!</td>
                                </tr>
                                

                                <tr>
                                    <td> <center> <input type='submit' name='connecter' value='connecter'
                                            style='background-color: rgb(88, 66, 66) ;color: aliceblue; width: 209px;height: 25px; ;margin: 12px; margin-left: 0;' />
                                   </center> </td>
                                </tr>
                            </table>
                        </fieldset>
                    </form>
                </td>


                <td style='float: right;'>
                    <form method='POST' action='register.php' style='float: right; height: 100%;'>
                        <fieldset>
                            <table>
                                <tr>
                                    <td style='font-size: 20px; font-weight:lighter;'>Nouveau client ?</td>
                                </tr>
                                <tr>
                                    <td>
                                        Pour votre shopping deco, vous pouvez compter sur votre compte !


                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        Retrouvez les informations de votre commande
                                    </td>
                                    <td>   <img src="?>"photo\r1.png" <?php echo" width='25px' height='25px'></td>
                                </tr>
                                <tr>
                                    <td>
                                        Accédez à nos ventes privées & restez informé de nos bons plans

                                    </td>
                                    <td> <img src="?>'photo\r2.png' <?php echo" width='25px' height='25px'> </td>
                                </tr>
                                <tr>
                                    <td>
                                        <center><input type='submit' name='button' value='Creer mon compte'
                                                style='background-color: rgb(88, 66, 66) ;color: aliceblue; width: 209px;height: 25px; margin: 16px;margin-bottom: 0;' />
                                        </center>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </form>

                </td>


            </tr>
        </table> 
       " ; }
       

       else{

        require('configtapis.php');
        $sql=" select *  from user where userId=".$_SESSION['userId'];
        $result=mysqli_query($con,$sql) ;

      
        
            if(!$result)  { header("refresh:2") ; 
                 echo" <center>
                <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Problème d'exécution de requête! </b>
            </center>" ;
            die () ;
            } 

            $row=mysqli_fetch_array($result) ;

           echo"   </br><center>
           <p style='font-family: Valentine;font-weight: 400;font-size:xx-large; margin-bottom:20px;'> Bonjour ".$row['prenom']." </p>
       </center>" ;
           echo" <center ><ins><a href='logouttapis.php' > <h style='background-color: black; color: #f8d3d3;'> Me déconnecter </h></a> </ins> </center> </br>" ;
           if($_SESSION['admin']==1 ){
            echo" 
            <form action='searchId.php' method='GET'>
    <table style='width:27%; margin-left: 70%; font-family: Valentine;'><tr >
     <td></td>
     <td style=' border: solid 1pt black; background-color: rgb(212, 190, 165);'> <b> <center>Trouver une pièce à l'aide IdTapis:</center> </b> 
     <h><center>
         <input type='number' name='IdTapis' style='width: 25%;' min='0' required>
     <input type='submit' value='search'></center> </h>
     <center>Ce champ appartient à l'administrateur</center>
     </td></tr></table></form>";}
     if($_SESSION['admin']==2){
         echo"   <form action='ventes.php' method='GET'>
         <table style='width:26%; margin-left: 70%;font-family: Valentine;'><tr >
          <td></td>
          <td style=' border: solid 1pt black; ;'> <b> <center>Aperçu des ventes :</center> </b> 
          <h><center>
             <input type='submit' value='L’historique des Ventes '  style='width: 68%; font-weight: 8;color:white;
             font-size: 16px;
             line-height: 16px;
             padding: 4px 0;
             color: #fff;
             font-family: oswald,sans-serif;
             display: block!important;
             -moz-transition: all .3s ease;
             -o-transition: all .3s ease;
             -webkit-transition: all .3s ease;
             transition: all .3s ease;background-color: #a58695;'> </center> </h>
          <center> Ce champ appartient à le commerçant</center>
          </td></tr></table></form>";
     }

     if($_SESSION['admin']==3){
         echo"  <form action='ordres.php' method='GET'>
         <table style='width:23%; margin-left: 70%;font-family: Valentine;'><tr >
          <td></td>
          <td style=' border: solid 1pt black; '> <b> <center>Les ordres des clients:</center> </b> 
          <h><center>
             <input type='submit' value='Outiles de lister les ordres'  style='width: 88%; font-weight: 8;color:white;
             font-size: 16px;
             line-height: 16px;
             padding: 4px 0;
             color: #fff;
             font-family: oswald,sans-serif;
             display: block!important;
             -moz-transition: all .3s ease;
             -o-transition: all .3s ease;
             -webkit-transition: all .3s ease;
             transition: all .3s ease;background-color: #a58695;'>
              
          <center>Ce champ appartient à le livreur</center>
          </td></tr></table></form>
 ";
     }

     
    
    
        
           
           echo" <br> <form action='commandes.php' method='GET' style='margin-left:20px;'>
           <input type='submit' value='L’historique de mes commandes'  style='width: 24%; font-weight: 10;
           font-size: 16px;
           line-height: 16px;
           padding: 10px 0;
           color: #fff;
           font-family: oswald,sans-serif;
           display: block!important;
           -moz-transition: all .3s ease;
           -o-transition: all .3s ease;
           -webkit-transition: all .3s ease;
           transition: all .3s ease;background-color: #a58695;'>
       </form>  <br>";
    
           echo" <h style=' margin-left:16px;font-size:large; ' ><b> Votre informations personnelles</b></h>";
         

           echo"
           <table> 
    <tr> <td>

<table style='width: 100%; height: 180px; border-bottom: 0 ;text-align: left; font-family:Valentine ;font-weight: 400; margin:10px;'>
    <tr>
        <td style=' border: solid 1pt black;'> <b>Prénom :</b>".$row['prenom']."</td>
        <td style=' border: solid 1pt black;''> <b>Adresse :</b>  ".$row['addresse']."</td>
        <td style=' border: solid 1pt black;'> <b>Points gagnes :</b> ".$row['nbpoint']."</td>
    </tr>
    <tr>
        <td style='border: solid 1pt black;'> <b>Nom :</b>".$row['nom']."</td>
        <td style=' border: solid 1pt black;'> <b>Nméro de la maison :</b>".$row['nbmaison']."</td>
        
    </tr>
    <tr>
        <td style=' border: solid 1pt black;'> <b>Gender :</b>".$row['gender']."</td>
        <td style=' border: solid 1pt black;'> <b>Téléphone:</b>".$row['tel']."</td>
        
    </tr>
    <tr>
        <td style=' border: solid 1pt black;'> <b>Email :</b>".$row['email']."</td>
        
        

    </tr>
    </tr> <td> </td></tr> </tr> <td> </td></tr> </tr> <td> </td></tr>
    "; if($_SESSION['admin']==1 ) echo"
   
     <tr >
     <td style=' border: solid 1pt black; background-color: rgb(212, 190, 165);'> <b> Ajouter un nouvel administrateur:</b> </br>
     <h><center><ins><a href='registeradmin.php?admin=1' >ADD ADMIN</a> </ins> </center> </h>
     Ce champ appartient à l'administrateur</td>
     <td style=' border: solid 1pt black; background-color: rgb(212, 190, 165);'> <b> Ajouter une nouvel pièce :</b> </br>
     <h><center><ins><a href='addpiece.php' >ADD PIÈCE</a> </ins> </center> </h>
     Ce champ appartient à l'administrateur</td>
     
     </tr>
     <td style=' border: solid 1pt black; background-color: rgb(212, 190, 165);'> <b> Ajouter un nouvel commerçant:</b> </br>
     <h><center><ins><a href='registeradmin.php?admin=2' >ADD COMMERCANT</a> </ins> </center> </h>
     Ce champ appartient à l'administrateur</td>
     <tr>


     </tr>
    
    ";
    if($_SESSION['admin']==2 ) echo" <tr>   <td style=' border: solid 1pt black;;'> <center> <b> Ajouter un nouvel Livreur:</b> </center> 
    <h><center><a href='registerlivreur.php?admin=3' style='width: 68%; font-weight: 8;
    font-size: 16px;
    line-height: 16px;
    padding: 4px 0;color: #fff;
    border: solid 1pt black;
    font-family: oswald,sans-serif;
    display: block!important;
    -moz-transition: all .3s ease;
    -o-transition: all .3s ease;
    -webkit-transition: all .3s ease;
    transition: all .3s ease;background-color: #a58695;' >Add livreur </a> </center> </h>
     Ce champ appartient à le commerçant </td>
     </tr> ";

   
    echo"


</table>

   </td>
   
        <td style='padding-top:40px;'>
        Cumulez 100 points  <br>pour bénéficier de la livraison gratuite sur toutes <br> vos commandes  , des nombreux cadeaux <br> Et bien d'autres avantages</br>  

        </td>

</tr>
</table>
           
           
           ";

           echo"

         <center>  <img src= " ;?> "photo\i5.webp"<?php echo" width='150px' hight='150px'> </center>
            
                    <center> <b>SERVICE CLIENTÈLE PERSONNALISÉ</b></center>
                    <i>
                        <center>
                            
                            Nos conseillers sont toujours à votre écoute afin de comprendre au mieux vos besoins.Le
                            service clients vous renseigne, vous conseille, vous aide à passer commande et est à vos
                            côtés jusqu à la réception de votre commande.</center> </i> ";




       }?>
        

        




    </section>



    <hr />

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
                                        hight='23px'></a>
                            </td>
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