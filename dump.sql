--
-- PostgreSQL database dump
--

-- Dumped from database version 15.1 (Debian 15.1-1.pgdg110+1)
-- Dumped by pg_dump version 15.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: public; Type: SCHEMA; Schema: -; Owner: pg_database_owner
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO pg_database_owner;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: pg_database_owner
--

COMMENT ON SCHEMA public IS 'standard public schema';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: genres; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.genres (
    id integer NOT NULL,
    name character varying(100) NOT NULL
);


ALTER TABLE public.genres OWNER TO dbuser;

--
-- Name: genres_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.genres_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.genres_id_seq OWNER TO dbuser;

--
-- Name: genres_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.genres_id_seq OWNED BY public.genres.id;


--
-- Name: liked_by; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.liked_by (
    id_user integer NOT NULL,
    id_song integer NOT NULL,
    rating integer NOT NULL
);


ALTER TABLE public.liked_by OWNER TO dbuser;

--
-- Name: matches; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.matches (
    id_user1 integer NOT NULL,
    id_user2 integer NOT NULL
);


ALTER TABLE public.matches OWNER TO dbuser;

--
-- Name: roles; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.roles (
    id integer NOT NULL,
    role character varying(100) NOT NULL
);


ALTER TABLE public.roles OWNER TO dbuser;

--
-- Name: roles_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.roles_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.roles_id_seq OWNER TO dbuser;

--
-- Name: roles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.roles_id_seq OWNED BY public.roles.id;


--
-- Name: song_genres; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.song_genres (
    id_song integer NOT NULL,
    id_genre integer NOT NULL
);


ALTER TABLE public.song_genres OWNER TO dbuser;

--
-- Name: songs; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.songs (
    id integer NOT NULL,
    title character varying(100) NOT NULL,
    author character varying(255) NOT NULL,
    album character varying(100) NOT NULL,
    filename character varying(255) NOT NULL
);


ALTER TABLE public.songs OWNER TO dbuser;

--
-- Name: users; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.users (
    id integer NOT NULL,
    id_role integer NOT NULL,
    id_user_details integer NOT NULL,
    email character varying(255) NOT NULL,
    username character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    enabled boolean DEFAULT false NOT NULL,
    salt boolean
);


ALTER TABLE public.users OWNER TO dbuser;

--
-- Name: table_name_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.table_name_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.table_name_id_seq OWNER TO dbuser;

--
-- Name: table_name_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.table_name_id_seq OWNED BY public.users.id;


--
-- Name: table_name_id_song_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.table_name_id_song_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.table_name_id_song_seq OWNER TO dbuser;

--
-- Name: table_name_id_song_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.table_name_id_song_seq OWNED BY public.songs.id;


--
-- Name: user_details; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.user_details (
    id integer NOT NULL,
    name character varying(100) NOT NULL,
    surname character varying(100) NOT NULL,
    gender integer NOT NULL,
    interested_in integer NOT NULL
);


ALTER TABLE public.user_details OWNER TO dbuser;

--
-- Name: user_details_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.user_details_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_details_id_seq OWNER TO dbuser;

--
-- Name: user_details_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.user_details_id_seq OWNED BY public.user_details.id;


--
-- Name: genres id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.genres ALTER COLUMN id SET DEFAULT nextval('public.genres_id_seq'::regclass);


--
-- Name: roles id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.roles ALTER COLUMN id SET DEFAULT nextval('public.roles_id_seq'::regclass);


--
-- Name: songs id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.songs ALTER COLUMN id SET DEFAULT nextval('public.table_name_id_song_seq'::regclass);


--
-- Name: user_details id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.user_details ALTER COLUMN id SET DEFAULT nextval('public.user_details_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.table_name_id_seq'::regclass);


--
-- Data for Name: genres; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.genres (id, name) FROM stdin;
1	rock
2	pop
3	rap
\.


--
-- Data for Name: liked_by; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.liked_by (id_user, id_song, rating) FROM stdin;
\.


--
-- Data for Name: matches; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.matches (id_user1, id_user2) FROM stdin;
\.


--
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.roles (id, role) FROM stdin;
1	admin
2	user
\.


--
-- Data for Name: song_genres; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.song_genres (id_song, id_genre) FROM stdin;
1	1
1	2
2	3
\.


--
-- Data for Name: songs; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.songs (id, title, author, album, filename) FROM stdin;
1	Hourglass	Hollywood Undead	Hotel Kalifornia	hukalifornia.jpg
2	Jeżyk	OKI	PRODUKT47	idk2.png
\.


--
-- Data for Name: user_details; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.user_details (id, name, surname, gender, interested_in) FROM stdin;
1	John	Snow	1	3
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.users (id, id_role, id_user_details, email, username, password, enabled, salt) FROM stdin;
1	1	1	jsnow@pk.edu.pl	jsnow	john123	f	\N
\.


--
-- Name: genres_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.genres_id_seq', 3, true);


--
-- Name: roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.roles_id_seq', 2, true);


--
-- Name: table_name_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.table_name_id_seq', 1, true);


--
-- Name: table_name_id_song_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.table_name_id_song_seq', 2, true);


--
-- Name: user_details_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.user_details_id_seq', 1, true);


--
-- Name: genres genres_name_key; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.genres
    ADD CONSTRAINT genres_name_key UNIQUE (name);


--
-- Name: genres genres_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.genres
    ADD CONSTRAINT genres_pkey PRIMARY KEY (id);


--
-- Name: roles roles_id_key; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_id_key UNIQUE (id);


--
-- Name: roles roles_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);


--
-- Name: roles roles_role_key; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_role_key UNIQUE (role);


--
-- Name: users table_name_email_key; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT table_name_email_key UNIQUE (email);


--
-- Name: songs table_name_filename_key; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.songs
    ADD CONSTRAINT table_name_filename_key UNIQUE (filename);


--
-- Name: users table_name_id_user_details_key; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT table_name_id_user_details_key UNIQUE (id_user_details);


--
-- Name: songs table_name_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.songs
    ADD CONSTRAINT table_name_pkey PRIMARY KEY (id);


--
-- Name: users table_name_pkey1; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT table_name_pkey1 PRIMARY KEY (id);


--
-- Name: users table_name_username_key; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT table_name_username_key UNIQUE (username);


--
-- Name: user_details user_details_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.user_details
    ADD CONSTRAINT user_details_pkey PRIMARY KEY (id);


--
-- Name: liked_by liked_by_songFK; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.liked_by
    ADD CONSTRAINT "liked_by_songFK" FOREIGN KEY (id_song) REFERENCES public.songs(id);


--
-- Name: liked_by liked_by_userFK; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.liked_by
    ADD CONSTRAINT "liked_by_userFK" FOREIGN KEY (id_user) REFERENCES public.users(id);


--
-- Name: matches matches_users_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.matches
    ADD CONSTRAINT matches_users_id_fk FOREIGN KEY (id_user1) REFERENCES public.users(id);


--
-- Name: matches matches_users_id_fk_2; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.matches
    ADD CONSTRAINT matches_users_id_fk_2 FOREIGN KEY (id_user2) REFERENCES public.users(id);


--
-- Name: song_genres song_genres_genreFK; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.song_genres
    ADD CONSTRAINT "song_genres_genreFK" FOREIGN KEY (id_genre) REFERENCES public.genres(id);


--
-- Name: song_genres song_genres_songFK; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.song_genres
    ADD CONSTRAINT "song_genres_songFK" FOREIGN KEY (id_song) REFERENCES public.songs(id);


--
-- Name: users users_roles_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_roles_id_fk FOREIGN KEY (id_role) REFERENCES public.roles(id);


--
-- Name: users users_user_details_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_user_details_id_fk FOREIGN KEY (id_user_details) REFERENCES public.user_details(id);


--
-- PostgreSQL database dump complete
--

