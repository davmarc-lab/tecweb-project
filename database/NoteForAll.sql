-- *********************************************
-- * Standard SQL generation                   
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Wed Dec 27 11:37:26 2023 
-- * LUN file:  
-- * Schema: schema1/SQL 
-- ********************************************* 

create table utente (
     IdUser char(1) not null,
     Name char(1) not null,
     Surname char(1) not null,
     Username char(1) not null,
     Email char(1) not null,
     Password char(1) not null,
     constraint ID_USER_ID primary key (IdUser));

create table vote (
     IdVote char(1) not null,
     IdPost char(1) not null,
     IdUser char(1) not null,
     constraint ID_LIKE_ID primary key (IdVote));

create table userComment (
     IdComment char(1) not null,
     IdPost char(1) not null,
     IdUser char(1) not null,
     constraint ID_COMMENT_ID primary key(IdComment));

create table notification (
     IdNotification char(1) not null,
     IdUser char(1) not null,
     constraint ID_NOTIFICATION_ID primary key(IdNotification));

create table category (
     IdCategory char(1) not null,
     constraint ID_CATEGORY_ID primary key (IdCategory));

create table post (
     IdPost char(1) not null,
     Title char(1) not null,
     Description char(1) not null,
     IdUser char(1) not null,
     constraint ID_POST_ID primary key (IdPost));

create table post_category (
     IdCategory char(1) not null,
     IdPost char(1) not null,
     constraint ID_POSTCATEGORY_ID primary key (IdCategory, IdPost));


-- Constraints Section
-- ___________________ 

alter table vote add constraint REF_LIKE_POST_FK
     foreign key (IdPost)
     references post(IdPost);

alter table vote add constraint REF_LIKE_USER_FK
     foreign key (IdUser)
     references utente(IdUser);

alter table userComment add constraint REF_COMME_POST_FK
     foreign key (IdPost)
     references post(IdPost);

alter table userComment add constraint REF_COMME_USER_FK
     foreign key (IdUser)
     references utente(IdUser);

alter table notification add constraint REF_NOTIF_USER_FK
     foreign key (IdUser)
     references utente(IdUser);

alter table post add constraint REF_POST_USER_FK
     foreign key (IdUser)
     references utente(IdUser);

alter table post_category add constraint EQU_POSTCATEGORY_POST_FK
     foreign key (IdPost)
     references post(IdPost);

alter table post_category add constraint REF_POSTCATEGORY_CATEG
     foreign key (IdCategory)
     references category(IdCategory);