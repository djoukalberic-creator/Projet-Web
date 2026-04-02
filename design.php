<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>the world of travelers</title>
    <style>
        .container {
            background: rgba(255, 255, 255, 0.9);x
            margin: 100px auto; /* On descend un peu le bloc */
            padding: 40px;
            width: 60%;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
         img:hover {
            opacity: 0.8;
            border: 2px solid #000;
        }
    body {
        /* Un dégradé léger ou une couleur sable/aventure */
        background: linear-gradient(rgba(255,255,255,0.8), rgba(255,255,255,0.8)), 
                    url('https://images.unsplash.com/photo-1488646953014-85cb44e25828?q=80&w=1000');
        background-size: cover;
        background-attachment: fixed;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        text-align: center; /* Centre tout pour un look plus moderne */
        color: #2c3e50;
    }

    img {
        border-radius: 15px; /* Arrondir les coins des drapeaux */
        box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* Ajouter une petite ombre */
        transition: transform 0.3s; /* Animation fluide */
    }

    img:hover {
        transform: scale(1.1); /* L'image grossit légèrement au survol */
    }
    .menu-continents {
        display: flex;          /* Met les éléments les uns à côté des autres */
        justify-content: center; /* Les centre horizontalement */
        align-items: flex-end;  /* Aligne les bases des images */
        gap: 20px;              /* Espace entre les boutons */
        margin-top: 50px;
    }

    .continent-card {
        text-align: center;     /* Centre le texte au-dessus de l'image */
        width: 300px;           /* Largeur de chaque bloc */
    }

    .continent-card img {
        width: 100%;            /* L'image s'adapte à la largeur du bloc */
        border-radius: 20px;    /* Tes fameux bords arrondis */
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        transition: 0.3s;       /* Pour l'effet de survol */
    }

    .continent-card img:hover {
        transform: translateY(-10px); /* Petit saut vers le haut au survol */
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