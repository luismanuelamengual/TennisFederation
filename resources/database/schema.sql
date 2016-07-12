--
-- PostgreSQL database dump
--

-- Dumped from database version 9.4.8
-- Dumped by pg_dump version 9.4.8
-- Started on 2016-07-12 10:45:25 ART

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 1 (class 3079 OID 11935)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2143 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 173 (class 1259 OID 16623)
-- Name: category; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE category (
    id integer NOT NULL,
    description text NOT NULL,
    matchtype integer NOT NULL
);


ALTER TABLE category OWNER TO postgres;

--
-- TOC entry 174 (class 1259 OID 16629)
-- Name: category_categoryid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE category_categoryid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE category_categoryid_seq OWNER TO postgres;

--
-- TOC entry 2144 (class 0 OID 0)
-- Dependencies: 174
-- Name: category_categoryid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE category_categoryid_seq OWNED BY category.id;


--
-- TOC entry 175 (class 1259 OID 16631)
-- Name: club; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE club (
    id integer NOT NULL,
    description text NOT NULL,
    latitude real,
    longitude real,
    address text,
    contactvia1 text,
    contactvia2 text
);


ALTER TABLE club OWNER TO postgres;

--
-- TOC entry 176 (class 1259 OID 16637)
-- Name: club_clubid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE club_clubid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE club_clubid_seq OWNER TO postgres;

--
-- TOC entry 2145 (class 0 OID 0)
-- Dependencies: 176
-- Name: club_clubid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE club_clubid_seq OWNED BY club.id;


--
-- TOC entry 177 (class 1259 OID 16639)
-- Name: match; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE match (
    id integer NOT NULL,
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


ALTER TABLE match OWNER TO postgres;

--
-- TOC entry 178 (class 1259 OID 16645)
-- Name: match_matchid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE match_matchid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE match_matchid_seq OWNER TO postgres;

--
-- TOC entry 2146 (class 0 OID 0)
-- Dependencies: 178
-- Name: match_matchid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE match_matchid_seq OWNED BY match.id;


--
-- TOC entry 179 (class 1259 OID 16647)
-- Name: notification; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE notification (
    id integer NOT NULL,
    expirationdate timestamp without time zone,
    message text,
    creationuserid integer,
    creationdate timestamp without time zone
);


ALTER TABLE notification OWNER TO postgres;

--
-- TOC entry 180 (class 1259 OID 16653)
-- Name: notification_notificationid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE notification_notificationid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE notification_notificationid_seq OWNER TO postgres;

--
-- TOC entry 2147 (class 0 OID 0)
-- Dependencies: 180
-- Name: notification_notificationid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE notification_notificationid_seq OWNED BY notification.id;


--
-- TOC entry 181 (class 1259 OID 16655)
-- Name: ranking; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ranking (
    userid integer NOT NULL,
    points integer NOT NULL,
    date timestamp without time zone,
    expirationdate timestamp without time zone
);


ALTER TABLE ranking OWNER TO postgres;

--
-- TOC entry 182 (class 1259 OID 16658)
-- Name: tournament; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tournament (
    id integer NOT NULL,
    description text NOT NULL,
    clubid integer NOT NULL,
    startdate timestamp without time zone NOT NULL,
    inscriptionsdate timestamp without time zone,
    state integer NOT NULL,
    organizeruserid integer
);


ALTER TABLE tournament OWNER TO postgres;

--
-- TOC entry 183 (class 1259 OID 16664)
-- Name: tournament_tournamentid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tournament_tournamentid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tournament_tournamentid_seq OWNER TO postgres;

--
-- TOC entry 2148 (class 0 OID 0)
-- Dependencies: 183
-- Name: tournament_tournamentid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tournament_tournamentid_seq OWNED BY tournament.id;


--
-- TOC entry 184 (class 1259 OID 16666)
-- Name: tournamentcategory; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tournamentcategory (
    tournamentid integer NOT NULL,
    categoryid integer NOT NULL
);


ALTER TABLE tournamentcategory OWNER TO postgres;

--
-- TOC entry 185 (class 1259 OID 16669)
-- Name: tournamentinscription; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tournamentinscription (
    tournamentid integer NOT NULL,
    categoryid integer NOT NULL,
    player1id integer NOT NULL,
    player2id integer
);


ALTER TABLE tournamentinscription OWNER TO postgres;

--
-- TOC entry 186 (class 1259 OID 16672)
-- Name: user; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "user" (
    id integer NOT NULL,
    username text NOT NULL,
    password text NOT NULL,
    permissions integer NOT NULL,
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


ALTER TABLE "user" OWNER TO postgres;

--
-- TOC entry 187 (class 1259 OID 16678)
-- Name: user_userid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE user_userid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE user_userid_seq OWNER TO postgres;

--
-- TOC entry 2149 (class 0 OID 0)
-- Dependencies: 187
-- Name: user_userid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE user_userid_seq OWNED BY "user".id;


--
-- TOC entry 2007 (class 2604 OID 16688)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY category ALTER COLUMN id SET DEFAULT nextval('category_categoryid_seq'::regclass);


--
-- TOC entry 2008 (class 2604 OID 16689)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY club ALTER COLUMN id SET DEFAULT nextval('club_clubid_seq'::regclass);


--
-- TOC entry 2009 (class 2604 OID 16690)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY match ALTER COLUMN id SET DEFAULT nextval('match_matchid_seq'::regclass);


--
-- TOC entry 2010 (class 2604 OID 16691)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY notification ALTER COLUMN id SET DEFAULT nextval('notification_notificationid_seq'::regclass);


--
-- TOC entry 2011 (class 2604 OID 16692)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tournament ALTER COLUMN id SET DEFAULT nextval('tournament_tournamentid_seq'::regclass);


--
-- TOC entry 2012 (class 2604 OID 16693)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "user" ALTER COLUMN id SET DEFAULT nextval('user_userid_seq'::regclass);


--
-- TOC entry 2014 (class 2606 OID 16696)
-- Name: category_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY category
    ADD CONSTRAINT category_pkey PRIMARY KEY (id);


--
-- TOC entry 2016 (class 2606 OID 16698)
-- Name: club_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY club
    ADD CONSTRAINT club_pkey PRIMARY KEY (id);


--
-- TOC entry 2018 (class 2606 OID 16700)
-- Name: match_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY match
    ADD CONSTRAINT match_pkey PRIMARY KEY (id);


--
-- TOC entry 2020 (class 2606 OID 16702)
-- Name: notification_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY notification
    ADD CONSTRAINT notification_pkey PRIMARY KEY (id);


--
-- TOC entry 2022 (class 2606 OID 16704)
-- Name: tournament_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tournament
    ADD CONSTRAINT tournament_pkey PRIMARY KEY (id);


--
-- TOC entry 2024 (class 2606 OID 16706)
-- Name: user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- TOC entry 2026 (class 2606 OID 16708)
-- Name: user_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_username_key UNIQUE (username);


--
-- TOC entry 2142 (class 0 OID 0)
-- Dependencies: 7
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2016-07-12 10:45:25 ART

--
-- PostgreSQL database dump complete
--

