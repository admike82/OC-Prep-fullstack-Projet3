<!DOCTYPE html>
<html>

<head>
    <title>
        <?= isset($title) ? $title : 'Mon super site' ?>
    </title>

    <meta charset="utf-8" />

    <link rel="stylesheet" href="" type="text/css" />
</head>

<body>
    <header></header>

    <div id="content">
        <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
        
        <?= $content ?>
    </div>

    <footer></footer>
</body>

</html>