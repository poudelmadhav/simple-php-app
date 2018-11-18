# Ecommerce Application

## Requirements
  - Features

## Technical Specifications

## System Design

### Ecommerce Database Design
   - DB Name: ecommerce

#### Tables/Entities

##### users
```
create table users (
	id int(11) not null primary key auto_increment,
	username varchar(100) not null,
	password varchar(50) not null,
	first_name varchar(100) not null,
	last_name varchar(100) not null,
	status smallint(4)  not null default '1' comment "0: Inactive, 1: Active",
	unique key (username)
);
```
```
insert into users (
	username, password, first_name, last_name)
	values('admin', md5('admin'), "Ecommerce", "Admin");
```
Another way of inserting
```
insert into users set
username = 'admin',
password = md5('admin'),
first_name = "Ecommerce",
last_name = "Admin"
```
```
insert into users set
username = 'manager',
password = md5('admin'),
first_name = "Ecommerce",
last_name = "Manager";
```

##### categories
```
create table categories (
	id int(11) not null primary key auto_increment,
	name varchar(255) not null,
	image_name varchar(255) null,
	description text null,
	status smallint(4) not null default '1' comment "0: Inactive, 1: Active"
);
```

##### products
```
create table products (
	id int(11) not null primary key auto_increment,
	category_id int(11) not null,
	name varchar(255) not null,
	description text null,
	status smallint(4) not null default '1' comment "0: Inactive, 1: Active"
);
```

##### product_images
```
create table product_images (
	id int(11) not null primary key auto_increment,
	product_id int(11) not null,
	image_name varchar(255) not null
);
```
```
alter table products
	add column price double(10,2) not null default '0.00' after name;
```

##### customers
```
create table customers (
	id int(11) not null primary key auto_increment,
	first_name varchar(100) not null,
	last_name varchar(100) not null,
	email varchar(100) not null,
	password varchar(50) not null,
	billing_address varchar(255) null,
	shipping_address varchar(255) null,
	status smallint(4) not null default '1' comment "0: Inactive, 1: Active",
	unique key (email)
);
```
```
insert into customers set
first_name = 'Madhav',
last_name = 'Paudel',
email = 'info@poudelmadhav.com.np',
password = md5('MADHAV'),
billing_address = 'Naya Thimi, Bhaktapur',
shipping_address = 'Mallarani Gaunpalika-1, Pyuthan';
```

##### cart
```
create table cart (
	id int(11) not null primary key auto_increment,
	session_id int(11) not null,
	product_id int(11) not null,
	quantity int(11) not null,
	price double(10,2) not null default '0.00'
);
```

##### orders
```
create table orders (
	id int(11) not null primary key auto_increment,
	customer_id int(11) not null,
	order_total int(11) not null,
	order_status varchar(25) not null comment "pending, processing, invoiced, complete, etc.",
	order_date date not null
);
```

##### ordered_items
```
create table ordered_items (
	id int(11) not null primary key auto_increment,
	order_id int(11) not null,
	product_id int(11) not null,
	quantity int(11) not null,
	price double(10,2) not null default '0.00'
);
```
Adding Foreign Key
```
alter table products add foreign key(category_id) references categories(id);
alter table product_images add foreign key(product_id) references products(id);

alter table cart add foreign key(product_id) references products(id);

alter table orders add foreign key(customer_id) references customers(id);
alter table ordered_items add foreign key(order_id) references orders(id);
alter table ordered_items add foreign key(product_id) references products(id);
```
