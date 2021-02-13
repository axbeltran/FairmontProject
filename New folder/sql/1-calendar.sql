CREATE TABLE `events` (
  `date` date NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `events`
  ADD PRIMARY KEY (`date`);