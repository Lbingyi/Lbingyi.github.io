

DROP TABLE IF EXISTS `jiasuyo_admin_menu`;
CREATE TABLE `jiasuyo_admin_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_sort` int(11) DEFAULT NULL,
  `menu_name` varchar(255) DEFAULT NULL,
  `tabs` varchar(255) DEFAULT NULL,
  `menu_url` varchar(255) DEFAULT NULL,
  `menu_icon` varchar(255) DEFAULT NULL,
  `menu_types` varchar(255) NOT NULL DEFAULT 'left',
  `menu_levelid` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1886 DEFAULT CHARSET=utf8;


INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('1','1','系统','system','','fa fa-gear','left','0','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('3','3','文章','article','','fa fa-edit','left','0','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('5','5','外观','ui','','fa fa-th-large','left','0','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('8','8','应用(APP)','app','','fa fa-clone','left','0','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('9','9','用户','auth','','fa fa-gears','left','0','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('10','11','网站设置','','admin/netset/index','glyphicon glyphicon-cog','left','1','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('12','14','数据备份','','admin/netset/bak','fa fa-database','left','1','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('13','91','用户管理','','admin/user/index','glyphicon glyphicon glyphicon-user','left','9','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('15','81','应用设置','','admin/app/index','glyphicon glyphicon-tasks','left','8','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('16','85','授权卡','','admin/acard/index','fa fa-address-card-o','left','8','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('18','18','积分设置','','admin/score/index','fa fa-scribd','left','1','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('52','52','模板主题','','admin/theme/index','fa fa-window-restore','left','5','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('53','53','菜单','','admin/menu/index','fa fa-maxcdn','left','5','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('54','54','评论设置','','admin/comment/index','fa fa-comments-o','left','5','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('60','13','邮件设置','','admin/mail/index','fa fa-at','left','1','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('101','86','充值卡','','admin/card/index','fa fa-credit-card','left','8','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('103','777','支付帐单','','admin/order/index','fa fa-yen','left','1','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('104','888','支付设置','','admin/pay/index','fa fa-paypal','left','1','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('105','88','应用销售','','admin/goods/index','fa fa-shopping-cart','left','8','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('106','31','文章列表','','admin/article/index','glyphicon glyphicon-list','left','3','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('107','32','撰写文章','','admin/article/add','glyphicon glyphicon-pencil','left','3','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('108','33','分类目录','','admin/article/sorts','glyphicon glyphicon-folder-open','left','3','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('109','92','用户组管','','admin/authgroup/index','fa fa-users','left','9','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('110','93','权限节点','','admin/authrule/index','fa fa-connectdevelop','left','9','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('188','188','代理平台','agents','','fa fa-paw','left','0','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('1881','1881','代理商','','admin/agents/index','fa fa-user-secret','left','188','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('1882','1882','待认证','','admin/agents/wait','fa fa-user-o','left','188','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('1883','1883','代理分类','','admin/agents/types','fa fa-map','left','188','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('1884','1884','商品相关','','admin/agents/goods','fa fa-th-large','left','188','1');
INSERT INTO `jiasuyo_admin_menu` (`id`,`menu_sort`,`menu_name`,`tabs`,`menu_url`,`menu_icon`,`menu_types`,`menu_levelid`,`status`) VALUES ('1885','83','卡类管理','','admin/card/type','fa fa-cubes','left','8','1');


DROP TABLE IF EXISTS `jiasuyo_auth_rule`;
CREATE TABLE `jiasuyo_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `cond` char(100) NOT NULL DEFAULT '',
  `group` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;


INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('1','admin/AppCenter/index','应用中心','1','1','','','扩展');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('2','admin/Databak/index','备份数据库','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('3','admin/Databak/baklist','数据库备份列表','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('4','admin/Email/index','邮件设置','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('5','admin/Email/update','邮件设置保存','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('6','admin/Error/index','模块类公共入口','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('7','admin/Index/index','管理首页','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('8','admin/Index/myEdit','管理员修改密码页','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('9','admin/Index/inMyEdit','管理员确认修改密码','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('10','admin/Menu/menu','读取菜单数据','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('11','admin/Module/index','模块管理','1','1','','','扩展');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('12','admin/Module/lists','模块例表','1','1','','','扩展');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('13','admin/Order/index','支付订单管理','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('14','admin/Order/lists','支付订单列表','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('15','admin/Order/set','删除订单','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('16','admin/Pay/index','支付设置页','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('17','admin/Pay/vapayadd','免签支付设置','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('18','admin/Pay/saverainpay','保存Rain支付设置','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('19','admin/Pay/savealipay','保存支付宝设置','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('20','admin/Pay/upload','扫码支付上传','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('21','admin/Plug/index','插件管理','1','1','','','扩展');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('22','admin/Plug/lists','插件列表','1','1','','','扩展');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('23','admin/Score/index','积分设置','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('24','admin/Settings/index','网站设置','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('25','admin/Settings/update','保存网站设置','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('26','admin/SiteUpdate/index','网站更新','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('27','admin/Ueditor/index','百度编辑器权限','1','1','','','系统');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('28','admin/AuthRule/index','权限节点管理','1','1','','','用户');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('29','admin/AuthRule/add','添加权限节点','1','1','','','用户');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('30','admin/AuthRule/addModule','添加模块权限节点','1','1','','','用户');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('31','admin/AuthRule/edit','编辑权限节点','1','1','','','用户');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('32','admin/AuthRule/set','启停删权限节点','1','1','','','用户');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('33','admin/AuthRule/lists','权限节点列表','1','1','','','用户');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('34','user/Menu/menu','菜单栏','1','1','','','用户');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('35','admin/Role/index','角色管理','1','1','','','用户');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('36','admin/Role/add','添加角色','1','1','','','用户');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('37','admin/Role/inAdd','确认添加角色','1','1','','','用户');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('38','admin/Role/edit','编辑角色','1','1','','','用户');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('39','admin/Role/set','启/停/删角色','1','1','','','用户');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('40','admin/Role/lists','角色列表','1','1','','','用户');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('41','admin/User/index','用户管理','1','1','','','用户');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('42','admin/User/add','添加用户','1','1','','','用户');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('43','admin/User/inAdd','确认添加用户','1','1','','','用户');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('44','admin/User/edit','编辑用户','1','1','','','用户');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('45','admin/User/inEdit','确认编辑用户','1','1','','','用户');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('46','admin/User/set','启/停/删用户','1','1','','','用户');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('47','admin/User/lists','用户列表','1','1','','','用户');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('48','admin/Home/index','首页管理','1','1','','','页面');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('49','admin/Home/saves','保存首页管理','1','1','','','页面');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('50','home/Menu/menu','菜单栏','1','1','','','页面');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('51','admin/NavMenu/index','前台菜单管理','1','1','','','页面');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('52','admin/NavMenu/getlink','添加菜单','1','1','','','页面');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('53','admin/Page/index','文章管理','1','1','','','页面');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('54','admin/Page/sorts','文章分类','1','1','','','页面');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('55','admin/Page/sortset','文章分类设置','1','1','','','页面');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('56','admin/Page/addsort','添加文章分类','1','1','','','页面');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('57','admin/Page/editsort','编辑文章分类','1','1','','','页面');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('58','admin/Page/sortlist','文章分类列表','1','1','','','页面');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('59','admin/Page/lists','文章列表','1','1','','','页面');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('60','admin/Page/add','添加文章','1','1','','','页面');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('61','admin/Page/upload','文章文件上传','1','1','','','页面');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('62','admin/Page/set','文章停删设置','1','1','','','页面');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('63','admin/Page/edit','编辑文章','1','1','','','页面');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('64','admin/App/index','应用管理','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('65','admin/App/lists','应用列表','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('66','admin/App/add','添加应用','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('67','admin/App/edit','编辑应用','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('68','admin/App/set','应用启停删','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('69','admin/AppGoods/index','应用商品管理','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('70','admin/AppGoods/lists','应用商品列表','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('71','admin/AppGoods/add','添加应用商品','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('72','admin/AppGoods/upload','应用商品图片上传','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('73','admin/AppGoods/set','启停删应用商品','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('74','admin/AppGoods/edit','编辑应用商品','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('75','admin/AuthCode/index','授权码管理','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('76','admin/AuthCode/add','生成授权码','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('77','admin/AuthCode/set','增删改授权码','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('78','admin/AuthCode/edit','编辑授权码','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('79','admin/AuthCode/lists','授权码列表','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('80','app/Menu/menu','菜单栏','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('81','admin/RechargeCard/index','充值卡管理','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('82','admin/RechargeCard/add','生成充值卡','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('83','admin/RechargeCard/set','启停删充值卡','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('84','admin/RechargeCard/lists','充值卡列表','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('85','admin/RechargeCard/type','充值卡类型管理','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('86','admin/RechargeCard/typelist','充值卡类型列表','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('87','admin/RechargeCard/typeadd','添加充值卡类型','1','1','','','应用');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('88','admin/RechargeCard/typeset','启停删充值卡类型','1','1','','','代理');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('89','admin/Agents/index','代理商','1','1','','','代理');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('90','admin/Agents/set','启停删代理','1','1','','','代理');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('91','admin/Agents/agentsinfo','代理商祥细信息','1','1','','','代理');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('92','admin/Agents/agentslist','代理商卡列表','1','1','','','代理');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('93','admin/Agents/setdist','取消分配','1','1','','','代理');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('94','admin/Agents/wait','代理商认证','1','1','','','代理');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('95','admin/Agents/waitset','代理商认证设置','1','1','','','代理');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('96','admin/Agents/types','代理类型管理','1','1','','','代理');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('97','admin/Agents/typeset','删除代理类型','1','1','','','代理');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('98','admin/Agents/addtype','添加代理类型','1','1','','','代理');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('99','admin/Agents/edittype','编辑代理类型','1','1','','','代理');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('100','admin/Agents/goods','代理商品相关','1','1','','','代理');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('101','admin/Agents/goodsset','启停代理商品','1','1','','','代理');
INSERT INTO `jiasuyo_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`cond`,`group`) VALUES ('102','agents/Menu/menu','菜单栏','1','1','','','代理');


DROP TABLE IF EXISTS `jiasuyo_page_index`;
CREATE TABLE `jiasuyo_page_index` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;



INSERT INTO `jiasuyo_page_index` (`id`,`name`,`title`,`url`,`icon`,`content`) VALUES ('1','banner','加速哟 开启应用验证新时代','','','Hello，欢迎使用 加速哟管理系统');
INSERT INTO `jiasuyo_page_index` (`id`,`name`,`title`,`url`,`icon`,`content`) VALUES ('2','service1','服务器环境安装','','','');
INSERT INTO `jiasuyo_page_index` (`id`,`name`,`title`,`url`,`icon`,`content`) VALUES ('3','service2','WEB','','','');
INSERT INTO `jiasuyo_page_index` (`id`,`name`,`title`,`url`,`icon`,`content`) VALUES ('4','service3','APP','','','');
INSERT INTO `jiasuyo_page_index` (`id`,`name`,`title`,`url`,`icon`,`content`) VALUES ('5','footer','RainSoft','','','<p class="footer-navs">
            <a href="#">关于我们</a><a href="#">广告合作</a><a href="#">免责声明</a>
        </p>
        <p class="footer-links">
            <a target="_blank" href="#">Rain</a><a target="_blank" href="#">网络验证</a>
        </p> ');
INSERT INTO `jiasuyo_page_index` (`id`,`name`,`title`,`url`,`icon`,`content`) VALUES ('6','service','客户服务','http://www.jiasuyo.com','','<p>售前售后在线服务，解决你关于购买和使用的各种疑惑，你只需要用心使用</p>
			<p>为 5623+ 个用户服务</p>');




DROP TABLE IF EXISTS `jiasuyo_user_menu`;
CREATE TABLE `jiasuyo_user_menu` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) NOT NULL DEFAULT '1',
  `name` varchar(255) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `group` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;



INSERT INTO `jiasuyo_user_menu` (`Id`,`sort`,`name`,`controller`,`url`,`group`) VALUES ('1','1','我的订单','home/Order','home/Order/index','1');
INSERT INTO `jiasuyo_user_menu` (`Id`,`sort`,`name`,`controller`,`url`,`group`) VALUES ('2','2','我的充值卡','app/Usercard','app/UserCard/index','1');
INSERT INTO `jiasuyo_user_menu` (`Id`,`sort`,`name`,`controller`,`url`,`group`) VALUES ('3','99','个人资料','home/User','home/User/index','2');
INSERT INTO `jiasuyo_user_menu` (`Id`,`sort`,`name`,`controller`,`url`,`group`) VALUES ('4','100','修改密码','home/Repwd','home/Repwd/index','2');
INSERT INTO `jiasuyo_user_menu` (`Id`,`sort`,`name`,`controller`,`url`,`group`) VALUES ('5','3','我的授权卡','app/Useracard','app/UserAcard/index','1');
INSERT INTO `jiasuyo_user_menu` (`Id`,`sort`,`name`,`controller`,`url`,`group`) VALUES ('6','3','我的积分','home/Score','home/Score/index','2');



