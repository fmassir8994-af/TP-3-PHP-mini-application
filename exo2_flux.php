<?php
// Auteur : [Votre nom] | Objectif : conditions et boucles | Date : 17/10/2026
require __DIR__ . "/config.php";

function mention(float|int $note): string {
    if ($note >= 16) return "Très bien";
    elseif ($note >= 14) return "Bien";
    elseif ($note >= 12) return "Assez bien";
    elseif ($note >= SEUIL) return "Passable";
    return "Ajourné";
}
foreach ([18, 15, 13, 10, 8] as $n) {
    echo $n . " : " . mention($n) . "<br>";
}

// Exercice 2.2 : switch sur le mois
$mois = (int) date("m");
switch ($mois) {
    case 1: $nomMois = "janvier"; break;
    case 2: $nomMois = "février"; break;
    case 3: $nomMois = "mars"; break;
    case 4: $nomMois = "avril"; break;
    case 5: $nomMois = "mai"; break;
    case 6: $nomMois = "juin"; break;
    case 7: $nomMois = "juillet"; break;
    case 8: $nomMois = "août"; break;
    case 9: $nomMois = "septembre"; break;
    case 10: $nomMois = "octobre"; break;
    case 11: $nomMois = "novembre"; break;
    case 12: $nomMois = "décembre"; break;
    default: $nomMois = "mois inconnu";
}
echo "<p>Mois courant : " . $nomMois . "</p>";
// Sans break, PHP continue dans les cases suivants (fall-through).

// Exercice 2.3.1 : triangle de 1 à 6 étoiles
for ($i = 1; $i <= 6; $i++) {
    for ($j = 1; $j <= $i; $j++) echo "*";
    echo "<br>";
}

// Exercice 2.3.2 : while, nombres pairs de 0 à 20
$i = 0;
while ($i <= 20) {
    if ($i === 10) echo "<strong>$i</strong><br>";
    else echo $i . "<br>";
    $i += 2;
}

// Exercice 2.3.3 : for + continue
for ($i = 0; $i <= 10; $i++) {
    if ($i % 2 !== 0) continue;
    echo $i . " ";
}
echo "<br>";

// Exercice 2.3.4 : break 2 quitte switch ET boucle
$i = 1;
while ($i <= 12) {
    switch ($i) {
        case 5:
            echo "At 5<br>";
            break; // quitte seulement switch
        case 10:
            echo "At 10; quitting<br>";
            break 2; // quitte switch et while
    }
    $i++;
}

// Exercice 2.3.5 : do-while
$i = 0;
do {
    if ($i === 10) echo "<strong>$i</strong><br>";
    else echo $i . "<br>";
    $i += 2;
} while ($i <= 20);
// do-while exécute le bloc au moins une fois ; while vérifie la condition avant.
