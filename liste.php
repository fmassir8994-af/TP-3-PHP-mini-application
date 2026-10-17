<?php
// Auteur : [Votre nom] | Objectif : lecture et affichage CSV | Date : 17/10/2026
require __DIR__ . "/config.php";
$fichier = __DIR__ . "/data/notes.csv";
if (!file_exists($fichier)) exit("Aucune donnée : le fichier notes.csv n'existe pas.");
$fp = fopen($fichier, "r");
if ($fp === false) exit("Erreur : impossible de lire le fichier.");
$totalMoyennes = 0; $nombre = 0;
echo '<!doctype html><html lang="fr"><meta charset="utf-8"><h1>Liste des apprenants</h1>';
echo '<table border="1" cellpadding="6"><tr><th>Nom</th><th>Info</th><th>Math</th><th>Moyenne</th><th>Mention</th></tr>';
while (($ligne = fgetcsv($fp, 0, ";")) !== false) {
    if (count($ligne) < 3) continue;
    [$nom, $info, $math] = $ligne;
    if (!is_numeric($info) || !is_numeric($math)) continue;
    $moy = ((float)$info + (float)$math) / 2;
    $mention = $moy >= 16 ? "Très bien" : ($moy >= 14 ? "Bien" : ($moy >= 12 ? "Assez bien" : ($moy >= SEUIL ? "Passable" : "Ajourné")));
    echo "<tr><td>" . htmlspecialchars($nom) . "</td><td>" . htmlspecialchars($info) . "</td><td>" .
         htmlspecialchars($math) . "</td><td>" . number_format($moy, 2) . "</td><td>" . $mention . "</td></tr>";
    $totalMoyennes += $moy; $nombre++;
}
fclose($fp);
echo "</table>";
echo "<p>Moyenne générale de la classe : " . ($nombre ? number_format($totalMoyennes / $nombre, 2) : "Aucune donnée") . "</p>";

// Lecture bas niveau demandée en 5.3 : fgets + explode (moins fiable si un champ contient ; ou guillemets).
$fp2 = fopen($fichier, "r");
echo "<h2>Exemple fgets / explode</h2><pre>";
while (!feof($fp2)) {
    $ligne = fgets($fp2);
    if ($ligne === false) break;
    print_r(explode(";", trim($ligne)));
}
fclose($fp2);
echo "</pre><p>fgetcsv() gère les champs CSV entre guillemets ; explode() est plus simple mais ne gère pas correctement les séparateurs intégrés aux champs.</p>";
echo '<p><a href="saisie.html">Retour à la saisie</a></p></html>';
