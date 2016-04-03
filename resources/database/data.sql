--
-- PostgreSQL database dump
--

-- Dumped from database version 9.4.5
-- Dumped by pg_dump version 9.4.5
-- Started on 2016-04-03 15:31:47 ART

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

--
-- TOC entry 2136 (class 0 OID 16623)
-- Dependencies: 172
-- Data for Name: category; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY category (id, description, matchtype) FROM stdin;
1	Junior B	1
\.


--
-- TOC entry 2155 (class 0 OID 0)
-- Dependencies: 173
-- Name: category_categoryid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('category_categoryid_seq', 1, true);


--
-- TOC entry 2138 (class 0 OID 16631)
-- Dependencies: 174
-- Data for Name: club; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY club (id, description, latitude, longitude, address, contactvia1, contactvia2) FROM stdin;
\.


--
-- TOC entry 2156 (class 0 OID 0)
-- Dependencies: 175
-- Name: club_clubid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('club_clubid_seq', 1, false);


--
-- TOC entry 2140 (class 0 OID 16639)
-- Dependencies: 176
-- Data for Name: match; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY match (id, matchtype, description, player1id, player2id, player3id, player4id, tournamentid, date, resultdetail, result) FROM stdin;
\.


--
-- TOC entry 2157 (class 0 OID 0)
-- Dependencies: 177
-- Name: match_matchid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('match_matchid_seq', 1, false);


--
-- TOC entry 2142 (class 0 OID 16647)
-- Dependencies: 178
-- Data for Name: notification; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY notification (id, expirationdate, message, creationuserid, creationdate) FROM stdin;
\.


--
-- TOC entry 2158 (class 0 OID 0)
-- Dependencies: 179
-- Name: notification_notificationid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('notification_notificationid_seq', 1, false);


--
-- TOC entry 2144 (class 0 OID 16655)
-- Dependencies: 180
-- Data for Name: ranking; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ranking (userid, points, date, expirationdate) FROM stdin;
\.


--
-- TOC entry 2145 (class 0 OID 16658)
-- Dependencies: 181
-- Data for Name: tournament; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tournament (id, description, clubid, startdate, inscriptionsdate, state, organizeruserid) FROM stdin;
\.


--
-- TOC entry 2159 (class 0 OID 0)
-- Dependencies: 182
-- Name: tournament_tournamentid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tournament_tournamentid_seq', 1, false);


--
-- TOC entry 2147 (class 0 OID 16666)
-- Dependencies: 183
-- Data for Name: tournamentcategory; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tournamentcategory (tournamentid, categoryid) FROM stdin;
\.


--
-- TOC entry 2148 (class 0 OID 16669)
-- Dependencies: 184
-- Data for Name: tournamentinscription; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tournamentinscription (tournamentid, categoryid, player1id, player2id) FROM stdin;
\.


--
-- TOC entry 2149 (class 0 OID 16672)
-- Dependencies: 185
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "user" (id, username, password, type, firstname, lastname, birthdate, address, contactvia1, contactvia2, contactvia3, email, clubid, data, documentnumber, active) FROM stdin;
1	lamengual	123qwe	1	Luis Manuel	Amengual	1982-04-10 00:00:00						0			t
\.


--
-- TOC entry 2160 (class 0 OID 0)
-- Dependencies: 186
-- Name: user_userid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('user_userid_seq', 1, false);


-- Completed on 2016-04-03 15:31:47 ART

--
-- PostgreSQL database dump complete
--

