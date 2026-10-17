<?php
// Auteur : [Votre nom] | Objectif : page protégée par session | Date : 17/10/2026
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
?>
<!doctype html><html lang="fr"><head><meta charset="utf-8"><title>Profil</title></head><body>
<h1>Bienvenue <?= htmlspecialchars($_SESSION["login"], ENT_QUOTES, "UTF-8") ?> !</h1>
<a href="deconnexion.php">Se déconnecter</a>
</body></html>
