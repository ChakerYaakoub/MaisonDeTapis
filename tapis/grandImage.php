<html lang="en">

<?php
session_start()
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>grand image </title>
</head>

<body style="background-color: black;">
    <center>

        <img src="imagesTapis/<?php echo $_GET['IdTapis'] ; ?>.<?php echo $_GET['ext'] ?>  ">
    </center>

</body>

</html>