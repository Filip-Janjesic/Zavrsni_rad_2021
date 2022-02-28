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