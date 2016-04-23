-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 23 Avril 2016 à 18:04
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `verygoodtrip`
--

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_image`) VALUES
(1, 'Europe Occidentale', 'Au sens strict : ces pays ont en commun une géographie commune (la grande plaine d''Europe du Nord, buttant plus ou moins brusquement sur les Alpes et sur l''Atlantique, un climat océanique...). On peut noter que la France, l''Allemagne et l''Angleterre seront issus du même "moule" (division de l''Empire carolingien, royaume anglo-normand puis angevin...). Ces trois pays, qui seront les seules vraies puissances médiévales, vont participer aux croisades, et se voir confronter au problème de la Réforme. La colonisation en Amérique sera le reflet de deux mondes distincts (l''Amérique du Nord et l''Amérique latine). L''ensemble de l''Europe du Nord-Ouest connaîtra les idéologies modernes qui ont marqué les sociétés contemporaines(les Lumières, le libéralisme, le communisme). La Révolution Industrielle et scientifique fournira des innovations techniques et scientifiques majeures, avec notamment des découvreurs de renom (Watt, Papin, Darwin, Koch, Pasteur, Curie...). Aujourd''hui, ces pays connaissent des modèles de société comparables, fortement déchristianisées, aux familles éclatées, avec un héritage industriel à la reconversion difficile.', './images/europe.jpg'),
(2, 'Amérique du Nord', 'La culture populaire retient couramment la découverte de Christophe Colomb comme le premier contact des européens avec le continent américain. Pourtant, l''ensemble continental avait déjà été atteint depuis le xe siècle, puisque c''est à cette époque que le Groenland, île américaine (au sens géographique), a été découvert par une expédition de Vikings (menée par le célèbre Érik le Rouge). De plus, selon de récentes avancées de la recherche archéologique, ils furent aussi les premiers Européens à atteindre le Canada : au tournant du xie siècle, des expéditions partirent du Groenland et tentèrent une colonisation de Terre-Neuve. Cependant, certaines thèses postulent des contacts épisodiques remontant jusqu''à l''Antiquité.', './images/northern_america.jpg'),
(3, 'Etats-Unis', 'L''immensité du territoire, la grande variété des reliefs et des climats produisent des paysages très divers selon les régions. Les grands ensembles naturels du pays suivent grossièrement une organisation méridienne : à l''est, une plaine de plus en plus large en allant vers la Floride, borde l''océan Atlantique. La partie nord (Nouvelle-Angleterre) est soumise aux masses d''air polaires en hiver. Le sud subit les influences tropicales. Vers l''intérieur se succèdent les collines du piémont puis les montagnes Appalaches, qui culminent à 2 037 mètres d''altitude et sont couvertes de forêts.', './images/amerique.jpg'),
(4, 'Asie', 'Des stuppas bouddhistes au Myanmar aux cascades du Laos ou vestiges Khmers du Cambodge en parssant par les collines des Philippines, découvrez des lieux mystiques ou des paysages insolites et des paysages à couper le souffle qui inspireront certainement vos prochaines envies de voyages... Pour le reste de l''Asie, consultez les plus beaux paysages du reste de l''Asie et les plus beaux paysages du Moyen Orient', './images/asie.jpg'),
(5, 'Océanie', 'L’Australie est un pays très sec et aride avec un désert couvrant une grande partie du centre du pays. Les côtes sont plus vertes et certaines régions d’Australie connaissent des précipitations élevées durant la saison des pluies (« wet season » de novembre à mai dans le nord du pays).\r\n\r\nChaque année des inondations surviennent alors qu’au même moment, d’autres régions souffrent de sécheresse, ce qui a des conséquences négatives pour l’agriculture. En somme l’Australie regorge de climats tous différents les uns des autres ce qui lui vaut la particularité d’être un pays unique.\r\nBien qu’une grande partie du pays soit désertique, l’Australie regorge en effet de merveilles naturelles comme l’outback, les forêts d’eucalyptus des Blue Mountains, les chaînes de montagne Great Dividing Range qui séparent la côte Est du reste du pays, ou encore les plages côtières et la Grande Barrière de Corail.', './images/oceania.jpg');

--
-- Contenu de la table `review`
--

INSERT INTO `review` (`review_id`, `trip_id`, `user_id`, `review_content`, `review_rating`) VALUES
(1, 8, 2, 'Expérience formidable !', 5),
(2, 8, 2, 'Génial', 5),
(3, 8, 2, 'Fantastique', 4),
(4, 5, 2, 'Très bon voyage', 4),
(5, 6, 2, 'Voyage agréable', 4),
(6, 4, 2, 'Super Voyage', 5),
(7, 2, 2, 'Très cher', 3),
(8, 1, 2, 'Super expérience ! Je recommande', 5),
(9, 5, 1, 'Superbe !', 5);

--
-- Contenu de la table `trip`
--

INSERT INTO `trip` (`trip_id`, `trip_name`, `trip_description`, `trip_price`, `trip_image`, `category_id`) VALUES
(1, 'Australie', 'L’Australie dispose d’une flore et d’une faune particulières, du fait de l’ancienneté du continent et de son isolation sous l’effet du mouvement des plaques tectoniques. Ainsi environ 85% des plantes à fleurs, 84% des mammifères (les marsupiaux sont des mammifères), plus de 45% des oiseaux et 89% des poissons du plateau continental seraient des espèces endémiques. Les animaux endémiques australiens les plus connus sont bien sûr le koala, le kangourou, l’émeu (sorte d’autruche), l’ornythorynque, le wombat, le possum, etc…', 7650, './images/australia.jpg', 5),
(2, 'New York', 'La ville de New York est difficilement dissociable de ses nombreux gratte-ciel, qui contribuent à rendre le panorama urbain de Manhattan reconnaissable entre tous. Ainsi, bien que le premier gratte-ciel de l''histoire de l''architecture fût construit à Chicago dans les années 1880, la ville de New York a toujours été mondialement populaire avec ses édifices immenses, et dont la notoriété est parfois universelle. On peut citer en premier lieu l''Empire State Building, sans doute le building le plus célèbre au monde. Ce nom vient du fait qu''Empire State est le surnom de l''État de New York. La construction de l''Empire State Building a débuté en 1930, pour s''achever en 1931. Le style Art déco de cet immeuble lui donne un aspect sobre et robuste, et ses 381 mètres ont fait de lui le plus haut immeuble du monde pendant plusieurs décennies.', 6800, './images/new-york.jpg', 3),
(3, 'Washington', 'Créée officiellement par la Constitution des États-Unis (1787), la capitale fédérale américaine naît de rien au tout début du xixe siècle. Son plan est l''œuvre de Pierre Charles L''Enfant, un ingénieur militaire, fils d''un peintre de la cour de France qui propose ses services à George Washington, dont il a fait la connaissance durant la guerre d''Indépendance alors qu''il s''était engagé en 1777, à l''âge de 23 ans, aux côtés des insurgés américains. Pendant la guerre anglo-américaine de 1812, les Britanniques reçoivent l''ordre de brûler les édifices publics de Washington, DC. Les Britanniques souhaitaient se venger des dommages causés à la capitale de la colonie du Haut-Canada (aujourd''hui Toronto) par les Américains après la bataille de York (1813). La destruction de la capitale des jeunes États-Unis devait démoraliser l''ennemi.', 6300, './images/washington.jpg', 3),
(4, 'Canada', 'Partez à la découverte de la nature à l''état pur : lacs bleutés, cascades et forêts majestueuses. La beauté des paysages de l''est canadien n''a d''égal que la richesse de sa faune, vous trouverez des baleines, des castors, des loups, des ours ou encore des originaux. Vous serez charmés par la gentillesse, l''accueil chaleureux et le bon vivant de nos cousins du Québec.', 8200, './images/canada.jpeg', 2),
(5, 'France', 'À l’extrémité occidentale du continent européen, l’histoire géologique a engendré une diversité de paysages – eux-mêmes liés à la nature des sols, à l’action des éléments, à l’étagement naturel de la végétation – qui offre un plaisir raffiné et sans cesse renouvelé à qui parcourt la France et sait l’observer.', 500, './images/france.jpg', 1),
(6, 'Espagne', 'Diversité des paysages, des cultures, des langues (castillan, catalan, basque), des terroirs et des villes. L’Espagne s’offre à tous les goûts : laissons de côté les plages envahies l’été et la Costa del Sol bétonnée par les complexes hôteliers. Aventurons-nous plutôt dans l’intérieur du pays, superbe et naturel, prodigue en paysages saisissants, en monuments splendides, en modes de vie passionnants…', 475, './images/espagne.jpg', 1),
(7, 'Allemagne', 'L''Allemagne, en forme longue République fédérale d''Allemagne, en allemand Deutschland, est un pays d''Europe centrale, entouré par la mer du Nord, le Danemark et la mer Baltique au nord, par la Pologne et la ...', 348, './images/allemagne.jpg', 1),
(8, 'Paris', 'Paris est dite, "la plus belle ville du monde". \r\nCette ville est considérée comme une des plus importantes villes du monde, et plus importante agglomération Européenne. \r\nParis : ville la plus peuplée et capitale de la France, chef-lieu de la région Île-de-France et unique commune-département du pays, se situe au centre du Bassin parisien, sur une boucle de la Seine. \r\nSes habitants, dont les dernier recencement de L''insee à jugé de 2.2millions, le 1er Janvier 2099, appelés "les Parisiens", sont répartis dans la villes sur 20 arrondissements.', 900, './images/paris.jpg', 1),
(9, 'Madrid', 'Diversité des paysages, des cultures, des langues (castillan, catalan, basque), des terroirs et des villes. L’Espagne s’offre à tous les goûts : laissons de côté les plages envahies l’été et la Costa del Sol bétonnée par les complexes hôteliers. Aventurons-nous plutôt dans l’intérieur du pays, superbe et naturel, prodigue en paysages saisissants, en monuments splendides, en modes de vie passionnants…', 435, './images/madrid.jpg', 1),
(11, 'Rome', 'Quoiqu''on y cherche, on se sent bien à Rome. Pèlerin, on dispose du Vatican. Historien, des forums où revivent Cicéron, César et Auguste. Amateurs d''art, des églises baroques où le Bernin et Borromini s''affrontent dans un combat sans merci. Cinéphile, des images des films de Fellini, les silhouettes de Gassmann et de Mastroianni. C''est la ville éternelle, celle d''où notre civilisation, notre langue proviennent. À Rome, on se sent si vite chez soi, que l''on s''en empare, qu''on la fait sienne.', 640, './images/rome.jpg', 1);

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `user_lastname`, `user_firstname`, `user_password`, `user_salt`, `user_address`, `user_town`, `user_zipcode`, `user_role`) VALUES
(1, 'john@doe.com', 'Doe', 'John', 'RYYqt3xSbek0GeCm48yO9FpXnSTBCg5dGj2q5Jxh1Hy5JMwLp+Pm++7aEZo6rk+t1fodkYyWTCWiu+p2+F/o7g==', 'qUgq3NAYfC1MKwrW?yevbE', 'Adresse de John Doe', 'Villeurbanne', 69100, 'ROLE_USER'),
(2, 'admin@admin.com', 'Doe', 'Jane', 'ANsXymapV3X3c8cDHo/CaY2XHiy6i1U82S8JN/OdWKJuVtGV/WyGyA4AL4AUeVD/E1Ijy3LB7dh7mh9JsjzIVg==', 'qUgq3NAYfC1MKwrW?yevbE', 'Adresse de Jane Doe', 'Villeurbanne', 69100, 'ROLE_ADMIN');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
