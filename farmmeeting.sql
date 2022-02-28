drop database if exists farmmeeting;
create database farmmeeting character set utf8 collate utf8_general_ci;
use farmmeeting ;
-----------------------------------------------------------------------------------------------------------------------
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
-----------------------------------------------------------------------------------------------------------------------
alter table farmers_meeting add foreign key (farmers) references farmers(id);
alter table farmers_meeting add foreign key (meeting) references meeting(id);
alter table meeting add foreign key (farmType) references farmType(id);
-----------------------------------------------------------------------------------------------------------------------
insert into farmers (id, opg, email, contactphone) values
(null, 'Admin', 'admin@email.com', 0911111111),
(null, 'OPG1', 'opg1@email.com', 0911111112),
(null, 'OPG2', 'opg2@email.com', 0911111113),
(null, 'OPG3', 'opg3@email.com', 0911111114),
(null, 'OPG4', 'opg4@email.com', 0911111115),
(null, 'OPG5', 'opg5@email.com', 0911111116),
(null, 'OPG6', 'opg6@email.com', 0911111117),
(null, 'OPG7', 'opg7@email.com', 0911111119),
(null, 'OPG8', 'opg8@email.com', 0912211110),
(null, 'OPG9', 'opg9@email.com', 0913311121),
(null, 'OPG10','opg10@email.com',09184411122);
