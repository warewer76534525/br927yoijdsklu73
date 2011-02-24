USE `test` ;

DROP PROCEDURE IF EXISTS `test`.`add_user_if_exists` ;
-- DELIMITER $$
CREATE PROCEDURE `test`.`add_user_if_exists`(IN p_username VARCHAR(255))
BEGIN
  DECLARE foo BIGINT DEFAULT 0 ;
  SELECT COUNT(*)
  INTO foo
    FROM `mysql`.`user`
      WHERE `User` =  p_username ;
  
  IF foo = 0 THEN 
         CREATE USER 'valas'@'%' IDENTIFIED BY 'valas';
  END IF;
END ;$$
DELIMITER ;

CALL `test`.`add_user_if_exists`('valas') ;

DROP PROCEDURE IF EXISTS `test`.`add_user_if_exists` ;
