ALTER TABLE tbl_user
ADD ResetToken varchar(100)

ALTER TABLE tbl_user
ADD Email varchar(50)

ALTER TABLE tbl_user
ADD JoinigData date

ALTER TABLE tbl_programme
ADD TotalSessions int

ALTER TABLE tbl_attendance
drop COLUMN TotalSessions

Create TABLE tbl_Semester
(
PK_ID int PRIMARY key AUTO_INCREMENT,
SemesterName varchar(50),
TotalSessions int,
FK_ProgrammeSemester int,
constraint FK_ProgrammeSemester foreign key(FK_ProgrammeSemester) references tbl_programme(PK_ID)
)

ALTER TABLE tbl_Semester
ADD COLUMN Position int

INSERT INTO `tbl_semester`(`SemesterName`, `TotalSessions`, `FK_ProgrammeSemester`, `Position`) VALUES ('CPISM', '72', 1, 1);
INSERT INTO `tbl_semester`(`SemesterName`, `TotalSessions`, `FK_ProgrammeSemester`, `Position`) VALUES ('DISM', '72', 1, 2);
INSERT INTO `tbl_semester`(`SemesterName`, `TotalSessions`, `FK_ProgrammeSemester`, `Position`) VALUES ('HDSE I', '72', 1, 3);
INSERT INTO `tbl_semester`(`SemesterName`, `TotalSessions`, `FK_ProgrammeSemester`, `Position`) VALUES ('HDSE II', '72', 1, 4);
INSERT INTO `tbl_semester`(`SemesterName`, `TotalSessions`, `FK_ProgrammeSemester`, `Position`) VALUES ('ADSE I', '72', 1, 5);
INSERT INTO `tbl_semester`(`SemesterName`, `TotalSessions`, `FK_ProgrammeSemester`, `Position`) VALUES ('ADSE II', '72', 1, 6);

ALTER TABLE tbl_user
ADD COLUMN CurrentSemester int;