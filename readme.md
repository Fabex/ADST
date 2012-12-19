Automatic Download Serie Torrent
================================

## A quoi ça sert

Cette application vous permez de pouvoir manager vos séries :

- Lien magnet
- Sous-titre
- Indiquer que vous avez déjà regardé cet épisode

## Pré-requi

1. Cette application ne fonctionne pour l'instant que sur Ubuntu ou autres systèmes du même genre

2. Cette application utilise l'API du site   [betaseries.com](http://www.betaseries.com/).

	Vous devez donc tout d'abord vous créer un [compte](http://www.betaseries.com/inscription?parrain=fabex).

	Ensuite ajouter toutes les séries que vous suivez.

3. Un client Torrent

4. Un dossier contenant l'ensemble de vos séries ai ce type [d'arborescence](https://github.com/Fabex/ADST/blob/master/arbo.png)

## Installation

### Télécharger

- cd ~/webroot
- mkdir adst
- git clone git@github.com:Fabex/ADST.git adst

### Création du virtualhost

- Dans votre virtualhost ajouté :

	NameVirtualHost adst

	&lt;VirtualHost adst:80&gt;

        	DocumentRoot ~/webroot/adst
	        ServerName adst
	
        	ErrorLog ~/webroot/adst/error.log
	
        	# Possible values include: debug, info, notice, warn, error, crit,
        	# alert, emerg.
        	LogLevel warn
	&lt;/VirtualHost&gt;

- Dans votre hosts :

	127.0.0.1       adst

## Configuration

1. Modifier le fichier lib/Tool.lib.php

	à la ligne 15 remplacé par vos login et mot de passe de betaseries

2. Crée un lien symbolique "Series" vers votre dossier de ou vous stockez vos séries

	- cd ~/webroot/adst

	- ln -s /path/to/series/folder Series
 
