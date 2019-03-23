INSERT INTO `branches` (`branch_id`, `branch_name`, `branch_phone`, `branch_address`, `branch_created_at`, `branch_updated_at`)VALUES
	(1, 'Bogor', '0251', 'Jl Raya bogor', '2019-03-20 14:15:18', '2019-03-20 14:32:13'),
	(2, 'Jakarta', '021', 'Jakarta raya bogor', '2019-03-20 14:21:54', '2019-03-20 14:32:21'),
	(3, 'Cibinong', '0211', 'cibinong', '2019-03-20 14:33:40', NULL);

	INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_role`, `user_full_name`, `user_created_at`, `user_updated_at`, `branch_id`)VALUES
	(1, 'admin', '$2y$10$OymCnefZ.lzAMUUD/0m2duF8ehTiRtRzOWijpZnP1mUuhVRcl0Cwy', 'Super Admin', 'Administrator', '2019-03-16 22:02:33', '2019-03-20 15:03:06', 1);