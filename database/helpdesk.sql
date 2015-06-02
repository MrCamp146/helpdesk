-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 24 Mai 2015 à 17:09
-- Version du serveur: 5.5.43
-- Version de PHP: 5.4.40-1~dotdeb+wheezy.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `helpdesk`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `idCategorie` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idCategorie` (`idCategorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`, `idCategorie`) VALUES
(1, 'Réseau', NULL),
(2, 'Télécommunication', NULL),
(3, 'Informatique', NULL),
(10, 'HelpDesk', NULL),
(11, 'Routage', 1),
(13, 'Serveur', 1),
(15, 'Materiel', 3),
(16, 'Logiciels', 3);

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `contenu` text NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idCategorie` int(11) DEFAULT NULL,
  `idUser` int(11) NOT NULL,
  `version` varchar(20) NOT NULL DEFAULT '1.0',
  `vue` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idCategorie` (`idCategorie`,`idUser`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `faq`
--

INSERT INTO `faq` (`id`, `titre`, `contenu`, `dateCreation`, `idCategorie`, `idUser`, `version`, `vue`) VALUES
(5, 'Comment formuler une demande à partir de l''interface web ?', '<p>L&#39;adresse de l&#39;application est https://...</p>\r\n\r\n<p>L&#39;acc&egrave;s &agrave; l&#39;interface web du HelpDesk requiert votre connexion sur le service d&#39;authentification.&nbsp; Une fois connect&eacute;, vous retrouverez tout ce qui concerne votre demande : groupe attributaire, technicien charg&eacute; du traitement, suivis, solution, &hellip;</p>\r\n\r\n<p>Pour formuler une nouvelle demande, vous devez commencer par utiliser l&#39;entr&eacute;e du menu ou l&#39;ic&ocirc;ne associ&eacute;e &agrave; &laquo; Cr&eacute;er un ticket &raquo;.</p>\r\n\r\n<p>Dans le formulaire qui vous est alors propos&eacute;, seuls trois champs sont obligatoires :</p>\r\n\r\n<p>Cat&eacute;gorie : elle permet l&#39;attribution de votre demande au groupe concern&eacute; ;<br />\r\nTitre : il est utilis&eacute; pour afficher l&#39;ensemble des demandes, aussi veillez &agrave; ce qu&#39;il soit concis, &agrave; la fois synth&eacute;tique et pr&eacute;cis<br />\r\nDescription : faites figurer ici toutes les informations que vous jugerez utiles pour permettre le traitement de votre demande.&nbsp; Des informations compl&eacute;mentaires pourront vous &ecirc;tre demand&eacute;es si n&eacute;cessaire.<br />\r\nLes autres champs, bien qu&#39;optionnels, peuvent &ecirc;tre utiles voire n&eacute;cessaires au traitement de votre demande :</p>\r\n\r\n<p>Type : Incident (par d&eacute;faut) en cas de dysfonctionnement, ou simple demande<br />\r\nUrgence : Elle est crois&eacute;e avec l&#39;impact &eacute;valu&eacute; par le technicien pour d&eacute;finir la priorit&eacute; utilis&eacute;e pour trier l&#39;ensemble des demandes.<br />\r\nSuivi par courriel : Choisissez &laquo; Non &raquo; si vous ne souhaitez pas recevoir d&#39;information concernant votre demande par m&eacute;l.<br />\r\n&Eacute;lement associ&eacute; : Si n&eacute;cessaire et s&#39;il est automatiquement identifi&eacute;, vous pourrez ici associer votre poste de travail ou l&#39;un de ses logiciels &agrave; votre demande.<br />\r\nFichier : &Agrave; utiliser pour joindre un fichier &agrave; votre demande.<br />\r\nUne fois le formulaire rempli, cr&eacute;er votre ticket en cliquant sur le bouton &laquo; Envoyer message &raquo;.&nbsp; Un compte-rendu appara&icirc;t alors dans lequel figure le num&eacute;ro associ&eacute; &agrave; votre demande &ndash; le ticket &ndash; que vous pourrez utiliser pour obtenir des informations a posteriori.</p>\r\n', '2015-05-23 14:48:50', 10, 2, '1.0', 7),
(6, 'À quoi sert le HelpDesk ?', '<p>Le HelpDesk correspond au projet 2 &laquo; &Eacute;volution de l&#39;outil d&#39;assistance &raquo; du programme 6 &laquo; Accompagner la consolidation et la transformation de la fonction SI au sein de notre &eacute;tablissement &raquo;.</p>\r\n\r\n<p>L&#39;un des objectifs strat&eacute;giques &agrave; l&#39;origine du projet est d&#39;homog&eacute;n&eacute;iser la prestation d&#39;assistance sur tous les sites et pour tous les usagers afin d&#39;offrir un niveau de service &eacute;quitablement accessible.</p>\r\n\r\n<p>En termes op&eacute;rationnels, l&#39;outil d&eacute;velopp&eacute; permet de disposer d&rsquo;un guichet d&rsquo;assistance unique, de mettre en &oelig;uvre des outils et des proc&eacute;dures communes et d&#39;identifier les probl&egrave;mes redondants.</p>\r\n\r\n<p>Du point de vue de l&#39;usager, il apporte l&#39;assurance d&#39;un enregistrement formel des demandes et des fonctionnalit&eacute;s d&#39;information et de suivi syst&eacute;matiques.</p>\r\n', '2015-05-23 14:49:18', 10, 2, '1.0', 3),
(7, 'Procédure de changement de mot de passe', '<h2>Descriptif</h2>\r\n\r\n<h3>Pr&eacute;-requis :</h3>\r\n\r\n<p>Un bon mot de passe est un mot de passe suffisamment long, facile &agrave; retenir et tr&egrave;s difficile &agrave; deviner. Votre mot de passse doit &ecirc;tre constitu&eacute; d&#39;au moins 8 caract&egrave;res dont une majuscule et un chiffre. Il peut contenir des lettres non accentu&eacute;es, des chiffres, et certains caract&egrave;res sp&eacute;ciaux : _ ! @ # $ % - + = &lt; &gt; ( ) { } [ ] | : ; , . ? ~ &amp;</p>\r\n\r\n<h3>Quelques proc&eacute;d&eacute;s ou comment faire ?</h3>\r\n\r\n<ul>\r\n	<li>Accoler mots et chiffres : Faire3Pas</li>\r\n	<li>Cr&eacute;er un r&eacute;bus : 71fame3MAIC&amp;O (c&#39;est un fameux 3 m&acirc;ts Hisse et Ho)</li>\r\n	<li>Pensez &agrave; une chanson ou un po&egrave;me et extrayez les premi&egrave;res lettres : ottoc4ocR! (one, two, three, o&#39;clock, four o&#39;clock, rock !)</li>\r\n	<li>Choisissez un mot de passe en y ins&eacute;rant des caract&egrave;res sp&eacute;ciaux g1M2p#DUtI1 (j&#39;ai un mot de passe diff&eacute;rent du tien)</li>\r\n	<li>Ne pas utiliser de mot de passe ayant un rapport avec soi (noms, dates de naissance,..)</li>\r\n	<li>Vous avez tout int&eacute;r&ecirc;t &agrave; m&eacute;langer les possibilit&eacute;s offertes : lettres, chiffres et caract&egrave;res sp&eacute;ciaux.</li>\r\n</ul>\r\n\r\n<h3>Respectez les r&egrave;gles</h3>\r\n\r\n<p>Vous &ecirc;tes responsable de l&#39;usage qui est fait de votre compte d&#39;acc&egrave;s au syst&egrave;me d&#39;information. Pour garantir la s&eacute;curit&eacute; de votre mot de passe, nous vous invitons &agrave; suivre les conseils ci-dessous:</p>\r\n\r\n<ul>\r\n	<li>Ne le communiquez &agrave; personne (il garantit votre identit&eacute; et vous identifie personnellement dans notre syst&egrave;me d&#39;information</li>\r\n	<li>Ne le notez pas sur un post-it</li>\r\n	<li>Verrouillez ou fermez syst&eacute;matiquement votre session en quittant votre poste de travail</li>\r\n	<li>Changez-le r&eacute;guli&egrave;rement</li>\r\n	<li>N&#39;utilisez pas le mot de passe de votre compte d&#39;acc&egrave;s au syst&egrave;me d&#39;information pour un autre compte</li>\r\n</ul>\r\n', '2015-05-23 14:50:08', 10, 2, '1.0', 3);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idUser` int(11) NOT NULL,
  `idTicket` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idUser` (`idUser`),
  KEY `idTicket` (`idTicket`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id`, `contenu`, `date`, `idUser`, `idTicket`) VALUES
(1, 'Nous somme intervenue sur votre poste afin de trouver la panne.\r\nNous reviendrons des que nous auront la nouvelle pièce pour votre ordinateur.', '2015-05-11 20:20:18', 2, 6),
(2, 'Merci.', '2015-05-11 20:30:11', 3, 6),
(4, 'Nous avons changer la pièce défaillant de votre ordinateur, il fonctionne normalement.', '2015-05-12 15:56:08', 2, 6),
(5, 'Votre OS est passer de Debian 6 à la version 8', '2015-05-12 16:26:37', 2, 8);

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE IF NOT EXISTS `statut` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(30) NOT NULL,
  `ordre` int(11) NOT NULL,
  `icon` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `statut`
--

INSERT INTO `statut` (`id`, `libelle`, `ordre`, `icon`) VALUES
(1, 'Nouveau', 0, 'flag'),
(2, 'Attribué', 1, 'user'),
(3, 'En attente', 2, 'hourglass'),
(4, 'Résolu', 3, 'check'),
(5, 'Clos', 5, 'off');

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` set('demande','incident') NOT NULL DEFAULT 'demande',
  `idCategorie` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `idStatut` int(11) NOT NULL DEFAULT '1',
  `idUser` int(11) NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idCategorie` (`idCategorie`),
  KEY `idStatut` (`idStatut`,`idUser`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `ticket`
--

INSERT INTO `ticket` (`id`, `type`, `idCategorie`, `titre`, `description`, `idStatut`, `idUser`, `dateCreation`) VALUES
(6, 'incident', 3, 'Ecran Blue', 'lors d''une récupération de fichier sur le serveur, mon pc affiche un écran bleu et redemande.', 4, 3, '2015-05-10 14:48:51'),
(8, 'demande', 3, 'update', 'Serais-t-il possible me mettre a jour mon OS linux.', 5, 2, '2015-05-12 16:25:08'),
(9, 'incident', 3, 'Rapport Apprentie', 'on as que 2 semaine pour rendre un rapport de deux semaine pour le projet d''entreprise', 1, 3, '2015-05-13 06:32:13'),
(10, 'demande', 3, 'projet php', 'Bonjour, je voudrais savoir quand est-ce que le projet seras fini car il y a le rapport et ma diapositives a faire.', 3, 2, '2015-05-16 20:44:53'),
(11, 'incident', 2, 'Probleme Téléphone IP', 'Bonjour,\r\nMon téléphone sur ip ne fonctionne plus.', 2, 3, '2015-05-17 13:09:19'),
(16, 'incident', 2, 'test', 'test', 1, 8, '2015-05-18 12:38:32');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `mail`, `admin`, `nom`, `prenom`, `ip`) VALUES
(2, 'Admin', '74ca81ba4560c4acd314d1a73bdccc7c06993135', 'yann-l-j@hotmail.com', 1, 'LE JUNTER', 'Yann', '127.0.0.1'),
(3, 'Yann', '74ca81ba4560c4acd314d1a73bdccc7c06993135', 'yannlj8@gmail.com', 0, 'LE JUNTER', 'Yann', '78.206.172.160'),
(4, 'flo', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', 'flo@flo.net', 1, NULL, NULL, '127.0.0.1'),
(5, 'thomas', '5f50a84c1fa3bcff146405017f36aec1a10a9e38', 'thomas.gardie@hotmail.fr', 0, NULL, NULL, '127.0.0.1'),
(8, 'jfa', '6eb30cce216e0d3ab9d9cf6eb44b8b58f9aa30ba', 'jfalycee@free.fr', 1, NULL, NULL, '194.199.115.193'),
(11, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test@test.com', 1, NULL, NULL, '78.206.172.160');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `categorie_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `faq_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `faq_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`idTicket`) REFERENCES `ticket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`idStatut`) REFERENCES `statut` (`id`),
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
