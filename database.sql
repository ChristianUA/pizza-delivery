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
    `size` varchar(10) DEFAULT NULL,
    PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `pizzas`;
CREATE TABLE `pizzas` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) DEFAULT NULL,
    `toppings` varchar(100) DEFAULT NULL,
    `description` varchar(320) DEFAULT NULL,
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

insert into pizzas (name, toppings, description) values ('Cheese', 'None', 'Delicious brick-oven pizza, covered in fresh mozzarella cheese.');
insert into pizzas (name, toppings, description) values ('Pepperoni', 'Pepperoni', 'Delicious brick-oven pizza, covered in fresh mozzarella cheese and pepperoni slices.');
insert into pizzas (name, toppings, description) values ('Veggie', 'Vegetables', 'Delicious brick-oven pizza, covered in black olives, bell peppers, cherry tomatoes, and mushroom.');
