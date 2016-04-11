drop table if exists podkategoria CASCADE;
drop table if exists kategoria CASCADE;
drop table if exists jezyk CASCADE;
drop table if exists rola CASCADE;
drop table if exists konto CASCADE;
drop table if exists uprawnienia CASCADE;
drop table if exists zestaw CASCADE;
drop table if exists wynik CASCADE;


CREATE TABLE kategoria(
   id			  SERIAL PRIMARY KEY NOT NULL,
   nazwa		TEXT NOT NULL,
   opis	    TEXT NOT NULL,
   obrazek	TEXT NOT NULL
);

CREATE TABLE podkategoria(
   id           SERIAL PRIMARY KEY NOT NULL,
   id_kategoria INT NOT NULL REFERENCES kategoria (id) ON UPDATE CASCADE ON DELETE CASCADE,
   nazwa        VARCHAR(50) UNIQUE NOT NULL,
   opis         VARCHAR(200) NOT NULL,
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
   data_edycji         DATE NOT NULL
);

CREATE TABLE wynik(
   id                  SERIAL PRIMARY KEY NOT NULL,
   id_konto            INT NOT NULL REFERENCES konto (id) ON UPDATE CASCADE ON DELETE CASCADE,
   id_zestaw           INT NOT NULL REFERENCES zestaw (id) ON UPDATE CASCADE ON DELETE CASCADE,
   data_wyniku         DATE NOT NULL,
   wynik               REAL
);




INSERT INTO `kategoria` (`id`, `nazwa`, `opis`, `obrazek`) VALUES
(1, 'Muzyka', 'Znane na calym swiecie', 'soundnote.png'),
(2, 'Narzedzia', 'Codziennie uzywane', 'tools.png'),
(3, 'Geografia', 'Swiat', 'world.png');


INSERT INTO `podkategoria` (`id`, `id_kategoria`, `nazwa`, `opis`, `obrazek`) VALUES
(1, 1, 'Rock', 'Instrumenty zwiazane z rockiem', 'electricgituar.png'),
(2, 1, 'Pop', 'Gwiazdy zwiazane z rokciem', 'pop.png'),
(3, 2, 'Budowlane', 'Uzywane na budowie', 'bulidhelmet.png'),
(4, 2, 'Ogrodowe', 'Do pielegnacji ogrodu', 'rake.png'),
(5, 3, 'Afryka', 'Rzeki Afryki', 'africa.png'),
(6, 3, 'Europa', 'Miasta Europy', 'europe.png');

insert into jezyk values (1,'polski');
insert into jezyk values (2,'angielski');

insert into rola values (4,'admin','jedyny na obiekcie');
insert into rola values (3,'super redaktor','poprawia po zwyklym pajacu');
insert into rola values (2,'redaktor','niby cos tam robi');
insert into rola values (1,'uczen','wszystko przez tego leszcza');

insert into konto values (1,1,'Radek','Golunski','jakisfrajer@koscierzyna.pl','radekmaster1','$2y$10$ONLqsb2jCLwCfd/.ozFL5OMqrgSy5meWuGyjGn1/i2EwCivEGZ5Iu');

insert into uprawnienia values (1,1,1);

insert into zestaw values (1,1,1,2,1,'Instrumenty','gitara;gituar','1',current_date);

insert into wynik values (1,1,1,current_date,9.5);


INSERT INTO `konto` (`id`, `id_rola`, `imie`, `nazwisko`, `email`, `login`, `haslo`) VALUES
(1, 1, 'radix', 'uczen', 'radix@master.pl', 'uczen', '$2y$10$ONLqsb2jCLwCfd/.ozFL5OMqrgSy5meWuGyjGn1/i2EwCivEGZ5Iu'),
(2, 4, 'admin', 'sort', 'radix@master.pl', 'admin', '$2y$10$ONLqsb2jCLwCfd/.ozFL5OMqrgSy5meWuGyjGn1/i2EwCivEGZ5Iu'),
(3, 2, 'redaktor', 'sort', 'radix@master.pl', 'redaktor', '$2y$10$ONLqsb2jCLwCfd/.ozFL5OMqrgSy5meWuGyjGn1/i2EwCivEGZ5Iu'),
(4, 3, 'superredaktor', 'sort', 'radix@master.pl', 'superredaktor', '$2y$10$ONLqsb2jCLwCfd/.ozFL5OMqrgSy5meWuGyjGn1/i2EwCivEGZ5Iu');





Select * from kategoria;
Select * from podkategoria;
Select * from jezyk;
Select * from rola;
Select * from konto;
Select * from uprawnienia;
Select * from zestaw;
Select * from wynik;
