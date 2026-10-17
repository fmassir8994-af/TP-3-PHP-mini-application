<?php
// Auteur : [Votre nom] | Objectif : connexion par session et cookie | Date : 17/10/2026
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = trim($_POST["login"] ?? "");
    if ($login === "") {
        $erreur = "Veuillez saisir un login.";
    } else {
        $_SESSION["login"] = $login;
        setcookie("dernier_login", $login, time() + 86400, "/");
        header("Location: profil.php");
        exit;
    }
}
$ancienLogin = $_COOKIE["dernier_login"] ?? "";
?>
<!doctype html><html lang="fr"><head><meta charset="utf-8"><title>Connexion</title></head><body>
<h1>Connexion</h1>
<?php if (isset($erreur)) echo "<p>" . htmlspecialchars($erreur) . "</p>"; ?>
<form method="post" action="login.php">
<label>Login : <input name="login" value="<?= htmlspecialchars($ancienLogin, ENT_QUOTES, "UTF-8") ?>" required></label>
<button type="submit">Se connecter</button>
</form></body></html>
