<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>tode - Equation #<?= $id ?></title>
        <link rel="stylesheet" href="/styles/main.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i|PT+Serif:700" rel="stylesheet">
        <script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-MML-AM_CHTML'></script>
    </head>
    <body>
        <?php
        require "db.php";
        require "nav.php";
        ?>
        <div class="wrapper">
            <h1><a href="/">tode</a></h1>

            <?php
            require "db.php";
            require "vendor/Parsedown.php";

            $query = $link->prepare("SELECT equations.*, users.id, users.username
            FROM equations
            INNER JOIN users ON equations.user = users.id
            WHERE equations.id = ?");

            $query->bind_param("i", $id);
            $query->execute();
            $result = $query->get_result();

            if ($row = $result->fetch_assoc()) : ?>
                <?php
                $tex = $row['equation'];
                $desc = $row['description'];
                $cats = explode(" ", $row['categories']);
                $cat = join(", ", $cats);
                $date = $row['date_updated'];
                $user= $row['username'];
                ?>

                <h2>Equation #<?= $id ?></h2>

                <h1 class="equation">`<?= htmlspecialchars($tex) ?>`</h1>
                <h2 class="sub"><?= htmlspecialchars($tex) ?></h2>
                <br>
                <h2 class="sub">categories: <?= htmlspecialchars($cat) ?></h2>
                <h2 class="sub">last updated: <?= htmlspecialchars($date) ?></h2>
                <h2 class="sub">added by: <?= htmlspecialchars($user) ?></h2>
                <br>

                <?php
                $Parsedown = new Parsedown();
                echo $Parsedown->text($desc);
                ?>
            <?php else : ?>
                <h1 class="center error">Equation #<?= $id ?> doesn't exist.</h1>
            <?php endif; ?>
        </div>
    </body>
</html>
