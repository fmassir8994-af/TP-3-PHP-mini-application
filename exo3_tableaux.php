<?php
// Auteur : [Votre nom] | Objectif : tableaux et statistiques | Date : 17/10/2026
require __DIR__ . "/config.php";
require __DIR__ . "/exo2_flux.php";

$notes = [
    "Mohamed" => 16, "Ahmed" => 14, "Hind" => 13, "Aicha" => 15,
    "Samir" => 13, "Zakaria" => 13, "Rafik" => 10, "Ilham" => 9,
    "Hamza" => 7, "Sami" => 7, "Noura" => 14
];
$modules = ["PHP", "UML", "Probabilités"];

function afficher(array $tab): void {
    echo "<ul>";
    foreach ($tab as $cle => $valeur) {
        echo "<li>" . htmlspecialchars((string)$cle) . " : " .
             htmlspecialchars((string)$valeur) . "</li>";
    }
    echo "</ul>";
}

include __DIR__ . "/includes/entete_inc.php";
include __DIR__ . "/includes/menu_inc.php";

echo "<h2>Modules (foreach)</h2>";
foreach ($modules as $module) echo htmlspecialchars($module) . "<br>";
echo "<h2>Modules par indice</h2>";
for ($i = 0; $i < count($modules); $i++) echo "$i : " . htmlspecialchars($modules[$i]) . "<br>";

// Tableau HTML et statistiques
echo '<h2>Notes des apprenants</h2><table border="1" cellpadding="6"><tr><th>Nom</th><th>Note</th><th>Mention</th></tr>';
$somme = 0; $meilleure = null; $faible = null; $effectifs = [];
foreach ($notes as $nom => $note) {
    $couleur = $note < SEUIL ? ' style="color:red"' : '';
    echo "<tr$couleur><td>" . htmlspecialchars($nom) . "</td><td>$note</td><td>" . htmlspecialchars(mention($note)) . "</td></tr>";
    $somme += $note;
    $meilleure = $meilleure === null ? $note : max($meilleure, $note);
    $faible = $faible === null ? $note : min($faible, $note);
    $m = mention($note);
    $effectifs[$m] = ($effectifs[$m] ?? 0) + 1;
}
echo "</table>";
$moyenne = $somme / count($notes);
echo "<p>Somme : $somme ; moyenne : " . number_format($moyenne, 2) .
     " ; meilleure : $meilleure ; plus faible : $faible</p>";
echo "<p>Vérification : somme = " . array_sum($notes) . " ; nombre = " . count($notes) .
     " ; max = " . max($notes) . " ; min = " . min($notes) . "</p>";
echo "<h3>Effectifs par mention</h3>";
afficher($effectifs);

// Tri : utiliser des copies pour garder l'ordre initial
$tmp = $notes; ksort($tmp); echo "<h3>Noms croissants (ksort)</h3>"; afficher($tmp);
$tmp = $notes; arsort($tmp); echo "<h3>Notes décroissantes (arsort)</h3>"; afficher($tmp);
$tmp = $notes; krsort($tmp); echo "<h3>Noms décroissants (krsort)</h3>"; afficher($tmp);
$tmp = $notes; asort($tmp); echo "<h3>Notes croissantes (asort)</h3>"; afficher($tmp);

// Opérateurs de tableaux
$a = ["x" => 1, "y" => 2];
$b = ["y" => 2, "x" => 1];
var_dump($a + $b);   // union : garde les clés de gauche si elles existent
var_dump($a == $b);  // true : mêmes paires clé/valeur, ordre ignoré
var_dump($a === $b); // false : identité stricte, ordre des clés différent

include __DIR__ . "/includes/pied_inc.php";
