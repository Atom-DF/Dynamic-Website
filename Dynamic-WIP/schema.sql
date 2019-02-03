drop table users;
create table users(id integer not null primary key autoincrement,
  username varchar(20),
  password varchar(60),
  salt varchar(60),
  email varchar(30),
  total integer not null);

drop table bill;
create table bill(id integer not null primary key autoincrement,
  name varchar(20),
  original_amount integer not null,
  payed integer not null,
  accepted boolean not null,
  complete boolean not null);

drop table transfer;
create table transfer(id integer not null primary key autoincrement,
  amount integer not null,
  description varchar(60),
  payed integer not null,
  done boolean not null,
  user_owed integer not null,
  user_owes integer not null,
  bill_id integer,
  weight integer not null,
  accepted boolean,
  foreign key (bill_id) references bill(id),
  foreign key (user_owed) references users(id),
  foreign key (user_owes) references users(id));
