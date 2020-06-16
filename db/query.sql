create table if not EXISTS tbl_Programme
(
PK_ID int PRIMARY key AUTO_INCREMENT,
ProgrammeName varchar(50) not null,
TotalFee int default 0,
Advance int default 0,
Certification int default 0,
Tuition int default 0
);
create table if not EXISTS tbl_Batch
(
PK_ID int PRIMARY key AUTO_INCREMENT,
BatchID varchar(50)
);
create table if not EXISTS tbl_User
(
PK_ID int PRIMARY KEY AUTO_INCREMENT,
FullName varchar(50) not null,
Username varchar(50) unique not null,
StudentID varchar(50) unique not null,
IsAdvancePaid boolean default 0,
CourseStatus boolean default 0,
ContactNumber varchar(50),
PaidFee int DEFAULT 0,
Password varchar(50) not null,
FK_Programme int,
constraint FK_Programme foreign key(FK_Programme) references tbl_Programme(PK_ID),
FK_Batch int,
constraint FK_Batch foreign key(FK_Batch) references tbl_Batch(PK_ID)
);
create table if not EXISTS tbl_Attendance
(
PK_ID int PRIMARY key AUTO_INCREMENT,
FK_User int,
constraint FK_User foreign key(FK_User) references tbl_User(PK_ID),
TotalSessions int default 0,
AttendedSessions int default 0,
RemainingSessions int default 0
);
create table if not EXISTS tbl_Admin
(
PK_ID int PRIMARY key AUTO_INCREMENT,
Username varchar(50) unique not null,
Password varchar(50) not null,
ContactNumber varchar(50),
FullName varchar(50)
);
