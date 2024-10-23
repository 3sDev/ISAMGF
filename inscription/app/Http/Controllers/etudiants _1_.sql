-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 17 juil. 2022 à 14:57
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `smartuniversity`
--

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

CREATE TABLE `etudiants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `diplome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filiere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cin` int(11) NOT NULL,
  `nom` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_ar` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_ar` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ddn` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu_naissance` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gov` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat_civil` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee_bac` int(11) NOT NULL,
  `session_bac` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_bac` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moyenne_bac` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rue_etudiant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codepostal_etudiant` int(11) NOT NULL,
  `tel1_etudiant` int(11) NOT NULL,
  `tel2_etudiant` int(11) NOT NULL,
  `prenom_pere` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession_pere` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_mere` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classe_id` bigint(20) UNSIGNED NOT NULL,
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_token` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expires_at` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cin_file` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paiement_file` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`id`, `diplome`, `filiere`, `cin`, `nom`, `prenom`, `nom_ar`, `prenom_ar`, `full_name`, `genre`, `ddn`, `lieu_naissance`, `gov`, `etat_civil`, `annee_bac`, `session_bac`, `section_bac`, `moyenne_bac`, `rue_etudiant`, `codepostal_etudiant`, `tel1_etudiant`, `tel2_etudiant`, `prenom_pere`, `profession_pere`, `prenom_mere`, `email`, `email_verified_at`, `password`, `classe_id`, `api_token`, `date_token`, `expires_at`, `remember_token`, `profile_image`, `cin_file`, `paiement_file`, `file`, `created_at`, `updated_at`) VALUES
(2, 'Licence appliquée en réseaux informatiques', 'Informatique', 9977444, 'Anis', 'Salhi', 'Anis_ar', 'Salhi_ar', 'Anis Salhi', 'Homme', '07/12/2002', 'Gafsa', 'Gafsa', 'Celibataire', 2022, 'Principale', 'Mathématiques', '12.47', 'Rue ecole primaire Gafsa', 2100, 11123456, 55001002, 'Hammadi Salhi', 'Professeur de sport', 'Mouna Ajmi', 'anis-salhi02@gmail.com', NULL, 'etudiant123', 1, NULL, NULL, NULL, NULL, '1657959881.jpg', '1657959881.pdf', '1657959881.png', NULL, '2022-07-16 07:24:41', '2022-07-16 07:24:41');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `etudiants_email_unique` (`email`),
  ADD KEY `etudiants_classe_id_foreign` (`classe_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `etudiants`
--
ALTER TABLE `etudiants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD CONSTRAINT `etudiants_classe_id_foreign` FOREIGN KEY (`classe_id`) REFERENCES `classes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
