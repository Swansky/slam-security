CREATE DATABASE slam_security;

CREATE TABLE `user`
(
    `id`       int(11)      NOT NULL,
    `email`    varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;


ALTER TABLE `user`
    ADD PRIMARY KEY (`id`);
ALTER TABLE `user`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 2;
COMMIT;

INSERT INTO `user` (`id`, `email`, `password`)
VALUES (1, 'test@gmail.com', '098f6bcd4621d373cade4e832627b4f6');



CREATE TABLE `comment`
(
    `id`       int(11)      NOT NULL,
    `username` varchar(255) NOT NULL,
    `comment`  text         NOT NULL,
    `date`     datetime     NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;


ALTER TABLE `comment`
    ADD PRIMARY KEY (`id`);


ALTER TABLE `comment`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

