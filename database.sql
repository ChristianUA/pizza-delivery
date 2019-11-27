DROP DATABASE IF EXISTS `final_project`;
CREATE DATABASE final_project;
USE final_project;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` int(11) NOT NULL DEFAULT '0',
    `first_name` varchar(100) DEFAULT NULL,
    `last_name` varchar(100) DEFAULT NULL,
    `address_id` int(11) DEFAULT NULL,
    `password_hash` char(60) DEFAULT NULL,
    PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
    `id` int(11) NOT NULL DEFAULT '0',
    `user_id` int(11) DEFAULT NULL,
    `pizza_id` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `pizzas`;
CREATE TABLE `pizzas` (
    `id` int(11) NOT NULL DEFAULT '0',
    `name` varchar(100) DEFAULT NULL,
    `toppings` varchar(100) DEFAULT NULL,
    `size` varchar(1) DEFAULT NULL,
    PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
    `id` int(11) NOT NULL DEFAULT '0',
    `street_address` varchar(100) DEFAULT NULL,
    `city` varchar(100) DEFAULT NULL,
    `state` varchar(100) DEFAULT NULL,
    `zip` int(5) DEFAULT NULL,
    PRIMARY KEY (`id`)
);

insert into pizzas values (1, 'Cheese', 'None', 'M');
insert into pizzas values (2, 'Pepperoni', 'Pepperoni', 'M');
insert into pizzas values (3,  'Veggie', 'Vegetables', 'M');

insert into users values (1, 'Devanshi', 'Chavda', 1);
insert into users values (2, 'Christian', 'Peterson', 2);
insert into users values(3, 'Rick', 'Mercer', 3);

insert into orders values (1, 1, 2);
insert into orders values (2, 1, 1);
insert into orders values (3, 2, 2);

insert into addresses values (1, '101 N Way Rd.', 'Tucson', 'Arizona', 85719);
insert into addresses values (2,'5 Central St.', 'Tucson', 'Arizona', 85719);
insert into addresses values (3, '26 E Greenway Rd.', 'Tucson', 'Arizona', 85719);
