<!DOCTYPE html>
<html>

<head>
    <title>
        <?= isset($title) ? $title : 'GBAF' ?>
    </title>

    <meta charset="utf-8" />

    <link rel="stylesheet" href="" type="text/css" />
</head>

<body>
    <header>
        <a href="/">
            <img src="/images/gbaf.png" alt="logo de GBAF" width="100px"/>
        </a>
       
        <?php if ($user->isAuthenticated()) { ?>
            <p><?= $user->getAttribute('account')['nom'] . ' ' . $user->getAttribute('account')['prenom'] ?></p>
            <a href="/logOut.html">logout</a>
        <?php } ?>

    </header>

    <div id="content">
        <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>

        <?= $content ?>
    </div>

    <footer>
        | <a href="#">Mentions légales</a> | <a href="#"> Contact</a> |
    </footer>
</body>

</html>