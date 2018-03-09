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
        <?php
        $user = 'root';
        $password = 'root';
        $db = 'tode';
        $host = 'localhost';
        $port = 8889;

        $link = mysqli_init();
        $success = mysqli_real_connect(
           $link,
           $host,
           $user,
           $password,
           $db,
           $port
        );
        ?>
        <div class="wrapper">
            <h1>tode</h1>
            <h2>The Online Directory of Equations</h2>

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

            <h3>Add an equation:</h3>
            <form class="add-eq" action="add.php" method="get">
                <p>
                    Uses <a href="http://asciimath.org">asciimath</a> syntax.
                </p>
                <input type="text" name="equation" placeholder="E = mc^2">
                <input type="submit" value="Add">
            </form>
        </div>
    </body>
</html>
