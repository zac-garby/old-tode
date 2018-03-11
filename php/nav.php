<div class="nav">
<?php
$logged_in = false;
$user_id = 0;
$username = "";
$email = "";
$admin = false;

// assumes db.php has been required already
if (isset($_COOKIE["sessid"])) {
    $sessid = $_COOKIE["sessid"];
    $query= $link->prepare("SELECT users.id, users.username, users.email, users.admin FROM sessions
    INNER JOIN users ON sessions.userid = users.id
    WHERE sessions.sessid = ?");

    $query->bind_param("i", $sessid);
    $query->execute();
    $result = $query->get_result();

    if ($row = $result->fetch_assoc()) {
        $logged_in = true;
        $user_id = $row['id'];
        $username = $row['username'];
        $email = $row['email'];
        $admin = $row['admin'];
    }
}

if ($logged_in) :
?>
    <a href="#">☺︎ <?= $username ?></a> <br>
    <a href="/logout">log out</a> <br>
    <a href="#">add an entry</a> <br>
    <?php
    if ($admin) : ?>
        <a href="#">administrate</a>
    <?php endif ?>
<?php else : ?>
    <?php setcookie("sessid", null, -1, "/") ?>
    <a href="/login">log in / sign up</a>
<?php endif ?>
</div>
