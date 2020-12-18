-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 15, 2020 at 01:51 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `EG_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE 'comment' (
  'id' int(11) NOT NULL,
  'date' datetime NOT NULL,
  'author' varchar(255) NOT NULL,
  'message' text NOT NULL,
  'status' varchar(255) NOT NULL,
  'post_id' int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO 'comment' ('id', 'date', 'author', 'message', 'status', 'post_id') VALUES
(60, '2020-12-14 16:38:11', 'ed', 'super article', 'agreed', 5),
(66, '2020-12-15 14:33:52', 'user', 'article très intéressant', 'agreed', 8),
(67, '2020-12-15 14:34:08', 'user', 'article difficile à lire', 'waiting', 5),
(68, '2020-12-15 14:38:01', 'utilisateur', 'top', 'agreed', 6),
(69, '2020-12-15 14:38:24', 'utilisateur', 'super article', 'agreed', 8);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE 'post' (
  'id' int(11) NOT NULL,
  'creation_date' date NOT NULL,
  'author' varchar(255) NOT NULL,
  'title' varchar(255) NOT NULL,
  'chapo' longtext NOT NULL,
  'content' longtext NOT NULL,
  'file' varchar(255) DEFAULT NULL,
  'modification_date' datetime DEFAULT NULL,
  'published' varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO 'post' ('id', 'creation_date', 'author', 'title', 'chapo', 'content', 'file', 'modification_date', 'published') VALUES
(5, '2020-11-25', 'Edwige', 'Mon projet Wordpress', "  Dans le cadre de ma formation openClassrooms j'ai réalisé un projet Web Wordpress our une agence immobilière de luxe.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sapien et ligula ullamcorper malesuada proin libero. Ut ornare lectus sit amet est placerat in egestas. Odio ut enim blandit volutpat maecenas volutpat blandit aliquam. Tellus elementum sagittis vitae et leo duis ut diam. Nulla pellentesque dignissim enim sit amet venenatis urna cursus eget. Ipsum suspendisse ultrices gravida dictum fusce ut placerat orci nulla. At quis risus sed vulputate odio ut enim blandit. Convallis posuere morbi leo urna molestie at. Ac placerat vestibulum lectus mauris ultrices eros. Eget sit amet tellus cras adipiscing. Aenean euismod elementum nisi quis eleifend quam. Viverra aliquet eget sit amet tellus cras adipiscing enim. At tempor commodo ullamcorper a lacus. Mauris ultrices eros in cursus turpis massa tincidunt dui ut. Auctor urna nunc id cursus. Nibh sit amet commodo nulla facilisi nullam. Quisque non tellus orci ac auctor augue mauris. Ultrices eros in cursus turpis massa tincidunt dui ut ornare.\r\n\r\nHabitasse platea dictumst quisque sagittis purus sit amet volutpat consequat. Aenean vel elit scelerisque mauris pellentesque pulvinar pellentesque. Diam vulputate ut pharetra sit amet aliquam id diam. Ipsum consequat nisl vel pretium lectus. Tristique sollicitudin nibh sit amet commodo nulla facilisi nullam vehicula. Erat nam at lectus urna duis convallis convallis tellus id. Arcu vitae elementum curabitur vitae nunc sed velit dignissim. In pellentesque massa placerat duis ultricies lacus sed. Justo nec ultrices dui sapien eget mi proin sed libero. Rhoncus dolor purus non enim praesent elementum facilisis leo. Et magnis dis parturient montes nascetur ridiculus mus mauris vitae. Facilisis mauris sit amet massa vitae tortor condimentum lacinia. Nunc congue nisi vitae suscipit tellus mauris. Egestas tellus rutrum tellus pellentesque eu tincidunt. Libero enim sed faucibus turpis in eu. Nulla porttitor massa id neque aliquam vestibulum morbi blandit.\r\n\r\nEleifend quam adipiscing vitae proin sagittis. Orci a scelerisque purus semper eget duis. Felis donec et odio pellentesque diam volutpat commodo sed egestas. A cras semper auctor neque. Habitasse platea dictumst vestibulum rhoncus est pellentesque elit ullamcorper. Gravida arcu ac tortor dignissim convallis aenean et. Scelerisque viverra mauris in aliquam sem fringilla. Nam at lectus urna duis convallis convallis tellus id interdum. Convallis tellus id interdum velit laoreet id donec. Accumsan sit amet nulla facilisi morbi tempus.", NULL, '2020-12-07 09:27:04', 'Publié'),
(6, '2020-11-27', 'Edwige', "Représenter le besoin client par l'UML ", "     Dans le cadre du projet 4 de ma formation OpenClassrooms, j'ai réalisé les diagrammes UML pour une entreprise de restauration rapide.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Varius sit amet mattis vulputate enim nulla aliquet. Orci phasellus egestas tellus rutrum tellus pellentesque. Elementum nisi quis eleifend quam adipiscing vitae. Semper viverra nam libero justo laoreet. Dictum varius duis at consectetur lorem donec massa sapien faucibus. Ipsum suspendisse ultrices gravida dictum fusce ut. Scelerisque eleifend donec pretium vulputate sapien. Vitae sapien pellentesque habitant morbi tristique. Hendrerit gravida rutrum quisque non tellus orci ac auctor. Et pharetra pharetra massa massa ultricies mi. Morbi tincidunt ornare massa eget egestas purus viverra accumsan in. Ultricies leo integer malesuada nunc vel risus commodo. Sed faucibus turpis in eu mi bibendum neque egestas congue. \r\n\r\nSit amet nulla facilisi morbi tempus iaculis urna id. Vulputate sapien nec sagittis aliquam malesuada bibendum arcu vitae elementum. Ut tortor pretium viverra suspendisse potenti nullam ac tortor. Tortor condimentum lacinia quis vel eros donec ac. Tempor orci eu lobortis elementum nibh tellus molestie nunc non. Elementum facilisis leo vel fringilla est ullamcorper eget nulla.\r\n\r\nSenectus et netus et malesuada. Dui nunc mattis enim ut tellus elementum sagittis vitae et. Gravida cum sociis natoque penatibus et magnis. Gravida arcu ac tortor dignissim convallis aenean et tortor at. Aliquet porttitor lacus luctus accumsan tortor. Purus semper eget duis at tellus at urna condimentum mattis. Enim nulla aliquet porttitor lacus luctus. Tristique senectus et netus et. Urna neque viverra justo nec. Bibendum enim facilisis gravida neque convallis a cras semper. Quam elementum pulvinar etiam non quam lacus suspendisse. Tincidunt dui ut ornare lectus sit amet est. Nunc consequat interdum varius sit amet mattis vulputate enim. Ultrices in iaculis nunc sed augue lacus viverra vitae. Sit amet justo donec enim diam.\r\n\r\nRisus viverra adipiscing at in tellus integer feugiat scelerisque. Sed vulputate odio ut enim blandit volutpat maecenas volutpat blandit. Risus at ultrices mi tempus imperdiet. Nulla at volutpat diam ut venenatis tellus in. Mattis vulputate enim nulla aliquet porttitor lacus luctus. Luctus venenatis lectus magna fringilla urna porttitor rhoncus dolor purus. Sit amet consectetur adipiscing elit duis tristique sollicitudin nibh sit. Quisque non tellus orci ac auctor augue. Purus gravida quis blandit turpis cursus in hac habitasse. Elit scelerisque mauris pellentesque pulvinar pellentesque habitant morbi tristique senectus. Fusce id velit ut tortor pretium viverra suspendisse potenti. Posuere urna nec tincidunt praesent semper feugiat nibh sed. Erat pellentesque adipiscing commodo elit at imperdiet dui. Ut sem nulla pharetra diam sit amet nisl suscipit. Vel risus commodo viverra maecenas accumsan. Elit sed vulputate mi sit. Eget egestas purus viverra accumsan. Quis vel eros donec ac.", NULL, '2020-12-03 09:20:49', 'Publié'),
(8, '2020-12-05', 'Edwige', "Création d'une maquette en HTML/CSS", " Comment concevoir une maquette fonctionnelle? A quoi sert le HTML et le CSS? Voici l'exemple d\un projet réalisé en septembre dernier.', 'Ex his quidam aeternitati se commendari posse per statuas aestimantes eas ardenter adfectant quasi plus praemii de figmentis aereis sensu carentibus adepturi, quam ex conscientia honeste recteque factorum, easque auro curant inbracteari, quod Acilio Glabrioni delatum est primo, cum consiliis armisque regem superasset Antiochum. quam autem sit pulchrum exigua haec spernentem et minima ad ascensus verae gloriae tendere longos et arduos, ut memorat vates Ascraeus, Censorius Cato monstravit. qui interrogatus quam ob rem inter multos... statuam non haberet malo inquit ambigere bonos quam ob rem id non meruerim, quam quod est gravius cur inpetraverim mussitare.\r\n\r\nSed cautela nimia in peiores haeserat plagas, ut narrabimus postea, aemulis consarcinantibus insidias graves apud Constantium, cetera medium principem sed siquid auribus eius huius modi quivis infudisset ignotus, acerbum et inplacabilem et in hoc causarum titulo dissimilem sui.\r\n\r\nEx turba vero imae sortis et paupertinae in tabernis aliqui pernoctant vinariis, non nulli velariis umbraculorum theatralium latent, quae Campanam imitatus lasciviam Catulus in aedilitate sua suspendit omnium primus; aut pugnaciter aleis certant turpi sono fragosis naribus introrsum reducto spiritu concrepantes; aut quod est studiorum omnium maximum ab ortu lucis ad vesperam sole fatiscunt vel pluviis, per minutias aurigarum equorumque praecipua vel delicta scrutantes.", NULL, NULL, 'Publié'),
(9, '2020-12-07', 'Edwige', 'Créer un blog from scratch avec PHP', "  Quelles sont les étapes de réalisation d'un blog from scratch? Qu'est ce que la programmation orientée objet? Le projet 5 de mon cursus m\'a permis d\'explorer ces méthodes d\'organisation de code. Je vous explique en détails ma démarche sur le sujet.', 'Isdem diebus Apollinaris Domitiani gener, paulo ante agens palatii Caesaris curam, ad Mesopotamiam missus a socero per militares numeros immodice scrutabatur, an quaedam altiora meditantis iam Galli secreta susceperint scripta, qui conpertis Antiochiae gestis per minorem Armeniam lapsus Constantinopolim petit exindeque per protectores retractus artissime tenebatur.\r\n\r\nHac ita persuasione reducti intra moenia bellatores obseratis undique portarum aditibus, propugnaculis insistebant et pinnis, congesta undique saxa telaque habentes in promptu, ut si quis se proripuisset interius, multitudine missilium sterneretur et lapidum.\r\n\r\nOmitto iuris dictionem in libera civitate contra leges senatusque consulta; caedes relinquo; libidines praetereo, quarum acerbissimum extat indicium et ad insignem memoriam turpitudinis et paene ad iustum odium imperii nostri, quod constat nobilissimas virgines se in puteos abiecisse et morte voluntaria necessariam turpitudinem depulisse. Nec haec idcirco omitto, quod non gravissima sint, sed quia nunc sine teste dico.", NULL, '2020-12-08 12:01:00', 'Non publié');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE "user" (
  "id" int(11) NOT NULL,
  "e_mail" varchar(45) NOT NULL,
  "login" varchar(45) NOT NULL,
  "password" varchar(255) NOT NULL,
  "role" varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO "user" ("id", "e_mail", "login", "password", "role") VALUES
(14, 'edwige.gentymail@gmail.com', 'ed', '$2y$10$O6OdjqhS0z/IIX6qLdnSiOBEjSUsgUMsyiY0vK/.uZ1gSguTzjf96', 'administrateur'),
(36, 'user2@mail.fr', 'user', '$2y$10$DphxjCAIOmkiBWrOSp0F1.6zCSKhZWtvS86xhTUDASCTfszqhLo5q', 'visiteur'),
(39, 'utilisateur1@mail.fr', 'utilisateur', '$2y$10$2PbovP/VD/fTceo3a81ZQelKlUpDubfka/M8aK6f2Lb/xQZtpVJoC', 'visiteur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE "comment"
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_post_id` (`post_id`) USING BTREE;

--
-- Indexes for table `post`
--
ALTER TABLE "post"
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE "user"
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
