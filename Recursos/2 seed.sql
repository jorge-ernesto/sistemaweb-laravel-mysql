/******************************Seeder******************************/
-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Admin', 'admin@admin.com', NULL, '$2y$10$daaHiiUUls.0vAlAyb.nMewZ8t746pYM6W/I4amN4YufRsQpQ7fPe', NULL, '2022-06-14 23:56:04', '2022-06-14 23:56:04');
INSERT INTO `users` VALUES (2, 'User', 'user@user.com', NULL, '$2y$10$XykPWw2Mpf73RTCx0fDP.uOi/OvNRSox3YDw6.DuCVBOIB2p7H/42', NULL, '2022-06-14 23:56:57', '2022-06-14 23:56:57');
INSERT INTO `users` VALUES (3, 'Guest', 'guest@guest.com', NULL, '$2y$10$NhuG3hTjWeyw05UoVqAiN.XPt7sSATZ82Xn8EUj4j55GkLyhk3/cW', NULL, '2022-06-15 00:00:41', '2022-06-15 00:00:41');

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'ROLE_ADMIN', 'ROLE_ADMIN', 'Admin', 'yes', '2020-11-01 00:18:22', '2020-11-01 00:18:22');
INSERT INTO `roles` VALUES (2, 'ROLE_USER', 'ROLE_USER', 'User', 'no', '2020-11-01 00:18:22', '2020-11-01 00:18:22');
INSERT INTO `roles` VALUES (3, 'ROLE_INVITADO', 'ROLE_INVITADO', 'Invitado', 'no', '2020-11-01 00:18:22', '2020-11-01 00:18:22');

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES (1, 1, 1, '2020-11-01 00:18:22', '2020-11-01 00:18:22');
INSERT INTO `role_user` VALUES (2, 2, 2, '2020-11-01 00:18:22', '2020-11-03 00:17:30');
INSERT INTO `role_user` VALUES (3, 3, 3, '2020-11-01 00:18:22', '2020-11-01 00:18:22');

/******************************curso_laravel******************************/
-- ----------------------------
-- Records of categoria
-- ----------------------------
INSERT INTO `categoria` VALUES (1, 'Categoria 1', 'Categoria 1', 1);
INSERT INTO `categoria` VALUES (2, 'Categoria 2', 'Categoria 2', 1);
INSERT INTO `categoria` VALUES (3, 'Categoria 3', 'Categoria 3', 1);

-- ----------------------------
-- Records of articulo
-- ----------------------------
INSERT INTO `articulo` VALUES (1, 1, '00000000001', 'Cable de impresora', 100, 'Cable de impresora', '1485910808.jpg', 'Activo');
INSERT INTO `articulo` VALUES (2, 1, '00000000002', 'Impresora', 200, 'Impresora', '1491149398.jpeg', 'Activo');

-- ----------------------------
-- Records of persona
-- ----------------------------
INSERT INTO `persona` VALUES (1, 'Cliente', 'Cliente 1', 'RUC', '99999999999', NULL, NULL, NULL);
INSERT INTO `persona` VALUES (2, 'Proveedor', 'Proveedor 1', 'RUC', '99999999998', NULL, NULL, NULL);

-- ----------------------------
-- Records of ingreso
-- ----------------------------
INSERT INTO `ingreso` VALUES (1, 2, 'Boleta', 'Synthes', '1', '2020-11-24 19:39:38', 18.00, 'Anulado');
INSERT INTO `ingreso` VALUES (2, 2, 'Boleta', 'Synthes', '2', '2020-11-24 19:42:18', 18.00, 'Anulado');
INSERT INTO `ingreso` VALUES (3, 2, 'Boleta', 'Synthes', '3', '2020-11-24 19:42:57', 18.00, 'Aceptado');

-- ----------------------------
-- Records of detalle_ingreso
-- ----------------------------
INSERT INTO `detalle_ingreso` VALUES (1, 1, 1, 20, 100.00, 150.00);
INSERT INTO `detalle_ingreso` VALUES (2, 1, 2, 9, 20.00, 30.00);
INSERT INTO `detalle_ingreso` VALUES (3, 2, 1, 3, 20.00, 35.00);
INSERT INTO `detalle_ingreso` VALUES (4, 3, 1, 3, 30.00, 50.00);
INSERT INTO `detalle_ingreso` VALUES (5, 3, 2, 3, 500.00, 650.00);
