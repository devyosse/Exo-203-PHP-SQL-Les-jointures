<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'exo203';

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

    $request = $pdo->prepare("
        SELECT e.prenom, e.nom, e.login, e.password, i.rue, i.cp, i.ville, i.pays
        FROM eleve as e
        INNER JOIN eleve_information as i ON e.information_id = i.id
    ");

    if($request->execute()) {
        foreach ($request->fetchAll() as $detail) {
            echo "<pre>".
                print_r($detail).
                "</pre>";
        }
    }

}

catch (PDOException $e){
    die($e->getMessage());
}

?>
