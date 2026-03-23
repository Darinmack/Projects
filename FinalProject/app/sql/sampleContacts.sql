CREATE TABLE `feed`
(
    `PersonID`    int NOT NULL AUTO_INCREMENT,
    `name`         varchar(254) NOT NULL,
    `email`        varchar(254) NOT NULL,
    `Feedback`        varchar(254) NOT NULL,
    primary key(`PersonID`)
   
);

insert into feed (name, email, Feedback) values ('Bob', 'coolman@gmail.com' 'Great Work');
insert into feed (name, email, Feedback) values ('Jane', 'missjane@gmail.com' 'Could use some work');
