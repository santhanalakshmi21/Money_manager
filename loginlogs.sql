CREATE TABLE `loginlogs` (
`id` int(11) NOT NULL,
`IpAddress` varbinary(16) NOT NULL,
`TryTime` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;