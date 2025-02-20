<?php
$db = new PDO('sqlite:elektronet.db');
$db->exec("create table users (
    user_id integer primary key,
    first_name text not null,
    last_name text not null,
    username text not null,
    password text not null,
    role text not null
)");
$db->exec("insert into users (
    first_name,
    last_name,
    username,
    password,
    role
) values (
    'Admin',
    'Admin',
    'admin',
    '" . password_hash('admin', PASSWORD_DEFAULT) . "',
    'director'
)");
$db->exec("create table errands (
    errand_id integer primary key,
    user_id integer not null,
    room text not null,
    description text not null,
    status text not null,
    foreign key (user_id) references users(user_id)
)");