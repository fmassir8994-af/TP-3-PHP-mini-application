<?php
// Auteur : [Votre nom] | Objectif : validation et enregistrement CSV | Date : 17/10/2026
require __DIR__ . "/config.php";

$champs = ["nom", "note_info", "note_math"];
foreach ($champs as $champ) {
    if (!isset($_POST[$champ]) || is_array($_POST[$champ]) || trim((string)$_POST[$champ]) === "") {
        exit("Erreur : champ manquant ou vide.");
    }
}
$nom = trim($_POST["nom"]);
$noteInfo = filter_var($_POST["note_info"], FILTER_VALIDATE_FLOAT);
$noteMath = filter_var($_POST["note_math"], FILTER_VALIDATE_FLOAT);
if ($noteInfo === false || $noteMath === false ||
    $noteInfo < NOTE_MIN || $noteInfo > NOTE_MAX ||
    $noteMath < NOTE_MIN || $noteMath > NOTE_MAX) {
    exit("Erreur : les notes doivent être comprises entre " . NOTE_MIN . " et " . NOTE_MAX . ".");
}
$moyenne = ($noteInfo + $noteMath) / 2;
$mention = $moyenne >= 16 ? "Très bien" : ($moyenne >= 14 ? "Bien" : ($moyenne >= 12 ? "Assez bien" : ($moyenne >= SEUIL ? "Passable" : "Ajourné")));

$repertoire = __DIR__ . "/data";
if (!is_dir($repertoire)) mkdir($repertoire, 0775, true);
$fichier = fopen($repertoire . "/notes.csv", "a");
if ($fichier === false) exit("Erreur : impossible d'ouvrir le fichier CSV.");
fputcsv($fichier, [$nom, $noteInfo, $noteMath], ";");
fclose($fichier);

echo "<h1>Récapitulatif</h1>";
echo "<p>Nom : " . htmlspecialchars($nom, ENT_QUOTES, "UTF-8") . "</p>";
echo "<p>Informatique : " . htmlspecialchars((string)$noteInfo) . "</p>";
echo "<p>Mathématiques : " . htmlspecialchars((string)$noteMath) . "</p>";
echo "<p>Moyenne : " . number_format($moyenne, 2) . " — " . htmlspecialchars($mention) . "</p>";
echo '<p><a href="saisie.html">Ajouter un apprenant</a> | <a href="liste.php">Voir la liste</a></p>';

// POST évite d'exposer les données dans l'URL et convient aux données envoyées au serveur,
// mais ne chiffre pas les données : utiliser HTTPS pour un mot de passe.
// $_REQUEST peut contenir les données de $_GET, $_POST et $_COOKIE selon la configuration PHP.
