<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>tode - The Online Directory of Equations</title>
        <link rel="stylesheet" href="styles/main.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i|PT+Serif:700" rel="stylesheet">
        <script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-MML-AM_CHTML'></script>
    </head>
    <body>
        <?php require "db.php" ?>
        <a href="./login" class="login">log in / sign up</a>
        <div class="wrapper">
            <h1><a href="/">tode</a></h1>
            <h2>The Online Directory of Equations, Identities, and Formulae</h2>
            <br>

            <p>
                <em>tode</em> is a place where you can browse a database of equations,
                identities, and formulae. The source is
                <a href="https://github.com/Zac-Garby/tode">hosted on GitHub</a>
                so you can play around with it and change things, as well as
                hosting your own version with your own database.
            </p>

            <p>
                You can also add items to the database. First, make an account.
                Then a button will appear on this page labelled "Add equation".
            </p>

            <h3>Search:</h3>
            <form class="search" action="search.php" method="get">
                <p>
                    Search through the database by ID, description, equation,
                    category, or user. A query is any number of sub-queries
                    separated by <code>and</code>. A sub query takes the form
                    <code>var [= or ~ or !=] val</code>, where <code>var</code>
                    is one of <code>id</code>, <code>eq</code>, <code>desc</code>,
                    or <code>user</code>. <code>=</code> searches for exact
                    matches, <code>~</code> for partial matches, and <code>!=</code>
                    for anything but.
                </p>

                <p>
                    A query which isn't in that form is interpreted as a partial
                    match on the description or equation.
                </p>

                <input type="text" name="query" placeholder="e.g. eq~a and user=pythagoras">
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
                        <?= "<a href=./eq/$ID>#$ID</a>" ?>
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
