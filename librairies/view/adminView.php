<?php
require 'librairies/autoload.php';

$db = connectionDb::getDb();
$billets_manager = new BilletsManager($db);

if(isset($_GET['modifier']))
{
    $billets = $billets_manager->getUnique((int)$_GET['modifier']);
}
if(isset($_POST['titre']))
{
    $billets = new Billets(
        [
            'titre' => $_POST['titre'],
            'contenu' => $_POST['contenu']
        ]
    );

    if(isset($_POST['id']))
    {
        $billets->setId($_POST['id']);
    } 
    if($billets->validate()) 
    {    
        $message = $billets_manager->save($billets) ? 'Le nouveau billet à bien été enregistré !' : 'le billet à bien été modifié !';
    }  
    else
    {
    $erreurs = $billets->erreurs();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>administration</title>
    <link rel="stylesheet" type="text/css" href="style/admin.css">
    <script src="https://cdn.tiny.cloud/1/5ya0hoc0tjh102vqr3m520w8306eqxcu8mz71btr0zmc1z2t/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector: '#formulaire', plugins: 'code',})</script>
</head>
<body>
    <p><a href=".">Accueil</a></p>
    <form action="admin.php" method='post'>
    <textarea id="formulaire"></textarea>
    </form>    
</body>
</html>