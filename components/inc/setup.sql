create table if not exists department(
    dno int PRIMARY KEY AUTO_INCREMENT,
    dname varchar(255),
    dlocation varchar(4095)
    );

create table if not exists employee(
    eid int AUTO_INCREMENT PRIMARY KEY,
    ename varchar(255),
    eaddress varchar(4095),
    eemail varchar(255),
    esex varchar(63),
    edesig int
    );
    