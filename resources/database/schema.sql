--
-- PostgreSQL database dump
--

-- Dumped from database version 9.1.13
-- Dumped by pg_dump version 9.1.13
-- Started on 2016-03-15 08:58:40 ART

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 178 (class 3079 OID 11717)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2009 (class 0 OID 0)
-- Dependencies: 178
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 161 (class 1259 OID 32402)
-- Dependencies: 6
-- Name: category; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE category (
    categoryid integer NOT NULL,
    description text NOT NULL,
    matchtype integer NOT NULL
);


ALTER TABLE public.category OWNER TO postgres;

--
-- TOC entry 162 (class 1259 OID 32408)
-- Dependencies: 161 6
-- Name: category_categoryid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE category_categoryid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.category_categoryid_seq OWNER TO postgres;

--
-- TOC entry 2010 (class 0 OID 0)
-- Dependencies: 162
-- Name: category_categoryid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE category_categoryid_seq OWNED BY category.categoryid;


--
-- TOC entry 163 (class 1259 OID 32410)
-- Dependencies: 6
-- Name: club; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE club (
    clubid integer NOT NULL,
    description text NOT NULL,
    latitude real,
    longitude real,
    address text,
    contactvia1 text,
    contactvia2 text
);


ALTER TABLE public.club OWNER TO postgres;

--
-- TOC entry 164 (class 1259 OID 32416)
-- Dependencies: 163 6
-- Name: club_clubid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE club_clubid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.club_clubid_seq OWNER TO postgres;

--
-- TOC entry 2011 (class 0 OID 0)
-- Dependencies: 164
-- Name: club_clubid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE club_clubid_seq OWNED BY club.clubid;


--
-- TOC entry 176 (class 1259 OID 32696)
-- Dependencies: 6
-- Name: match; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE match (
    matchid integer NOT NULL,
    matchtype integer NOT NULL,
    description text,
    player1id integer,
    player2id integer,
    player3id integer,
    player4id integer,
    tournamentid integer NOT NULL,
    date timestamp without time zone,
    resultdetail text,
    result integer
);


ALTER TABLE public.match OWNER TO postgres;

--
-- TOC entry 175 (class 1259 OID 32694)
-- Dependencies: 176 6
-- Name: match_matchid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE match_matchid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.match_matchid_seq OWNER TO postgres;

--
-- TOC entry 2012 (class 0 OID 0)
-- Dependencies: 175
-- Name: match_matchid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE match_matchid_seq OWNED BY match.matchid;


--
-- TOC entry 165 (class 1259 OID 32434)
-- Dependencies: 6
-- Name: notification; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE notification (
    notificationid integer NOT NULL,
    expirationdate timestamp without time zone,
    message text,
    creationuserid integer,
    creationdate timestamp without time zone
);


ALTER TABLE public.notification OWNER TO postgres;

--
-- TOC entry 166 (class 1259 OID 32440)
-- Dependencies: 165 6
-- Name: notification_notificationid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE notification_notificationid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.notification_notificationid_seq OWNER TO postgres;

--
-- TOC entry 2013 (class 0 OID 0)
-- Dependencies: 166
-- Name: notification_notificationid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE notification_notificationid_seq OWNED BY notification.notificationid;


--
-- TOC entry 167 (class 1259 OID 32450)
-- Dependencies: 6
-- Name: ranking; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ranking (
    userid integer NOT NULL,
    points integer NOT NULL,
    date timestamp without time zone,
    expirationdate timestamp without time zone
);


ALTER TABLE public.ranking OWNER TO postgres;

--
-- TOC entry 168 (class 1259 OID 32453)
-- Dependencies: 6
-- Name: tournament; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tournament (
    tournamentid integer NOT NULL,
    description text NOT NULL,
    clubid integer NOT NULL,
    startdate timestamp without time zone NOT NULL,
    inscriptionsdate timestamp without time zone,
    state integer NOT NULL,
    organizeruserid integer
);


ALTER TABLE public.tournament OWNER TO postgres;

--
-- TOC entry 169 (class 1259 OID 32459)
-- Dependencies: 168 6
-- Name: tournament_tournamentid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tournament_tournamentid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tournament_tournamentid_seq OWNER TO postgres;

--
-- TOC entry 2014 (class 0 OID 0)
-- Dependencies: 169
-- Name: tournament_tournamentid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tournament_tournamentid_seq OWNED BY tournament.tournamentid;


--
-- TOC entry 170 (class 1259 OID 32461)
-- Dependencies: 6
-- Name: tournamentcategory; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tournamentcategory (
    tournamentid integer NOT NULL,
    categoryid integer NOT NULL
);


ALTER TABLE public.tournamentcategory OWNER TO postgres;

--
-- TOC entry 177 (class 1259 OID 32705)
-- Dependencies: 6
-- Name: tournamentinscription; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tournamentinscription (
    tournamentid integer NOT NULL,
    categoryid integer NOT NULL,
    player1id integer NOT NULL,
    player2id integer
);


ALTER TABLE public.tournamentinscription OWNER TO postgres;

--
-- TOC entry 171 (class 1259 OID 32467)
-- Dependencies: 6
-- Name: user; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "user" (
    userid integer NOT NULL,
    username text NOT NULL,
    password text NOT NULL,
    usertypeid integer NOT NULL,
    firstname text NOT NULL,
    lastname text NOT NULL,
    birthdate timestamp without time zone,
    address text,
    contactvia1 text,
    contactvia2 text,
    contactvia3 text,
    email text,
    clubid integer,
    data text,
    documentnumber text,
    active boolean NOT NULL
);


ALTER TABLE public."user" OWNER TO postgres;

--
-- TOC entry 172 (class 1259 OID 32473)
-- Dependencies: 171 6
-- Name: user_userid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE user_userid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_userid_seq OWNER TO postgres;

--
-- TOC entry 2015 (class 0 OID 0)
-- Dependencies: 172
-- Name: user_userid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE user_userid_seq OWNED BY "user".userid;


--
-- TOC entry 173 (class 1259 OID 32475)
-- Dependencies: 6
-- Name: usertype; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usertype (
    usertypeid integer NOT NULL,
    description text
);


ALTER TABLE public.usertype OWNER TO postgres;

--
-- TOC entry 174 (class 1259 OID 32481)
-- Dependencies: 173 6
-- Name: usertype_usertypeid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE usertype_usertypeid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usertype_usertypeid_seq OWNER TO postgres;

--
-- TOC entry 2016 (class 0 OID 0)
-- Dependencies: 174
-- Name: usertype_usertypeid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE usertype_usertypeid_seq OWNED BY usertype.usertypeid;


--
-- TOC entry 1878 (class 2604 OID 32483)
-- Dependencies: 162 161
-- Name: categoryid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY category ALTER COLUMN categoryid SET DEFAULT nextval('category_categoryid_seq'::regclass);


--
-- TOC entry 1879 (class 2604 OID 32484)
-- Dependencies: 164 163
-- Name: clubid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY club ALTER COLUMN clubid SET DEFAULT nextval('club_clubid_seq'::regclass);


--
-- TOC entry 1884 (class 2604 OID 32699)
-- Dependencies: 176 175 176
-- Name: matchid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY match ALTER COLUMN matchid SET DEFAULT nextval('match_matchid_seq'::regclass);


--
-- TOC entry 1880 (class 2604 OID 32487)
-- Dependencies: 166 165
-- Name: notificationid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY notification ALTER COLUMN notificationid SET DEFAULT nextval('notification_notificationid_seq'::regclass);


--
-- TOC entry 1881 (class 2604 OID 32489)
-- Dependencies: 169 168
-- Name: tournamentid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tournament ALTER COLUMN tournamentid SET DEFAULT nextval('tournament_tournamentid_seq'::regclass);


--
-- TOC entry 1882 (class 2604 OID 32490)
-- Dependencies: 172 171
-- Name: userid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "user" ALTER COLUMN userid SET DEFAULT nextval('user_userid_seq'::regclass);


--
-- TOC entry 1883 (class 2604 OID 32491)
-- Dependencies: 174 173
-- Name: usertypeid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usertype ALTER COLUMN usertypeid SET DEFAULT nextval('usertype_usertypeid_seq'::regclass);


--
-- TOC entry 1886 (class 2606 OID 32493)
-- Dependencies: 161 161 2003
-- Name: category_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY category
    ADD CONSTRAINT category_pkey PRIMARY KEY (categoryid);


--
-- TOC entry 1888 (class 2606 OID 32495)
-- Dependencies: 163 163 2003
-- Name: club_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY club
    ADD CONSTRAINT club_pkey PRIMARY KEY (clubid);


--
-- TOC entry 1900 (class 2606 OID 32704)
-- Dependencies: 176 176 2003
-- Name: match_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY match
    ADD CONSTRAINT match_pkey PRIMARY KEY (matchid);


--
-- TOC entry 1890 (class 2606 OID 32501)
-- Dependencies: 165 165 2003
-- Name: notification_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY notification
    ADD CONSTRAINT notification_pkey PRIMARY KEY (notificationid);


--
-- TOC entry 1892 (class 2606 OID 32505)
-- Dependencies: 168 168 2003
-- Name: tournament_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tournament
    ADD CONSTRAINT tournament_pkey PRIMARY KEY (tournamentid);


--
-- TOC entry 1894 (class 2606 OID 32509)
-- Dependencies: 171 171 2003
-- Name: user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (userid);


--
-- TOC entry 1896 (class 2606 OID 32511)
-- Dependencies: 171 171 2003
-- Name: user_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_username_key UNIQUE (username);


--
-- TOC entry 1898 (class 2606 OID 32513)
-- Dependencies: 173 173 2003
-- Name: usertype_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usertype
    ADD CONSTRAINT usertype_pkey PRIMARY KEY (usertypeid);


--
-- TOC entry 2008 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2016-03-15 08:58:40 ART

--
-- PostgreSQL database dump complete
--

