drop table podkategoria CASCADE;
drop table kategoria CASCADE;
drop table jezyk CASCADE;
drop table rola CASCADE;
drop table konto CASCADE;
drop table uprawnienia CASCADE;
drop table zestaw CASCADE;
drop table wynik CASCADE;


CREATE TABLE kategoria(
   id			     SERIAL PRIMARY KEY NOT NULL,
   nazwa		     VARCHAR(50)  NOT NULL,
   opis	        VARCHAR(200) NOT NULL,
   widocznosc    INT NOT NULL,
   obrazek	     VARCHAR(100) NOT NULL
);

CREATE TABLE podkategoria(
   id           SERIAL PRIMARY KEY NOT NULL,
   id_kategoria INT NOT NULL REFERENCES kategoria (id) ON UPDATE CASCADE ON DELETE CASCADE,
   nazwa        VARCHAR(50)  NOT NULL,
   opis         VARCHAR(200) NOT NULL,
   widocznosc   INT NOT NULL,
   obrazek      VARCHAR(100) NOT NULL
);

CREATE TABLE jezyk(
   id       SERIAL PRIMARY KEY NOT NULL,
   nazwa    VARCHAR(30) UNIQUE NOT NULL
);

CREATE TABLE rola(
   id       SERIAL PRIMARY KEY NOT NULL,
   nazwa    VARCHAR(50) NOT NULL,
   opis     VARCHAR(200) NOT NULL
);

CREATE TABLE konto(
   id           SERIAL PRIMARY KEY NOT NULL,
   id_rola      INT NOT NULL REFERENCES rola (id) ON UPDATE CASCADE ON DELETE CASCADE,
   imie         VARCHAR(30) NOT NULL,
   nazwisko     VARCHAR(30) NOT NULL,
   email        VARCHAR(50) NOT NULL,
   login        VARCHAR(20) NOT NULL,
   haslo        VARCHAR(200) NOT NULL
);

CREATE TABLE uprawnienia(
   id               SERIAL PRIMARY KEY NOT NULL,
   id_konto         INT NOT NULL REFERENCES konto (id) ON UPDATE CASCADE ON DELETE CASCADE,
   id_podkategoria  INT NOT NULL REFERENCES podkategoria (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE zestaw(
   id                  SERIAL PRIMARY KEY NOT NULL,
   id_konto            INT NOT NULL REFERENCES konto (id) ON UPDATE CASCADE ON DELETE CASCADE,
   id_jezyk1           INT NOT NULL REFERENCES jezyk (id) ON UPDATE CASCADE ON DELETE CASCADE,
   id_jezyk2           INT NOT NULL REFERENCES jezyk (id) ON UPDATE CASCADE ON DELETE CASCADE,
   id_podkategoria     INT NOT NULL REFERENCES podkategoria (id) ON UPDATE CASCADE ON DELETE CASCADE,
   nazwa               VARCHAR(30) NOT NULL,
   zestaw              TEXT NOT NULL,
   ilosc_slowek        INT,
   data_edycji         DATE NOT NULL,
   widocznosc          INT NOT NULL
);

CREATE TABLE wynik(
   id                  SERIAL PRIMARY KEY NOT NULL,
   id_konto            INT NOT NULL REFERENCES konto (id) ON UPDATE CASCADE ON DELETE CASCADE,
   id_zestaw           INT NOT NULL REFERENCES zestaw (id) ON UPDATE CASCADE ON DELETE CASCADE,
   data_wyniku         DATE NOT NULL,
   wynik               REAL
);



INSERT INTO `jezyk` (`id`, `nazwa`) VALUES
(2, 'angielski'),
(1, 'polski');

INSERT INTO `kategoria` (`id`, `nazwa`, `opis`, `widocznosc`, `obrazek`) VALUES
(1, 'Muzyka', 'Znane na calym swiecie', 1, 'soundnote.png'),
(2, 'Narzedzia', 'Codziennie uzywane', 1, 'tools.png'),
(3, 'Geografia', 'Swiat', 1, 'world.png');

INSERT INTO `konto` (`id`, `id_rola`, `imie`, `nazwisko`, `email`, `login`, `haslo`) VALUES
(1, 1, 'radix', 'uczen', 'radix@master.pl', 'uczen', '$2y$10$ONLqsb2jCLwCfd/.ozFL5OMqrgSy5meWuGyjGn1/i2EwCivEGZ5Iu'),
(2, 4, 'admin', 'sort', 'radix@master.pl', 'admin', '$2y$10$ONLqsb2jCLwCfd/.ozFL5OMqrgSy5meWuGyjGn1/i2EwCivEGZ5Iu'),
(3, 2, 'redaktor', 'sort', 'radix@master.pl', 'redaktor', '$2y$10$ONLqsb2jCLwCfd/.ozFL5OMqrgSy5meWuGyjGn1/i2EwCivEGZ5Iu'),
(4, 3, 'superredaktor', 'sort', 'radix@master.pl', 'superredaktor', '$2y$10$ONLqsb2jCLwCfd/.ozFL5OMqrgSy5meWuGyjGn1/i2EwCivEGZ5Iu');

INSERT INTO `podkategoria` (`id`, `id_kategoria`, `nazwa`, `opis`, `widocznosc`, `obrazek`) VALUES
(1, 1, 'Rock', 'Instrumenty zwiazane z rockiem', 1, 'electricgituar.png'),
(2, 1, 'Pop', 'Gwiazdy zwiazane z rokciem', 1, 'pop.png'),
(3, 2, 'Budowlane', 'Uzywane na budowie', 1, 'bulidhelmet.png'),
(4, 2, 'Ogrodowe', 'Do pielegnacji ogrodu', 1, 'rake.png'),
(5, 3, 'Afryka', 'Rzeki Afryki', 1, 'africa.png'),
(6, 3, 'Europa', 'Miasta Europy', 1, 'europe.png');

INSERT INTO `rola` (`id`, `nazwa`, `opis`) VALUES
(1, 'uczen', 'wszystko przez tego leszcza'),
(2, 'redaktor', 'niby cos tam robi'),
(3, 'super redaktor', 'poprawia po zwyklym pajacu'),
(4, 'admin', 'jedyny na obiekcie');

INSERT INTO `uprawnienia` (`id`, `id_konto`, `id_podkategoria`) VALUES
(1, 1, 3),
(2, 3, 1),
(3, 3, 2);

INSERT INTO `zestaw` (`id`, `id_konto`, `id_jezyk1`, `id_jezyk2`, `id_podkategoria`, `nazwa`, `zestaw`, `ilosc_slowek`, `data_edycji`, `widocznosc`) VALUES
(2, 2, 1, 2, 2, 'Instrumenty', 'mikrofon;microphone\r\nelo; siemanko\r\nzestaw; set\r\nedzio;miecio\r\njeste;motyle', 5, '2016-04-10', 1),
(3, 1, 1, 2, 1, 'Gwiazdy', 'hania montana, kotek;hannah montanah', 1, '2016-04-10', 1),
(4, 1, 1, 2, 2, 'Naglosnienie', 'subufer;subufer', 1, '2016-04-10', 1),
(5, 2, 1, 2, 1, 'ogolnie', 'fajnie;nice', 1, '2016-04-17', 1),
(6, 2, 1, 2, 2, 'cos', 'test, test3;test2', 1, '2016-04-17', 1);
