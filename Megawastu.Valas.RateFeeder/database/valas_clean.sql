DROP database IF EXISTS `valas`;

-- drop database user
USE `test` ;

DROP PROCEDURE IF EXISTS `test`.`drop_user_if_exists` ;
DELIMITER $$
CREATE PROCEDURE `test`.`drop_user_if_exists`(IN p_username VARCHAR(255))
BEGIN
  DECLARE foo BIGINT DEFAULT 0 ;
  SELECT COUNT(*)
  INTO foo
    FROM `mysql`.`user`
      WHERE `User` =  p_username ;
  
  IF foo > 0 THEN 
         DROP USER  'valas' ;
  END IF;
END ;$$
DELIMITER ;

CALL `test`.`drop_user_if_exists`('valas') ;

DROP PROCEDURE IF EXISTS `test`.`drop_users_if_exists` ;