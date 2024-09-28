TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER `safe_member_id` BEFORE UPDATE ON `member` FOR EACH ROW BEGIN\nSET NEW.member_id = OLD.member_id;\nEND'
sql_modes=524288
definers='root@localhost'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_general_ci'
db_cl_names='utf8_general_ci'
created=170117904512
