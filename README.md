# Projet Redis NoSQL
Projet redis réalisé pour un cours de NoSQL. Modélisation d'un call center avec :
 - Opérateur (employé) :
      - Prénom
      - Nom
      - Email
      - Age
      
 - Appels :
      - Numéro
      - Description
      - Heure d'appel
      - Opérateur affecté à l'appel
      - Durée de l'appel
      
# Prérequis et lancement

Installation :
 - Apache2
 - Php
 - Redis
 - phpredis : https://github.com/phpredis/phpredis 
 - (un apt-get install php-redis possiblement nécessaire)
    
    
Cloner le repository dans var/www/html/'yourpath'
Lancer ~/redis-server
Lancer le service apache

Ouvrez un navigateur web, tapez dans l'url "localhost/'yourpath'"

# Modélisation

Chaque opérateur est stocké dans un Hash sous la forme :
 - operateur:id_operateur avec les champs suivants:
   - firstname
   - lastname
   - email
   - age
       
Les appels sont également stockés dans des Hash sous la forme:
 - appel:id_appel:
   - numero
   - description
   - heure
   - affectation
   - duree
 
 Les ids des opérateurs et des appels sont stockés dans des Sets avec les clés:
  - id_operateur
  - id_appel

 Les appels peuvent avoir trois status. Chaque status est représenté par un Set contenant les ids de tous les appels qui sont à cet état :
  - En attente : signifiant que la personne est en attente. Key = en_attente
  - En cours : la personne est au téléphone avec un opérateur. Key = en_cours
  - Terminé : la conversation est finie. Key = fini
 Lorsqu'un appel change d'état, il sufit de faire un smove afin de changer l'id de set.
 
 L'information de l'affection d'un opérateur à un appel est présente dans le hash de chaque appel. Cependant afin d'accéder simplement et rapidement à tous les appels traités par un opérateur (relation 1-N), on stocke également dans un set de la forme affectation:id_operateur tous les ids des appels traités par l'opérateur avec l'id id_operateur.
 
 # Fichiers
 
 ## Initialisation
 
 Le fichier initialisation.php créé 5 opérateurs ainsi que 1 appel par status. De plus il supprime les keys afin de pouvoir initialiser sur des sets et des hashs inextistants.
 
 ## Connexion à Redis
 
 La connexion à redis est assurée par le fichier connecition.php qui créer un objet Redis et une connexion en localhost.
 
 ## Vues pour la visualisation des données
 
  - before.html est appellé sur toutes les vues. Contient les import pour le style et la barre nav.
  - appels.php premet de voir tous les appels répartis dans 3 tableaux : un par état de l'appel. Elle est accéssible via l'onglet "Appels" de la barre nav
  - operateurs.php représente tous les opérateurs. Accessible depuis l'onglet "Opérateurs" de la barre nav.
  - operateur.php représente tous les appels affectés à un utilisateur particulier. Accessible en cliquant sur l'id de l'opérateur depuis la vue operateurs.php ou en cliquant sur le nom de l'opérateur depuis la vue appels.php.
  
  ## Vues pour la manipulation des données
  
  - newAppel.php contient le formulaire afin de rentrer un nouvel appel. Accessible depuis le bouton "Nouvel appel" de la vue 
  - affectation.php permet de choisir la personne à affecter à un appel.
  
  ## Scripts de modification des données
  
  - addAppel.php ajoute un appel aux sets et créer son Hash.
  - affectationAppel.php change l'état d'un appel et y affecte son opérateur.
  - endAppel.php est appelé lorsqu'un appel se fini. Il change l'état de l'appel et ajoute la durée au Hash de l'appel.


