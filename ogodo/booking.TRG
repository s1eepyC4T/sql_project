TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER checkin_out_date\nBEFORE INSERT ON booking\nFOR EACH ROW\nBEGIN\n    IF NEW.check_in_date >= NEW.check_out_date THEN\n        SIGNAL SQLSTATE \'45000\' \n    SET MESSAGE_TEXT = \'Check-in date must be before the check-out date\';\n    END IF;\nEND'
sql_modes=1436549152
definers='root@localhost'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_unicode_ci'
db_cl_names='utf8_general_ci'
created=170107134823
