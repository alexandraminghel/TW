DROP TABLE IF EXISTS USERS;

DROP TABLE IF EXISTS DETINUTI;

CREATE TABLE USERS (
	ID INT AUTO_INCREMENT PRIMARY KEY,
	NUME VARCHAR(50),
	PRENUME VARCHAR(50),
	EMAIL VARCHAR(100),
	PAROLA VARCHAR(100),
	TELEFON VARCHAR(20),
	POZA VARCHAR(100)
	
);

CREATE TABLE DETINUTI (
	ID INT AUTO_INCREMENT PRIMARY KEY,
	NUME VARCHAR(50),
	PRENUME VARCHAR(50),
	DATANASTERE DATE,
	DATAINCARCERARE DATE,
	PEDEAPSA INT,
	CRIMA VARCHAR(50)
);

CREATE TABLE VIZITE (
	ID INT AUTO_INCREMENT PRIMARY KEY,
	ID_VIZITATOR INT,
	ID_DETINUT INT,
	DATA_VIZITEI DATE,
	NATURA_VIZITEI VARCHAR(100),
	REZUMATUL_DISCUTIEI TEXT,
	OBIECTE_ADUSE TEXT,
	RELATIA_DETINUT VARCHAR(50),
	ORA TIME,
	DURATA FLOAT,
	NUME_MARTOR VARCHAR(100),
	OBIECTE_OFERITE TEXT,
	STARE_SPIRIT TEXT,
	STARE_SANATATE VARCHAR(20),
	
	CONSTRAINT user_visit_fk FOREIGN KEY(ID_VIZITATOR) REFERENCES USERS(ID),
	CONSTRAINT detinut_visit_fk FOREIGN KEY(ID_DETINUT) REFERENCES DETINUTI(ID)
);

CREATE TABLE PROGRAMARI (
	ID INT AUTO_INCREMENT PRIMARY KEY,
	ID_VIZITATOR INT,
	ID_DETINUT INT,
	DATA_VIZITEI DATE,
	NATURA_VIZITEI VARCHAR(100),
	REZUMATUL_DISCUTIEI TEXT,
	OBIECTE_ADUSE TEXT,
	RELATIA_DETINUT VARCHAR(50),
	
	CONSTRAINT user_prog_fk FOREIGN KEY(ID_VIZITATOR) REFERENCES USERS(ID),
	CONSTRAINT detinut_prog_fk FOREIGN KEY(ID_DETINUT) REFERENCES DETINUTI(ID)
);