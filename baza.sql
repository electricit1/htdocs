drop table podkategoria CASCADE;
drop table kategoria CASCADE;
drop table jezyk CASCADE;
drop table rola CASCADE;
drop table konto CASCADE;
drop table uprawnienia CASCADE;
drop table zestaw CASCADE;
drop table wynik CASCADE;


CREATE TABLE kategoria(
   id			  SERIAL PRIMARY KEY NOT NULL,
   nazwa		TEXT Unique NOT NULL,
   opis	    TEXT NOT NULL,
   obrazek	TEXT NOT NULL
);

CREATE TABLE podkategoria(
   id           SERIAL PRIMARY KEY NOT NULL,
   id_kategoria SERIAL NOT NULL REFERENCES kategoria (id) ON UPDATE CASCADE ON DELETE CASCADE,
   nazwa        TEXT Unique NOT NULL,
   opis         TEXT NOT NULL,
   obrazek      TEXT NOT NULL
);

CREATE TABLE jezyk(
   id       SERIAL PRIMARY KEY NOT NULL,
   nazwa    TEXT Unique NOT NULL
);

CREATE TABLE rola(
   id       SERIAL PRIMARY KEY NOT NULL,
   nazwa    TEXT Unique NOT NULL,
   opis     TEXT NOT NULL
);

CREATE TABLE konto(
   id           SERIAL PRIMARY KEY NOT NULL,
   id_rola      SERIAL NOT NULL REFERENCES rola (id) ON UPDATE CASCADE ON DELETE CASCADE,
   imie         TEXT NOT NULL,
   nazwisko     TEXT NOT NULL,
   email        TEXT NOT NULL,
   login        TEXT NOT NULL,
   haslo        TEXT NOT NULL
);

CREATE TABLE uprawnienia(
   id               SERIAL PRIMARY KEY NOT NULL,
   id_konto         SERIAL NOT NULL REFERENCES konto (id) ON UPDATE CASCADE ON DELETE CASCADE,
   id_podkategoria  SERIAL NOT NULL REFERENCES podkategoria (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE zestaw(
   id                  SERIAL PRIMARY KEY NOT NULL,
   id_konto            SERIAL NOT NULL REFERENCES konto (id) ON UPDATE CASCADE ON DELETE CASCADE,
   id_jezyk1           SERIAL NOT NULL REFERENCES jezyk (id) ON UPDATE CASCADE ON DELETE CASCADE,
   id_jezyk2           SERIAL NOT NULL REFERENCES jezyk (id) ON UPDATE CASCADE ON DELETE CASCADE,
   id_podkategoria     SERIAL NOT NULL REFERENCES podkategoria (id) ON UPDATE CASCADE ON DELETE CASCADE,
   nazwa               TEXT NOT NULL,
   zestaw              TEXT NOT NULL,
   ilosc_slowek        INT,
   data_edycji         DATE NOT NULL
);

CREATE TABLE wynik(
   id                  SERIAL PRIMARY KEY NOT NULL,
   id_konto            SERIAL NOT NULL REFERENCES konto (id) ON UPDATE CASCADE ON DELETE CASCADE,
   id_zestaw           SERIAL NOT NULL REFERENCES zestaw (id) ON UPDATE CASCADE ON DELETE CASCADE,
   data_wyniku         DATE NOT NULL,
   wynik               REAL
);




insert into kategoria values (1,'Muzyka','Znane na calym swiecie','soundnote.png');
insert into podkategoria values (1,1,'Rock','Instrumenty zwiazane z rockiem','instrument.png');

insert into jezyk values (1,'polski');
insert into jezyk values (2,'angielski');

insert into rola values (4,'admin','jedyny na obiekcie');
insert into rola values (3,'super redaktor','poprawia po zwyklym pajacu');
insert into rola values (2,'redaktor','niby cos tam robi');
insert into rola values (1,'uczen','wszystko przez tego leszcza');

insert into konto values (1,1,'Radek','Golunski','jakisfrajer@koscierzyna.pl','radekmaster1','radekleszcz');

insert into uprawnienia values (1,1,1);

insert into zestaw values (1,1,1,2,1,'Instrumenty','gitara;gituar','1',current_date);

insert into wynik values (1,1,1,current_date,9.5);

Select * from kategoria;
Select * from podkategoria;
Select * from jezyk;
Select * from rola;
Select * from konto;
Select * from uprawnienia;
Select * from zestaw;
Select * from wynik;
