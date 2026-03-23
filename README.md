# 🖥️ Système Web de Gestion de Parc Informatique (SAÉ 3)

![Stack](https://img.shields.io/badge/Stack-LAMP-blue.svg)
![Database](https://img.shields.io/badge/Database-MariaDB-4479A1.svg)
![Infra](https://img.shields.io/badge/Infra-Raspberry_Pi-C51A4A.svg)
![Documentation](https://img.shields.io/badge/Focus-QA_%26_Docs-success.svg)

## 📌 Contexte du Projet
Ce projet a été réalisé en équipe dans le cadre du **BUT Informatique**. Il s'agit de la conception intégrale et du déploiement d'une application web de gestion de parc informatique pédagogique, hébergée sur un serveur physique **Raspberry Pi (Debian)**.

L'objectif était de mobiliser une architecture complète (Fullstack) tout en respectant un cycle de développement professionnel : de l'analyse des besoins jusqu'au déploiement système, en passant par la conception UML et la base de données.

## 🎯 Mes Contributions Spécifiques
Au sein de l'équipe, j'ai adopté un rôle fortement orienté sur la cohérence globale du projet, la vérification et l'interface :

- **UI/UX & Maquettage :** Participation à l'élaboration de la maquette initiale, avec un focus particulier sur l'identité visuelle de l'application (choix des couleurs, de la typographie et agencement).
- **Base de Données (MariaDB) :** Revue et vérification de la conception (MCD/MLD/Tables). Je suis notamment intervenu en fin de cycle pour auditer et corriger une erreur d'intégrité structurelle sur la base de données.
- **Assurance Qualité (QA) & Documentation :** Relecture systématique, vérification de l'ensemble des livrables documentaires (Cahier des charges, spécifications, architecture). Cette démarche m'a permis de garantir la cohérence fonctionnelle et d'acquérir une maîtrise globale de l'architecture de l'application.

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
