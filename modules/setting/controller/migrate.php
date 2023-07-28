<?php
$arrayTable = ['config'];

$migrate['config'] = '
  --
  -- Table structure for table `config`
  --

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

  -- --------------------------------------------------------

  --
  -- Table structure for table `counter`
  --

  CREATE TABLE `counter` (
    `id` int(11) NOT NULL,
    `date` date NOT NULL,
    `month` varchar(255) NOT NULL,
    `counter` int(11) NOT NULL,
    `date_create` datetime NOT NULL,
    `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `status` int(1) NOT NULL
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

  -- --------------------------------------------------------

  --
  -- Table structure for table `menu`
  --

  CREATE TABLE `menu` (
    `id` int(11) NOT NULL,
    `name` varchar(255) NOT NULL,
    `module` varchar(255) NOT NULL,
    `parent` int(11) NOT NULL,
    `position` int(11) NOT NULL,
    `url` varchar(255) NOT NULL,
    `icon` varchar(255) NOT NULL,
    `theme` varchar(255) NOT NULL,
    `orderby` int(11) NOT NULL,
    `date_create` datetime NOT NULL,
    `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `status` int(1) NOT NULL
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

  -- --------------------------------------------------------

  --
  -- Table structure for table `meta`
  --

  CREATE TABLE `meta` (
    `id` int(11) NOT NULL,
    `title` varchar(255) NOT NULL,
    `module` varchar(255) NOT NULL,
    `meta_switch` varchar(255) NOT NULL,
    `meta_keyword` text NOT NULL,
    `meta_description` text NOT NULL,
    `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `date_update` datetime NOT NULL,
    `status` int(1) NOT NULL
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

  -- --------------------------------------------------------

  --
  -- Table structure for table `module`
  --

  CREATE TABLE `module` (
    `id` int(11) NOT NULL,
    `name` varchar(255) NOT NULL,
    `date_create` datetime NOT NULL,
    `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `status` int(11) NOT NULL
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

  -- --------------------------------------------------------

  --
  -- Table structure for table `redirect`
  --

  CREATE TABLE `redirect` (
    `id` int(11) NOT NULL,
    `url_from` varchar(255) NOT NULL,
    `url_to` varchar(255) NOT NULL,
    `date_create` datetime NOT NULL,
    `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `status` int(11) NOT NULL
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

  -- --------------------------------------------------------

  --
  -- Table structure for table `role`
  --

  CREATE TABLE `role` (
    `id` int(11) NOT NULL,
    `name` varchar(255) NOT NULL,
    `date_create` datetime NOT NULL,
    `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `status` int(1) NOT NULL
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

  --
  -- Indexes for dumped tables
  --

  --
  -- Indexes for table `config`
  --
  ALTER TABLE `config`
    ADD PRIMARY KEY (`id`);

  --
  -- Indexes for table `counter`
  --
  ALTER TABLE `counter`
    ADD PRIMARY KEY (`id`);

  --
  -- Indexes for table `menu`
  --
  ALTER TABLE `menu`
    ADD PRIMARY KEY (`id`);

  --
  -- Indexes for table `meta`
  --
  ALTER TABLE `meta`
    ADD PRIMARY KEY (`id`);

  --
  -- Indexes for table `module`
  --
  ALTER TABLE `module`
    ADD PRIMARY KEY (`id`);

  --
  -- Indexes for table `redirect`
  --
  ALTER TABLE `redirect`
    ADD PRIMARY KEY (`id`);

  --
  -- Indexes for table `role`
  --
  ALTER TABLE `role`
    ADD PRIMARY KEY (`id`);

  --
  -- AUTO_INCREMENT for dumped tables
  --

  --
  -- AUTO_INCREMENT for table `config`
  --
  ALTER TABLE `config`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

  --
  -- AUTO_INCREMENT for table `counter`
  --
  ALTER TABLE `counter`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

  --
  -- AUTO_INCREMENT for table `menu`
  --
  ALTER TABLE `menu`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

  --
  -- AUTO_INCREMENT for table `meta`
  --
  ALTER TABLE `meta`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

  --
  -- AUTO_INCREMENT for table `module`
  --
  ALTER TABLE `module`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

  --
  -- AUTO_INCREMENT for table `redirect`
  --
  ALTER TABLE `redirect`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

  --
  -- AUTO_INCREMENT for table `role`
  --
  ALTER TABLE `role`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  COMMIT;
';

// $checkTable = $db->tableExists("config");
// if($checkTable == false){

// }

?>