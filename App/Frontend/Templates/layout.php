<!DOCTYPE html>
<html>

<head>
    <title>
        GBAF-<?= isset($title) ? $title : '' ?>
    </title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://fonts.googleapis.com/css?family=Oxygen&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/style.css" type="text/css" />
</head>

<body>
    <div id="main">
        <header>
            <div class="logo">
                <a href="/">
                    <img src="/images/gbaf.png" alt="logo de GBAF" />
                </a>
            </div>
            <div class="user">
                <?php if ($user->isAuthenticated()) { ?>
                    <span>
                        <?= $user->getAttribute('account')['nom'] . ' ' . $user->getAttribute('account')['prenom'] ?>
                        <a href="/update-user.html" title="Paramètre du compte"><img src="/images/settings.png" alt="Paramètre"></a>
                        <a href="/logOut.html" title="Déconnexion"><img src="/images/logout.png" alt="Déconnexion"></a>
                    </span>

                <?php } ?>
            </div>
        </header>

        <div id="content">
            <?php if ($user->hasFlash()) {
                $flash = $user->getFlash();
                echo '<div id="alert"><strong class="alert-' . $flash['class'] . '">', $flash['message'], '</strong></div>';
            } ?>

            <?= $content ?>
        </div>

        <footer>
            <a href="/info/" class="btn-light">Mentions légales</a> <a href="/info/contact.html" class="btn-light"> Contact</a>
        </footer>
    </div>
</body>

</html>