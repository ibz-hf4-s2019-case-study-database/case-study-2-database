PGDMP                         w           market    11.5 (Debian 11.5-1.pgdg90+1)    11.5 "    \           0    0    ENCODING    ENCODING     $   SET client_encoding = 'ISO_8859_5';
                       false            ]           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            ^           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            _           1262    16384    market    DATABASE     v   CREATE DATABASE market WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'en_US.utf8' LC_CTYPE = 'en_US.utf8';
    DROP DATABASE market;
             postgres    false            �            1259    16387    city    TABLE     �   CREATE TABLE public.city (
    uid integer NOT NULL,
    name character varying(100),
    zip character varying(4),
    address character varying(100)
);
    DROP TABLE public.city;
       public         postgres    false            �            1259    16385    city_uid_seq    SEQUENCE     �   CREATE SEQUENCE public.city_uid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.city_uid_seq;
       public       postgres    false    197            `           0    0    city_uid_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.city_uid_seq OWNED BY public.city.uid;
            public       postgres    false    196            �            1259    24578    company    TABLE     w   CREATE TABLE public.company (
    uid integer NOT NULL,
    name character varying,
    telephone character varying
);
    DROP TABLE public.company;
       public         postgres    false            �            1259    24576    company_uid_seq    SEQUENCE     �   CREATE SEQUENCE public.company_uid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.company_uid_seq;
       public       postgres    false    205            a           0    0    company_uid_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.company_uid_seq OWNED BY public.company.uid;
            public       postgres    false    204            �            1259    16395    date    TABLE     n   CREATE TABLE public.date (
    uid integer NOT NULL,
    "cityId" integer NOT NULL,
    date date NOT NULL
);
    DROP TABLE public.date;
       public         postgres    false            �            1259    16393    date_uid_seq    SEQUENCE     �   CREATE SEQUENCE public.date_uid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.date_uid_seq;
       public       postgres    false    199            b           0    0    date_uid_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.date_uid_seq OWNED BY public.date.uid;
            public       postgres    false    198            �            1259    16421    reservation    TABLE     �   CREATE TABLE public.reservation (
    uid integer NOT NULL,
    "cityId" integer NOT NULL,
    "dateId" integer NOT NULL,
    "siteId" integer NOT NULL,
    "peopleId" integer
);
    DROP TABLE public.reservation;
       public         postgres    false            �            1259    16419    reservation_uid_seq    SEQUENCE     �   CREATE SEQUENCE public.reservation_uid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.reservation_uid_seq;
       public       postgres    false    203            c           0    0    reservation_uid_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.reservation_uid_seq OWNED BY public.reservation.uid;
            public       postgres    false    202            �            1259    16408    site    TABLE     �   CREATE TABLE public.site (
    uid integer NOT NULL,
    "cityId" integer NOT NULL,
    length double precision,
    width double precision
);
    DROP TABLE public.site;
       public         postgres    false            �            1259    16406    site_uid_seq    SEQUENCE     �   CREATE SEQUENCE public.site_uid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.site_uid_seq;
       public       postgres    false    201            d           0    0    site_uid_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.site_uid_seq OWNED BY public.site.uid;
            public       postgres    false    200            �
           2604    16390    city uid    DEFAULT     d   ALTER TABLE ONLY public.city ALTER COLUMN uid SET DEFAULT nextval('public.city_uid_seq'::regclass);
 7   ALTER TABLE public.city ALTER COLUMN uid DROP DEFAULT;
       public       postgres    false    196    197    197            �
           2604    24581    company uid    DEFAULT     j   ALTER TABLE ONLY public.company ALTER COLUMN uid SET DEFAULT nextval('public.company_uid_seq'::regclass);
 :   ALTER TABLE public.company ALTER COLUMN uid DROP DEFAULT;
       public       postgres    false    204    205    205            �
           2604    16398    date uid    DEFAULT     d   ALTER TABLE ONLY public.date ALTER COLUMN uid SET DEFAULT nextval('public.date_uid_seq'::regclass);
 7   ALTER TABLE public.date ALTER COLUMN uid DROP DEFAULT;
       public       postgres    false    199    198    199            �
           2604    16424    reservation uid    DEFAULT     r   ALTER TABLE ONLY public.reservation ALTER COLUMN uid SET DEFAULT nextval('public.reservation_uid_seq'::regclass);
 >   ALTER TABLE public.reservation ALTER COLUMN uid DROP DEFAULT;
       public       postgres    false    202    203    203            �
           2604    16411    site uid    DEFAULT     d   ALTER TABLE ONLY public.site ALTER COLUMN uid SET DEFAULT nextval('public.site_uid_seq'::regclass);
 7   ALTER TABLE public.site ALTER COLUMN uid DROP DEFAULT;
       public       postgres    false    201    200    201            �
           2606    16392    city city_pkey 
   CONSTRAINT     M   ALTER TABLE ONLY public.city
    ADD CONSTRAINT city_pkey PRIMARY KEY (uid);
 8   ALTER TABLE ONLY public.city DROP CONSTRAINT city_pkey;
       public         postgres    false    197            �
           2606    24586    company company_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.company
    ADD CONSTRAINT company_pkey PRIMARY KEY (uid);
 >   ALTER TABLE ONLY public.company DROP CONSTRAINT company_pkey;
       public         postgres    false    205            �
           2606    16400    date date_pkey 
   CONSTRAINT     M   ALTER TABLE ONLY public.date
    ADD CONSTRAINT date_pkey PRIMARY KEY (uid);
 8   ALTER TABLE ONLY public.date DROP CONSTRAINT date_pkey;
       public         postgres    false    199            �
           2606    16426    reservation reservation_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT reservation_pkey PRIMARY KEY (uid);
 F   ALTER TABLE ONLY public.reservation DROP CONSTRAINT reservation_pkey;
       public         postgres    false    203            �
           2606    16413    site site_pkey 
   CONSTRAINT     M   ALTER TABLE ONLY public.site
    ADD CONSTRAINT site_pkey PRIMARY KEY (uid);
 8   ALTER TABLE ONLY public.site DROP CONSTRAINT site_pkey;
       public         postgres    false    201            �
           2606    16401    date cityDate    FK CONSTRAINT     o   ALTER TABLE ONLY public.date
    ADD CONSTRAINT "cityDate" FOREIGN KEY ("cityId") REFERENCES public.city(uid);
 9   ALTER TABLE ONLY public.date DROP CONSTRAINT "cityDate";
       public       postgres    false    199    197    2771            �
           2606    16414    site dateCity    FK CONSTRAINT     o   ALTER TABLE ONLY public.site
    ADD CONSTRAINT "dateCity" FOREIGN KEY ("cityId") REFERENCES public.city(uid);
 9   ALTER TABLE ONLY public.site DROP CONSTRAINT "dateCity";
       public       postgres    false    201    197    2771            �
           2606    16427    reservation reservationCity    FK CONSTRAINT     }   ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT "reservationCity" FOREIGN KEY ("cityId") REFERENCES public.city(uid);
 G   ALTER TABLE ONLY public.reservation DROP CONSTRAINT "reservationCity";
       public       postgres    false    197    203    2771            �
           2606    16432    reservation reservationDate    FK CONSTRAINT     }   ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT "reservationDate" FOREIGN KEY ("dateId") REFERENCES public.date(uid);
 G   ALTER TABLE ONLY public.reservation DROP CONSTRAINT "reservationDate";
       public       postgres    false    203    199    2773            �
           2606    16437    reservation reservationSite    FK CONSTRAINT     }   ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT "reservationSite" FOREIGN KEY ("siteId") REFERENCES public.site(uid);
 G   ALTER TABLE ONLY public.reservation DROP CONSTRAINT "reservationSite";
       public       postgres    false    203    201    2775           