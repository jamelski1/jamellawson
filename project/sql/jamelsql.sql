
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

CREATE TABLE IF NOT EXISTS `articles` (
  `article_id` INT NOT NULL AUTO_INCREMENT,
  `ebm_id` INT NULL,
  `name` VARCHAR(30) NOT NULL,
  `file_type` VARCHAR(30) NOT NULL,
  `file_size` INT NOT NULL,
  `content` MEDIUMBLOB NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `abstract` TEXT NOT NULL,
  `theTime` TIMESTAMP NULL,
  `suggested_reviewers` VARCHAR(255) NULL,
  `status` VARCHAR(45) NULL,
  `rating` VARCHAR(45) NULL,
  `previous_version` VARCHAR(45) NULL,
  PRIMARY KEY (`article_id`),
  INDEX `ebm_id_idx` (`ebm_id` ASC),
  CONSTRAINT `ebm_id`
    FOREIGN KEY (`ebm_id`)
    REFERENCES `editorial_board_member` (`ebm_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


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
  `review_file` BLOB NULL,
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
	
INSERT INTO `role` (
	role_name) 
	values (
	'admin');

INSERT INTO `role` (
	role_name) 
	values (
	'editor');

INSERT INTO `role` (
	role_name)
	values (
	'member');