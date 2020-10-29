drop database if exists fridges;
CREATE DATABASE fridges CHARACTER SET utf8 COLLATE utf8_general_ci;

use fridges;



DROP TABLE IF EXISTS tbl_users;
CREATE TABLE tbl_users
(
    id       INTEGER not null auto_increment,
    login    BIGINT  NOT NULL,
    name     VARCHAR(63),
    password VARCHAR(205),
    primary key (id)

);
INSERT INTO tbl_users
values (1, 1122, 'danny', 1234),
       (2, 3322, 'Max', 4321),
       (3, 3344, 'John', 2233)
;


drop table if exists tbl_departments;
create table tbl_departments
(
    id   INTEGER not null auto_increment,
    name VARCHAR(63),
    primary key (id)
);
INSERT INTO tbl_departments
values (1, 'Плиточник << Убой >>'),
       (2, 'Плиточник << Оволка Голов >>')
;

drop table if exists tbl_department_fridges;
create table tbl_department_fridges
(
    id      INTEGER not null auto_increment,
    name    VARCHAR(63),
    dept_id INTEGER,
    primary key (id),
    foreign key (dept_id) references tbl_departments (id)
        on delete cascade
        on update cascade
);
INSERT INTO tbl_department_fridges
values (1, 1, 1),
       (2, 2, 1),
       (3, 3, 1),
       (4, 4, 1),
       (5, 5, 1),
       (6, 1, 2),
       (7, 2, 2),
       (8, 3, 2),
       (9, 4, 2),
       (10, 5, 2),
       (11, 6, 2)
;


create table fridge_power
(
    id               bigint not null auto_increment,
    user_id          int    not null,
    fridge_id        int    not null,
    status           int,
    begin_time1      datetime,
    end_time1        datetime,
    begin_time2      datetime,
    end_time2        datetime,
    datetime_compare datetime,
    primary key (id),
    foreign key (fridge_id) references tbl_department_fridges (id)
        on delete cascade
        on update cascade
);

create table fridge_unique
(
    action_id int not null,
    user_id   int not null,
    fridge_id int not null

);

