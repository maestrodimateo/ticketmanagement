<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>design pdf</title>
    <style>
        .text-center {text-align: center;}
        .bg-primary {background-color: #f0bc74;}
        .p-3 {padding: 3px;}
        .mx-auto {margin: 0 auto;}
        .w-content {width: max-content;}
        .d-inline-block {display: inline-block;}
        .mt-5 {margin-top: 5rem;}
        .mt-3 {margin-top: 3rem;}
        body {
            padding: 2rem; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: .8rem;
        }
        th, td, table, tr {
            border: solid 1.5px;
            border-collapse: collapse;
            text-align: left;
        }
        th {background-color: #f0bc74; width: 25%;}
        table {width: 100%;}
        td, th{padding: 3px;}
        h2 {color: rgb(63, 62, 62);}
    </style>
</head>
<body>
    <h1 class="mx-auto text-center"><?= $info['reference'] ?></h1>
    <main class="mt-3">
        <h2>Information ticket</h2>
        <table>
            <tr>
                <th scope="row">Libellé</th>
                <td><?= $info['label'] ?></td>
            </tr>
            <tr>
                <th scope="row">Description</th>
                <td><?php empty($info['description']) ? 'N/A' : $info['description'] ?></td>
            </tr>
            <tr>
                <th scope="row">Déclaré le</th>
                <td><?= $info['created_at'] ?></td>
            </tr>
            <tr>
                <th scope="row">Clôturé le</th>
                <td><?= $info['closed_at'] ?? 'N/A' ?></td>
            </tr>
        </table>
        <h2>Information du déclarant</h2>
        <table>
            <tr>
                <th scope="row">Nom(s) et prénom(s)</th>
                <td><?= $info['user']['firstname'] .' '. $info['user']['name'] ?></td>
            </tr>
            <tr>
                <th scope="row">Email</th>
                <td><?= $info['user']['email'] ?></td>
            </tr>
            <tr>
                <th scope="row">Direction</th>
                <td><?= $info['user']['department'] ?></td>
            </tr>
            <tr>
                <th scope="row">Service</th>
                <td><?= $info['user']['service'] ?></td>
            </tr>
        </table>
        <?php if ($info['solution']): ?>
            <div>
                <h2>Solution</h2>
                <p class="bg-primary" style="padding: 1rem;"><?= $info['solution'] ?></p>
            </div>
        <?php endif ?>
        <p>
            <small>Imprimé le <?= $printed_at ?></small>
        </p>
    </main>
</body>
</html>