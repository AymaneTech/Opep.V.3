CREATE DATABASE if not exists opep_v3;

CREATE TABLE if not exists
    users
(
    userId    int auto_increment primary key,
    firstName varchar(255),
    lastName  varchar(255),
    email     varchar(255),
    password  varchar(255),
    userType  varchar(30)
);

CREATE TABLE if not exists
    category
(
    categoryId   int(11) NOT NULL AUTO_INCREMENT,
    categoryName varchar(255)  DEFAULT NULL,
    categoryDesc varchar(1000) DEFAULT NULL,
    PRIMARY KEY (categoryId)
);

CREATE TABLE if not exists
    plant
(
    plantId    int(11) NOT NULL AUTO_INCREMENT,
    plantName  varchar(255) DEFAULT NULL,
    plantDesc  varchar(255) DEFAULT NULL,
    plantPrice int(11)      DEFAULT NULL,
    plantImage mediumblob   DEFAULT NULL,
    categoryId int(11)      DEFAULT NULL,
    PRIMARY KEY (plantId),
    KEY categoryId (categoryId),
    CONSTRAINT categoryFk FOREIGN KEY (categoryId) REFERENCES category (categoryId)
);

create table if not exists cart
(
    cartId int(11) NOT NULL AUTO_INCREMENT,
    userId int(11) NOT NULL,
    PRIMARY KEY (cartId),
    KEY userFk (userId),
    CONSTRAINT userFk FOREIGN KEY (userId) REFERENCES users (userId) ON DELETE CASCADE ON UPDATE CASCADE
);

create table if not exists cartPlant
(
    pivotId int auto_increment primary key,
    cartFk  int,
    foreign key (cartFk) references cart (cartId),
    plantFk int,
    foreign key (plantFk) references plant (plantId)
);

CREATE TABLE orders (
    orderId int not null auto_increment primary key,
    pivotFk int ,
    foreign key (pivotFk) references cartPlant (pivotId),
    totalPrice int
);

CREATE TABLE theme(
    themeId int not null auto_increment primary key,
    themeName varchar(255),
    themeDesc text,
    themeImage mediumblob
);

CREATE TABLE tags (
    tagId int not null auto_increment primary key,
    tagName varchar (255),
    themeFk int,
    foreign key (themeFk) REFERENCES theme (themeId)
);

DELIMITER //
CREATE TRIGGER after_orders_insert
    AFTER INSERT ON orders
    FOR EACH ROW
BEGIN
    DELETE FROM cartPlant WHERE pivotId = NEW.pivotFk;
END;

//
DELIMITER ;



-- SELECT sum(plantPrice) as total FROM cart, plant, cartPlant
-- WHERE cartPlant.cartFk = cart.cartId
--   AND cartPlant.plantFk = plant.plantid
--   AND cart.userId = 1;

-- ALTER TABLE cartplant
--     DROP FOREIGN KEY cartplant_ibfk_1;
-- ALTER TABLE cartplant
--     ADD CONSTRAINT cartplant_ibfk_1 FOREIGN KEY (cartFk) REFERENCES cart (cartId) ON DELETE CASCADE ON UPDATE CASCADE;
-- ALTER TABLE cartplant
--     DROP FOREIGN KEY cartplant_ibfk_2;
-- ALTER TABLE cartplant
--     ADD CONSTRAINT cartplant_ibfk_2 FOREIGN KEY (plantFk) REFERENCES plant (plantId) ON DELETE CASCADE ON UPDATE CASCADE;
--
--
-- ALTER TABLE cartplant
--     DROP FOREIGN KEY cartplant_ibfk_1;
--
-- ALTER TABLE cartplant
--     DROP FOREIGN KEY cartplant_ibfk_2;