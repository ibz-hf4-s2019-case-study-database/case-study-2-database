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

create table company
(
	uid serial not null
		constraint company_pkey
			primary key,
	name varchar,
	telephone varchar
);

alter table company owner to postgres;

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
	"companyId" integer
		constraint "reservationCompany"
			references company,
	constraint "reservationConstraint"
		unique ("cityId", "dateId", "siteId"),
	constraint "companyConstraint"
		unique ("cityId", "companyId", "dateId")
);

alter table reservation owner to postgres;

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

create table offer
(
	uid serial not null
		constraint offer_pkey
			primary key,
	title varchar,
	description varchar,
	price double precision not null,
	"beginDate" date,
	"endDate" date,
	"periodOfValidity" varchar,
	"numberOfCities" integer
);

alter table offer owner to postgres;

create table abo
(
	uid serial not null
		constraint abo_pkey
			primary key,
	"companyId" integer
		constraint company
			references company,
	"offerId" integer
		constraint offer
			references offer,
	"beginDate" date,
	"endDate" date
);

alter table abo owner to postgres;

create table "aboCity"
(
	uid serial not null,
	"aboId" integer
		constraint abo
			references abo,
	"cityId" integer
		constraint city
			references city
);

alter table "aboCity" owner to postgres;