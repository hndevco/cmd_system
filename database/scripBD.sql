
--BD_posgresql

--inicio cargo		
CREATE TABLE tbl_cargos(
	id SERIAL primary key,
	nombre text,
	descripcion text,
	created_at TIMESTAMP NOT NULL,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null
);
--fin cargo

--inicio paciente
CREATE TABLE reg_ficha_pacientes(
	id serial primary key,
	identidad text not null,
	primer_nombre VARCHAR (50) null,
	segundo_nombre VARCHAR (50) null,
	primer_apellido VARCHAR (50) null,
	segundo_apellido VARCHAR (50) null,
	fecha_nacimiento DATE null,
	sexo VARCHAR (1),
	telefono text,
	id_pais integer,
	domicilio VARCHAR (250) null,
	nombre_padre VARCHAR (100) null,
	nombre_madre VARCHAR (100) null,
	nombre_tutor VARCHAR (100) null,
	created_at TIMESTAMP not null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null
);
--fin paciente

--incio masa corporal
CREATE TABLE tbl_indice_masa_corporal(
	id serial primary key,
	descripcion_masa_corporal TEXT NULL,
	created_at TIMESTAMP NOT null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null
);
--fin masa corporal


--inicio paises
CREATE TABLE tbl_paises (
	id serial primary key,
	code int  NULL,
	iso3166a1 varchar(2) default NULL,
	iso3166a2 varchar(3) default NULL,
	nombre varchar(128) default NULL,
	created_at TIMESTAMP not null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null
);
--fin paises

/*
--inico empleado 
CREATE TABLE per_empleado(
	id SERIAL primary key,
	primer_nombre VARCHAR (50) NOT NULL,
	segundo_nombre VARCHAR (50) NULL,
	primer_apellido VARCHAR (50) NOT NULL,
	segundo_apellido VARCHAR (50) NULL,
	identidad text not null,
	telefono text,
	id_pais integer, 
	domicilio VARCHAR (250) NULL,
	id_usuario INT  NULL,
	id_cargo INT null,
	created_at TIMESTAMP NOT null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null,	
	CONSTRAINT fk_id_usuario foreign key(id_usuario) references public.users(id),
	CONSTRAINT fk_id_cargo foreign key(id_cargo) references public.tbl_cargo(id)
);
--fin empleado
*/
--inico estado_conciencia
CREATE TABLE tbl_estados_conciencia(
	id serial primary key not null,
	--nombre text,
	descripcion text,
	created_at TIMESTAMP not null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null
);
--fin estado_conciencia

--inicio tipo de sangra
CREATE TABLE tbl_tipos_sangre(
	id SERIAL primary key not null,
	nombre VARCHAR (5),
	descripcion text,
	created_at TIMESTAMP not null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null
);
--fin tipo de sangre

--inicio tipo de expediente
CREATE TABLE tbl_tipos_expedientes(
	id SERIAL PRIMARY KEY not null,
	nombre text,
	descripcion text,
	created_at TIMESTAMP not null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null
);
--fin tipo de expediente

--inicio base de expediente de pediatria
CREATE TABLE tbl_ped_expediente_pediatrico (
	id serial PRIMARY KEY not null,
	id_paciente INTEGER NOT NULL,
	id_expediente INT NOT NULL,
	motivo_consulta VARCHAR (500) NULL,
	historial_efermedad_actual VARCHAR (500) NULL,
	antecendentes_personales_patologicos BOOLEAN null,
	tratamiento_antecendentes_personales_patologicos BOOLEAN null,
	antecendentes_familiares_patologicos BOOLEAN null,
	antecedentes_hospitalarios_quirurgicos BOOLEAN null,
	inmunizacion VARCHAR (500) null,
	--alergia BOOLEAN null,
	tipo_alergia VARCHAR (500) NULL,
	created_at TIMESTAMP NOT NULL,
	updated_at TIMESTAMP  NULL,
	deleted_at TIMESTAMP  NULL,
	CONSTRAINT fk_id_paciente foreign key(id_paciente) references public.reg_ficha_pacientes(id),
	CONSTRAINT fk_id_expedeinte foreign key(id_expediente) references public.tbl_tipos_expedientes(id)	

);

CREATE TABLE tbl_ped_antecendentes_prenatales(
	id SERIAL PRIMARY KEY,
	id_paciente INTEGER not null,
	id_expediente INT NOT NULL,
	nombre_madre VARCHAR (50) null,
	edad DATE null,
	id_tipo_sangre_madre INT NULL,
	--enfermedades_durante_embarazo BOOLEAN null,
	tipo_enfermedades_durante_embarazo VARCHAR (500) null,
	cantidad_gestas INT null,
	catidad_parto INT null,
	cantidad_cesaria INT null,
	control_prenatal_ultimo_embarazo INT null,
	created_at TIMESTAMP NOT null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null,
	CONSTRAINT fk_id_paciente foreign key(id_paciente) references public.reg_ficha_pacientes(id),
	CONSTRAINT fk_id_expediente foreign key(id_expediente) references public.tbl_tipos_expedientes(id),
	CONSTRAINT fk_id_tipo_sangre_madre foreign key(id_tipo_sangre_madre) references public.tbl_tipos_sangre(id)
);


CREATE TABLE tbl_ped_natalicio(
	id SERIAL PRIMARY KEY not null,
	id_paciente INTEGER not null,
	id_expediente INT NOT NULL,
	lugar_nacimiento VARCHAR (50) null,
	apgar NUMERIC null,
	peso NUMERIC null,
	talla NUMERIC null,
	perimetro_cefaleo NUMERIC null,
	tipo_parto VARCHAR (25) null,
	--complicaciones_parto BOOLEAN null,
	tipo_complicaciones_parto VARCHAR (500) null,
	created_at TIMESTAMP NOT null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null,
	CONSTRAINT fk_id_paciente foreign key(id_paciente) references public.reg_ficha_pacientes(id),
	CONSTRAINT fk_id_expediente foreign key(id_expediente) references public.tbl_tipos_expedientes(id)	

);


CREATE TABLE tbl_ped_desarrollo_psicomotor(
	id SERIAL PRIMARY KEY,
	id_paciente INTEGER not null,
	id_expediente INT NOT NULL,
	sonrio BOOLEAN null,
	sostuvo_cabeza BOOLEAN null,
	se_sento BOOLEAN null,
	se_paro BOOLEAN null,
	comio_solo BOOLEAN null,
	habla BOOLEAN null,
	control_esfinteres BOOLEAN null,
	--escolaridad_actual BOOLEAN null,
	grado_escolaridad_actual VARCHAR (50) null,
	created_at TIMESTAMP NOT null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null,
	CONSTRAINT fk_id_paciente foreign key(id_paciente) references public.reg_ficha_pacientes(id),
	CONSTRAINT fk_id_expediente foreign key(id_expediente) references public.tbl_tipos_expedientes(id)	

);

CREATE TABLE tbl_tipos_lactancia(
	id SERIAL PRIMARY KEY not null,
	nombre text,
	descripcion text,
	created_at TIMESTAMP not null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null
);

CREATE TABLE tbl_ped_lactancia(
	id SERIAL PRIMARY KEY,
	id_paciente INTEGER not null,
	id_expediente INT NOT NULL,
	/*materna BOOLEAN null,
	artificial BOOLEAN null,
	mixta BOOLEAN null,*/
	id_tipo_lactancia integer ,
	ablactacion VARCHAR (500) null,
	alimentacion_actual VARCHAR (500) null,
	created_at TIMESTAMP NOT null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null,
	CONSTRAINT fk_id_paciente foreign key(id_paciente) references public.reg_ficha_pacientes(id),
	CONSTRAINT fk_id_expediente foreign key(id_expediente) references public.tbl_tipos_expedientes(id),
	CONSTRAINT fk_id_tipo_lactancia foreign key(id_tipo_lactancia) references public.tbl_tipos_lactancia(id)
);
/*
CREATE TABLE tbl_ped_signos_vitales(
	id SERIAL primary key,
	id_paciente INTEGER not null,
	id_expediente INT not null,
	temperatura NUMERIC null,
	precion_arterial NUMERIC null,
	peso NUMERIC null,
	talla NUMERIC null,
	saturacion NUMERIC null,
	frecuencia_cardiaca NUMERIC null,
	frecuancia_respiratoria NUMERIC null,
	glucometria NUMERIC null,
	examen_fisico VARCHAR (500) null,
	diagnostico VARCHAR (500) NULL,
	indicaciones_tratamiento VARCHAR (500) null,
	fecha_proxima_cita DATE null,
	CONSTRAINT fk_id_paciente foreign key(id_paciente) references public.reg_ficha_pacientes(id),
	CONSTRAINT fk_id_expediente foreign key(id_expediente) references public.tbl_tipos_expedientes(id)
);*/
--fin expediente de pediatria

--inicio receta
CREATE TABLE tbl_receta_medica(
	id SERIAL PRIMARY KEY,
	id_paciente INTEGER not  null,
	id_expediente INT NOT NULL,
	edad INT null,
	fecha_elaborada DATE null,
	descripcion_receta VARCHAR (500) null,
	id_medico int null,
	CONSTRAINT fk_id_paciente foreign key(id_paciente) references public.reg_ficha_pacientes(id),
	CONSTRAINT fk_id_medico foreign key(id_medico) references public.per_empleado(id),
	CONSTRAINT fk_id_expediente foreign key(id_expediente) references public.tbl_tipos_expedientes(id)	


);
--fin receta

--inicio expedinte general
CREATE TABLE tbl_mg_medicina_general(
	id SERIAL PRIMARY KEY not null,
	id_paciente INTEGER not null,
	id_expediente INT NOT NULL,
	antecedentes_patologicos_personales VARCHAR (500) null,
	tratamiento_antecedentes_patologicos_personales VARCHAR (500) null,
	antecendetes_familiares_patologicos VARCHAR (500) null,
	--antecendetes_ginecologico BOOLEAN null,
	gestas INT null,
	partos INT null,
	cesareas INT null,
	abortos INT null,
	fecha_ultima_menstruacion DATE null,
	--antecedentes_alergias BOOLEAN null,
	cuales_alergias VARCHAR (500) null,
	--habitos BOOLEAN null,
	tipo_habitos VARCHAR (500) null,
	antecendetes_hospitalarios_quirurgicos VARCHAR (500) null,
	motivo_consulta VARCHAR (500) null,
	historia_enfermedad_actual VARCHAR (500) null,
	created_at TIMESTAMP not null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null,
	CONSTRAINT fk_id_paciente foreign key(id_paciente) references public.reg_ficha_pacientes(id),
	CONSTRAINT fk_id_expediente foreign key(id_expediente) references public.tbl_tipos_expedientes(id)	
);

CREATE TABLE tbl_mg_glasgow(
	id SERIAL PRIMARY KEY not null,
	id_paciente INTEGER not null,
	id_expediente INT NOT NULL,
	glasgow INT null,
	actividad_ocular NUMERIC null,
	respuesta_verval NUMERIC null,
	respuesta_motora NUMERIC null,
	--total_glasgow INT NULL,
	created_at TIMESTAMP not null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null,
	CONSTRAINT fk_id_paciente foreign key(id_paciente) references public.reg_ficha_pacientes(id),
	CONSTRAINT fk_id_expediente foreign key(id_expediente) references public.tbl_tipos_expedientes(id)	

);


CREATE TABLE tbl_mg_estado_conciencia(
	id SERIAL PRIMARY KEY not null,
	id_paciente INTEGER not null,
	id_expediente INT NOT NULL,
	--alerta BOOLEAN null,
	--somnoliento BOOLEAN null,
	--estupor BOOLEAN null,
	--coma BOOLEAN null,
	id_estado_conciencia INT,
	created_at TIMESTAMP not null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null,
	CONSTRAINT fk_id_paciente foreign key(id_paciente) references public.reg_ficha_pacientes(id),
	CONSTRAINT fk_id_expediente foreign key(id_expediente) references public.tbl_tipos_expedientes(id),
	CONSTRAINT fk_id_estado_conciencia foreign key(id_estado_conciencia) references public.tbl_estados_conciencia(id)

);
/*
CREATE TABLE tbl_mg_signos_vitales(
	id serial PRIMARY KEY not null,
	id_paciente INTEGER not null,
	id_expediente INT not null,
	temperatura NUMERIC null,
	precion_arterial NUMERIC null,
	peso NUMERIC null,
	talla NUMERIC null,
	saturacion NUMERIC null,
	frecuencia_cardiaca NUMERIC null,
	frecuancia_respiratoria NUMERIC null,
	glucometria NUMERIC null,
	examen_fisico VARCHAR (500) null,
	diagnostico VARCHAR (500) NULL,
	indicaciones_tratamiento VARCHAR (500) null,
	fecha_proxima_cita DATE null,
	created_at TIMESTAMP NOT null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null,	
	CONSTRAINT fk_id_paciente foreign key(id_paciente) references public.reg_ficha_pacientes(id),
	CONSTRAINT fk_id_expediente foreign key(id_expediente) references public.tbl_tipos_expedientes(id)	
);*/
--fin expedinte general


--inicio expediente ginecologia
CREATE TABLE tbl_gin_ginecoligia(
	id SERIAL PRIMARY KEY not null,
	id_paciente INTEGER not null,
	id_expediente INT NOT NULL,
	--antecendetes_gineco_obstetricos BOOLEAN null,
	gestas INT null,
	partos INT null,
	cesareas INT null,
	abortos INT null,
	hijos_vivos INT null,
	hijos_muertos INT null,
	fecha_parto DATE null,
	atendido VARCHAR (100) null,	
	--fum BOOLEAN null,
	fecha_ultima_mestruacion  DATE null,	 
	--fpp BOOLEAN null,
	fecha_provable_parto DATE null,
	citologia VARCHAR (500) null,
	--planificacion_familiar BOOLEAN null,
	descripcion_planificacion_familiar VARCHAR (500),
	id_tipo_sangre int null,
	--vaginosis BOOLEAN null,
	descripcion_vaginosis VARCHAR (500) NULL,
	--infeccion_tracto_urinario BOOLEAN null,
	descripcion_infeccion_tracto_urinario VARCHAR (500) null,
	--prurito BOOLEAN null,
	descripcion_prurito VARCHAR (500) NULL,
	menarquia VARCHAR (50) null,
	descripcion_menarquia VARCHAR (500) null,
	--inicio_vida_sexual VARCHAR (50) null,
	edad_inicio_vida_sexual INT null,
	numero_parejas_sexuales INT null,
	--enfermedades_trasmision_sexual BOOLEAN null,
	tipo_enfermedades_trasmision_sexual VARCHAR (500) null,
	vida_sexual_activa VARCHAR (500) null,
	--antecendestes_personales_patologicos BOOLEAN null,
	tipo_antecendestes_personales_patologicos VARCHAR (500),
	--AFP SABER QUE SIGNIFICA
	--afp BOOLEAN null,
	--tipo_afp VARCHAR (500) null,
	--antecedentes_inmunoalergicos BOOLEAN null,
	tipo_antecedentes_inmunoalergicos VARCHAR (500) null,
	habitos VARCHAR (500) null,
	--antecedentes_hospitalarios_quirurgicos BOOLEAN null,
	tipos_antecedentes_hospitalarios_quirurgicos VARCHAR (500) null,
	motivo_cosulta VARCHAR (100) null,
	nota_motivo_cosulta VARCHAR (500) null,
	historia_enfermedad_actual VARCHAR (500) null,	
	created_at TIMESTAMP NOT null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null,
	CONSTRAINT fk_id_paciente foreign key(id_paciente) references public.reg_ficha_pacientes(id),
	CONSTRAINT fk_id_expediente foreign key(id_expediente) references public.tbl_tipos_expedientes(id),
	CONSTRAINT fk_id_tipo_sangre foreign key(id_tipo_sangre) references public.tbl_tipos_sangre(id)
);

CREATE TABLE tbl_gin_examen_fisico(
	id SERIAL PRIMARY KEY,
	id_paciente INTEGER not null,
	id_expediente INT NOT NULL,
	otorrinolaringologia VARCHAR (500) null,
	cardiopulmonar VARCHAR (500) NULL,
	abdomen VARCHAR (500) null,
	ginecologio VARCHAR (500) null,
	especulo VARCHAR (500) null,
	ultrasonido VARCHAR (500) null,
	created_at TIMESTAMP NOT null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null,
	CONSTRAINT fk_id_paciente foreign key(id_paciente) references public.reg_ficha_pacientes(id),
	CONSTRAINT fk_id_expediente foreign key(id_expediente) references public.tbl_tipos_expedientes(id)	
);

CREATE TABLE tbl_gin_diagnostico(
	id SERIAL PRIMARY KEY,
	id_paciente INTEGER not null,
	id_expediente INT not null,
	diangnostico VARCHAR (500) null,	
	created_at TIMESTAMP NOT null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null,
	CONSTRAINT fk_id_paciente foreign key(id_paciente) references public.reg_ficha_pacientes(id),
	CONSTRAINT fk_id_expediente foreign key(id_expediente) references public.tbl_tipos_expedientes(id)	
);

CREATE TABLE tbl_gin_plan(
	id SERIAL PRIMARY KEY,
	id_paciente INTEGER not null,
	id_expediente INT not null,
	plan VARCHAR (500) null,
	fecha_proxima_cita DATE null,
	created_at TIMESTAMP NOT null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null,	
	CONSTRAINT fk_id_paciente foreign key(id_paciente) references public.reg_ficha_pacientes(id),
	CONSTRAINT fk_id_expediente foreign key(id_expediente) references public.tbl_tipos_expedientes  (id)	
);
/*
CREATE TABLE tbl_gin_signos_vitales(
	id SERIAL PRIMARY KEY,
	id_paciente INTEGER not null,
	id_expediente INT not null,
	temperatura NUMERIC null,
	precion_arterial NUMERIC null,
	peso NUMERIC null, 
	talla NUMERIC null,
	saturacion NUMERIC null,
	frecuencia_cardiaca NUMERIC null,
	frecuencia_respiratoria NUMERIC null,
	indice_masa_coorporal NUMERIC null,
	gmt NUMERIC null,
	created_at TIMESTAMP NOT null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null,	
	CONSTRAINT fk_id_paciente foreign key(id_paciente) references public.reg_ficha_pacientes(id),
	CONSTRAINT fk_id_expediente foreign key(id_expediente) references public.tbl_tipos_expedientes(id)	
);*/
--fin expediente ginecologia

--inicio signos vitales
/*
CREATE TABLE tbl_signos_vitales(
	id SERIAL PRIMARY KEY,
	id_paciente INTEGER not null,
	id_expediente INT not null,
	temperatura NUMERIC null,
	precion_arterial NUMERIC null,
	peso NUMERIC null, 
	talla NUMERIC null,
	saturacion NUMERIC null,
	frecuencia_cardiaca NUMERIC null,
	frecuencia_respiratoria NUMERIC null,
	indice_masa_coorporal NUMERIC null,
	glucometria NUMERIC null,
	created_at TIMESTAMP NOT null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null,	
	CONSTRAINT fk_id_paciente foreign key(id_paciente) references public.reg_ficha_pacientes(id),
	CONSTRAINT fk_id_expediente foreign key(id_expediente) references public.tbl_tipos_expedientes(id)	
);
*/
 CREATE TABLE tbl_signos_vitales(
	id SERIAL PRIMARY KEY,
	id_paciente INTEGER not null,
	id_expediente INT not null,
	id_masa_corporal INT null,
	temperatura NUMERIC null,
	presion_arterial NUMERIC null,
	peso NUMERIC null, 
	talla NUMERIC null,
	saturacion NUMERIC null,
	frecuencia_cardiaca NUMERIC null,
	frecuencia_respiratoria NUMERIC null,
	--indice_masa_corporal text null,
	glucometria NUMERIC null,
	created_at TIMESTAMP NOT null,
	updated_at TIMESTAMP null,
	deleted_at TIMESTAMP null,	
	CONSTRAINT fk_id_paciente foreign key(id_paciente) references public.reg_ficha_pacientes(id),
	CONSTRAINT fk_id_expediente foreign key(id_expediente) references public.tbl_tipos_expedientes(id),
	CONSTRAINT fk_id_masa_corporal foreign key(id_masa_corporal) references public.tbl_indice_masa_corporal(id),
);
--fin signos vitales
