<?php
$arrayTable = [
    'user',
    'role',
    'user_role'
    ];

$migrate['user'] = '
CREATE TABLE `user` (
    `id` int(11) NOT NULL,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `token` varchar(255) NOT NULL,
    `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `date_create` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    `status` int(1) NOT NULL
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

    INSERT INTO `user` (`id`, `email`, `password`, `token`, `last_login`, `date_create`, `date_update`, `status`) VALUES
    (1, 'admin@irframework.com', '21232f297a57a5a743894a0e4a801fc3', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

    ALTER TABLE `user` ADD PRIMARY KEY (`id`);

    ALTER TABLE `user` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
';

$migrate['role'] = '
    CREATE TABLE `role` (
    `id` int(11) NOT NULL,
    `name` varchar(255) NOT NULL,
    `date_create` datetime NOT NULL,
    `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `status` int(1) NOT NULL
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

    ALTER TABLE `role` ADD PRIMARY KEY (`id`);

    ALTER TABLE `role` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
';

$migrate['user_role'] = '
    CREATE TABLE `user_role` (
    `id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `role_id` int(11) NOT NULL,
    `date_create` datetime NOT NULL,
    `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `status` int(1) NOT NULL
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

    ALTER TABLE `user_role` ADD PRIMARY KEY (`id`);
    
    ALTER TABLE `user_role` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
';