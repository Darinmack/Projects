CREATE TABLE `newRecipes`
(
    `recipesID`    int NOT NULL AUTO_INCREMENT,
    `name`         varchar(254) NOT NULL,
    `category`        varchar(254) NOT NULL,
    `time`        varchar(254) NOT NULL,
     `servingSize`        varchar(254) NOT NULL,
      `ingredients`        varchar(254) NOT NULL,
       `instructions`        varchar(254) NOT NULL,
    primary key(`recipesID`)
   
);

insert into newRecipes (name, category, time, servingSize, ingredients, instructions) values ('Chicken Pasta', 'Chicken' ,'40 min', '6oz','pasta, chicken, sauce, seasonings', 'first start by prepping and seasoning the chicken...');
insert into newRecipes (name, category, time, servingSize, ingredients, instructions ) values ('Macaroni and Beef','Beef', '25', '8oz', 'macaroni, beef, cheese, barbecue', 'Begin by heating water on the stove...');