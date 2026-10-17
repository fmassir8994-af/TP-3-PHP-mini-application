<?php
// Auteur : [Votre nom] | Objectif : variables, constantes, types et chaînes | Date : 17/10/2026
require __DIR__ . "/config.php";

echo "<h1>Hello PHP</h1>";

// Exercice 1.1 : noms valides
// $x : valide ; $_x : valide ; $2x : invalide (un nom ne commence pas par un chiffre).
// $x-y : invalide comme nom de variable (le tiret est interprété comme une soustraction).
// $Prix_HT : valide ; $prix ht : invalide (espace interdit).
// $état : accepté dans les versions modernes de PHP, mais les identifiants ASCII sont préférables.
$x = 1;
$_x = 2;
$Prix_HT = 3;
$état = 4;
$a = "minuscule";
$A = "majuscule";
echo "<p>a = " . htmlspecialchars($a) . " ; A = " . htmlspecialchars($A) . "</p>";

// Exercice 1.2 : constantes
echo ETABLISSEMENT . "<br>";
echo "NOTE_MIN = " . NOTE_MIN . "<br>";
echo "NOTE_MAX = " . NOTE_MAX . "<br>";
echo "SEUIL = " . SEUIL . "<br>";
var_dump(defined("SEUIL"));       // true
var_dump(defined("INCONNUE"));    // false
// Une constante non définie produit généralement une erreur/avertissement et est traitée comme nom constant inconnu.
// const est déclarée à l'écriture du code ; define() définit une constante à l'exécution.

// Exercice 1.3 : calcul
$prix_ht = 60;
$tva = 20;
$prix_ttc = $prix_ht * (1 + $tva / 100);
echo "<p>Le prix TTC du produit est de " . $prix_ttc . " €.</p>";

// Exercice 1.4 : types et conversions
$test = 42;
$test = (string) $test;
var_dump($test); // string(2) "42"
foreach ([0, 0.0, "0", "", "abc", [], null] as $valeur) {
    var_dump((bool) $valeur);
}
var_dump((int) 3.9);       // 3
var_dump((int) "12abc");   // 12 dans les versions courantes de PHP
var_dump((float) "1.5e3"); // 1500
var_dump((int) true);      // 1
echo "<p>Décimal : " . 255 . " ; hexadécimal : " . dechex(255) .
     " ; octal : " . decoct(255) . " ; binaire : " . decbin(255) . "</p>";

// Exercice 1.5 : chaînes
echo '<p>Ahmed a dit : "J\'ai réussi"</p>';
echo '<p>Voulez-vous supprimer C:\*.*?</p>';
echo '<p>Ceci n\'affichera pas \n de nouvelle ligne (le \n doit apparaître tel quel)</p>';
$traitees = "égales à";
$ici = 2;
echo '<p>Les variables ne seront pas $traitees $ici</p>';
echo "<p>Les variables seront $traitees $ici</p>";

$texte = "*Bonjour les développeurs*";
$texte = trim($texte, "*");
echo "<p>" . htmlspecialchars($texte) . "</p>";
for ($i = 0; $i < strlen($texte); $i++) {
    echo htmlspecialchars($texte[$i]) . "<br>";
}
// Note : strlen() compte les octets ; les caractères accentués peuvent occuper plusieurs octets.
