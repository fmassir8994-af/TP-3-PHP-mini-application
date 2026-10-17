<?php
// Auteur : [Votre nom] | Objectif : traitement du formulaire GET | Date : 17/10/2026
$nom = trim($_GET["nom"] ?? "");
$prenom = trim($_GET["prenom"] ?? "");
$sexe = $_GET["sexe"] ?? "";
if ($nom === "" || $prenom === "") {
    exit("Veuillez renseigner le nom et le prénom.");
}
$civilite = $sexe === "F" ? "Madame" : "Monsieur";
echo "Bonjour " . $civilite . " " . htmlspecialchars($prenom) . " " . htmlspecialchars($nom);
