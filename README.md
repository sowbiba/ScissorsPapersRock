# Hackathon #5

## Participants

* Bobynette               : Florent Degardin
* Crazy                   : Tirage au sort
* Love                    : Robin Duval
* Zerg                    : Florent Sevestre
* Hal                     : Patrick Renaud
* LightJarvis             : El Mehdi Brahimi
* Alpha                   : Ibrahima Sow
* Streichholzschachtel    : Verena Lenes
* Prout                   : Nicolas Moulin

## Voici les IA déjà mis en place

* Evil
* Happy
* HardCoop
* HardMajority
* Lain
* Love
* Moody
* PeriodicCCT
* PeriodicTTC
* Rancor
* SoftMajority
* Sounder
* Wary


## Introduction

Vous êtes enfermés avec une autre IA, dont vous ne connaissez pas l'identité.

Vous avez trois choix : pierre (rock), feuille (paper) ou ciseaux (scissors).
En fonction de vos deux choix, les gains (ou pertes) sont répartis de la manière suivante.

| Moi @ L'autre | pierre          | feuille    | ciseaux   |
| ------------- | --------------- | ---------- |---------- |
| pierre        | 1 @ 1           | 0 @ 5      | 5 @ 0     |
| feuille       | 5 @ 0           | 1 @ 1      | 0 @ 5     |
| ciseaux       | 0 @ 5           | 5 @ 0      | 1 @ 1     |

## Comment faire ?

A chaque tour, vous devez faire un choix 'rock', 'paper' ou 'scissors', en fonction du contexte.

## Objectif

Il faut avoir le plus haut score. Les scores se cumulent entre chaque match.

## Informations

Il y a 10'000 tours par match.
Pour vous aidez à faire vos choix, vous avez accès aux informations suivantes :
- votre (ou son) dernier choix
- la pile de vos (ou ses) choix
- votre (ou son) dernier gain (ou perte)
- la pile de vos (et ses) gains (ou pertes)
- des statistiques (pour vous, pour l'autre ou les deux) concernant le nombre de fois : où il a été dit 'rock', 'paper', 'scissors'' et le score de chacun
- le numéro du tour où vous en êtes (le tour 0 signifie le premier tour)

Les informations sont dans la proprieté result de votre objet.

## Les scripts à connaitre

./phpunit.phar : permet de lancer les tests (ils seront lancés AVANT de lancer tous les combats)
php EntryPoint.php : permet de lancer les combats ET de générer un fichier index.html avec l'ensemble des résultats

## Les résultats - Etape par Etape

* Récupération de vos classes que je remplace
* Remplacement (ou non) de la classe Crazy par les autres IA
* Execution des tests qui permettent de vérifier s'il n'y a pas eu triche et que vos IAs sont compatibles (si une IA ne passe pas les tests ==> c'est la disqualification)
* Generation de la page de résultats

## Notes

- Les boucles infinis, l'utilisation de die, exit, exceptions, signal, ... sont interdits.
- Une vérification du temps d'execution sera effectué.
- Les valeurs de la matrice de gains/pertes sont amenées à évoluer, ainsi que le nombre de tours pour un match (le nombre de tours sera toujours supérieur à 100).
- Les IAs Lazy, Crazy ne seront pas les mêmes sur l'environnement final. Elles ne servent qu'à tester votre propre IA.

## Quotes

Prediction is very difficult, especially about the future.
-Niels Bohr
