DROP VIEW IF EXISTS `view_waste_emission_ratio`;

-- change user for your database
CREATE ALGORITHM=UNDEFINED DEFINER=`fixometer_root`@`localhost` SQL SECURITY DEFINER VIEW `view_waste_emission_ratio` AS select sum(`categories`.`footprint`) / sum(`categories`.`weight`) AS `Ratio` from (`devices` join `categories` on((`categories`.`idcategories` = `devices`.`category`))) where (`devices`.`repair_status` = 1 and `devices`.`category` != 46);


