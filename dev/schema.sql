drop table appuser cascade;
drop table scores cascade;
drop table msg cascade;

create table appuser (
	userid varchar(50) primary key,
	password varchar(100),
	firstname varchar(25),
	lastname varchar(25),
	email varchar(250),
	dob date,
	major varchar(100),
	campus varchar(100),
	sequ varchar(500),
	sequ_ans varchar(100),
	gender varchar(10)
);

create table scores (
	gameid varchar(50),
	userid varchar(100) references appuser(userid),
	score integer,
	difficulty integer,
	primary key (gameid, userid, difficulty)
);

create table msg (
	chatid serial,
	userid varchar(50) references appuser(userid),
	text text,
	time date, 
	primary key (chatid)
);


-- 'GuessGame'
-- 'SlideGame'		
-- 'FrogGame'
-- '2048Game'

-- Dummy data

INSERT INTO appuser (userid, password) VALUES ('Bob',CRYPT('pass', GEN_SALT('bf', 8)));
INSERT INTO appuser (userid, password) VALUES ('Kevin',CRYPT('pass', GEN_SALT('bf', 8)));
INSERT INTO appuser (userid, password) VALUES ('Tim',CRYPT('pass', GEN_SALT('bf', 8)));
INSERT INTO appuser (userid, password) VALUES ('Joe',CRYPT('pass', GEN_SALT('bf', 8)));
INSERT INTO appuser (userid, password) VALUES ('Jeff',CRYPT('pass', GEN_SALT('bf', 8)));
INSERT INTO appuser (userid, password) VALUES ('Dan',CRYPT('pass', GEN_SALT('bf', 8)));
INSERT INTO appuser (userid, password) VALUES ('Andy',CRYPT('pass', GEN_SALT('bf', 8)));
INSERT INTO appuser (userid, password) VALUES ('Billy',CRYPT('pass', GEN_SALT('bf', 8)));
INSERT INTO appuser (userid, password) VALUES ('Rio',CRYPT('pass', GEN_SALT('bf', 8)));
INSERT INTO appuser (userid, password) VALUES ('Sam',CRYPT('pass', GEN_SALT('bf', 8)));
INSERT INTO appuser (userid, password) VALUES ('Jenny',CRYPT('pass', GEN_SALT('bf', 8)));
INSERT INTO appuser (userid, password) VALUES ('Andrew',CRYPT('pass', GEN_SALT('bf', 8)));
INSERT INTO appuser (userid, password) VALUES ('Shuprio',CRYPT('pass', GEN_SALT('bf', 8)));
INSERT INTO appuser (userid, password) VALUES ('Sabrina',CRYPT('pass', GEN_SALT('bf', 8)));

INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('GuessGame', 'Bob', 995, 0);
INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('GuessGame', 'Kevin', 997, 0);
INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('GuessGame', 'Tim', 994, 0);
INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('GuessGame', 'Joe', 876, 1);
INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('GuessGame', 'Jeff', 950, 1);
INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('GuessGame', 'Dan', 942, 1);
INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('GuessGame', 'Andy', 512, 2);

--


INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('SlideGame', 'Billy', 854, 0);
INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('SlideGame', 'Kevin', 863, 0);
INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('SlideGame', 'Tim', 872, 0);
INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('SlideGame', 'Joe', 766, 1);
INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('SlideGame', 'Rio', 797, 1);
INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('SlideGame', 'Dan', 546, 1);
INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('SlideGame', 'Jeff', 854, 2);

--


INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('FrogGame', 'Sam', 985, 0);
INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('FrogGame', 'Kevin', 985, 0);
INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('FrogGame', 'Joe', 960, 1);
INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('FrogGame', 'Rio', 960, 1);
INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('FrogGame', 'Jenny', 935, 2);
INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('FrogGame', 'Jeff', 935, 2);

--


INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('2048Game', 'Andrew', 14241, 0);
INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('2048Game', 'Shuprio', 24556, 0);
INSERT INTO scores (gameid, userid, score, difficulty) VALUES ('2048Game', 'Sabrina', 5644, 0);

--

INSERT INTO msg (userid, text, time) VALUES ('Shuprio','Hello', current_date);
INSERT INTO msg (userid, text, time) VALUES ('Kevin','Ya Eh', current_date);

