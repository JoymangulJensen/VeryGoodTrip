INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_image`) VALUES
(1, 'Europe', 'Occident', './images/france.jpg'),
(2, 'Amérique du Nord', 'Visitez les Etats-Unis ou encore le Canada au meilleur prix', './images/amerique.jpg');

INSERT INTO `trip` (`trip_id`, `trip_name`, `trip_description`, `trip_price`, `trip_image`, `category_id`) VALUES
(1, 'France', 'La France est merveilleuse !', 500, './images/france.jpg', 1),
(2, 'Espagne', 'Diversité des paysages, des cultures, des langues (castillan, catalan, basque), des terroirs et des villes. L’Espagne s’offre à tous les goûts : laissons de côté les plages envahies l’été et la Costa del Sol bétonnée par les complexes hôteliers. Aventurons-nous plutôt dans l’intérieur du pays, superbe et naturel, prodigue en paysages saisissants, en monuments splendides, en modes de vie passionnants…\r\n\r\nEn savoir plus : http://www.routard.com/guide/code_dest/espagne.htm#ixzz42urECR3S', 475, './images/espagne.jpg', 1);
