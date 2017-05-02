dab_Clicker
===========

A Symfony project created on March 10, 2017, 1:57 pm.

Librement inspiré de Cookie Clicker (orteil.dashnet.org/cookieclicker/), civclicker et l'explication de comment le développer (http://dhmholley.co.uk/incrementals.html) et CandyBox (candies.aniwey.net/)

Authors : LEVY Corentin - MASSON Bastien


PARTIES DU SITE ET EXPLICATIONS

Authentification : classique.

Avatar : classique, un avatar par personnage.

Personnages : chaque utilisateur peut avoir plusieurs persos qui sont concrètement des parties différentes.

Ressources persistantes & Points d'actions: chaque perso a accès à plusieurs ressources : les dabs, la monnaie principale du jeu, les doubles dabs, plus rares et permettant d'avoir des bonus, et les massons (jeu de mots valant au minimum +3 sur la note) qui permettent de créer les bâtiments. On gagne un masson par heure, pour un maximum de 10 massons (donc masson = point d'action).

Parties optionnelles 

Affichage des personnages : quand un utilisateur se connecte, il peut choisir quelle partie reprendre selon les infos affichées (affichage des ressources + nom de la partie).

Multijoueur : un joueur peut transmettre des dabs / doubles dabs. FYI, sur le marché noir, 10k dabs = 1€.

Statistiques : classique.

Messages privés : classique.

Evenements globaux & Calendrier des évènements : classique.


BASE DE DONNEES

2 tables

User : id / mail / password
Character : id / id_user (foreign key sur id de User) / dabs / double_dabs / massons / time_connected / messages


PLAN DU SITE :
Accueil = login form avec lien vers registration form

Une fois log -> choix du perso
Une fois le perso choisi -> on joue sur une seule page
Et toujours un petit lien logout en haut à droite.

Accueil
	Choose_char
		create_char
	Jeu
	Logout
Inscription