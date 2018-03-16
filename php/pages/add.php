<?php
require "php/db.php";
require "php/nav.php";

if (!$logged_in) {
    $url = "https://" . $_SERVER['HTTP_HOST'] . "/";
    header("Location: $url");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>tode - New equation</title>
        <link rel="stylesheet" href="/styles/main.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i|PT+Serif:700" rel="stylesheet">
        <script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-MML-AM_CHTML'></script>
    </head>
    <body>
        <div class="wrapper">
            <h1><a href="/">tode</a></h1>
            <h2>New equation, identity, or formula</h2>
            <br>

            <p>
                Here you can add a new entry to the database. Please make sure
                it's 100% correct before adding it.
                When an equation is added, it is flagged as <em>unconfirmed</em>
                until an admin looks at it and removes either the flag or the
                question.
            </p>

            <form id="form" action="/addpage">
                <h3>Enter the details of your equation:</h3>
                <p>
                    Again, make sure it's correct. If it is correct, but you
                    don't think admins will be able to tell, say so in the
                    references section below.
                </p>
                <span id="equation-err"></span>
                <textarea name="equation" placeholder="E = hf"></textarea>

                <h3>Describe your equation:</h3>
                <p>
                    You can use Markdown and TeX. TeX is inserted like:
                    <code>$$ your code here $$</code>. Keep in mind that
                    markdown isn't rendered on the home page, so try not to use
                    any in the first 55 characters.
                </p>
                <span id="description-err"></span>
                <textarea name="description" rows="22"></textarea>

                <h3>Categories:</h3>
                <p>
                    Enter a list of categories separated by spaces. Try to use
                    category names more commonly used on tode, for example
                    <code>mathematics</code> instead of <code>maths</code>.
                </p>
                <span id="categories-err"></span>
                <input class="mono" type="text" name="categories" placeholder="mathematics calculus">

                <h3>References:</h3>
                <p>
                    Use this section to explain to the admins that your
                    equation is correct. This could be in the form of
                    a mathematical proof, a link to a site explaining it, or
                    anything else. This won't be displayed anywhere on tode.
                </p>
                <span id="references-err"></span>
                <textarea name="references" rows="5"></textarea>

                <br>
                <br>

                <input type="submit" value="Submit">
            </form>
        </div>
    </body>
    <script src="js/add.js" charset="utf-8"></script>
</html>
