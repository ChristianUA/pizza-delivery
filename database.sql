DROP DATABASE IF EXISTS `final_project`;
CREATE DATABASE final_project;
USE final_project;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `email` varchar(320) DEFAULT NULL,
    `first_name` varchar(100) DEFAULT NULL,
    `last_name` varchar(100) DEFAULT NULL,
    `address_id` int(11) DEFAULT NULL,
    `password_hash` char(60) DEFAULT NULL,
    PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) DEFAULT NULL,
    `pizza_id` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `pizzas`;
CREATE TABLE `pizzas` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) DEFAULT NULL,
    `toppings` varchar(100) DEFAULT NULL,
    `size` varchar(1) DEFAULT NULL,
    PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `street_address` varchar(100) DEFAULT NULL,
    `city` varchar(100) DEFAULT NULL,
    `state` varchar(100) DEFAULT NULL,
    `zip` int(5) DEFAULT NULL,
    PRIMARY KEY (`id`)
);

insert into pizzas values ('Cheese', 'None', 'M');
insert into pizzas values ('Pepperoni', 'Pepperoni', 'M');
insert into pizzas values ('Veggie', 'Vegetables', 'M');

insert into users values ('Devanshi', 'Chavda', 1);
insert into users values ('Christian', 'Peterson', 2);
insert into users values('Rick', 'Mercer', 3);

insert into orders values (1, 2);
insert into orders values (1, 1);
insert into orders values (2, 2);

insert into addresses values ('101 N Way Rd.', 'Tucson', 'Arizona', 85719);
insert into addresses values ('5 Central St.', 'Tucson', 'Arizona', 85719);
insert into addresses values ('26 E Greenway Rd.', 'Tucson', 'Arizona', 85719);
