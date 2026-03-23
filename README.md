# 🖥️ Système Web de Gestion de Parc Informatique (SAÉ 3)

![Stack](https://img.shields.io/badge/Stack-LAMP-blue.svg)
![Database](https://img.shields.io/badge/Database-MariaDB-4479A1.svg)
![Infra](https://img.shields.io/badge/Infra-Raspberry_Pi-C51A4A.svg)
![Security](https://img.shields.io/badge/Focus-AppSec-orange.svg)

## 📌 Contexte du Projet
Ce projet a été réalisé en équipe dans le cadre du **BUT Informatique**. Il s'agit de la conception intégrale et du déploiement d'une application web de gestion de parc informatique pédagogique, hébergée sur un serveur physique **Raspberry Pi (Debian)**.

L'objectif était de mobiliser une architecture complète (Fullstack) tout en respectant un cycle de développement professionnel : de l'analyse des besoins jusqu'au déploiement système, en passant par la conception UML et la sécurisation des accès.

## 🎯 Mon Focus Technique & Rôle
En tant que membre très impliqué du projet, mon approche s'est fortement orientée sur la robustesse du Back-end et la sécurité applicative :
- **Sécurisation de l'Authentification :** Gestion stricte des rôles (RBAC : Admin, Sysadmin, Technicien). *(Note : Ce travail fait écho à mon implémentation algorithmique [ChaCha20-Python](https://github.com/Ilyes-Akhdari/ChaCha20-Python) réalisée en parallèle sur le chiffrement des flux).*
- **Intégrité des Données :** Modélisation et requêtage sécurisé sur **MariaDB**.
- **Supervision :** Consultation sécurisée des journaux d'activité système (logs Apache) via l'interface Sysadmin.

## ⚙️ Architecture et Fonctionnalités

### Authentification & Droits
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
