<<<<<<< HEAD
<?php

$host="localhost";
$dbname="lewis";
$user= "root";
$password= "root";

$conn = new mysqli($host, $user, $password, $dbname);

if($conn-> connect_error){
    die("Falha na conexão")
    . $conn->connect_error;
}
=======
    <?php

    $host="localhost";
    $dbname="lewis";
    $user= "root";
    $password= "root";

    $conn = new mysqli($host, $user, $password, $dbname);

    if($conn-> connect_error){
        die("Falha na conexão")
        . $conn->connect_error;
    }
>>>>>>> 7116ede3ff1994b3e04c18ba68f3120f0203c249
