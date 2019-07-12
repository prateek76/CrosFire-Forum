CREATE table categories(
	id int(3) NOT null AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(24) NOT null

);


CREATE table posts (
	id int(6) NOT null AUTO_INCREMENT PRIMARY KEY,
    cat_id int(3) NOT null,
    title VARCHAR(255) NOT null,
    contents TEXT NOT null,
    date_posted DATETIME NOT null
);