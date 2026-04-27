CREATE TABLE `favorites`
(
    `favoriteID`    int NOT NULL AUTO_INCREMENT,
    `mealName`         varchar(254) NOT NULL,
    `category`        varchar(254) NOT NULL,

    primary key(`favoriteID`)
   
);

INSERT INTO favorites (mealName, category) values('Beef and Oyster Pie', 'Beef');
INSERT INTO favorites (mealName, category) values('Beef Dumpling Stew', 'Beef');