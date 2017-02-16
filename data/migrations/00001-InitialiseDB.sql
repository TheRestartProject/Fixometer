SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE IF NOT EXISTS `categories` (
  `idcategories` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `weight` float DEFAULT NULL,
  `footprint` float DEFAULT NULL,
  `footprint_reliability` int(11) DEFAULT NULL,
  `lifecycle` int(11) DEFAULT NULL,
  `lifecycle_reliability` int(11) DEFAULT NULL,
  `extendend_lifecycle` int(11) DEFAULT NULL,
  `extendend_lifecycle_reliability` int(11) DEFAULT NULL,
  `revision` int(11) NOT NULL,
  `cluster` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `category_revisions` (
  `idcategory_revisions` int(11) NOT NULL,
  `revision` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `clusters` (
  `idclusters` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `devices` (
  `iddevices` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `category_creation` int(11) NOT NULL,
  `estimate` varchar(10) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `problem` text,
  `spare_parts` tinyint(1) NOT NULL DEFAULT '0',
  `repair_status` int(11) NOT NULL,
  `professional_help` tinyint(1) NOT NULL DEFAULT '0',
  `more_time_needed` tinyint(1) NOT NULL DEFAULT '0',
  `do_it_yourself` tinyint(1) NOT NULL DEFAULT '0',
  `repaired_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `events` (
  `idevents` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  `event_date` date NOT NULL DEFAULT '1970-01-01',
  `start` time NOT NULL,
  `end` time NOT NULL,
  `location` varchar(255) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `free_text` text,
  `pax` int(11) DEFAULT NULL,
  `volunteers` int(11) DEFAULT NULL,
  `hours` float DEFAULT NULL,
  `wordpress_post_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `events_users` (
  `idevents_users` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `groups` (
  `idgroups` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `latitude` varchar(25) DEFAULT NULL,
  `longitude` varchar(25) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `frequency` int(11) DEFAULT NULL,
  `free_text` text,
  `wordpress_post_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `images` (
  `idimages` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `alt_text` text,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `links` (
  `idlinks` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `permissions` (
  `idpermissions` int(11) NOT NULL,
  `permission` varchar(150) NOT NULL COMMENT 'Manage Users; Manage Restart Party; Manage devices'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `roles` (
  `idroles` int(11) NOT NULL,
  `role` varchar(45) NOT NULL COMMENT 'Needed to assign blocks of permissions to groups of users. 1 = Admin; 2 = Hosts; 3 = Volunteer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `roles_permissions` (
  `idroles_permissions` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sessions` (
  `idsessions` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users` (
  `idusers` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '3',
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users_groups` (
  `idusers_groups` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `view_waste_emission_ratio` (
`Ratio` double(21,4)
);

CREATE TABLE IF NOT EXISTS `xref` (
  `idxref` int(11) NOT NULL,
  `object` int(11) NOT NULL,
  `object_type` int(11) NOT NULL,
  `reference` int(11) NOT NULL,
  `reference_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `view_waste_emission_ratio`;

CREATE ALGORITHM=UNDEFINED DEFINER=`fixometer_root`@`%` SQL SECURITY DEFINER VIEW `view_waste_emission_ratio` AS select (round((sum(`categories`.`footprint`) * 0.5),0) / round(sum(`categories`.`weight`),0)) AS `Ratio` from (`devices` join `categories` on((`categories`.`idcategories` = `devices`.`category`))) where (`devices`.`repair_status` = 1);


ALTER TABLE `categories`
  ADD PRIMARY KEY (`idcategories`),
  ADD KEY `idxCategoryRevisions` (`revision`),
  ADD KEY `idxCategoryCluster` (`cluster`);

ALTER TABLE `category_revisions`
  ADD PRIMARY KEY (`idcategory_revisions`);

ALTER TABLE `clusters`
  ADD PRIMARY KEY (`idclusters`);

ALTER TABLE `devices`
  ADD PRIMARY KEY (`iddevices`),
  ADD KEY `idxDeviceEvent` (`event`),
  ADD KEY `idxDeviceCategory` (`category`),
  ADD KEY `idxDeviceCategoryCreation` (`category_creation`),
  ADD KEY `idxDeviceUser` (`repaired_by`);

ALTER TABLE `events`
  ADD PRIMARY KEY (`idevents`),
  ADD KEY `idxEventsGroups` (`group`);

ALTER TABLE `events_users`
  ADD PRIMARY KEY (`idevents_users`),
  ADD KEY `idxEventsUsersEvent` (`event`),
  ADD KEY `idxEventsUsersUser` (`user`);

ALTER TABLE `groups`
  ADD PRIMARY KEY (`idgroups`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

ALTER TABLE `images`
  ADD PRIMARY KEY (`idimages`);

ALTER TABLE `links`
  ADD PRIMARY KEY (`idlinks`);

ALTER TABLE `permissions`
  ADD PRIMARY KEY (`idpermissions`);

ALTER TABLE `roles`
  ADD PRIMARY KEY (`idroles`);

ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`idroles_permissions`),
  ADD KEY `idxRolePermissionRole` (`role`),
  ADD KEY `idxRolePermissionPermission` (`permission`);

ALTER TABLE `sessions`
  ADD PRIMARY KEY (`idsessions`),
  ADD UNIQUE KEY `session_UNIQUE` (`session`),
  ADD KEY `idxSessionsUsers` (`user`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `idxUserRole` (`role`);

ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`idusers_groups`),
  ADD KEY `idxUserUsers` (`user`),
  ADD KEY `idxGroupGroups` (`group`);

ALTER TABLE `xref`
  ADD PRIMARY KEY (`idxref`),
  ADD KEY `idxObject` (`object`),
  ADD KEY `idxObjectType` (`object_type`),
  ADD KEY `idxReference` (`reference`),
  ADD KEY `idxReferenceType` (`reference_type`);


ALTER TABLE `categories`
  MODIFY `idcategories` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `category_revisions`
  MODIFY `idcategory_revisions` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `clusters`
  MODIFY `idclusters` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `devices`
  MODIFY `iddevices` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `events`
  MODIFY `idevents` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `events_users`
  MODIFY `idevents_users` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `groups`
  MODIFY `idgroups` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `images`
  MODIFY `idimages` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `links`
  MODIFY `idlinks` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `permissions`
  MODIFY `idpermissions` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `roles`
  MODIFY `idroles` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `roles_permissions`
  MODIFY `idroles_permissions` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `sessions`
  MODIFY `idsessions` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `users_groups`
  MODIFY `idusers_groups` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `xref`
  MODIFY `idxref` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `categories`
  ADD CONSTRAINT `fkCategoryCluster` FOREIGN KEY (`cluster`) REFERENCES `clusters` (`idclusters`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkCategoryRevisions` FOREIGN KEY (`revision`) REFERENCES `category_revisions` (`idcategory_revisions`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `devices`
  ADD CONSTRAINT `fkDeviceCategory` FOREIGN KEY (`category`) REFERENCES `categories` (`idcategories`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkDeviceCategoryCreation` FOREIGN KEY (`category_creation`) REFERENCES `categories` (`idcategories`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkDeviceEvent` FOREIGN KEY (`event`) REFERENCES `events` (`idevents`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkDeviceUser` FOREIGN KEY (`repaired_by`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `events`
  ADD CONSTRAINT `fkEventsGroups` FOREIGN KEY (`group`) REFERENCES `groups` (`idgroups`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `events_users`
  ADD CONSTRAINT `fkEventsUsersEvent` FOREIGN KEY (`event`) REFERENCES `events` (`idevents`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkEventsUsersUser` FOREIGN KEY (`user`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `roles_permissions`
  ADD CONSTRAINT `fkRolePermissionPermission` FOREIGN KEY (`permission`) REFERENCES `permissions` (`idpermissions`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkRolePermissionRole` FOREIGN KEY (`role`) REFERENCES `roles` (`idroles`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `sessions`
  ADD CONSTRAINT `fkSessionsUsers` FOREIGN KEY (`user`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `users`
  ADD CONSTRAINT `fkUserRole` FOREIGN KEY (`role`) REFERENCES `roles` (`idroles`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `users_groups`
  ADD CONSTRAINT `fkGroupGroups` FOREIGN KEY (`group`) REFERENCES `groups` (`idgroups`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkUserUsers` FOREIGN KEY (`user`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
