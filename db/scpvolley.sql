--
-- PostgreSQL database dump
--

-- Dumped from database version 9.2.23
-- Dumped by pg_dump version 9.5.10

SET statement_timeout = 0;
-- SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
-- SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

-- COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: sq_id_adherent; Type: SEQUENCE; Schema: public; Owner: scp4
--

DROP SEQUENCE IF EXISTS sq_id_adherent CASCADE;
CREATE SEQUENCE sq_id_adherent
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sq_id_adherent OWNER TO scp4;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: adherents; Type: TABLE; Schema: public; Owner: scp4
--

DROP TABLE IF EXISTS adherents CASCADE;
CREATE TABLE adherents (
    id_adherent integer DEFAULT nextval('sq_id_adherent'::regclass) NOT NULL,
    id_poste integer,
    type_adherent char(1) NOT NULL,
    login character varying(20) NOT NULL,
    mdp character varying(1024) NOT NULL,
    nom character varying(50),
    prenom character varying(50),
    no_licence character varying(20),
    date_naissance date NOT NULL,
    genre character(1) NOT NULL,
    surclassement integer DEFAULT 0 NOT NULL,
    habilitation integer NOT NULL,
    arbitre boolean NOT NULL,
    entraineur boolean NOT NULL,
    CONSTRAINT ck_genre CHECK ((genre = ANY (ARRAY['M'::bpchar, 'F'::bpchar]))),
    CONSTRAINT ck_habilitation CHECK (((habilitation >= 1) AND (habilitation <= 3))),
    CONSTRAINT ck_surclassement CHECK (((surclassement >= 0) AND (surclassement <= 3))),
    CONSTRAINT ck_type_adherent CHECK (type_adherent IN('P', 'A'))

);


ALTER TABLE adherents OWNER TO scp4;

--
-- Name: arbitre; Type: TABLE; Schema: public; Owner: scp4
--

DROP TABLE IF EXISTS arbitre CASCADE;
CREATE TABLE arbitre (
    id_adherent integer NOT NULL,
    id_match integer NOT NULL
);


ALTER TABLE arbitre OWNER TO scp4;

--
-- Name: sq_id_archive; Type: SEQUENCE; Schema: public; Owner: scp4
--

DROP SEQUENCE IF EXISTS sq_id_archive CASCADE;
CREATE SEQUENCE sq_id_archive
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sq_id_archive OWNER TO scp4;

--
-- Name: archives; Type: TABLE; Schema: public; Owner: scp4
--

DROP TABLE IF EXISTS archives CASCADE;
CREATE TABLE archives (
    id_archive integer DEFAULT nextval('sq_id_archive'::regclass) NOT NULL,
    titre character varying(50),
    type character varying(1),
    lien_photo character varying(50),
    contenu text,
    lien_document character varying(50),
    id_createur integer NOT NULL,
    date_creation date NOT NULL,
    id_validateur integer,
    date_validation date,
    CONSTRAINT ck_type CHECK (((type)::text = ANY (ARRAY[('A'::character varying)::text, ('F'::character varying)::text])))
);


ALTER TABLE archives OWNER TO scp4;

--
-- Name: sq_id_article; Type: SEQUENCE; Schema: public; Owner: scp4
--

DROP SEQUENCE IF EXISTS sq_id_article CASCADE;
CREATE SEQUENCE sq_id_article
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sq_id_article OWNER TO scp4;

--
-- Name: catalogue; Type: TABLE; Schema: public; Owner: scp4
--

DROP TABLE IF EXISTS catalogue CASCADE;
CREATE TABLE catalogue (
    id_article integer DEFAULT nextval('sq_id_article'::regclass) NOT NULL,
    designation character varying(50),
    des_comp character varying(50),
    taille character varying(6),
    coloris character varying(20),
    prix integer,
    lien_photo character varying(50)
);


ALTER TABLE catalogue OWNER TO scp4;

--
-- Name: sq_id_categorie; Type: SEQUENCE; Schema: public; Owner: scp4
--

DROP SEQUENCE IF EXISTS sq_id_categorie CASCADE;
CREATE SEQUENCE sq_id_categorie
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sq_id_categorie OWNER TO scp4;

--
-- Name: categories; Type: TABLE; Schema: public; Owner: scp4
--

DROP TABLE IF EXISTS categories CASCADE;
CREATE TABLE categories (
    id_categorie integer DEFAULT nextval('sq_id_categorie'::regclass) NOT NULL,
    categorie character varying(20) NOT NULL,
    description character varying(50),
    age_debut integer,
    age_fin integer,
    duree_entrainement timestamp,
    duree_match timestamp,
    tarif real
);


ALTER TABLE categories OWNER TO scp4;

--
-- Name: sq_id_contact; Type: SEQUENCE; Schema: public; Owner: scp4
--

DROP SEQUENCE IF EXISTS sq_id_contact CASCADE;
CREATE SEQUENCE sq_id_contact
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sq_id_contact OWNER TO scp4;

--
-- Name: contacts; Type: TABLE; Schema: public; Owner: scp4
--

DROP TABLE IF EXISTS contacts CASCADE;
CREATE TABLE contacts (
    id_contact integer DEFAULT nextval('sq_id_contact'::regclass) NOT NULL,
    id_adherent integer,
    nom character varying(50),
    prenom character varying(50),
    adresse character varying(200),
    code_postal character varying(50),
    ville character varying(50),
    complement character varying(200),
    remarque character varying(200),
    ordre integer
);


ALTER TABLE contacts OWNER TO scp4;

--
-- Name: courriels; Type: TABLE; Schema: public; Owner: scp4
--

DROP TABLE IF EXISTS courriels CASCADE;
CREATE TABLE courriels (
    id_contact integer NOT NULL,
    courriel character varying(256) NOT NULL,
    ordre integer,
    CONSTRAINT ck_courriel CHECK (((courriel)::text ~ '^(([a-zA-Z0-9_+-]+\.)+[a-zA-Z0-9_+-]+|[a-zA-Z0-9]+)?[a-zA-Z0-9_+-]@([a-zA-Z0-9_+-]+\.)+[a-zA-Z0-9_+-]{2,6}$'::text))
);


ALTER TABLE courriels OWNER TO scp4;

--
-- Name: sq_id_creneau; Type: SEQUENCE; Schema: public; Owner: scp4
--

DROP SEQUENCE IF EXISTS sq_id_creneau CASCADE;
CREATE SEQUENCE sq_id_creneau
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sq_id_creneau OWNER TO scp4;

--
-- Name: creneaux; Type: TABLE; Schema: public; Owner: scp4
--

DROP TABLE IF EXISTS creneaux CASCADE;
CREATE TABLE creneaux (
    id_creneau integer DEFAULT nextval('sq_id_creneau'::regclass) NOT NULL,
    id_salle integer NOT NULL,
    debut timestamp without time zone NOT NULL,
    fin timestamp without time zone NOT NULL
);


ALTER TABLE creneaux OWNER TO scp4;

--
-- Name: sq_id_indisponibilites; Type: SEQUENCE; Schema: public; Owner: scp4
--

DROP SEQUENCE IF EXISTS sq_id_indisponibilites CASCADE;
CREATE SEQUENCE sq_id_indisponibilites
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sq_id_indisponibilites OWNER TO scp4;

--
-- Name: indisponibilite; Type: TABLE; Schema: public; Owner: scp4
--

DROP TABLE IF EXISTS indisponibilites CASCADE;
CREATE TABLE indisponibilites (
    id_indisponibilite integer DEFAULT nextval('sq_id_indisponibilites'::regclass) NOT NULL,
    id_salle integer NOT NULL,
    debut timestamp without time zone NOT NULL,
    fin timestamp without time zone NOT NULL
);


ALTER TABLE indisponibilites OWNER TO scp4;

--
-- Name: sq_id_document; Type: SEQUENCE; Schema: public; Owner: scp4
--

DROP SEQUENCE IF EXISTS sq_id_document CASCADE;
CREATE SEQUENCE sq_id_document
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sq_id_document OWNER TO scp4;

--
-- Name: documents; Type: TABLE; Schema: public; Owner: scp4
--

DROP TABLE IF EXISTS documents CASCADE;
CREATE TABLE documents (
    id_document integer DEFAULT nextval('sq_id_document'::regclass) NOT NULL,
    titre character varying(50),
    type character varying(1),
    lien_photo character varying(50),
    contenu text,
    lien_document character varying(50),
    id_createur integer NOT NULL,
    date_creation date NOT NULL,
    id_validateur integer,
    date_validation date,
    id_equipe integer,
    CONSTRAINT ck_type CHECK (((type)::text = ANY (ARRAY[('A'::character varying)::text, ('F'::character varying)::text])))
);


ALTER TABLE documents OWNER TO scp4;

--
-- Name: entraine; Type: TABLE; Schema: public; Owner: scp4
--

DROP TABLE IF EXISTS entraine CASCADE;
CREATE TABLE entraine (
    id_entraineur integer NOT NULL,
    id_equipe integer NOT NULL,
    ordre integer
);


ALTER TABLE entraine OWNER TO scp4;

--
-- Name: sq_id_entrainement; Type: SEQUENCE; Schema: public; Owner: scp4
--

DROP SEQUENCE IF EXISTS sq_id_entrainement CASCADE;
CREATE SEQUENCE sq_id_entrainement
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sq_id_entrainement OWNER TO scp4;

--
-- Name: entrainements; Type: TABLE; Schema: public; Owner: scp4
--

DROP TABLE IF EXISTS entrainements CASCADE;
CREATE TABLE entrainements (
    id_entrainement integer DEFAULT nextval('sq_id_entrainement'::regclass) NOT NULL,
    id_equipe integer,
    id_entraineur integer,
    id_creneau integer NOT NULL
);


ALTER TABLE entrainements OWNER TO scp4;

--
-- Name: sq_id_equipe; Type: SEQUENCE; Schema: public; Owner: scp4
--

DROP SEQUENCE IF EXISTS sq_id_equipe CASCADE;
CREATE SEQUENCE sq_id_equipe
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sq_id_equipe OWNER TO scp4;

--
-- Name: equipes; Type: TABLE; Schema: public; Owner: scp4
--

DROP TABLE IF EXISTS equipes CASCADE;
CREATE TABLE equipes (
    id_equipe integer DEFAULT nextval('sq_id_equipe'::regclass) NOT NULL,
    id_categorie integer NOT NULL,
    nom character varying(50),
    points integer,
    victoires integer,
    defaites integer,
    nulls integer,
    photo character varying(30),
    club boolean DEFAULT true
);


ALTER TABLE equipes OWNER TO scp4;

--
-- Name: joue; Type: TABLE; Schema: public; Owner: scp4
--

DROP TABLE IF EXISTS joue CASCADE;
CREATE TABLE joue (
    id_adherent integer NOT NULL,
    id_equipe integer NOT NULL
);


ALTER TABLE joue OWNER TO scp4;

--
-- Name: sq_id_match; Type: SEQUENCE; Schema: public; Owner: scp4
--

DROP SEQUENCE IF EXISTS sq_id_match CASCADE;
CREATE SEQUENCE sq_id_match
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sq_id_match OWNER TO scp4;

--
-- Name: matchs; Type: TABLE; Schema: public; Owner: scp4
--

DROP TABLE IF EXISTS matchs CASCADE;
CREATE TABLE matchs (
    id_match integer DEFAULT nextval('sq_id_match'::regclass) NOT NULL,
    id_equipe_a integer NOT NULL,
    id_creneau integer NOT NULL,
    score_a integer,
    score_b integer,
    nom_equipe_b character varying,
	description varchar(500)
);


ALTER TABLE matchs OWNER TO scp4;

--
-- Name: sq_id_poste; Type: SEQUENCE; Schema: public; Owner: scp4
--

DROP SEQUENCE IF EXISTS sq_id_poste CASCADE;
CREATE SEQUENCE sq_id_poste
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sq_id_poste OWNER TO scp4;

--
-- Name: postes; Type: TABLE; Schema: public; Owner: scp4
--

DROP TABLE IF EXISTS postes CASCADE;
CREATE TABLE postes (
    id_poste integer DEFAULT nextval('sq_id_poste'::regclass) NOT NULL,
    designation character varying(50) NOT NULL,
    description character varying(200)
);


ALTER TABLE postes OWNER TO scp4;

--
-- Name: sq_id_salle; Type: SEQUENCE; Schema: public; Owner: scp4
--

DROP SEQUENCE IF EXISTS sq_id_salle CASCADE;
CREATE SEQUENCE sq_id_salle
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sq_id_salle OWNER TO scp4;

--
-- Name: salles; Type: TABLE; Schema: public; Owner: scp4
--

DROP TABLE IF EXISTS salles CASCADE;
CREATE TABLE salles (
    id_salle integer DEFAULT nextval('sq_id_salle'::regclass) NOT NULL,
    nom character varying(50),
    adresse character varying(200),
    code_postal character varying(50),
    ville character varying(50),
    complement character varying(200),
	competition boolean
);


ALTER TABLE salles OWNER TO scp4;

--
-- Name: telephones; Type: TABLE; Schema: public; Owner: scp4
--

DROP TABLE IF EXISTS telephones CASCADE;
CREATE TABLE telephones (
    id_contact integer NOT NULL,
    telephone character(10) NOT NULL,
    type character varying(50),
    remarque character varying(200),
    ordre integer,
    CONSTRAINT ck_telephone CHECK ((telephone ~ '^0[0-9]{9}$'::text)),
    CONSTRAINT ck_type CHECK (((type)::text = ANY (ARRAY[('fixe'::character varying)::text, ('portable'::character varying)::text, ('travail'::character varying)::text, ('autre'::character varying)::text])))
);


ALTER TABLE telephones OWNER TO scp4;

--
-- Name: sq_id_partenaire; Type: SEQUENCE; Schema: public; Owner: scp4
--

DROP SEQUENCE IF EXISTS sq_id_partenaire CASCADE;
CREATE SEQUENCE sq_id_partenaire
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sq_id_partenaire OWNER TO scp4;

--
-- Name: partenaires; Type: TABLE; Schema: public; Owner: scp4
--

DROP TABLE IF EXISTS partenaires CASCADE;
CREATE TABLE partenaires (
    id_partenaire integer DEFAULT nextval('sq_id_partenaire'::regclass) NOT NULL,
    titre character varying(50),
    description character varying(500),
    lien_logo character varying(50),
    position integer
);


ALTER TABLE archives OWNER TO scp4;
--
-- Data for Name: adherents; Type: TABLE DATA; Schema: public; Owner: scp4
--

COPY adherents (id_adherent, type_adherent, id_poste, login, mdp, nom, prenom, no_licence, date_naissance, genre, surclassement, habilitation, arbitre, entraineur) FROM stdin;
1	P	\N	azlouni.sirine	123	AZLOUNI	Sirine	4568792	2008-11-25	F	1	3	f	f
2	P	\N	delmotte.camille	123	DELMOTTE	Camille	456443	2009-05-21	F	1	3	f	f
3	P	\N	guers.louna	123	GUERS	Louna	3467924	2007-04-12	F	0	3	f	f
4	P	\N	journade.mathieu	123	JOURNADE	Mathieu	2467923	2008-08-10	M	0	3	f	f
5	P	\N	legal.camille	123	LEGAL	Camille	0288924	2009-01-05	F	0	3	f	f
6	A	\N	lemetayer.gaetane	123	LEMETAYER	Gaetane	8534456	2007-02-18	F	0	3	f	f
7	A	\N	vigier.maxens	123	VIGIER	Maxens	0259335	2010-03-13	M	0	3	f	f
8	A	\N	virgili.margaux	123	VIRGILI	Margaux	1464931	2008-11-27	F	0	3	f	f
0	P	\N	test	test	admin	grand chef	0000	2005-10-10	M	1	1	f	f
\.


--
-- Data for Name: arbitre; Type: TABLE DATA; Schema: public; Owner: scp4
--

COPY arbitre (id_adherent, id_match) FROM stdin;
\.


--
-- Data for Name: archives; Type: TABLE DATA; Schema: public; Owner: scp4
--

COPY archives (id_archive, titre, type, lien_photo, contenu, lien_document, id_createur, date_creation, id_validateur, date_validation) FROM stdin;
1	R1 f&eacute;minines championnes !	A		Nos R1 filles sont championnes r&eacute;gionales	\N	0	2016-05-30	0	2016-05-31
2	R1 masculin champions !	A		Nos R1 gar&ccedil;ons sont champions r&eacute;gion	\N	0	2016-05-31	0	2016-05-31
3	Victoire des M11	A	./img/articles/m11.jpg	Superbe victoire des M11 au TQO ;-)	\N	0	2016-05-31	0	2016-05-31
4	M11F test	A	./img/articles/amourJuB.jpg	test blabla trop cool	\N	1	2016-06-09	0	2016-06-09
\.


--
-- Data for Name: catalogue; Type: TABLE DATA; Schema: public; Owner: scp4
--

COPY catalogue (id_article, designation, des_comp, taille, coloris, prix, lien_photo) FROM stdin;
1	Ballon MOLTEN	\N	\N	\N	20	./img/boutique/ballon.png
2	Genouillères ASICS	\N	S	Bleu foncé	10	./img/boutique/genouilleres.jpg
3	Genouillères ASICS	\N	M	Bleu foncé	10	./img/boutique/genouilleres.jpg
4	Genouillères ASICS	\N	L	Bleu foncé	10	./img/boutique/genouilleres.jpg
5	Genouillères coque	\N	M	Noir	24	./img/boutique/genouilleres_coque.png
6	Genouillères coque	\N	L	Noir	24	./img/boutique/genouilleres_coque.png
7	Genouillères coque	\N	XL	Noir	24	./img/boutique/genouilleres_coque.png
8	Short Garçon ASICS ZONA	\N	XS	Noir	18	./img/boutique/short_garcon.png
9	Short Garçon ASICS ZONA	\N	S	Noir	18	./img/boutique/short_garcon.png
10	Short Garçon ASICS ZONA	\N	M	Noir	18	./img/boutique/short_garcon.png
11	Short Garçon ASICS ZONA	\N	L	Noir	18	./img/boutique/short_garcon.png
12	Short Garçon ASICS ZONA	\N	XL	Noir	18	./img/boutique/short_garcon.png
13	Short Garçon ASICS ZONA	\N	XXL	Noir	18	./img/boutique/short_garcon.png
14	Short cuissard Fille ASICS	\N	XS	Noir	18	./img/boutique/short_filles.png
15	Short cuissard Fille ASICS	\N	S	Noir	18	./img/boutique/short_filles.png
16	Short cuissard Fille ASICS	\N	M	Noir	18	./img/boutique/short_filles.png
17	Short cuissard Fille ASICS	\N	L	Noir	18	./img/boutique/short_filles.png
18	Short cuissard Fille ASICS	\N	XL	Noir	18	./img/boutique/short_filles.png
19	Short cuissard Fille ASICS	\N	XXL	Noir	18	./img/boutique/short_filles.png
20	Tee-shirt Classic	Flocage club + prénom	4A	Noir	10	./img/boutique/tee_shirt.jpg
21	Tee-shirt Classic	Flocage club + prénom	8A	Noir	10	./img/boutique/tee_shirt.jpg
22	Tee-shirt Classic	Flocage club + prénom	10A	Noir	10	./img/boutique/tee_shirt.jpg
23	Tee-shirt Classic	Flocage club + prénom	12A	Noir	10	./img/boutique/tee_shirt.jpg
24	Tee-shirt Classic	Flocage club + prénom	S	Noir	10	./img/boutique/tee_shirt.jpg
25	Tee-shirt Classic	Flocage club + prénom	M	Noir	10	./img/boutique/tee_shirt.jpg
26	Tee-shirt Classic	Flocage club + prénom	L	Noir	10	./img/boutique/tee_shirt.jpg
27	Tee-shirt Classic	Flocage club + prénom	XL	Noir	10	./img/boutique/tee_shirt.jpg
28	Tee-shirt Classic	Flocage club + prénom	XXL	Noir	10	./img/boutique/tee_shirt.jpg
29	Tee-shirt Classic	Flocage club + prénom	XXXL	Noir	10	./img/boutique/tee_shirt.jpg
30	SAC 60x30x38 cm	70 L floqué club	\N	Rouge et Noir	20	./img/boutique/sac.png
\.


--
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: scp4
--

COPY categories (id_categorie, categorie, description, age_debut, age_fin, tarif) FROM stdin;
1	M7	Baby	\N	8	80
2	M9	Pupilles	9	10	100
3	M11	Poussins	11	12	100
4	M13	Benjamins	13	14	100
5	M15	Minimes	15	16	115
6	M17	Cadets	17	18	115
7	M20	Juniors et Espoirs	19	21	125
8	Seniors	\N	18	\N	135
9	FSGT	\N	15	\N	105
\.


--
-- Data for Name: contacts; Type: TABLE DATA; Schema: public; Owner: scp4
--

COPY contacts (id_contact, id_adherent, nom, prenom, adresse, code_postal, ville, complement, remarque, ordre) FROM stdin;
1	1	AZLOUNI	Sirine	adresse	31000	toulouse	\N	\N	0
\.


--
-- Data for Name: courriels; Type: TABLE DATA; Schema: public; Owner: scp4
--

COPY courriels (id_contact, courriel, ordre) FROM stdin;
1	azlouni.sirine@hotmail.fr	\N
1	azlouni.sirine@gmail.com	\N
\.


--
-- Data for Name: creneaux; Type: TABLE DATA; Schema: public; Owner: scp4
--

COPY creneaux (id_creneau, id_salle, debut, fin) FROM stdin;
1	1	2016-05-02 10:30:00	2016-05-02 12:00:00
2	2	2016-05-09 10:30:00	2016-05-09 12:00:00
3	2	2016-05-16 10:30:00	2016-05-16 12:00:00
6	1	2016-05-28 10:00:00	2016-05-28 12:00:00
7	1	2016-05-28 10:00:00	2016-05-28 12:00:00
8	1	2016-06-04 10:00:00	2016-06-04 12:00:00
10	3	2016-06-18 10:00:00	2016-06-18 12:00:00
11	3	2016-06-18 10:00:00	2016-06-18 12:00:00
12	1	2016-11-12 10:00:00	2016-11-12 12:05:00
\.


--
-- Data for Name: documents; Type: TABLE DATA; Schema: public; Owner: scp4
--

COPY documents (id_document, titre, type, lien_photo, contenu, lien_document, id_createur, date_creation, id_validateur, date_validation, id_equipe) FROM stdin;
1	Test article	A	./img/articles/m11.jpg	blabla bla	\N	0	2016-05-30	0	2016-05-30	3
2	M13F article	A	./img/articles/m13f.jpg	Super match des MF ce Week-end !	\N	0	2016-05-31	0	2016-05-31	4
7	Victoire des M11 2	A	./img/articles/amours2016.JPG	test	\N	0	2016-06-09	0	2016-06-09	23
\.


--
-- Data for Name: entraine; Type: TABLE DATA; Schema: public; Owner: scp4
--

COPY entraine (id_entraineur, id_equipe, ordre) FROM stdin;
1	1	1
\.


--
-- Data for Name: entrainements; Type: TABLE DATA; Schema: public; Owner: scp4
--

COPY entrainements (id_entrainement, id_equipe, id_entraineur, id_creneau) FROM stdin;
\.


--
-- Data for Name: equipes; Type: TABLE DATA; Schema: public; Owner: scp4
--

COPY equipes (id_equipe, id_categorie, nom, points, victoires, defaites, nulls, photo, club) FROM stdin;
1	1	M7 (Ecole de volley)	0	0	0	0	./img/equipes/ecole_volley.jpg	t
2	2	M9 (Ecole de volley)	0	0	0	0	./img/equipes/ecole_volley.jpg	t
3	3	M11 (Poussins / Poussines)	0	0	0	0	./img/equipes/m11.jpg	t
4	4	M13 M (Benjamins)	0	0	0	0	\N	t
5	4	M13 F (Benjamines)	0	0	0	0	./img/equipes/m13f.jpg	t
6	5	M15 M (Minimes M)	0	0	0	0	\N	t
7	5	M15 F (Minimes F)	0	0	0	0	./img/equipes/m15f.jpg	t
8	7	M20 F (Juniors F)	0	0	0	0	\N	t
22	3	M11F2 (Poussines)	\N	\N	\N	\N	./img/equipes/amours.jpg	t
23	3	M11 2 (Poussins)	\N	\N	\N	\N	./img/equipes/amours.jpg	t
\.


--
-- Data for Name: joue; Type: TABLE DATA; Schema: public; Owner: scp4
--

COPY joue (id_adherent, id_equipe) FROM stdin;
4	3
\.


--
-- Data for Name: matchs; Type: TABLE DATA; Schema: public; Owner: scp4
--

COPY matchs (id_match, id_equipe_a, id_creneau, score_a, score_b, nom_equipe_b) FROM stdin;
1	4	1	1	2	Portet
2	5	2	0	0	L'Union
3	6	3	1	0	Fonsorbes
4	3	7	\N	\N	TOAC
5	5	8	\N	\N	L'Union
7	3	10	\N	\N	TOAC
8	23	11	\N	\N	L'Union
9	23	12	\N	\N	TOAC
\.


--
-- Data for Name: postes; Type: TABLE DATA; Schema: public; Owner: scp4
--

COPY postes (id_poste, designation, description) FROM stdin;
1	Président(e)	Le chef
2	Secrétaire	Ben un poste de secrétaire quoi ...
3	Comptable	Le chef
4	Entraineur referent	Le referent des entraineurs
\.


--
-- Data for Name: salles; Type: TABLE DATA; Schema: public; Owner: scp4
--

COPY salles (id_salle, nom, adresse, code_postal, ville, complement) FROM stdin;
1	gymnase Rivière	4 rue d’Estujats	31830	Plaisance du Touch	TRUE \N
2	Gymnase Monestié	rue des fauvettes	31830	Plaisance du Touch	FALSE \N
3	Exterieur				
\.


--
-- Name: sq_id_adherent; Type: SEQUENCE SET; Schema: public; Owner: scp4
--

SELECT pg_catalog.setval('sq_id_adherent', 8, true);


--
-- Name: sq_id_archive; Type: SEQUENCE SET; Schema: public; Owner: scp4
--

SELECT pg_catalog.setval('sq_id_archive', 4, true);


--
-- Name: sq_id_article; Type: SEQUENCE SET; Schema: public; Owner: scp4
--

SELECT pg_catalog.setval('sq_id_article', 30, true);


--
-- Name: sq_id_categorie; Type: SEQUENCE SET; Schema: public; Owner: scp4
--

SELECT pg_catalog.setval('sq_id_categorie', 9, true);


--
-- Name: sq_id_contact; Type: SEQUENCE SET; Schema: public; Owner: scp4
--

SELECT pg_catalog.setval('sq_id_contact', 1, true);


--
-- Name: sq_id_creneau; Type: SEQUENCE SET; Schema: public; Owner: scp4
--

SELECT pg_catalog.setval('sq_id_creneau', 12, true);


--
-- Name: sq_id_document; Type: SEQUENCE SET; Schema: public; Owner: scp4
--

SELECT pg_catalog.setval('sq_id_document', 7, true);


--
-- Name: sq_id_entrainement; Type: SEQUENCE SET; Schema: public; Owner: scp4
--

SELECT pg_catalog.setval('sq_id_entrainement', 1, true);


--
-- Name: sq_id_equipe; Type: SEQUENCE SET; Schema: public; Owner: scp4
--

SELECT pg_catalog.setval('sq_id_equipe', 23, true);


--
-- Name: sq_id_match; Type: SEQUENCE SET; Schema: public; Owner: scp4
--

SELECT pg_catalog.setval('sq_id_match', 9, true);


--
-- Name: sq_id_poste; Type: SEQUENCE SET; Schema: public; Owner: scp4
--

SELECT pg_catalog.setval('sq_id_poste', 4, true);


--
-- Name: sq_id_salle; Type: SEQUENCE SET; Schema: public; Owner: scp4
--

SELECT pg_catalog.setval('sq_id_salle', 4, true);


--
-- Data for Name: telephones; Type: TABLE DATA; Schema: public; Owner: scp4
--

COPY telephones (id_contact, telephone, type, remarque, ordre) FROM stdin;
1	0204050607	\N	\N	\N
\.


--
-- Name: adherents_login_key; Type: CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY adherents
    ADD CONSTRAINT adherents_login_key UNIQUE (login);


--
-- Name: adherents_no_licence_key; Type: CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY adherents
    ADD CONSTRAINT adherents_no_licence_key UNIQUE (no_licence);


--
-- Name: adherents_pkey; Type: CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY adherents
    ADD CONSTRAINT adherents_pkey PRIMARY KEY (id_adherent);


--
-- Name: archives_pkey; Type: CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY archives
    ADD CONSTRAINT archives_pkey PRIMARY KEY (id_archive);


--
-- Name: catalogue_pkey; Type: CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY catalogue
    ADD CONSTRAINT catalogue_pkey PRIMARY KEY (id_article);


--
-- Name: categories_pkey; Type: CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id_categorie);


--
-- Name: contacts_pkey; Type: CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY contacts
    ADD CONSTRAINT contacts_pkey PRIMARY KEY (id_contact);


--
-- Name: creneaux_pkey; Type: CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY creneaux
    ADD CONSTRAINT creneaux_pkey PRIMARY KEY (id_creneau);

--
-- Name: indisponibilites_pkey; Type: CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY indisponibilites
    ADD CONSTRAINT indisponibilites_pkey PRIMARY KEY (id_indisponibilite);


--
-- Name: documents_pkey; Type: CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY documents
    ADD CONSTRAINT documents_pkey PRIMARY KEY (id_document);


--
-- Name: entrainements_pkey; Type: CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY entrainements
    ADD CONSTRAINT entrainements_pkey PRIMARY KEY (id_entrainement);


--
-- Name: equipes_pkey; Type: CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY equipes
    ADD CONSTRAINT equipes_pkey PRIMARY KEY (id_equipe);


--
-- Name: matchs_pkey; Type: CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY matchs
    ADD CONSTRAINT matchs_pkey PRIMARY KEY (id_match);


--
-- Name: pk_arbitre; Type: CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY arbitre
    ADD CONSTRAINT pk_arbitre PRIMARY KEY (id_adherent, id_match);


--
-- Name: pk_entraine; Type: CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY entraine
    ADD CONSTRAINT pk_entraine PRIMARY KEY (id_entraineur, id_equipe);


--
-- Name: pk_joue; Type: CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY joue
    ADD CONSTRAINT pk_joue PRIMARY KEY (id_adherent, id_equipe);


--
-- Name: postes_designation_key; Type: CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY postes
    ADD CONSTRAINT postes_designation_key UNIQUE (designation);


--
-- Name: postes_pkey; Type: CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY postes
    ADD CONSTRAINT postes_pkey PRIMARY KEY (id_poste);


--
-- Name: salles_pkey; Type: CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY salles
    ADD CONSTRAINT salles_pkey PRIMARY KEY (id_salle);


--
-- Name: partenaires_pkey; Type: CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY partenaires
    ADD CONSTRAINT partenaires_pkey PRIMARY KEY (id_partenaire);


--
-- Name: un_entraineur; Type: CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY entraine
    ADD CONSTRAINT un_entraineur UNIQUE (id_entraineur, id_equipe, ordre);



--
-- Name: adherents_id_poste_fkey; Type: FK CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY adherents
    ADD CONSTRAINT adherents_id_poste_fkey FOREIGN KEY (id_poste) REFERENCES postes(id_poste);


--
-- Name: arbitre_id_adherent_fkey; Type: FK CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY arbitre
    ADD CONSTRAINT arbitre_id_adherent_fkey FOREIGN KEY (id_adherent) REFERENCES adherents(id_adherent);


--
-- Name: arbitre_id_match_fkey; Type: FK CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY arbitre
    ADD CONSTRAINT arbitre_id_match_fkey FOREIGN KEY (id_match) REFERENCES matchs(id_match);


--
-- Name: archives_id_createur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY archives
    ADD CONSTRAINT archives_id_createur_fkey FOREIGN KEY (id_createur) REFERENCES adherents(id_adherent);


--
-- Name: archives_id_validateur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY archives
    ADD CONSTRAINT archives_id_validateur_fkey FOREIGN KEY (id_validateur) REFERENCES adherents(id_adherent);


--
-- Name: contacts_id_adherent_fkey; Type: FK CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY contacts
    ADD CONSTRAINT contacts_id_adherent_fkey FOREIGN KEY (id_adherent) REFERENCES adherents(id_adherent);


--
-- Name: courriels_id_contact_fkey; Type: FK CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY courriels
    ADD CONSTRAINT courriels_id_contact_fkey FOREIGN KEY (id_contact) REFERENCES contacts(id_contact);


--
-- Name: creneaux_id_salle_fkey; Type: FK CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY creneaux
    ADD CONSTRAINT creneaux_id_salle_fkey FOREIGN KEY (id_salle) REFERENCES salles(id_salle);


--
-- Name: indisponibilites_id_salle_fkey; Type: FK CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY indisponibilites
    ADD CONSTRAINT indisponibilites_id_salle_fkey FOREIGN KEY (id_salle) REFERENCES salles(id_salle);


--
-- Name: documents_id_createur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY documents
    ADD CONSTRAINT documents_id_createur_fkey FOREIGN KEY (id_createur) REFERENCES adherents(id_adherent);


--
-- Name: documents_id_validateur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY documents
    ADD CONSTRAINT documents_id_validateur_fkey FOREIGN KEY (id_validateur) REFERENCES adherents(id_adherent);


--
-- Name: entraine_id_entraineur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY entraine
    ADD CONSTRAINT entraine_id_entraineur_fkey FOREIGN KEY (id_entraineur) REFERENCES adherents(id_adherent);


--
-- Name: entraine_id_equipe_fkey; Type: FK CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY entraine
    ADD CONSTRAINT entraine_id_equipe_fkey FOREIGN KEY (id_equipe) REFERENCES equipes(id_equipe);


--
-- Name: entrainements_id_creneau_fkey; Type: FK CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY entrainements
    ADD CONSTRAINT entrainements_id_creneau_fkey FOREIGN KEY (id_creneau) REFERENCES creneaux(id_creneau);


--
-- Name: entrainements_id_entraineur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY entrainements
    ADD CONSTRAINT entrainements_id_entraineur_fkey FOREIGN KEY (id_entraineur) REFERENCES adherents(id_adherent);


--
-- Name: entrainements_id_equipe_fkey; Type: FK CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY entrainements
    ADD CONSTRAINT entrainements_id_equipe_fkey FOREIGN KEY (id_equipe) REFERENCES equipes(id_equipe);


--
-- Name: equipes_id_categorie_fkey; Type: FK CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY equipes
    ADD CONSTRAINT equipes_id_categorie_fkey FOREIGN KEY (id_categorie) REFERENCES categories(id_categorie);


--
-- Name: joue_id_adherent_fkey; Type: FK CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY joue
    ADD CONSTRAINT joue_id_adherent_fkey FOREIGN KEY (id_adherent) REFERENCES adherents(id_adherent);


--
-- Name: joue_id_equipe_fkey; Type: FK CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY joue
    ADD CONSTRAINT joue_id_equipe_fkey FOREIGN KEY (id_equipe) REFERENCES equipes(id_equipe);


--
-- Name: matchs_id_creneau_fkey; Type: FK CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY matchs
    ADD CONSTRAINT matchs_id_creneau_fkey FOREIGN KEY (id_creneau) REFERENCES creneaux(id_creneau);


--
-- Name: telephones_id_contact_fkey; Type: FK CONSTRAINT; Schema: public; Owner: scp4
--

ALTER TABLE ONLY telephones
    ADD CONSTRAINT telephones_id_contact_fkey FOREIGN KEY (id_contact) REFERENCES contacts(id_contact);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

