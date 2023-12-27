-- *********************************************
-- * Standard SQL generation                   
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Wed Dec 27 11:37:26 2023 
-- * LUN file:  
-- * Schema: schema1/SQL 
-- ********************************************* 


-- Database Section
-- ________________ 

create database NoteForAll;


-- DBSpace Section
-- _______________


-- Tables Section
-- _____________ 

create table USER (
     IdUser char(1) not null,
     Name char(1) not null,
     Surname char(1) not null,
     Username char(1) not null,
     Email char(1) not null,
     Password char(1) not null,
     constraint ID_USER_ID primary key (IdUser));

create table VOTE (
     IdVote char(1) not null,
     IdPost char(1) not null,
     IdUser char(1) not null,
     constraint ID_LIKE_ID primary key (IdVote));

create table COMMENT (
     IdComment char(1) not null,
     IdPost char(1) not null,
     IdUser char(1) not null);

create table NOTIFICATION (
     IdNotification char(1) not null,
     IdUser char(1) not null);

create table CATEGORY (
     IdCategory char(1) not null,
     constraint ID_CATEGORY_ID primary key (IdCategory));

create table POST (
     IdPost char(1) not null,
     Title char(1) not null,
     Description char(1) not null,
     IdUser char(1) not null,
     constraint ID_POST_ID primary key (IdPost));

create table of (
     IdCategory char(1) not null,
     IdPost char(1) not null,
     constraint ID_of_ID primary key (IdCategory, IdPost));


-- Constraints Section
-- ___________________ 

alter table VOTE add constraint REF_LIKE_POST_FK
     foreign key (IdPost)
     references POST;

alter table VOTE add constraint REF_LIKE_USER_FK
     foreign key (IdUser)
     references USER;

alter table COMMENT add constraint REF_COMME_POST_FK
     foreign key (IdPost)
     references POST;

alter table COMMENT add constraint REF_COMME_USER_FK
     foreign key (IdUser)
     references USER;

alter table NOTIFICATION add constraint REF_NOTIF_USER_FK
     foreign key (IdUser)
     references USER;

alter table POST add constraint ID_POST_CHK
     check(exists(select * from of
                  where of.IdPost = IdPost)); 

alter table POST add constraint REF_POST_USER_FK
     foreign key (IdUser)
     references USER;

alter table of add constraint EQU_of_POST_FK
     foreign key (IdPost)
     references POST;

alter table of add constraint REF_of_CATEG
     foreign key (IdCategory)
     references CATEGORY;


-- Index Section
-- _____________ 

create unique index ID_USER_IND
     on USER (IdUser);

create unique index ID_LIKE_IND
     on VOTE (IdVote);

create index REF_LIKE_POST_IND
     on VOTE (IdPost);

create index REF_LIKE_USER_IND
     on VOTE (IdUser);

create index REF_COMME_POST_IND
     on COMMENT (IdPost);

create index REF_COMME_USER_IND
     on COMMENT (IdUser);

create index REF_NOTIF_USER_IND
     on NOTIFICATION (IdUser);

create unique index ID_CATEGORY_IND
     on CATEGORY (IdCategory);

create unique index ID_POST_IND
     on POST (IdPost);

create index REF_POST_USER_IND
     on POST (IdUser);

create unique index ID_of_IND
     on of (IdCategory, IdPost);

create index EQU_of_POST_IND
     on of (IdPost);

