<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['admin'])|| $_SESSION['admin']==false ||$_SESSION['admin']==2||$_SESSION['admin']==3){// actuel user .. dhhhar
    
    header("location:compte.php") ;
    die();
}

?>

<html>

<head>
    <title> add piece </title>
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


    <section class="tool">
    <h style="font-family:'Courier New', Courier, monospace; font-size: 30px; color: rgb(39, 29, 29); margin: 5px;">
            <center> <b>  ADD PIÈCE</b></center>
        </h>
    
    <p style="font-family:Valentine,Arial;font-weight: 200; font-size: 18px;"> <b> Remarque : </b> Assurez-vous de saisir toutes les informations relatives au produit </p>



<form method="post" action="addpiece1.php" >
    <fieldset>



        <table style="width: 100%; height: 70%; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif">
            <tr >




                <td style="border: solid 1pt rgb(129, 93, 93);">




                    <table style="width: 100%; height: 100%;">
                        <tr>
                            <td id="tt"> Pièce :</td>
                            <td id="ttt">
                                <select name="piece">
                                    <option>salon</option>
                                    <option>chambre</option>
                                    <option>entree</option>
                                    <option>toilette</option>
                                    <option>terrasse</option>
                                    <option>bureau</option>
                                    <option>cuisine</option>
                                    <option>couloir</option>
                                    <option>adolescent</option>
                                    <option>garcan</option>
                                    <option>fille</option>
                                    <option>bebe</option>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td id="tt" style="padding-bottom: 70px">Product_Title:</td>
                            <td id="ttt">
                                <textarea type="text" name="titre" required></textarea>

                            </td>

                        </tr>


                        <tr>
                            <td id="tt"> Marque :</td>
                            <td id="ttt">
                                <input type="text" name="mark" list="list" required/>
                                <datalist id="list">
                                    <option>allotapis</option>
                                    <option>deladeco</option>
                                    <option>vivabita</option>
                                    <option>esprit</option>
                                    <option>lorena</option>
                                    <option>home</option>
                                    <option>james</option>
                                    <option>angelo</option>
                                </datalist>


                            </td>
                        </tr>




                        <tr>
                            <td id="tt"> Couleur :</td>
                            <td id="ttt">
                                <select name="color">
                                    <option>beige</option>
                                    <option>blanc</option>
                                    <option>gris</option>
                                    <option>noir</option>
                                    <option>marron</option>
                                    <option>taupe</option>
                                    <option>bleu</option>
                                    <option>jaune</option>
                                    <option>orange</option>
                                    <option>rose</option>
                                    <option>rouge</option>
                                    <option>vert</option>
                                    <option>violet</option>
                                    <option>multicolor</option>

                                </select>

                            </td>
                        </tr>
            </tr>

            <!--<tr>
                <td id="tt">Dimension (cm):</td>
                <td id="ttt">
                    <input type="text" name="dimension" />

                </td>

            </tr>-->
            <tr>
                <td id="tt">Stock :</td>
                <td id="ttt">
                    <input type="number" name="stock" min="1" required/>

                </td>

            </tr>
            <tr>
                <td id="tt">Composition précise :</td>
                <td id="ttt">
                    <input type="text" name="composition" required/>

                </td>

            </tr>

            <tr>
                <td id="tt" style="padding-bottom: 70px">Description:</td>
                <td id="ttt">
                    <textarea type="text" name="description" required></textarea>

                </td>

            </tr>
        </table>

        </td>
        <td style="border: solid 1pt rgb(129, 93, 93);">
            <table style="width: 100%; height: 70%;">

            <tr>
                    <td id="tt"> D/Longueur(cm):</td>
                    <td id="ttt">
                        <input type="number" name="longueur" min="0" required />

                    </td>

                </tr>
                <tr>
                    <td id="tt"> D/Largeur(cm):</td>
                    <td id="ttt">
                        <input type="number" name="largeur" min="0" required/>

                    </td>

                </tr>


                <tr>
                    <td id="tt">Garantie :</td>
                    <td id="ttt">
                        <input type="number" name="garantie" min="0" required/>

                    </td>

                </tr>


                <tr>
                    <td id="tt" style="padding-bottom: 70px">Entretien :</td>
                    <td id="ttt">
                        <textarea type="text" name="entretien" required></textarea>

                    </td>

                </tr>
                <tr>
                    <td id="tt">Formes disponible :</td>
                    <td id="ttt">
                        <input type="text" name="forme" list="form" required />
                        <datalist id="form">
                            <option> rectangle</option>
                            <option> carre</option>
                            <option> rond</option>
                            <option> ovale</option>
                        </datalist>


                    </td>

                </tr>


                <tr>
                    <td id="tt"> Origine :</td>
                    <td id="ttt">
                        <input type="text" name="origine" list="origine" required>
                        <datalist name="origine" id="origine">
                            <option>Turquie</option>
                            <option>France</option>
                            <option>Italy</option>
                            <option>lebanon</option>
                            <option>Belgium</option>

                        </datalist>

                    </td>
                </tr>
                <tr>
                    <td id="tt"> Dossier :</td>
                    <td id="ttt">
                        <input type="text" name="dossier" required>

                    </td>

                <tr>
            </table>
        </td>
        <td style="border: solid 1pt rgb(129, 93, 93);">


            <table style="width: 100%; height: 50%;">



                <tr>
                    <td id="tt"> Type de fabrication :</td>
                    <td id="ttt">
                        <input type="text" name="fabtype" required>

                    </td>

                <tr>

                <tr>
                    <td id="tt"> Gagner/Point:</td>
                    <td id="ttt">
                        <input type="number" name="point" min="0" required>

                    </td>

                <tr>
                <tr>
                    <td id="tt">Prix ($):</td>
                    <td id="ttt">
                        <input type="number" name="prix" min="1" required>

                    </td>

                <tr>

                <tr>
                    <td id="tt">Reduit (%):</td>
                    <td id="ttt">
                        <input type="number" name="reduit" min="0" required>

                    </td>

                <tr>


                    <td></td>
            </table>
        </td>



        </tr>





        </table>

        </tr>

        </table>
        <center> <input type="submit" name="submit" value="Add Description"
                style="background-color: rgb(167, 137, 137) ;color: aliceblue; width: 220px ; height: 35px;margin: 12px; margin-left: 0;" />

        </center>



    </fieldset>

</form>
 <center>Ce champ appartient à l'administrateur </center>
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