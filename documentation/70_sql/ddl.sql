create table city
(
	uid serial not null
		constraint city_pkey
			primary key,
	name varchar(100),
	zip varchar(4),
	address varchar(100)
);

alter table city owner to postgres;

create table date
(
	uid serial not null
		constraint date_pkey
			primary key,
	"cityId" integer not null
		constraint "cityDate"
			references city,
	date date not null
);

alter table date owner to postgres;

create table site
(
	uid serial not null
		constraint site_pkey
			primary key,
	"cityId" integer not null
		constraint "dateCity"
			references city,
	length double precision,
	width double precision
);

alter table site owner to postgres;

create table reservation
(
	uid serial not null
		constraint reservation_pkey
			primary key,
	"cityId" integer not null
		constraint "reservationCity"
			references city,
	"dateId" integer not null
		constraint "reservationDate"
			references date,
	"siteId" integer not null
		constraint "reservationSite"
			references site,
	"peopleId" integer
);

alter table reservation owner to postgres;

create table company
(
	uid serial not null
		constraint company_pkey
			primary key,
	name varchar,
	telephone varchar
);

alter table company owner to postgres;

create table people
(
	uid serial not null
		constraint people_pkey
			primary key,
	username varchar,
	password varchar,
	firstname varchar,
	lastname varchar,
	street varchar,
	zip varchar,
	place varchar,
	telephone varchar,
	function varchar,
	"isOffical" boolean[],
	"companyId" integer
		constraint company
			references company
);

alter table people owner to postgres;

