<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['admin'])){
    
    header("location:compte.php") ;
    die();
}
?>

<html>

<head>
    <title> login tapis </title>
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


    <section class="log">


  


<?php

if(!isset($_POST['submit'])) {//this page is requested for thr first time .


// variabl cookies for form "username"
    if(isset($_COOKIE['email'])) { // 3mlt hek l2n hateta lal form bi echo w if .. fa 7tyton hon

        $user=$_COOKIE['email'] ;
    }
      else{
        $user="" ;
             }
echo
"
<form method='POST' action='logintapis.php' style='height: 100%; padding:30px;'>
    <fieldset>
        <table style='margin:auto'>
           
            <tr>
                <td style='padding-top:20px;padding-bottom:10px; '>Connectez-vous ici pour poursuivre votre shopping!</td>
            </tr>
            <tr>
                <td>
                    <input type='email' placeholder='Email' name='email' value='".$user."'
                        style='width: 355px;height: 35px;' id='in' required />
                </td>
            </tr>
            <tr>
                <td>
                    <input type='password' placeholder='Mot de passe' name='password'
                        style='width: 355px;height: 35px;' required/>
                </td>

            </tr>

            <tr>
                <td> <center> <input type='submit' name='submit' value='Se connecter'
                        style='background-color: rgb(88, 66, 66) ;color: aliceblue; width: 209px;height: 25px; ;margin: 12px; margin-left: 0;' />
                </center></td>
            </tr>
        </table>
    </fieldset>
</form>" ; } 

else {

    
if( empty( $_POST['email'] )|| empty( $_POST['password'])) {
    header("refresh:4") ;
   echo" <center>
    <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' >Adresse e-mail / Mot de passe requise.</b>
</center>" ;
die () ;


}


$email=$_POST['email'] ;
$password=$_POST['password'] ;

// establishing a connection to the database ulplatform
//$con=mysqli_connect("hoatname" , "mysql-username ", " mysql-password" ; "database-name ") ;
 $con=mysqli_connect("localhost" ,"root", "", "tapis") ;

 if(!$con)  {
     header("refresh:2") ;
    echo" <center>
    <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  > problème de connexion de données</b>
</center>" ;
die () ;
 


     }

// write a qwery 
$sql=" select *  from user where email='$email' and password='$password' " ;


 // for execute the query "sql" from the connection "con"
 $result=mysqli_query($con,$sql) ;

// if retutne errer alor on a a syntax error in the query :

    if(!$result)  { header("refresh:2") ; 
         echo" <center>
        <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Problème d'exécution de requête! </b>
    </center>" ;
    die () ;
    } 

    if(mysqli_num_rows($result)==0) {

        header('refresh:4') ; 
        echo"<center><p style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' >  Votre e-mail ou votre mot de passe est invalide,réessaye à nouveau!</p></center>" ;
        die () ;

    } 
    

    else{ // in case we found a record , we will redirect the user to the page off books.php 

        $row=mysqli_fetch_array($result) ;
      


        setcookie('email',$row['email'],time()+10000) ; // variabl for cookies 
    
        $_SESSION['userId']=$row['userId'] ;
        
        // set variable for session 
        if($row['admin']==1) {
            $_SESSION['admin']=1 ;
        }elseif($row['admin']==2){$_SESSION['admin']=2; }
        elseif($row['admin']==3){$_SESSION['admin']=3; }
        else{
              $_SESSION['admin']=false;}

                  if(isset($_COOKIE['email'])) { 

                    $user=$_COOKIE['email'] ;
                }
                  else{
                    $user="" ;
                         }


        header('location:compte.php') ;
    }
    


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