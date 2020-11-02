<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" href="style.css" />
      <title>Edwige Genty</title>
  </head>

  <body>
    <header style="background-color:green;">
      <h1>Edwige Genty</h1>
      <h2><?= $subtitle ?></h2>

  <!-- Menu-->
      <ul><!-- rajouter lien et image pour  chaque-->
        <li>Accueil</li>
        <li>Articles</li>
        <li>Contact</li>
      </ul>

  <!-- Réseaux sociaux-->
      <ul> <!-- rajouter lien et image pour  chaque-->
        <li>Twitter</li> 
        <li>GitHub</li>
        <li>LinkedIn</li>
      </ul>
    
    </header>

  <section> 
    <?= $content ?>
  </section>

  <footer>
  <!-- logo?, image, nom + accroche, menu (accueil, liste posts, contact, admin), lien vers réseaux sociaux-->
  
  <!-- Menu-->
      <ul><!-- rajouter lien et image pour  chaque-->
        <li>Accueil</li>
        <li>Articles</li>
        <li>Contact</li>  
        <li><a href=<?php '/admin'?>>Administration</a></li>
      </ul>

  <!-- Réseaux sociaux-->
      <ul> <!-- rajouter lien et image pour  chaque-->
        <li>Twitter</li> 
        <li>GitHub</li>
        <li>LinkedIn</li>
      </ul>
  </footer>

</body>

</html>