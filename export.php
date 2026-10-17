<?php
// Auteur : [Votre nom] | Objectif : export JSON et sérialisation | Date : 17/10/2026
require __DIR__ . "/config.php";
$fichier = __DIR__ . "/data/notes.csv";
if (!file_exists($fichier)) exit("Aucune donnée à exporter.");
$fp = fopen($fichier, "r");
if ($fp === false) exit("Impossible d'ouvrir le CSV.");
$resultats = [];
while (($ligne = fgetcsv($fp, 0, ";")) !== false) {
    if (count($ligne) < 3 || !is_numeric($ligne[1]) || !is_numeric($ligne[2])) continue;
    $moyenne = ((float)$ligne[1] + (float)$ligne[2]) / 2;
    $resultats[] = ["nom" => $ligne[0], "note_info" => (float)$ligne[1],
        "note_math" => (float)$ligne[2], "moyenne" => $moyenne];
}
fclose($fp);
$json = json_encode($resultats, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
if ($json === false) exit("Erreur de conversion JSON.");
file_put_contents(__DIR__ . "/data/notes.json", $json);
$contenu = file_get_contents(__DIR__ . "/data/notes.json");
$donnees = json_decode($contenu, true);
echo "<h1>Contenu JSON décodé</h1><pre>";
echo htmlspecialchars(print_r($donnees, true));
echo "</pre><h2>Comparaison</h2><pre>";
echo htmlspecialchars(serialize($resultats));
echo "\n\n";
echo htmlspecialchars(json_encode($resultats, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "</pre>";
// JSON est directement exploitable par JavaScript ; serialize() est un format propre à PHP.
