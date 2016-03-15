--
-- PostgreSQL database dump
--

-- Dumped from database version 9.1.13
-- Dumped by pg_dump version 9.1.13
-- Started on 2016-03-15 09:00:16 ART

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

--
-- TOC entry 2002 (class 0 OID 32402)
-- Dependencies: 161 2019
-- Data for Name: category; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY category (categoryid, description, matchtype) FROM stdin;
1	[Singles] 1era Categoría	1
3	[Singles] 3era Categoría	1
4	[Singles] 4ta Categoría	1
5	[Singles] 5ta Categoría	1
6	[Dobles] 1era Categoría	2
7	[Dobles] 2da Categoría	2
8	[Dobles] 3era Categoría	2
9	[Dobles] 4ta Categoría	2
10	[Dobles] 5ta Categoría	2
2	[Singles] 2da Categoría	1
\.


--
-- TOC entry 2023 (class 0 OID 0)
-- Dependencies: 162
-- Name: category_categoryid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('category_categoryid_seq', 11, true);


--
-- TOC entry 2004 (class 0 OID 32410)
-- Dependencies: 163 2019
-- Data for Name: club; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY club (clubid, description, latitude, longitude, address, contactvia1, contactvia2) FROM stdin;
2	Mendoza Tenis Club	\N	\N	\N	\N	\N
3	Club Aleman	\N	\N	\N	\N	\N
1	Andino Tenis Club	\N	\N	Dirección nueva	1234	456
\.


--
-- TOC entry 2024 (class 0 OID 0)
-- Dependencies: 164
-- Name: club_clubid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('club_clubid_seq', 6, true);


--
-- TOC entry 2017 (class 0 OID 32696)
-- Dependencies: 176 2019
-- Data for Name: match; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY match (matchid, matchtype, description, player1id, player2id, player3id, player4id, tournamentid, date, resultdetail, result) FROM stdin;
\.


--
-- TOC entry 2025 (class 0 OID 0)
-- Dependencies: 175
-- Name: match_matchid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('match_matchid_seq', 1, false);


--
-- TOC entry 2006 (class 0 OID 32434)
-- Dependencies: 165 2019
-- Data for Name: notification; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY notification (notificationid, expirationdate, message, creationuserid, creationdate) FROM stdin;
\.


--
-- TOC entry 2026 (class 0 OID 0)
-- Dependencies: 166
-- Name: notification_notificationid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('notification_notificationid_seq', 1, false);


--
-- TOC entry 2008 (class 0 OID 32450)
-- Dependencies: 167 2019
-- Data for Name: ranking; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ranking (userid, points, date, expirationdate) FROM stdin;
\.


--
-- TOC entry 2009 (class 0 OID 32453)
-- Dependencies: 168 2019
-- Data for Name: tournament; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tournament (tournamentid, description, clubid, startdate, inscriptionsdate, state, organizeruserid) FROM stdin;
1	Torneo Vendimia	1	2014-04-21 00:00:00	2014-04-11 00:00:00	1	3
\.


--
-- TOC entry 2027 (class 0 OID 0)
-- Dependencies: 169
-- Name: tournament_tournamentid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tournament_tournamentid_seq', 1, true);


--
-- TOC entry 2011 (class 0 OID 32461)
-- Dependencies: 170 2019
-- Data for Name: tournamentcategory; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tournamentcategory (tournamentid, categoryid) FROM stdin;
1	2
1	3
1	4
\.


--
-- TOC entry 2018 (class 0 OID 32705)
-- Dependencies: 177 2019
-- Data for Name: tournamentinscription; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tournamentinscription (tournamentid, categoryid, player1id, player2id) FROM stdin;
\.


--
-- TOC entry 2012 (class 0 OID 32467)
-- Dependencies: 171 2019
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "user" (userid, username, password, usertypeid, firstname, lastname, birthdate, address, contactvia1, contactvia2, contactvia3, email, clubid, data, documentnumber, active) FROM stdin;
3	lamengual	123qwe	1	Luis Manuel	Amengual	1982-04-10 00:00:00	Barrio Villa Azcuenaga Sur M N L 4 Dpto 6	155897606	4216921	12388	luismanuelamengual@gmail.com	3	\N	29385108	t
4	peter	123	1	tito	Manfredi	\N		123125415				\N	\N		t
\.


--
-- TOC entry 2028 (class 0 OID 0)
-- Dependencies: 172
-- Name: user_userid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('user_userid_seq', 6, true);


--
-- TOC entry 2014 (class 0 OID 32475)
-- Dependencies: 173 2019
-- Data for Name: usertype; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usertype (usertypeid, description) FROM stdin;
1	Administrador
2	Organizador
3	Jugador
\.


--
-- TOC entry 2029 (class 0 OID 0)
-- Dependencies: 174
-- Name: usertype_usertypeid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usertype_usertypeid_seq', 3, true);


-- Completed on 2016-03-15 09:00:17 ART

--
-- PostgreSQL database dump complete
--

