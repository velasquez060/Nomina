create database nomina;
use nomina;
create table empleado (
id_Usuario int not null auto_increment primary key,
nombre varchar(50) not null,
apellido varchar(50) not null,
cedula varchar(50) not null,
fechaNacimiento  varchar(50) not null,
celular varchar(50) not null,
direccion varchar(50) not null,
correo varchar(50) not null,
estadoCivil varchar(50) not null,
eps varchar(50)  null,
arl varchar(50)  null,
fondoPensiones varchar(50)  null,
fondoCesantias varchar(50)  null,
entidadBancaria varchar(50)  null,
numeroCuenta varchar (50) null,
fechaIngreso date not null,
fechaTerminacion date not null,
contactoEmergencia varchar(50) not null,
nuinfo_basemeroContactoEmergencia varchar(50) not null
);
drop table empleado;
create table info_base(
id_infobase int not null auto_increment primary key,
salario_basico double not null,
valor_dia double not null,
valor_hora double not null,
horas_trabajadas int not null,
valor_hora_extra double not null,
valor_hora_dominical_o_festiva double not null,
auxilio_transporte double not null,
recargo_nocturno double not null,
aporte_salud double not null,
aporte_pension double not null
);

create table info_nomina(
id_info_nomina int not null auto_increment primary key,
cantidad_dias_laborados int NOT NULL,
cantidad_dias_no_remunerados  int NULL,
cantidad_dias_incapacidad int NULL,
cantidad_horas_extras_reportadas int NULL,
cantidad_horas_reportadas_festivas_dominicales int NULL,
cantidad_horas_nocturnas int NULL,
cantidad_horas_trabajadas int NOT NULL,
cantidad_dias_trabajados_Aux_transporte int NOT NULL,
fecha_inicial_quincena Date NOT NULL,
fecha_final_quincena Date NOT NULL,
id_usuario int not null,  
id_infobase int not null,
foreign key (id_usuario) references empleado (id_usuario),
foreign key (id_infobase) references info_base (id_infobase)
);

create table prima
