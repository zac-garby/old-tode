<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>tode - <?= $name ?></title>
        <link rel="stylesheet" href="/styles/main.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i|PT+Serif:700" rel="stylesheet">
        <script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-MML-AM_CHTML'></script>
    </head>
    <body>
        <?php
        require "php/db.php";
        require "php/nav.php";
        ?>
        <div class="wrapper">
            <h1><a href="/">tode</a></h1>
            <h2>User: <?= $name ?></h2>
            <br>

            <h3>Entries:</h3>
            <table class="equations">
                <?php
                $query = $link->prepare("SELECT equations.id, equations.equation, equations.description, users.username
                FROM equations
                INNER JOIN users ON equations.user = users.id
                WHERE users.username = ?");

                $query->bind_param("s", $name);
                $query->execute();
                $result = $query->get_result();
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
