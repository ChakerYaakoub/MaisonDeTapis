<?php
         if(!isset($_SESSION['admin'])){
    
    echo" <center>
    <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Vous devez de connecter d'abord </b>
</center>" ;
    header('refresh:2;url=compte.php');
    die(); }

    $con=mysqli_connect("localhost" ,"root", "", "tapis") ;

    if(!$con)  {
       $_page=$_SERVER["HTTP_REFERER"] ; 
       header('refresh:3 ; url= '.$_page) ;
       echo" <center>
       <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  > problème de connexion de données</b>
   </center>" ;
   die () ;}

   // if stock < quantite 
   $sql=" select *  from panier,tapis,user where userId=CuserId and IdTapis=CIdTapis and CuserId='".$_SESSION['userId']."'" ;
   $result=mysqli_query($con,$sql) ;
   if(!$result)  { $_page=$_SERVER["HTTP_REFERER"] ; 
    header('refresh:3 ; url= '.$_page) ;
        echo" <center>
       <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Problème d'exécution de requête!  </b>
   </center>" ;
   die () ;}
   
 

   if(mysqli_num_rows($result)==0) { //nothing  
   }else{
       




   for($i=0;$i<mysqli_num_rows($result); $i++){
    $row=mysqli_fetch_assoc($result);
    if($row['stock']<$row['quantite']){
        $Id=$row['CIdTapis'];
        $nq=$row['stock'];
        $sql1=" update panier set quantite='$nq' where CIdTapis='$Id' and CuserId='".$_SESSION['userId']."'" ;
        $con1=mysqli_connect("localhost" ,"root", "", "tapis") ;

        if(!$con1)  {
           $_page=$_SERVER["HTTP_REFERER"] ; 
           header('refresh:3 ; url= '.$_page) ;
           echo" <center>
           <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  > problème de connexion de données</b>
       </center>" ;
       die () ;}
        
        // for execute the query "sql" from the connection "con"
        $result1=mysqli_query($con1,$sql1) ;
        
        // if retutne errer alor on a a syntax error in the query :
        
           if(!$result1)  {  $_page=$_SERVER["HTTP_REFERER"] ; 
            header('refresh:3 ; url= '.$_page) ; 
                echo" <center>
               <b style='padding:30px; margin-top:30px; background-color:red; color:white; font-size:30px;'  >Problème d'exécution de requête! </b>
           </center>" ;
           die () ;
           } 

    } } }
   //end
   ?>