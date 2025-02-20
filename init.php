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
    'Kacper',
    'Wyczawski',
    'kwyczawski',
    '" . password_hash('admin', PASSWORD_DEFAULT) . "',
    'dyrector'
)");
$db->exec("create table issues (
    issue_id integer primary key,
    user_id integer not null,
    room text not null,
    description text not null,
    priority text,
    foreign key (user_id) references users(user_id)
)");