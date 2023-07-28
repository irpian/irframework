<?php
$arrayTable = ['config'];

$migrate['config'] = '
    CREATE TABLE `config` (
    `id` int(11) NOT NULL,
    `name` varchar(255) NOT NULL,
    `key` varchar(255) NOT NULL,
    `value` text NOT NULL,
    `type` int(1) NOT NULL,
    `date_create` datetime NOT NULL,
    `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `status` int(1) NOT NULL
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  
  ALTER TABLE `config` ADD PRIMARY KEY (`id`);

  ALTER TABLE `config` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
';

// $checkTable = $db->tableExists("config");
// if($checkTable == false){

// }

?>