-- -----------------------------------------------------
-- Table `people`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `people`;

CREATE TABLE IF NOT EXISTS `people` (
  `people_id` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(45) NOT NULL,
  `middlename` VARCHAR(45) NULL,
  `lastname` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `salt` VARCHAR(512) NOT NULL,
  `password` VARCHAR(512) NOT NULL,
  `phonenumber` VARCHAR(11) NOT NULL,
  `photo` VARCHAR(45) NULL,
  PRIMARY KEY (`people_id`));


-- -----------------------------------------------------
-- Table `editorial_board_member`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `editorial_board_member`;

CREATE TABLE IF NOT EXISTS `editorial_board_member` (
  `ebm_id` INT NOT NULL AUTO_INCREMENT,
  `people_id` INT NOT NULL,
  PRIMARY KEY (`ebm_id`, `people_id`),
  INDEX `people_id_idx` (`people_id` ASC),
  CONSTRAINT `people`
    FOREIGN KEY (`people_id`)
    REFERENCES `people` (`people_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `articles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `articles`;
	
CREATE TABLE `articles` (
	article_id INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'unique id',
	name VARCHAR( 30 ) NOT NULL COMMENT 'file name',
	type VARCHAR( 30 ) NOT NULL COMMENT 'MIME type',
	size INT( 11 ) NOT NULL COMMENT 'file size',
	content LONGTEXT NOT NULL COMMENT 'actual file',
	title VARCHAR(45) NOT NULL,
	abstract TEXT NOT NULL,
	theTime TIMESTAMP,
	status VARCHAR(45),
	rating VARCHAR(45),
	ebmcomments VARCHAR(45));


-- -----------------------------------------------------
-- Table `article_detail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `article_detail`;

CREATE TABLE IF NOT EXISTS `article_detail` (
  `people_id` INT NOT NULL,
  `article_id` INT NOT NULL,
  `corresponding_author` TINYINT(1) NULL,
  PRIMARY KEY (`article_id`, `people_id`),
  INDEX `people_id_idx` (`people_id` ASC),
  CONSTRAINT `people_id`
    FOREIGN KEY (`people_id`)
    REFERENCES `people` (`people_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `article_id`
    FOREIGN KEY (`article_id`)
    REFERENCES `articles` (`article_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `reviewer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reviewer`;

CREATE TABLE IF NOT EXISTS `reviewer` (
  `article_id` INT NOT NULL,
  `people_id` INT NOT NULL,
  `decision` VARCHAR(45),
  `comments` VARCHAR(45),
  `ebcomments` VARCHAR(45),
  `status` VARCHAR(45) NULL,
  PRIMARY KEY (`article_id`, `people_id`),
  INDEX `people_id_idx` (`people_id` ASC),
  CONSTRAINT `people_id`
    FOREIGN KEY (`people_id`)
    REFERENCES `people` (`people_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `article_id`
    FOREIGN KEY (`article_id`)
    REFERENCES `articles` (`article_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `role`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `role`;

CREATE TABLE IF NOT EXISTS `role` (
	role_id INT NOT NULL AUTO_INCREMENT,
	role_name VARCHAR(45) NOT NULL,
	PRIMARY KEY (role_id));


-- -----------------------------------------------------
-- Table `role_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `role_user`;

CREATE TABLE IF NOT EXISTS `role_user` (
  people_id int,
  role_id int,
  CONSTRAINT people_det_pk PRIMARY KEY (people_id, role_id),
  CONSTRAINT FK_people FOREIGN KEY (people_id) REFERENCES people (people_id),
  CONSTRAINT FK_role FOREIGN KEY (role_id) REFERENCES role (role_id));


-- -----------------------------------------------------
-- Table `sessions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sessions`;

CREATE TABLE IF NOT EXISTS `sessions` (
  `people_id` INT NOT NULL,
  `login` TIMESTAMP NULL,
  `logout` TIMESTAMP NULL,
  PRIMARY KEY (`people_id`),
  CONSTRAINT `people_id`
    FOREIGN KEY (`people_id`)
    REFERENCES `people` (`people_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `expertise`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `expertise`;

CREATE TABLE IF NOT EXISTS `expertise` (
  `expertise_id` INT NOT NULL AUTO_INCREMENT,
  `expertise_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`expertise_id`));


-- -----------------------------------------------------
-- Table `expertise_detail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `expertise_detail`;

CREATE TABLE IF NOT EXISTS `expertise_detail` (
  `people_id` INT NOT NULL,
  `expertise_id` INT NOT NULL,
  PRIMARY KEY (`people_id`, `expertise_id`),
  INDEX `expertise_id_idx` (`expertise_id` ASC),
  CONSTRAINT `people_id`
    FOREIGN KEY (`people_id`)
    REFERENCES `people` (`people_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `expertise_id`
    FOREIGN KEY (`expertise_id`)
    REFERENCES `expertise` (`expertise_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
	
-- -----------------------------------------------------
-- Table `expertise_detail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ebm_detail`;

CREATE TABLE IF NOT EXISTS `ebm_detail` (
  `people_id` INT NOT NULL,
  `article_id` INT NOT NULL,
  PRIMARY KEY (`people_id`, `article_id`),
  INDEX `article_id_idx` (`article_id` ASC),
  CONSTRAINT `people_id`
    FOREIGN KEY (`people_id`)
    REFERENCES `people` (`people_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `article_id`
    FOREIGN KEY (`article_id`)
    REFERENCES `article` (`article_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `topic_article`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `topic_article`;

CREATE TABLE IF NOT EXISTS `topic_article` (
  `expertise_id` INT NOT NULL,
  `article_id` INT NOT NULL,
  PRIMARY KEY (`expertise_id`, `article_id`),
  INDEX `article_id_idx` (`article_id` ASC),
  CONSTRAINT `expertise_id`
    FOREIGN KEY (`expertise_id`)
    REFERENCES `expertise` (`expertise_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `article_id`
    FOREIGN KEY (`article_id`)
    REFERENCES `articles` (`article_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

DROP TABLE IF EXISTS `invited_authors`;
	
CREATE TABLE `invited_authors`(
  firstname VARCHAR(45) NOT NULL,
  lastname VARCHAR(45) NOT NULL,
  email VARCHAR(45) NOT NULL,
  article_id INT NOT NULL,
  title VARCHAR(45) NOT NULL,
  inviter VARCHAR(45) NOT NULL,
  CONSTRAINT invited_auth_pk PRIMARY KEY (email, article_id),
  CONSTRAINT FK_articles FOREIGN KEY (article_id) REFERENCES articles (article_id)
);
	
INSERT INTO `role` (
	role_name) 
	values (
	'admin');

INSERT INTO `role` (
	role_name) 
	values (
	'ebm');

INSERT INTO `role` (
	role_name)
	values (
	'member');
        
INSERT INTO `role` (
	role_name)
	values (
	'reviewer');