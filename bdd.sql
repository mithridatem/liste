create database liste;
use liste;
create table user(
	id_user int auto_increment primary key not null,
    name_user varchar(50) null,
    first_name_user varchar(50) null,
    id_role int DEFAULT 1
)engine=InnoDB;
create table role(
	id_role int auto_increment primary key not null,
    name_role varchar(50)
)engine=InnoDB;
alter table user
add constraint fk_role
foreign key(id_role)
references role(id_role);
INSERT INTO role(name_role) VALUE
('Auncun'),
('Utilisateur'),
('Moderateur'),
('Admin');
INSERT INTO user(name_user, first_name_user) VALUES
('Mithridate', 'Mathieu'),
('Albert', 'Marie'),
('Dupond', 'Anne'),
('Durant', 'Jean');
