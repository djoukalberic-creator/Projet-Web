<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IvoryTrain - Transport 2.0</title>
    <style>
        body {
            background-size: cover;
            background-attachment: fixed;
            font-family: sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            margin: 100px auto; /* On descend un peu le bloc */
            padding: 40px;
            width: 60%;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        /* ICI LA MAGIE PHP */
        <?php if(isset($fond) && $fond == "login"): ?>
            body {
                background-image: linear-gradient(rgba(255,255,255,0.7), rgba(255,255,255,0.7)), 
                                  url('images/carte-du-monde.jpg');
            }
        <?php elseif(isset($fond) && $fond == "UA"): ?>
            body {
                background-image: linear-gradient(rgba(255,255,255,0.7), rgba(255,255,255,0.7)), 
                                  url('images/carte-du-mode.jpg');
            }
        <?php endif; ?>
    </style>
</head>
<body>