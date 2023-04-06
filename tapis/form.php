<!DOCTYPE html>
<?php
session_start();
?>

<html>

<head>
    <title> info tapis </title>
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


    <section class="form">

    <?php 
    if(empty( $_GET['IdTapis'] )) {
        $_page=$_SERVER["HTTP_REFERER"] ; // you can just utilise $_page="login.php"
       
       echo" <center>
        <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' > IdTapis not found</b>
    </center>" ;
     header('refresh:3 ; url= '.$_page) ;
    die () ;} 
    
    
    
    $IdTapis=$_GET['IdTapis'] ;
    // write a qwery 
$sql=" select *  from tapis where IdTapis='$IdTapis'  " ;
$con=mysqli_connect("localhost" ,"root", "", "tapis") ;


// for execute the query "sql" from the connection "con"
$result=mysqli_query($con,$sql) ;

// if retutne errer alor on a a syntax error in the query :

   if(!$result)  { header("refresh:2") ; 
        echo" <center>
       <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Problème d'exécution de requête! </b>
   </center>" ;
   die () ;
   } 

       $row=mysqli_fetch_array($result) ;

    
    ?>
        <br> <br><br> <br> 
        <t style=" font-size: 28px;
       color: #232323;
        min-height: 40px;
       
        
        margin-bottom: 20px;
        font-family: oswald,sans-serif;">
            <b> <?php echo $row['titre'] ;?></b> <br>
    </t>





        <table style="width: 100%; margin-top: 25px;">
            <tr>
                <td style="width: 40%;">
                    </tdstyle>

                    <table>
                        <tr>
                            <td>
                                <a href="grandImage.php?IdTapis=<?php echo $IdTapis ; ?>&ext=<?php echo $row['ext'] ?>">

                                <img src="imagesTapis/<?php echo $IdTapis ; ?>.<?php echo $row['ext'] ?> " width='500px' height="500px"></a>

                            </td>
                        </tr>
                    </table>

                </td>
                <td style="width: 27%;">
                    <table id="t2">
                        <tr>
                            <td>
                                <b> Couleur :</b>
                            </td>
                            <td>
                                <!-- -->
                                        <?php if($row['color']=='blanc'||$row['color']=='bleu'||$row['color']=='rose'||$row['color']=='violet'){
                                         echo"<a href='list.php?color=".$row['color']."'>

                                    <img src="?>'photo/color/<?php echo $row['color'] ; ?>.png'<?php echo" width='100px' height='40px'
                                        style='border: solid 1pt black;'></a>" ;}
                                        else{
                                            echo"<a href='list.php?color=".$row['color']."'>
                                            <img src="?>'photo/color/<?php echo $row['color'] ; ?>.jpg'<?php echo" width='100px' height='40px'
                                                style='border: solid 1pt black;'></a>" ;
                                            
                                            
                                        }?>
                            </td>
                        </tr>
                        <tr>


                            <td>
                                <b> Dimensions:</b>
                            </td>
                            <td>
                            <?php echo $row['longueur'] ;?>x<?php echo $row['largeur'] ;?> cm

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center><img src="photo/gan.webp "> </center>
                            </td>


                            <td>
                                Gagnez <b style="color: brown;"><?php echo $row['point'] ;?> points</b> en commandant ce produit que vous
                                pourrez
                                convertir en bon d'achat.
                            </td>
                        </tr>
                        <tr>


                            <td>
                                <b> Stock :</b>
                            </td>
                            <td> <?php echo $row['stock'] ;?> pieces</td>
                        </tr>

                        <tr>


                            <td>
                                <b> Prix_conseillé:</b>
                            </td>
                            <td style="color: brown;">


                              <?php if($row['reduit']!=0){echo"<strike> <small>"; } else{echo"<big>";}?> 
                               <b><?php echo $row['prix'] ;?> $</b>
                               <?php if($row['reduit']!=0){echo"</strike> </small>"; }else{echo"</big>";}?> 
                            </td>
                        </tr>
                        <?php $reduit=$row['prix']-($row['prix']*$row['reduit']/100);?>
                        <?php  ?>
                        <?php if($row['reduit']!=0){echo" 
                        
                        <td>
                                <b>Remise: </b>
                            </td>
                            <td style='color: brown;'>
                                <big><b>
                                
                                
                                  ".$row['reduit']." 
                                % </b> </big>
                            </td>
                        
                        <tr>
                            <td>
                                <b>Prix_reduit: </b>
                            </td>
                            <td style='color: brown;'>
                                <big><b>
                                
                                
                                  $reduit    
                                $ </b> </big>
                            </td>
                        </tr>";} ?>
                       
                       

                    </table>

                </td>
                <td>

                    <table id="t3">
                        <?php $eco=($row['prix']*$row['reduit']/100); ?>
                    <?php if($row['reduit']==0) { echo"<tr><td style='font-size: 14px;'><center> <b>Actuellement</b> <br>Pas de remise pour ce produit <br>( Le prix sera réduit prochainement )</center></td> </tr>";}
                      else{echo"<tr>
                            <td>
                                <center> <b>Vous économisez :<big style='color: brown;'> 
                               
                                  $eco  $</big> </b> </center>
                            </td>

                        </tr>";}  ?> 
                        <tr>
                            <td>
                                <center> Vous pouvez maintenant choisir la quantité que vous souhaitez acheter <br>
                                    et la
                                    mettre dans le panier, puis confirmer l'achat plus tard</center>
                            </td>
                        </tr>
                        <?php
                        if($row['stock']==0){
                            echo"<tr><td style='background: #efeaed;border-radius: 10px;color:#892929;'> <center>  Ce tapis a rencontré un vif succès et <b> n'est plus disponible </b> sur MaionDuTapis pour le moment.<b> Désolé </b> <br></center> </td></tr>";
                        } else{echo"<tr>

                            <td style='padding-bottom: 0;'>
                                <form action='savepanier.php' method='POST'>
                                   
                                    <center> <b style='color: #777;'>QUANTITÉ : </b><input type='number' name='quantite' min='1' max='".$row['stock']."' 
                                            style=' width: 38px; height:18px;' value='1'></center>
                                    <input type='number' name='CuserId' value='";?><?php if(isset($_SESSION['userId'])) echo $_SESSION['userId'] ;?><?php echo"' hidden>
                                    <input type='number' name='CIdTapis' value='";?><?php echo $row['IdTapis'] ;?><?php echo"' hidden>
                                    
                            </td>
                        </tr>
                        <tr>
                            <td style='padding-top: 3px;'>
                                <input type='submit' name='submit' value=' .   Ajouté au panier'
                                    style='width: 100%; font-weight: 400;
                                font-size: 24px;
                                line-height: 24px;
                                padding: 10px 0;
                                color: #fff;
                                font-family: oswald,sans-serif;
                                display: block!important;
                                -moz-transition: all .3s ease;
                                -o-transition: all .3s ease;
                                -webkit-transition: all .3s ease;
                                transition: all .3s ease; background: url(photo/addcart.webp ) no-repeat;background-color: #a1c330;' />
                            </td>
                        </tr>
                        </form>";}
                        ?> 
                        
                        <tr>
                            <td style="padding: 0;">
                                <center>
                                    <a
                                        href="https://mingclee.medium.com/paypal-vs-credit-card-visa-master-961c6f13c604">
                                        <img src="photo/visamaster.png " width='90%' hight='10px'>
                                    </a>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center> <!-- <a href="list.php?mark=allotapis"> <img src="photo/mark/allotapis.webp "
                                            width='60%' hight='70%'></a> -->
                                            
                                            <?php 
                                            if($row['mark']=='allotapis'||$row['mark']=='deladeco'||$row['mark']=='vivabita'||$row['mark']=='esprit'
                                              ||$row['mark']=='lorena'||$row['mark']=='home'||$row['mark']=='james'||$row['mark']=='angelo'){
                                                echo"<a href='list.php?mark=".$row['mark']."'>
       
                                           <img src="?>'photo/mark/<?php echo $row['mark'] ; ?>.webp'<?php echo" width='60%' height='70%'
                                               </a>" ;}
                                            
                                            else {echo $row['mark'] ;}
                                            ?>
                                        </center>

                                            
                            </td>


                        </tr>
                    </table>

                </td>
            </tr>
        </table>

        <?php 

if( isset($_SESSION['admin']) && $_SESSION['admin']==2){
    echo" <br> <h style='padding-left:20px;'>Ce champ appartient à  <b>le commerçant :</b> IdTapis is ".$row['IdTapis']."</h> <br><br>";

}


        if( isset($_SESSION['admin']) && $_SESSION['admin']==1){

            echo"<table style='padding-top: 10px; padding-left: 30px; border: solid 1pt #e5e5e5; '>

            <tr>
                <td>
                    <form action='uploadphotoTapis.php' method='POST' enctype='multipart/form-data' style='left: 100px;'>
                        <fieldset>
                            <input type='file' name='tapisPhoto' style='width: 100%; font-weight: 400;
                        font-size: 24px;
                        line-height: 24px;
                       
                        color: #fff;
                        font-family: oswald,sans-serif;
                        display: block!important;
                        -moz-transition: all .3s ease;
                        -o-transition: all .3s ease;
                        -webkit-transition: all .3s ease;
                        transition: all .3s ease;background-color: #a1c330;'> <br> <br>
                            <input type='number' name='IdTapis' value='".$row['IdTapis']."' hidden>
                            <input type='text' name='ext' value='".$row['ext']."' hidden>
                            <input type='submit' name='submit' value='Télécharger une nouvelle photo' style='width: 100%; font-weight: 400;
                        font-size: 24px;
                        line-height: 24px;
                        padding: 10px 0;
                        color: #fff;
                        font-family: oswald,sans-serif;
                        display: block!important;
                        -moz-transition: all .3s ease;
                        -o-transition: all .3s ease;
                        -webkit-transition: all .3s ease;
                        transition: all .3s ease; background-color: #a1c330;'>
                        </fieldset>
                    </form>
                    
                    
                  
                </td>


                <td style='padding-left: 20px;'>
                    <form action='edittapis.php' method='GET' style='float: left;'>
                        <fieldset>
                            <input type='number' name='IdTapis' value=".$row['IdTapis']."  hidden>
                            <input type='submit' name='submit' value='Mettre à jour les Description' style='width: 100%; font-weight: 400;
                        font-size: 24px;
                        line-height: 24px;
                        padding: 10px 0;
                        color: #fff;
                        font-family: oswald,sans-serif;
                        display: block!important;
                        -moz-transition: all .3s ease;
                        -o-transition: all .3s ease;
                        -webkit-transition: all .3s ease;
                        transition: all .3s ease; background-color: #a1c330;'>
                        </fieldset>
                    </form>
                    <br>

                    <form action='delettapis.php' method='GET' style='float:left; padding-left: 45px;'>
                        <fieldset>
                            <input type='number' name='IdTapis' value=".$row['IdTapis']."  hidden>
                            <input type='text' name='ext' value='".$row['ext']."'  hidden>
                            <input type='submit' name='submit' value='supprimer le produit' style='width: 100%; font-weight: 400;
                        font-size: 24px;
                        line-height: 24px;
                        padding: 10px 0;
                        color: #fff;
                        font-family: oswald,sans-serif;
                        display: block!important;
                        -moz-transition: all .3s ease;
                        -o-transition: all .3s ease;
                        -webkit-transition: all .3s ease;
                        transition: all .3s ease; background-color: #a1c330;'>
                        </fieldset>
                    </form>
                </td>
                <td>
                    <center> <img src="?>'photo/admn.jpg'<?php echo" width='100px' height='100px'>
                        <h1 style='font-size: small;'>Ces champs appartiennent à l'administrateur</h1>
                    </center>
                    <center> <b>note:</b>IdTapis is ".$row['IdTapis']."</center>
                </td>
            </tr>

        </table> ";
        }
        ?>

        




        <table style="width: 100%;padding: 20px; border: #e5e5e5 1pt solid;">
            <tr>
                <td style="font-size: large; font-family: sans-serif; font-weight: bold;">
                    Description:
                </td>
            </tr>
            <tr>
                <td style="float: left;">

                <?php echo $row['description'] ;?>

                </td>
            </tr>
        </table>

        <h1>CARACTÉRISTIQUES TECHNIQUES :</h1>

        <table style=" border: #e5e5e5 1pt solid; width: 100%;">
            <tr>
                <td style="border-right: 1px solid #a09e9e;
                width: 35%;
                font-weight: 700;
                color: #232323;     padding: 10px 20px 11px;"><b>Composition précise :</b></td>
                <td> <?php echo $row['composition'] ;?></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid #a09e9e;
                width: 35%;
                font-weight: 700;
                color: #232323;    padding: 10px 20px 11px;"><b>Garantie :</b></td>
                <td> <?php echo $row['garantie'] ;?> ans </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid #a09e9e;
                width: 35%;
                font-weight: 700;
                color: #232323;    padding: 10px 20px 11px;"><b>Entretien :</b></td>
                <td><?php echo $row['entretien'] ;?></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid #a09e9e;
                width: 35%;
                font-weight: 700;
                color: #232323;    padding: 10px 20px 11px;"><b>Formes disponibles :</b></td>
                <td> <?php echo $row['forme'] ;?></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid #a09e9e;
                width: 35%;
                font-weight: 700;
                color: #232323;     padding: 10px 20px 11px;"><b>Origine :</b></td>
                <td> <?php echo $row['origine'] ;?></td>
            </tr>

            <tr>
                <td style="border-right: 1px solid #a09e9e;
                width: 35%;
                font-weight: 700;
                color: #232323;    padding: 10px 20px 11px;"><b>Type de fabrication :</b></td>
                <td> <?php echo $row['fabtype'] ;?></td>
            </tr>

            <tr>
                <td style="border-right: 1px solid #a09e9e;
                width: 35%;
                font-weight: 700;
                color: #232323;     padding: 10px 20px 11px;"><b>Dossier :</b></td>
                <td> <?php echo $row['dossier'] ;?></td>
            </tr>




        </table>
        <br>

    <re> <center><b> Information : </b> Toutes les précautions d'hygiène dans le parcours de livraison ont été renforcées et nous les suivons avec attention. <br> En savoir plus.
        Et surtout, prenez soin de vous !</re></center>

      
        </section>
        <section class="listtt"> 

  <!-- for produit similaire  similaire -->
        <br><hr>

        <?php

        


    

     $form=$row['forme'] ;
     $piece=$row['piece'];
     $color=$row['color'] ;
     
     echo"<br><h >  <b style=' font-size: 30px; color: #3c3c3B;  text-transform: uppercase;'> PRODUITS SIMILAIRES :</b></center></h><br><br>";


     
    $con=mysqli_connect("localhost" ,"root", "", "tapis") ;

    if(!$con)  {
        
   $_page=$_SERVER["HTTP_REFERER"] ; // you can just utilise $_page="login.php"
          
   echo" <center>
    <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;' >problème de connexion de données </b>
   </center>" ;
   header('refresh:3 ; url= '.$_page) ;
   die () ;}

   $sql=" select *  from tapis where forme='$form' and piece='$piece' and color='$color'" ;


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

 
 if(mysqli_num_rows($result)==1) {


   
    echo" <h style='padding: 20px'; ><center ><img src="?>'photo\vide12.png' <?php echo" ><center/> <h/> <br>
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
    if($row['IdTapis']!=$_GET['IdTapis']){
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
}}

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


        


    


} // end of list of produit similaire 

        
        
        ?>






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