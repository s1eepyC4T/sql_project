TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER `upd_stock_on_sale` BEFORE UPDATE ON `transaction` FOR EACH ROW BEGIN\nIF (OLD.totalprice=0 AND NEW.totalprice > OLD.totalprice) THEN\nCALL upd_stock(OLD.transaction_id);\nEND IF;\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER `revert_stock_on_del` BEFORE DELETE ON `transaction` FOR EACH ROW BEGIN\nIF (OLD.totalprice!=0) THEN\nCALL revert_stock(OLD.transaction_id);\nEND IF;\nEND'
sql_modes=524288 524288
definers='root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci'
db_cl_names='utf8_general_ci' 'utf8_general_ci'
created=170117904538 170117904535
