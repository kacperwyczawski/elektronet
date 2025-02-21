<?php
$db = new PDO('sqlite:elektronet.db');

$db->exec("create table users (
    user_id integer primary key,
    first_name text not null,
    last_name text not null,
    username text not null,
    password text not null,
    role text not null,
    created_at text not null
)");

$db->exec("insert into users (
    first_name,
    last_name,
    username,
    password,
    role,
    created_at
) values (
    'Kacper',
    'Wyczawski',
    'kacwyc',
    '" . password_hash('admin', PASSWORD_DEFAULT) . "',
    'dyrektor',
    datetime('now')
)");

$db->exec("create table issues (
    issue_id integer primary key,
    raised_by_id integer not null,
    assigned_to_id integer,
    room text not null,
    description text not null,
    priority integer,
    raised_at text not null,
    approved_at text,
    foreign key (raised_by_id) references users(user_id),
    foreign key (assigned_to_id) references users(user_id)
)");
