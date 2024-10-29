CREATE TABLE utilisateur
(
  pseudo    varchar(15)     NOT NULL,
  mdp       varchar(255)    NOT NULL,
  genre     char(1)         NOT NULL,
  ddn       DATE            NOT NULL,
  avatar    varchar(20),
  PRIMARY KEY (pseudo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE chatMessage
(
  id        int(11)         NOT NULL AUTO_INCREMENT,
  message   varchar(1000)   NOT NULL,
  temps     timestamp       DEFAULT CURRENT_TIMESTAMP,
  emetteur  varchar(15)     NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (emetteur) REFERENCES utilisateur(pseudo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO utilisateur VALUES
('cedric', '$2y$10$2L7KpeXmMlYc.awCd5aXlOaBy2EQOJk.BIAwCAHbl9oqrCuUCGKbG', 'M', STR_TO_DATE('30-03-1979','%d-%m-%Y'), ''),
('pierre', '$2y$10$QK3.2jK0NMi5U9VhD6TIm.ljWSe1CC1lELolS86BkGQSf.xmsHrV2', 'S', STR_TO_DATE('15-04-1979','%d-%m-%Y'), '');
-- les mots de passes sont également cedric et pierre

INSERT INTO chatMessage (message, emetteur) VALUES
('Notre premier message... Bienvenue!','pierre');
