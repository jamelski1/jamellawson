-- -----------------------------------------------------
-- Table `people`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `people`;

CREATE TABLE IF NOT EXISTS `people` (
  `people_id` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(45) NOT NULL,
  `lastname` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `salt` VARCHAR(512) NOT NULL,
  `password` VARCHAR(512) NOT NULL,
  PRIMARY KEY (`people_id`));