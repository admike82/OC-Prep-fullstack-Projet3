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
        <?php if ($user->isAuthenticated()) { ?>
            <a href="/connexion/logOut.html">logout</a>
        <?php } ?>
        
    </header>

    <div id="content">
        <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>

        <?= $content ?>
    </div>

    <footer></footer>
</body>

</html>