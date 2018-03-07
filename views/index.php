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
                <tr>
                    <td>
                        <a href="./view.php?id=5">#5</a>
                    </td>
                    <td>
                        `sin^2\theta + cos^2\theta \equiv 1`
                    </td>
                    <td>
                        Sine squared plus cosine squared is equivalent to 1.
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="./view.php?id=20">#20</a>
                    </td>
                    <td>
                        `F = ma`
                    </td>
                    <td>
                        Force equals mass times acceleration.
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="./view.php?id=73">#73</a>
                    </td>
                    <td>
                        `E = hf`
                    </td>
                    <td>
                        Energy of a wave equals Planck's constant times the frequency.
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="./view.php?id=11">#11</a>
                    </td>
                    <td>
                        `1 - sin\theta \equiv cos\theta`
                    </td>
                    <td>
                        One minus sine is equivalent to cosine.
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="./view.php?id=105">#105</a>
                    </td>
                    <td>
                        `d/dx u/v = (v(du)/dx - u(dv)/dx) / v^2`
                    </td>
                    <td>
                        The chain rule.
                    </td>
                </tr>
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
