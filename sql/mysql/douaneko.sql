
create table t_reporters(
    _id bigint auto_increment not null,
    _uuid varchar(40) not null,
    _last_name varchar(160) not null,
    _first_name varchar(160) not null,
    _telephone bigint not null,
    _city varchar(160) not null,
    _email varchar(255) not null,
    _pseudo varchar(32) not  null,
    _password varchar(70) not null,
    _status enum ('valide', 'invalide') default "valide",
    _inserted_at datetime default now(),
    _updated_at datetime default now(),
    primary key(_id),
    constraint u_reporters_uuid unique(_uuid),
    constraint u_reporters_email unique(_email),
    constraint u_reporters_pseudo unique(_pseudo)
    
) engine = innodb default charset utf8 ;

create table t_tiddAdministrators(
    _id bigint auto_increment not null,
    _uuid varchar(40) not null,
    _last_name varchar(160) not null,
    _first_name varchar(160) not null,
    _email varchar(255) not null,
    _identifier varchar(32) not  null,
    _telephone bigint not null,
    _password varchar(70) not null,
    _access_level enum("reader","editor") default "reader",
    _status enum ('valide', 'invalide') default "valide",
    _created_at datetime default now(),
    _updated_at datetime default now(),
    primary key(_id),
    constraint u_administrators_uuid unique(_uuid),
    constraint u_administrators_telephone unique(_telephone),
    constraint u_administrators_email unique(_email),
    constraint u_administrators_identifier unique(_identifier)
    
) engine = innodb default charset utf8 ;


create table t_cityHalls(
    _id bigint auto_increment not null,
    _uuid varchar(40) not null,
    _name varchar(160) not null,
    _city varchar(160) not null,
    _postal_code varchar(60),
    _telephone int(20),
    _prefecture varchar(160),
    _status enum ('valide', 'invalide') default "valide",
    _author bigint not null,
    _inserted_at datetime default now(),
    _updated_at datetime default now(),
    primary key(_id),
    constraint fk_city_hall_tidd_administrators foreign key(_author) references t_tiddAdministrators(_id)
    

)engine = innodb default charset utf8 ;

create table t_cityHallAdministrators(
    _id bigint auto_increment not null,
    _uuid varchar(40) not null,
    _access_level enum("reader","editor") default "reader",
    _last_name varchar(160) not null,
    _first_name varchar(160) not null,
    _identifier varchar(32) not  null,
    _password varchar(70) not null,
    _city_hall bigint not null, 
    _status enum ('valide', 'invalide') default "valide",
    _inserted_at datetime default now(),
    _updated_at datetime default now(),
    primary key(_id),
    constraint fk_city_hall_city_hall_administrators foreign key(_city_hall) references t_cityHalls(_id)

)engine = innodb default charset utf8 ;

create table t_trashs(
    _id bigint auto_increment not null,
    _uuid varchar(40) not null,
    _name varchar(160) not null,
    _longitude text not null,
    _latitude text not null,
    _address varchar(160) not null,
    _status enum ('valide', 'invalide') default "valide",
    _inserted_at datetime default now(),
    _updated_at datetime default now(),
    primary key(_id),
    constraint u_trashs_uuid unique(_uuid) 
    
) engine = innodb default charset utf8 ;

create table t_trashStatus(
    _id bigint auto_increment not null,
    _full_level int(3) not null,
    _trash bigint not null,
    _sent_at datetime default now(),
    primary key(_id),
    constraint fk_trashs foreign key(_trash) references t_trashs(_id)
    
) engine = innodb default charset utf8 ;

-- insert into  t_trashStatus(_full_level, _trash) values (50,2);


create table t_reporting(
    _id bigint auto_increment not null,
    _uuid varchar(40) not null,
    _type enum('savage', 'gutters'),
    _level enum('1','2','3','4','5') not null,
    _longitude float not null,
    _latitude float not null,
    _comment text not null,
    _reporter bigint not null,
    _status enum('valide', 'invalide') default 'valide',
    _sent_at datetime default now(),
    _updated_at datetime default now(),
    primary key(_id),
    constraint fk_reporting_reporters foreign key(_reporter) references t_reporters(_id)
)engine = innodb default charset utf8 ;




create table t_programs(
    _id bigint auto_increment not null,
    _uuid varchar(40) not null,
    _name varchar(255) not null,
    _place text,
    _execution_date date not null,
    _status enum('programed', 'executed') default 'programed' not null,
    _executed_by varchar(160) ,
    _inserted_at datetime default now(),
    _updated_at datetime default now(),
    primary key(_id)
    
)engine = innodb default charset utf8 ;





create table t_media(
    _id bigint auto_increment not null,
    _uuid varchar(255) not null,
    _type varchar(10) not null,
    _extension varchar(10) not null,
    _size bigint not null,
    _name varchar(160) not null,
    _inserted_at datetime default now(),
    primary key(_id),
    constraint u_media_uuid unique(_uuid)

)engine = innodb default charset utf8;




create table t_reportingMedia(
    _id bigint auto_increment not null,
    _reporting bigint not null,
    _media bigint not null,
    _inserted_at datetime default now(),
    primary key(_id),
    constraint fk_reporting_media_media foreign key(_media) references t_media(_id),
    constraint fk_reporting_media_reporting foreign key(_media) references t_reporting(_id) 

)engine = innodb default charset utf8 ;

/*
create table t_programsTidd(
    _id bigint auto_increment not null,
    _tidd bigint not null,
    _program bigint not null , 
    _inserted_at datetime default now(),
    primary key(_id),
    constraint fk_programs_tidd_administrators foreign key(_tidd) references t_tiddAdministrators(_id),
    constraint fk_programs_tidd_programs foreign key(_program) references t_programs(_id) 
)engine = innodb default charset utf8 ;
*/


create table t_programsCityHalls(
    _id bigint auto_increment not null,
    _city_hall bigint not null,
    _program bigint not null , 
    _inserted_at datetime default now(),
    primary key(_id),
    constraint fk_programs_city_halls_programs foreign key(_program) references t_programs(_id),
    constraint fk_programs_city_halls_city_hall foreign key(_city_hall) references t_cityHallAdministrators(_id) 
)engine = innodb default charset utf8 ;

create table t_trashsCityHalls(
    _id bigint auto_increment not null,
    _city_hall bigint not null,
    _trash bigint not null , 
    _inserted_at datetime default now(),
    primary key(_id),
    constraint fk_trashs_city_halls_trash foreign key(_trash) references t_trashs(_id),
    constraint fk_trashs_city_halls_city_hall foreign key(_city_hall) references t_cityHallAdministrators(_id) 
)engine = innodb default charset utf8 ;





