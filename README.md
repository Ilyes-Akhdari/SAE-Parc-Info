# 🖥️ Système Web de Gestion de Parc Informatique (SAÉ 3)

![Stack](https://img.shields.io/badge/Stack-LAMP-blue.svg)
![Database](https://img.shields.io/badge/Database-MariaDB-4479A1.svg)
![Infra](https://img.shields.io/badge/Infra-Raspberry_Pi-C51A4A.svg)
![Documentation](https://img.shields.io/badge/Focus-QA_%26_Docs-success.svg)

## 📌 Contexte du Projet
Ce projet a été réalisé en équipe dans le cadre du **BUT Informatique**. Il s'agit de la conception intégrale et du déploiement d'une application web de gestion de parc informatique pédagogique, hébergée sur un serveur physique **Raspberry Pi (Debian)**.

L'objectif était de mobiliser une architecture complète (Fullstack) tout en respectant un cycle de développement professionnel : de l'analyse des besoins jusqu'au déploiement système, en passant par la conception UML et la base de données.

## 🎯 Mes Contributions Spécifiques
En tant que membre très impliqué dans le cycle de vie de cette application, j'ai particulièrement piloté les axes suivants :

- **UI/UX & Front-End :** Conception des maquettes initiales, définition de la charte graphique (couleurs, ergonomie) et développement de l'interface utilisateur pour garantir une navigation fluide aux différents profils (Admin, Tech).
- **Intégrité de la Base de Données :** Participation active à la modélisation et à l'implémentation de la base **MariaDB** (garantie des contraintes d'intégrité, relations fiables entre le matériel et les utilisateurs).
- **Assurance Qualité (QA) & Documentation :** Travail approfondi de synthèse, de vérification croisée et de validation technique sur l'ensemble des livrables (Cahier des charges, spécifications fonctionnelles, modèles UML). Une documentation rigoureuse est la première ligne de défense d'un projet maintenable.

## ⚙️ Fonctionnalités Principales

### Authentification & Droits (RBAC)
- Connexion sécurisée et routage selon 3 niveaux d'accréditation.
- **Administrateur :** Gestion des comptes, systèmes d'exploitation et constructeurs.
- **Technicien :** Gestion opérationnelle (CRUD) des machines du parc via formulaires sécurisés.
- **Administrateur système :** Audit et monitoring du serveur (Logs Apache).

### Stack Technologique
- **Infrastructure :** Raspberry Pi sous Debian.
- **Serveur & Base de données :** Apache, PHP, MariaDB.
- **Statistiques :** Analyse de données via parsing de fichiers CSV.

---

## 📂 Organisation de l'Architecture (MVC & Cycle en V)

Notre dépôt reflète une méthodologie de travail structurée :

* 📁 **Analyse & Spec :** Recueil des besoins, cahier des charges, et spécifications.
* 📁 **Conception :** Diagrammes UML, Modèles conceptuels et logiques (MCD/MLD).
* 📁 **SRC (Code Source) :** Logique métier séparée par rôles (`admin`, `sysadmin`, `tech`, `stats`).
* 📁 **Test :** Scripts et protocoles de validation.
