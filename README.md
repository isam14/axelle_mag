Axelle Mag
==========

Faire un **composer update** pour ajouter le vendor et les fichiers requis pour faire tourner symfony.

Faire **php bin/console ckeditor:install** puis **php bin/console assets:install --symlink** pour installer le package wysiwyg
 ( si message d'erreur  : sudo apt-get install php7.0-zip  remplacer la version par celle de php sur la machine)

Faire **php bin/console doctrine:database:create** puis **php bin/console doctrine:schema:update --force**

Ajouter /register à l'URL pour créer le compte.

Une fois le compté créé, aller dans **app/config/routing.yml** et sur **fos_user**, changer **.../all.xml** par **.../security.xml**

Initialiser les tables dans la db, une fois cela fait, ajuster les paramètres dans **app/config/parameters.yml** (*database_...*)

Lancer les requêtes du fichier **initialisationLignesTab.sql** pour set les entrées par défaut requises dans la db.

Pour swiftmailer (système de newsletter), paramétrer **app/config/parameters.yml** (*mailer_...*)

Pour accéder au backoffice, il faudra ajouter /admin à l'URL et entrer les identifiants.
