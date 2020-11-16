# Mise en pratique de la POO en PHP
## Présentation
Création d'un blog avec des articles triés par catégories. Administration avec un back-office. Ajout de fonctionnalités : boutique, formulaire de contact...
<br>
Modulaire : On peut activer / désactiver des blocs

## Packages utilisés
### guzzlehttp/psr7
Permet d'avoir un code testable via PHPUnit en créant de fausses requêtes et récupérer réponses pour faire des vérifications dessus.
<br>
Request et Response vont être ensuite utilisés dans cette formation.
<br>
Résumé d'utilisation : https://youtu.be/WHjx-MfgaFo?t=2199

### squizlabs/php_codesniffer=*
Permet de vérifier la qualité du code et les bonnes pratiques. On peut lui préciser dans un fichier "phpcs.xml" les règles que l'on veut utiliser pour vérifier le code.
<br>
Résumé d'utilisation : https://youtu.be/WHjx-MfgaFo?t=2199

## Tips
### Lancer un serveur PHP, avec affichage des erreurs, sur le dossier public
```
php -S localhost:8000 -d display_errors=1 -t public
```

### Ignorer composer.lock dans le fichier git
Le fichier composer.lock est influencé par la version de PHP, donc si je travaille avec une version PHP différente de celle de mon serveur, il peut avoir des dépendances à une version différente.

### Lancer les commandes PHPCS et PHPUnit
On peut lancer les commandes pour faire des tests et sniffer le code en même temps :
```
.\vendor\bin\phpunit ; .\vendor\bin\phpcs
```