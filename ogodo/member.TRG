TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER `check_upd_tel` BEFORE UPDATE ON `member` FOR EACH ROW BEGIN\n    IF NEW.m_tel = "" THEN\n        SET NEW.m_tel = OLD.m_tel;\n    END IF;\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER `check_upd_name` BEFORE UPDATE ON `member` FOR EACH ROW BEGIN\n    IF NEW.m_name = "" THEN\n        SET NEW.m_name = OLD.m_name;\n    END IF;\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER `check_upd_username` BEFORE UPDATE ON `member` FOR EACH ROW BEGIN\n    IF NEW.username = "" THEN\n        SET NEW.username = OLD.username;\n    END IF;\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER `check_upd_email` BEFORE UPDATE ON `member` FOR EACH ROW BEGIN\n    IF NEW.email = "" THEN\n        SET NEW.email = OLD.email;\n    END IF;\nEND'
sql_modes=1436549152 1436549152 1436549152 1436549152
definers='root@localhost' 'root@localhost' 'root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4' 'utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_unicode_ci' 'utf8mb4_unicode_ci' 'utf8mb4_unicode_ci' 'utf8mb4_unicode_ci'
db_cl_names='utf8_general_ci' 'utf8_general_ci' 'utf8_general_ci' 'utf8_general_ci'
created=170136930821 170136932690 170136934247 170136993923
