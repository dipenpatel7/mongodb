<?php
//09-07-2019
ALTER TABLE `users` ADD `role_id` ENUM('P','D') NOT NULL DEFAULT 'P' COMMENT 'p=patient,D=doctor' AFTER `password`, ADD `phone` VARCHAR(50) NULL AFTER `role_id`, ADD `address` VARCHAR(250) NULL AFTER `phone`;

ALTER TABLE `users` ADD `status` ENUM('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive,1=active' AFTER `remember_token`;
    
    
    
    
?>
