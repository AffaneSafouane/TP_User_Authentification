# TP : Élaboration d'un CRUD et Système d'Authentification

Ce projet a pour objectif la mise en place d'un système de gestion de données (Back-end) et la sécurisation de l'accès utilisateurs via une architecture modulaire.

## Objectifs

L'objectif principal est la **maîtrise du CRUD**.

> **CRUD** (Create, Read, Update, Delete) est l'acte élémentaire de l'informatique de gestion. Il représente les quatre opérations de base pour la persistance des données dans une application Web.

Ce TP vise également à :
* Gérer la connexion des utilisateurs.
* Sécuriser le processus d'authentification.

---

## Architecture : Principe de Séparation des Responsabilités

Pour respecter les bonnes pratiques de développement (inspirées notamment de frameworks comme Symfony), ce projet sépare distinctement les données de leur gestion. Nous utilisons deux classes principales :

### 1. La Classe `User` (Entité)
* **Rôle :** Représentation objet de la table `User` de la base de données.
* **Contenu :** Elle contient les propriétés de l'utilisateur (nom, email, mot de passe, etc.) et les accesseurs (Getters/Setters). Elle ne contient **aucune logique métier** ni requête SQL.

### 2. La Classe `UserManager` (Service / Repository)
* **Rôle :** Gère la persistance des données.
* **Contenu :** Elle contient toutes les méthodes pour interagir avec la base de données (INSERT, SELECT, UPDATE, DELETE). C'est elle qui "manipule" les objets `User`.

### Pourquoi cette séparation ?
Dans des frameworks modernes comme Symfony, ces responsabilités sont toujours distinctes (Entity vs Repository). Cette approche rend le code plus maintenable, testable et évolutif.

---

## Fonctionnalités Implémentées

L'application rendue couvre le parcours fonctionnel suivant :

### 1. Accueil Dynamique
La page d'accueil s'adapte selon l'état de l'utilisateur :
* **Si non connecté :** Affiche un message invitant à la connexion.
* **Si authentifié :** Affiche un message de salutation personnalisé.

### 2. Authentification (Login)
* Formulaire de connexion sécurisé.
* Vérification des identifiants via le `UserManager`.

### 3. Création de Compte (Register)
* Formulaire d'inscription pour créer un nouvel utilisateur.
* Persistance du nouvel utilisateur en base de données via le `UserManager`.

**Contexte :** TP Développement Web - Backend
