<!-- Ajout des données php -->
    <?php 
    //phpinfo();die;
    session_start();
    require_once('./autoload.php');
    $game = new GameClass();

    ?>

<!DOCTYPE html>
<html>
  <head>
    <title></title>
  </head>
  <body>
    <p> Weelcooooooome to the ARENA !!!! </p>
    <main>
      <a href="index.php?state=reset">Reset</a>
    </main>
  </body>
</html>
