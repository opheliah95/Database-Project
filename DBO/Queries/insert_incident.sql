USE VehicleDB;
INSERT INTO Incident (Incident_ID, Vehicle_ID, People_ID, Incident_Date, Incident_Report, Offence_ID, Officer_ID, Incident_Time) 
VALUES 		    (1, 15, 4, '2017-12-01', '40mph in a 30 limit', 1, 26, "12:28:15"), 
		    (2, 20, 8, '2017-11-01', 'Double parked', 4, 27, "22:40:20"), 
		    (3, 13, 4, '2017-09-17', '110mph on motorway', 1, 26, "20:38:35"), 
		    (4, 14, 2, '2017-08-22', 'Failure to stop at a red light - travelling 25mph', 8, 27, "10:15:09"), 
		    (5, 13, 4, '2017-10-17', 'Not wearing a seatbelt on the M1', 3, 27, "11:29:05");
