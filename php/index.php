<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>tode - The Online Directory of Equations</title>
        <link rel="stylesheet" href="styles/main.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i|PT+Serif:700" rel="stylesheet">
        <script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=AM_CHTML'></script>
    </head>
    <body>
        <?php require "db.php" ?>
        <a href="./login" class="login">log in / sign up</a>
        <div class="wrapper">
            <h1><a href="/">tode</a></h1>
            <h2>The Online Directory of Equations, Identities, and Formulae</h2>

            <p>
                <em>tode</em> is a place where you can browse a database of equations,
                identities, and formulae. It's written in PHP, using an Apache
                web server and a MySQL database. The source is
                <a href="https://github.com/Zac-Garby/tode">hosted on GitHub</a>
                so you can play around with it and change things, as well as
                hosting your own version with your own database.
            </p>

            <p>
                You can also add items to the database, just ensure they're
                correct. First, you'll need to make an account, or log
                in if you already have one. Then, there'll be a button on this
                page which you can press to add your own equation, identity, or
                formula.
            </p>

            <h3>Search:</h3>
            <form class="search" action="search.php" method="get">
                <input type="text" name="query" placeholder="e.g. #100, sin, chain rule">
                <input type="submit" value="Search">
            </form>

            <h3>A random set of 5:</h3>
            <table class="equations">
                <?php
                $result = mysqli_query(
                    $link,
                    "SELECT ID, equation, description
                    FROM equations
                    ORDER BY RAND()
                    LIMIT 5"
                );

                $rows = $result->fetch_all();

                foreach ($rows as $row) : ?>
                <tr>
                    <?php
                    $ID = $row[0];
                    $eq = $row[1];

                    $desc = $row[2];
                    if (strlen($desc) > 55) {
                        $desc = wordwrap($desc, 55);
                        $desc = substr($desc, 0, strpos($desc, "\n")) . "...";
                    }
                    ?>
                    <td>
                        <?= "<a href=./view/$ID>#$ID</a>" ?>
                    </td>
                    <td>
                        `<?= htmlspecialchars($eq) ?>`
                    </td>
                    <td>
                        <?= htmlspecialchars($desc) ?>
                    </td>
                </tr>
                <?php endforeach ?>
            </table>
        </div>
    </body>
</html>
