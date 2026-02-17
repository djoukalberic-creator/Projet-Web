<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Projet Web - World of Travelers</title>
    <style>
        /* Un peu de style pour que l'utilisateur comprenne que c'est cliquable */
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
	footer {
    margin-top: 80px;
    padding: 20px;
    background-color: rgba(44, 62, 80, 0.8); /* Un bleu nuit transparent pour coller à l'image */
    color: white;
    font-size: 0.9em;
    border-radius: 10px 10px 0 0; /* Arrondi seulement en haut */
}

footer p {
    margin: 5px 0;
}
</style>
</head>
<body>

    <h1>The World of Travelers</h1>
    <h2>Le site de voyage pour les curieux et les aventuriers</h2>

    <h3>Choisissez votre continent</h3>
<div class = "menu-continents">
<div class="continent-card">
    <p>L'Amérique, Terre de contrastes</p>
    <a href="liste_amerique.html">
        <img src="images/Amerique.png" alt="Drapeau Amerique">
    </a>
</div>
	<div class="continent-card">
    <p>L'Afrique, berceau de l'humanité</p>
    <a href="liste_afrique.html">
        <img src="images/UnionAfricaine.jpg" alt="Drapeau Union Africaine">
    </a>
</div>
<div class="continent-card">
    <p>L'Europe, terre de l'innovation</p>
    <a href="liste_europe.html">
        <img src="images/UnionEuropeenne.png" alt="Drapeau Union Européenne">
    </a>
</div>
<div class="continent-card">
    <p>l'Asie, le géant en puissance</p>
    <a href="liste_asie.html">
        <img src="images/Asie.png" alt="Drapeau sie">
    </a>
</div>
</div>
<footer>
    <p>© 2026 - World of Travelers</p>
    <p>	Prigogine nous regarde, alors on fait du bon code !</p>
</footer>
</body>
</html>