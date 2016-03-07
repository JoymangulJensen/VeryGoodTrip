INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_image`) VALUES
(1, 'Europe', 'Occident', './images/france.jpg'),
(2, 'Amérique du Nord', 'Visitez les Etats-Unis ou encore le Canada au meilleur prix', './images/amerique.jpg');

INSERT INTO `trip` (`trip_id`, `trip_name`, `trip_description`, `trip_price`, `trip_image`, `category_id`) VALUES
  (1, 'France', 'La France est merveilleuse !', 500, './images/france.jpg', 1);