TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER `safe_staff_id` BEFORE UPDATE ON `staff` FOR EACH ROW BEGIN\nSET NEW.staff_id = OLD.staff_id;\nEND'
sql_modes=524288
definers='root@localhost'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_general_ci'
db_cl_names='utf8_general_ci'
created=170117904518
