<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau ticket créé</title>

    <style>
        body { 
            background-color: #e3f9fb;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        main {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            background-color: #fff;
            text-align: center;
            padding: 10px;
        }
        main p { font-size: 1rem; }
        main h1 {font-size: 1.2rem;}
    </style>
</head>
<body>
    <main>
        <h1>Nouveau ticket de l'agent <?= $creator->u_userLname .' '. $creator->u_username ?></h1>
        <p>Le ticket numéro <?= $ticket->id ?> vient d'être créé.</p>
    </main>
</body>
</html>