# Be Five, réseau social qui vise à réunir les gamers (joueurs de jeux vidéos) entre eux

## Sommaire

1. [Header](#header)
2. [Panneau de navigation](#panneau-de-navigation)


## Plan du site

> Toutes les informations en dessous sont générales à toutes les pages à part dans la page de profil

> Sur toutes les pages, il y aura un système de notifications en temps réel qui affichera les notifications à l'écran pour une durée de 10 sec avant de disparaître.


### Header

>Dans le **header**, il y aura:
>	- Le logo de be five,
>	- Une barre de recherche,
>	- Un bouton d'action pour ajouter une publication,
>	- Une petite navigation pour au moins un lien vers la page d'accueil,
>	- Un lien vers son propre profil,
>	- Un bouton pour afficher les notifications,
>	- Un bouton pour les réglages et certaines aides et certaines informations.

#### La barre de recherche

Dans cette barre, on pourra rechercher plusieurs informations:
- **Un utilisateur**
- **Une publication**
- **Une équipe**
- **Un jeu**
- **Une page d'un jeu**

#### Le bouton pour ajouter une publication

Le bouton ouvrira une boite lors du clic, ce sera un formulaire pour ajouter une publication

#### Le bouton des notifications

Les notifications s'afficheront dans une boite scrollable et les notifications s'afficheront en lazy loading

#### Navigation des paramètres

La navigation :
- Un lien vers le profil
	- Des informations sur l'équipe actuelle
	- La barre d'expérience
- Paramètres et confidentialités
	- Les notifications
	- L'historique personnel
	- Les différentes connexion (IP) sur le site
	- La langue
- Aide et assistance
	- Les raccourcis clavier
	- Signaler un problème
- Se déconnecter


### Panneau de navigation

> Le panneau de navigation sera sur la gauche du site, ce sera une colonne qui aura des informations importantes sur le profil d'un joueur et il y aura aussi une navigation plus poussée que dans le header avec des liens vers divers plateforme comme *discord* ou *twitch*, tout en bas de cette colonne, il y aura des liens vers les termes de confidentialités.


#### Profil

Dans ce petit espace dédié au profil, il y aura :
- **La photo de profil**
- **Le nom réel du joueur** si il l'a indiqué
- **Le pseudo** (qui ne sera pas unique car plusieurs personnes peuvent avoir le même pseudo sans le savoir)
- **La barre d'expérience** (cette barre d'expérience pourra permettre au différentes personnes de se classer sur le site)
- **Le hashtag** (qui sera différent pour chaque personne ayant le même pseudo pour pouvoir les différentier dans l'url
- **L'équipe**

#### Navigation

Dans cette navigation, il y aura:
- **[Accueil](#la-page-d-accueil)**
- **[Profil](#page-de-profil)**
- **[Équipe](#page-d-equipe)**
- **[Amis](#page-des-amis)**
- **[Message](#page-des-messages)**
- **[Vidéo](#page-des-videos)**
- **[Jeux](#page-des-jeux)**
- **[Tournoi](#page-des-tourois)**
- **[Classement](#page-du-classement)**
- **[Paramètres](#page-des-parametres)**

#### Lien vers divers plateforme

Les divers plateforme sont:
- **[Discord]()**
- **[Twitch]()**


### Panneau des amis

> Ce panneau sera une colonne se situant sur la droite du site, il y aura une liste de tous les amis connectés.

#### Infos d'un ami

Les informations seront:
- **Son image de profil**
- **Son pseudo**
- **Son jeu auquel il joue** (à voir si je trouve comment faire)
- **Son statut** ('En ligne', 'Occupé', 'Absent', 'Hors ligne')

***

### La page d'accueil

> Dans la page d'accueil, il y aura un champ de formulaire destinés à publier des posts et il y aura des posts qui seront triés stratégiquement.

#### Champ de formulaire

Dans ce champ de formulaire, il y aura:
- **Un champ pour le message à afficher**
- **Un bouton pour des images**
- **Un bouton pour des vidéos**
- **Un champ de recherche** pour trouver le jeu sur lequel on publie le post
- **Un bouton d'envoi**


#### Posts

Les posts seront triés de cette façon:
1. **Le post que l'on vient de poster** si celui-ci ne dépasse pas 1h
2. **Un post d'un ami**
3. **Un post d'une personne connu** (*Influanceur*, *Streamer*, *Youtuber*)
4. **Un post d'un jeu** dont vous restez le plus souvent devant le post
5. **Une publicité**

Ce sera un tableau qui se créera à l'infini plus l'utilisateur scrollera, ce tableau s'affichera en lazy-loading

### Page de profil

> La seule page qui aura pas le panneau du profil, sur cette page, il y aura :
> - une bannière pour le joueur avec ses jeux à afficher si il veut se faire recruter (3 jeux)
> - Les posts du joueurs ou les posts dans lesquels il a été identifié
> - D'autres petits panneaux d' informations :
>   - Son équipe si il en a une
>   - Les informations générales (si il veut les afficher)
>   - Son classement sur certains jeux
>   - Son classement sur le site
>   - Les jeux auquel il joue

### Page d'équipe

> Sur la page d'équipe, il y aura la liste de certaines équipes **publiques** avec un champ de recherche et un filtre qui permettra de filtrer les équipes par rapport aux jeux auquel le joueur joue. Les équipes s'afficheront en lazy-loading

### Page des amis

> Sur cette page, il y aura la liste de tous les amis qui pourront être triés, filtrer et rechercher

> Ils pourront être trié par statut ('En ligne', 'Absent', 'Hors Ligne')

> Ils pourront être filtrés par jeux où par équipe

### Page des message

> Il y aura comme pour les amis une liste de tout les messages ou les groupes de message qui pourront être recherché

### Page des vidéos

> Ce sera comme la page d'accueil mais uniquement avec des vidéos, ce sera un peu comme *"à la tiktok"*

### Page des jeux

> Une liste de tout les jeux, recherchable, triable et filtrable avec beaucoup de paramètres