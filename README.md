# Projet de développement Web : Comparateur de véhicules VsCar

## Description du projet

Dans le cadre de ce projet, nous allons concevoir et réaliser un site web de comparaison des caractéristiques de divers véhicules. Le site utilisera les technologies HTML5, CSS3, PHP, JQuery, JavaScript, et Ajax. L'objectif est de fournir aux utilisateurs une plateforme conviviale pour comparer différents véhicules en termes de spécifications, de prix et d'avis. Le site suivra une architecture de type Modèle-Vue-Contrôleur (MVC).

## Fonctionnalités du site

### Page d'accueil

La page d'accueil du site contiendra :

- Un logo sous forme d'image en haut à gauche de la page.
- Des liens vers les réseaux sociaux en haut à droite.
- Un diaporama d'images qui sont des liens vers des news sur le monde de l'automobile et des publicités. Ces images apparaîtront à tour de rôle toutes les 5 secondes.
- Un menu horizontal contenant des liens vers les sections « News », « Comparateur », « Marques », « Avis », « Guides d'achat » et « Contact ».
- Un pied de page avec le même menu (sans le style).
- Une zone de contenu constituera le reste de la page.

### Comparateur

La partie contenue de la page principale sera divisée en 3 zones :

- La première contiendra les logos des principales marques de véhicules. Ces logos seront des liens vers la page de la marque correspondante.
- La deuxième zone contiendra 4 cadres, chacun contenant un formulaire de choix de la marque, du modèle, de la version et de l'année. Un bouton permettra de comparer les 4 véhicules dans la page comparaison.
- La dernière zone contiendra un bouton vers le guide d'achat, puis en dessous les comparaisons 2 par 2 les plus recherchées qui seront disposées dans des cadres.

### Page de comparaison

La page « Comparateur » reprendra la même interface que la zone 2 de la partie contenue. Le clic sur le bouton comparer offrira la possibilité de comparer les spécifications de deux à 4 voitures sur la même page. Le résultat sera un tableau comparatif affichant l'image du véhicule, ces informations pratiques (marque, modèle, version, année, note...etc.), des détails importants (puissance, consommation, capacité ... etc.) et les tarifs indicatifs. L'image sera un lien vers la page détaillée de la voiture.

### Page de news

La page « news » contiendra des cadres avec un titre, une image et un texte se terminant par un lien vers une page de news contenant des paragraphes et des images de cette information.

### Page des marques

La page « Marques » contiendra la même interface de logos des marques que la zone 1 de la partie contenue de la page d'accueil, mais avec le nom de la marque et une taille d'image plus grande. Le clic sur une image permettra d'afficher les informations générales sur la marque (Nom, pays d'origine, siège social, année de création...etc.) ainsi que des liens des principales voitures de la marque et une liste déroulante pour toutes les voitures qui permettront l'affichage des spécifications de chaque voiture (nom, modèle, version, année, dimensions, consommation, moteur, performances, note...etc.). Dans la page de description d'un véhicule, toutes les spécifications de celle-ci seront affichées en plus de la possibilité de le comparer avec d'autres véhicules.

## Authentification et Gestion des Administrateurs

### Authentification

L'authentification est un aspect crucial de ce projet. Elle permet de s'assurer que seuls les utilisateurs autorisés ont accès à certaines fonctionnalités du site. Voici comment elle pourrait être mise en œuvre :

- Lorsqu'un utilisateur visite le site pour la première fois, il devra créer un compte en fournissant des informations telles que son nom, son prénom, son adresse e-mail et un mot de passe.
- Le mot de passe de l'utilisateur sera haché avant d'être stocké dans la base de données pour des raisons de sécurité.
- Lorsque l'utilisateur revient sur le site, il devra se connecter en utilisant son adresse e-mail et son mot de passe.
- Si les informations d'identification fournies correspondent à celles stockées dans la base de données, l'utilisateur sera authentifié et aura accès aux fonctionnalités du site.

### Gestion des Administrateurs

La gestion des administrateurs est également un aspect important de ce projet. Elle permet de contrôler qui a le droit de modifier le contenu du site. Voici comment elle pourrait être mise en œuvre :

- Les administrateurs sont des utilisateurs qui ont des privilèges supplémentaires. Ces privilèges peuvent inclure la possibilité de modifier ou de supprimer des véhicules, des marques, des avis, des actualités, etc.
- Il peut y avoir différents types d'administrateurs, chacun ayant un ensemble spécifique de privilèges. Par exemple, un administrateur de type "Véhicule" pourrait avoir le droit de modifier les informations sur les véhicules, tandis qu'un administrateur de type "Marque" pourrait avoir le droit de modifier les informations sur les marques.
- Lorsqu'un administrateur se connecte, le site vérifie son type et lui accorde les privilèges appropriés.
- Les administrateurs peuvent également avoir la possibilité de gérer les autres utilisateurs, par exemple en modifiant leurs privilèges ou en supprimant leurs comptes.

Ces fonctionnalités d'authentification et de gestion des administrateurs contribueront à faire de votre site un environnement sûr et bien géré. Bon courage avec votre projet !

## À venir

- Implémentation des fonctionnalités restantes.
- Tests et débogage.
- Déploiement du site.

## Comment contribuer

Si vous souhaitez contribuer à ce projet, veuillez nous contacter. Toutes les contributions sont les bienvenues, qu'il s'agisse de corrections de bugs, d'améliorations de fonctionnalités ou de nouvelles idées.

D'accord, dans ce cas, vous pouvez utiliser la licence Creative Commons Attribution-NonCommercial 4.0 International (CC BY-NC 4.0). Cette licence permet à d'autres de distribuer, remixer, adapter et construire sur votre travail de manière non commerciale, et bien qu'ils doivent vous créditer et ne peuvent pas utiliser le travail à des fins commerciales, ils n'ont pas à obtenir de licence pour les nouvelles créations basées sur le vôtre.

Voici comment vous pourriez le formuler dans votre fichier README :

## Licence

Ce projet est sous licence Creative Commons Attribution-NonCommercial 4.0 International (CC BY-NC 4.0). Pour plus d'informations, veuillez consulter le fichier LICENSE ou visitez [la page de la licence](https://creativecommons.org/licenses/by-nc/4.0/).

## Contact

Si vous avez des questions ou des commentaires sur ce projet, n'hésitez pas à nous contacter à <kk_habouche@esi.dz>.
