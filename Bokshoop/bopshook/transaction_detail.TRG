TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER `check_amnt_bf_buy_isrt` BEFORE INSERT ON `transaction_detail` FOR EACH ROW BEGIN\nIF NEW.amount > (SELECT amount FROM stock WHERE stock.isbn = NEW.isbn) THEN\n	SIGNAL SQLSTATE \'45000\' \n	SET MESSAGE_TEXT = "The amount exceed the stock quantity!";\nEND IF;\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER `check_amnt_bf_buy_updt` BEFORE UPDATE ON `transaction_detail` FOR EACH ROW BEGIN\nIF NEW.amount > (SELECT amount FROM stock WHERE stock.isbn = NEW.isbn) THEN\n	SIGNAL SQLSTATE \'45000\' \n	SET MESSAGE_TEXT = "The amount exceed the stock quantity!";\nEND IF;\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER `safe_transaction_dt` BEFORE UPDATE ON `transaction_detail` FOR EACH ROW BEGIN\nSET NEW.transaction_id = OLD.transaction_id;\nEND'
sql_modes=524288 524288 524288
definers='root@localhost' 'root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci' 'utf8mb4_general_ci'
db_cl_names='utf8_general_ci' 'utf8_general_ci' 'utf8_general_ci'
created=170117904544 170117904547 170117904548
