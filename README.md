# GreenChallenges

# Récuperer les dependances
composer update

# Crée une base de donnée
php bin/console doctrine:database:create

# Crée une nouvelle version de la BDD
 php bin/console make:migration (ou) php bin/console ma:mi

# Envoie la version à la BDD
 php bin/console doctrine:migrations:migrate (ou) php bin/console do:mi:mi
