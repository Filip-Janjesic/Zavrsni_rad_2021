drop database if exists farmshop;
create database farmshop character set utf8 collate utf8_general_ci;
use farmshop ;

SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));

create table users (

	id int primary key auto_increment not null,
	name varchar(50) not null,
	lastname varchar(50) not null,
	password char (60) not null,
	role varchar(50) not null,
	email varchar(100),
	register_time varchar(50) ,
	confirm_email_token varchar(255),
	reset_password_token varchar(255),
	rememberme_token varchar(255)
	
);

create table products (

	id int primary key auto_increment not null,
	title varchar(50) not null,
	manufacturer varchar(50) not null,
	image varchar(255) not null,
	price decimal(18.2) not null,
	category int not null,
	content text not NULL,
	visible varchar(20) default 'visible',
	pdf varchar(50) NOT NULL, 
	date_of_manufacture varchar(50) NOT null,
	discount varchar (3)

);

create table categories(

	id int primary key auto_increment not null,
	name varchar(50)

);

create table orders(

	id int primary key auto_increment not null,
	status varchar(50) not null,
	amount varchar(50) not null,
	transaction_id varchar(50) not null,
	order_date date not null,
	user int
	
);

create table comments(

	id int primary key auto_increment not null,
	user int,
	product int,
	comment text,
	comment_date date,
	approved varchar(100)

);

create table rating(

	user int,
	product int,
	rating int(1)

);

create table bought(

	orders int,
	product int,
	price decimal(18,2)

);

create table slideshow(

	id int primary key auto_increment not null,
	photo varchar(255) not null,
	visible varchar (1) 

);

alter table bought add foreign key (orders) references orders(id);
alter table bought add foreign key (product) references products(id);

alter table products add foreign key (category) references categories(id);
alter table orders add foreign key (user) references users(id);

alter table comments add foreign key (product) references products(id);
alter table comments add foreign key (user) references users(id) ON DELETE CASCADE;

alter table rating add foreign key (product) references products(id);
alter table rating add foreign key (user) references users(id) ON DELETE CASCADE;
