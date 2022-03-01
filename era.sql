drop database if exists farmmeeting;
create database farmmeeting character set utf8 collate utf8_general_ci;
use farmmeeting ;

create table farmers(
	id int not null primary key auto_increment,
	opg varchar(50)	not null,
	email varchar(50) not null,
	contactphone int not null
);

create table farmType(
	id int not null primary key auto_increment,
	name varchar(50) not null,
	numOfWorkers int not null
);

create table meeting(
	id int not null primary key auto_increment,
	farmType int not null,
	meetingStart datetime not null,
	meetingLocation varchar(50) not null,
	reason varchar(10000) not null
);

create table farmers_meeting(
	meeting int not null,
	farmers int not null
);

alter table farmers_meeting add foreign key (farmers) references farmers(id);
alter table farmers_meeting add foreign key (meeting) references meeting(id);
alter table meeting add foreign key (farmType) references farmType(id);

insert into farmers (id, opg, email, contactphone) values
(null, 'Admin', 'admin@email.com', 091111111),
(null, 'OPG1', 'opg1@email.com', 091111112),
(null, 'OPG2', 'opg2@email.com', 091111113),
(null, 'OPG3', 'opg3@email.com', 091111114),
(null, 'OPG4', 'opg4@email.com', 091111115),
(null, 'OPG5', 'opg5@email.com', 091111116),
(null, 'OPG6', 'opg6@email.com', 091111117),
(null, 'OPG7', 'opg7@email.com', 091111119),
(null, 'OPG8', 'opg8@email.com', 091221110),
(null, 'OPG9', 'opg9@email.com', 091331121),
(null, 'OPG10','opg10@email.com',0918441122);

insert into farmType (id, name, numOfWorkers) values
(null, 'Poultry farming', 5),
(null, 'Pig farming', 8),
(null, 'Cattle farming', 15),
(null, 'Beekeeping', 2),
(null, 'Fruit growing', 4);

insert into meeting (id, farmType,  meetingStart,  meetingLocation, reason) values
(null, 1, '2022-08-20 10:00:00',  'KonferencijskDvorana','Dodjela sredstava.'), 
(null, 2, '2022-10-21 08:00:00',  'KonferencijskDvorana','Dogovor oko EU projekata.'),
(null, 3, '2022-06-22 09:45:00',  'DvorKonferencijskDvoranaana1', 'Dodjela zemlje.'),
(null, 4, '2022-05-23 16:30:00',  'KonferencijskDvorana', 'Skup razmjene sadnica, meda i sjemena medonosnog bilja.'),
(null, 5, '2022-02-24 11:50:00',  'KonferencijskDvorana', 'Uvoz radne snage za sezonu.');

insert into farmers_meeting (meeting, farmers) values
(1, 1),
(1, 2),
(1, 3),
(1, 4),

(2, 1),
(2, 5),
(2, 6),
(2, 7),

(3, 1),
(3, 2),
(3, 8),
(3, 10),

(4, 1),
(4, 3),
(4, 4),
(4, 5),
(4, 6),

(5, 1),
(5, 9),
(5, 10),
(5, 11);



