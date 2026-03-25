DROP TABLE IF EXISTS people;

/* This is a very simple table for a mysql-php example */
CREATE TABLE people (
    people_id INT NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(45) NOT NULL,
	middlename VARCHAR(45) NOT NULL,
    lastname VARCHAR(45) NOT NULL,
	author INT(1)NOT NULL,
	reviewer INT(1) NOT NULL,
	email VARCHAR(45) NOT NULL,
	password VARCHAR(45) NOT NULL,
    PRIMARY KEY (people_id)
);

DROP TABLE IF EXISTS expertise;

CREATE TABLE expertise (
	expertise_id INT NOT NULL AUTO_INCREMENT,
	expertise_name VARCHAR(45) NOT NULL,
	PRIMARY KEY (expertise_id)
);
	/*PRIMARY KEY (expertise_id),
	FOREIGN KEY(people_det_pk) REFERENCES expertise_detail(people_det_pk)*/
	

DROP TABLE IF EXISTS expertise_detail;

CREATE TABLE expertise_detail(
  people_id int,
  expertise_id int,
  CONSTRAINT people_det_pk PRIMARY KEY (people_id, expertise_id),
  CONSTRAINT FK_people FOREIGN KEY (people_id) REFERENCES people (people_id),
  CONSTRAINT FK_expertise FOREIGN KEY (expertise_id) REFERENCES expertise (expertise_id)
);

DROP TABLE IF EXISTS affiliation;
CREATE TABLE affiliation (
	expertise_id INT NOT NULL AUTO_INCREMENT,
	expertise_name VARCHAR(45) NOT NULL,
	PRIMARY KEY (expertise_id)
);

	
DROP TABLE IF EXISTS articles;	
CREATE TABLE articles (
	article_id INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'unique id',
	name VARCHAR( 30 ) NOT NULL COMMENT 'file name',
	file_type VARCHAR( 30 ) NOT NULL COMMENT 'MIME type',
	file_size INT( 11 ) NOT NULL COMMENT 'file size',
	content MEDIUMBLOB NOT NULL COMMENT 'actual file',
	title VARCHAR(45) NOT NULL
); /*ENGINE = MYISAM COMMENT = 'Uploaded files'*/
/*CREATE TABLE expertise_detail(
	people_id INT,
	expertise_id INT,
	CONSTRAINT people_det_pk PRIMARY KEY(people_id, expertise_id)
	CONSTRAINT fk_people
		FOREIGN KEY (people_id) REFERENCES people(people_id),
	CONSTRAINT fk_expertise
		FOREIGN KEY (expertise_id) REFERENCES expertise(expertise_id)
);*/
	