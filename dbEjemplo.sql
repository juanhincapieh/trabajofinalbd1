CREATE TABLE bibliotecario(
	cedula NUMERIC(10) PRIMARY KEY CHECK(cedula >= 0),
	nombre VARCHAR(20) NOT NULL,
	apellido VARCHAR(20) NOT NULL,
	contratoid NUMERIC(10) UNIQUE,
	FOREIGN KEY(contratoid) REFERENCES contratotemporal(codigo)
);

CREATE TABLE contratotemporal(
	codigo NUMERIC(10) PRIMARY KEY CHECK(codigo >= 0),
	salario NUMERIC(8) NOT NULL,
	fechacontratacion DATE NOT NULL,
	fechaterminacion DATE NOT NULL,
	CHECK (fechacontratacion <= fechaterminacion)
);

CREATE TABLE seccion(
	codBiblioteca NUMERIC(4) NOT NULL,
	adminid NUMERIC(10) NOT NULL,
	auxiliarid NUMERIC(10),
	nombre VARCHAR(20) NOT NULL,
	piso NUMERIC(2) NOT NULL,
	pasillo VARCHAR(2) NOT NULL,
	fechacreacion DATE NOT NULL,
	PRIMARY KEY(codBiblioteca, nombre),
	FOREIGN KEY(adminid) REFERENCES bibliotecario(cedula),
	FOREIGN KEY(auxiliarid) REFERENCES bibliotecario(cedula),
	CHECK (auxiliarid <> adminid)
);
