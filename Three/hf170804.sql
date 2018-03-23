DROP DATABASE
IF EXISTS Three_Pro;

CREATE DATABASE Three_Pro DEFAULT CHARACTER
SET 'utf8' COLLATE 'utf8_general_ci';
USE Three_Pro;


-- 权限菜单表
CREATE TABLE IF NOT EXISTS accessMenu(
	a_id INT PRIMARY KEY auto_increment, -- 菜单id
	a_name VARCHAR(10) NOT NULL, -- 菜单名称
	fid INT NOT NULL, -- 父id
	url text -- 地址
);

INSERT INTO accessMenu(a_name,fid,url)
VALUES('系统管理',0,''),
			('商品管理',0,''),
			('订单管理',0,''),
			('员工管理',1,'./index.php?a=userManag&c=showuser'),
			('用户管理',1,'./index.php?a=employManag&c=showEmploy'),
			('角色管理',1,'./index.php?a=roleManag&c=showrole'),
			('商品录入',2,'./index.php?a=goodsentry&c=showcom'),
			('商品信息',2,'./index.php?a=mcsinform&c=showMcsPage'),
			('未支付订单',3,'./index.php?a=nonpay&c=shownopay'),
			('已支付订单',3,'./index.php?a=havepay&c=showlastpay');

-- 角色表
CREATE TABLE IF NOT EXISTS role(
	r_id INT PRIMARY KEY auto_increment, -- 角色id
	r_name VARCHAR(6) NOT NULL, -- 角色名称
	ribe text -- 描述
)ENGINE=INNODB;
INSERT INTO role(r_name,ribe)
VALUES('超级管理员','系统管理员'),
			('经理','添加员工查看日报等'),
			('普通业务员','商品管理，订单管理'),
			('客服','订单管理');


-- 员工表
CREATE TABLE IF NOT EXISTS staff(
	s_id VARCHAR(6) NOT NULL PRIMARY KEY, -- 员工id
	s_pwd VARCHAR(32) NOT NULL, -- 员工密码
	s_name VARCHAR(4), -- 员工名称
	s_role INT NOT NULL,  -- 员工角色id
	state VARCHAR(4), -- 员工状态
	FOREIGN KEY(s_role) REFERENCES role(r_id)
)ENGINE=INNODB; 

INSERT INTO staff(s_id,s_pwd,s_name,s_role,state)
VALUES('S101',MD5('123'),'张三',1,'使用'),
			('S102',MD5('123'),'李四',2,'使用'),
			('S103',MD5('123'),'王五',3,'使用'),
			('S104',MD5('123'),'赵六',4,'使用');


-- 角色分配
CREATE TABLE IF NOT EXISTS roleParts(
	id INT PRIMARY KEY auto_increment, -- 角色分配id
	role_id INT NOT NULL, -- 角色id
	m_id INT NOT NULL, -- 菜单id
	FOREIGN KEY(role_id) REFERENCES role(r_id),
	FOREIGN KEY(m_id) REFERENCES accessmenu(a_id)
);

INSERT INTO roleParts(role_id,m_id)
VALUES(1,1),
			(1,2),
			(1,3),
			(1,4),
			(1,5),
			(1,6),
			(1,7),
			(1,8),
			(1,9),
			(1,10),
			(2,1),
			(2,2),
			(2,3),
			(2,4),
			(2,5),
			(2,7),
			(2,8),
			(2,9),
			(2,10),
			(3,2),
			(3,3),
			(3,7),
			(3,8),
			(3,9),
			(3,10),
			(4,1),
			(4,3),
			(4,5),
			(4,9),
			(4,10);

-- 商品类型表
CREATE TABLE IF NOT EXISTS t_commodtype
(
      typeid INT PRIMARY KEY auto_increment, -- 商品类型id
      t_name VARCHAR(4) -- 商品类型名称
);

INSERT INTO t_commodtype(t_name)
       values('女装'),
       ('女鞋'),
       ('男装'),
       ('男鞋'),
       ('美妆'),
       ('食品'),
       ('数码电器'),
       ('户外运动'),
       ('家纺家居'),
       ('医药保健'),
       ('手表配饰');

-- 秒杀时段表
CREATE TABLE IF NOT EXISTS t_secondkilltime
(
       secondid INT PRIMARY KEY auto_increment, -- 时段id     
       starttime INT, -- 开始时间
       endtime INT -- 结束时间
);
insert into t_secondkilltime(starttime,endtime)      
       values(8,9),      
       (9,10),
       (10,11),       
       (11,12),
       (12,13),       
       (13,14),       
       (14,15),
       (15,16),       
       (16,17),
       (17,18);

-- 普通商品表
CREATE TABLE IF NOT EXISTS n_merchandise
(
	 n_mcsid INT PRIMARY KEY auto_increment,      -- 商品ID 
	 n_mcsidname text,       -- 商品名字
	 n_typeid INT NOT NULL,       -- 商品类型
	 n_mcsimg text,				-- 商品图片
	 n_originalprice VARCHAR(6),      -- 原价
	 n_alltory INT,       -- 总库存
	 n_surplus INT,       -- 剩余库存
	 n_note text,				-- 备注
	 n_shelves DATE,			-- 上架时间
	 n_releaseTime DATE, 			-- 发布时间
	 n_mcsState text,     -- 商品状态
	 n_publishType	text,		-- 发布类型
	 FOREIGN KEY(n_typeid) REFERENCES t_commodtype(typeid)
);

 
-- 商品表
CREATE TABLE IF NOT EXISTS s_merchandise
(
	 s_mcsid INT NOT NULL PRIMARY KEY auto_increment,      -- 商品ID 
	 s_mcsidname text,       -- 商品名字
	 s_typeid INT NOT NULL,       -- 商品类型
	 s_mcsimg text,				-- 商品图片
	 s_originalprice VARCHAR(6),      -- 原价
	 s_secondprice INT NOT NULL,       -- 秒杀价
	 s_alltory INT,       -- 总库存
	 s_surplus INT,       -- 剩余库存
	 s_num INT,           -- 限定秒杀数量
	 s_startdates DATE,    -- 开始时间
	 s_stopdates DATE,     -- 结束时间
	 s_secondid INT,       -- 秒杀时间ID
	 s_note text,				-- 备注
	 s_shelves DATE,			-- 上架时间
	 s_releaseTime DATE, 			-- 发布时间
	 s_mcsState text,     -- 商品状态
	 s_publishType	text,		-- 发布类型
	 FOREIGN KEY(s_typeid) REFERENCES t_commodtype(typeid),
	 FOREIGN KEY(s_secondid) REFERENCES t_secondkilltime(secondid)	
);

INSERT INTO s_merchandise(s_mcsidname,s_typeid,s_mcsimg,s_originalprice,s_secondprice,s_alltory,s_surplus,s_num,s_startdates,s_stopdates,s_secondid,s_note,s_shelves,s_releaseTime,s_mcsState,s_publishType)
VALUES
('加绒连帽中长款卫衣女版','1','../backStage/view/images/Women02_max.png',220,109,500,10,0,'','',1,'黑色',NOW(),NOW(),'上架','普通'),
('欧洲2018新款羽绒服','1','../backStage/view/images/Women04_max.png',1080,399,100,10,'1','2018-01-26','2018-02-28',4,'长款','',NOW(),'上架','秒杀'),
('日版学生款连帽冬季棉服','1','../backStage/view/images/Women05_max.png',330,130,1000,10,'1','2018-01-31','2018-02-28',2,'青春版','',NOW(),'上架','秒杀'),
('舒适切尔茜鞋女款','2','../backStage/view/images/women_shoes05_max.png',330,288,300,10,0,'','',1,'加绒保暖',NOW(),NOW(),'上架','普通'),
('磨砂牛皮蝴蝶结短靴','2','../backStage/view/images/women_shoes01.webp.jpg',440,364,1000,10,0,'','',1,'雪地靴',NOW(),NOW(),'上架','普通'),
('磨砂兔毛雪地靴','2','../backStage/view/images/women_shoes04.webp.jpg',716,354,500,10,'1','2018-01-31','2018-02-28',7,'加绒加厚','',NOW(),'上架','秒杀'),
('羊羔毛工装冬季棉衣','3','../backStage/view/images/man05_max.png',220,168,1000,10,0,'','',1,'加厚型','',NOW(),'下架','普通'),
('花花公子加绒休闲库','3','../backStage/view/images/man04_max.png',288,108,1000,10,'1','2018-01-31','2018-02-28',5,'加厚加绒','',NOW(),'上架','秒杀'),
('头层牛皮高层鞋','4','../backStage/view/images/man_shoes05_max.png',330,228,1000,10,0,'','',1,'加绒/皮里两选',NOW(),NOW(),'上架','普通'),
('花花公子男鞋冬季加绒','4','../backStage/view/images/man_shoes01_max.png',220,188,1000,10,0,'','',1,'豆豆鞋',NOW(),NOW(),'上架','普通'),
('牛筋真皮男鞋','4','../backStage/view/images/man_shoes02_max.png',208,119,1000,10,'1','2018-01-31','2018-02-28',7,'加绒可选','',NOW(),'上架','秒杀'),
('屈臣氏超薄嫩白巨补水面膜','5','../backStage/view/images/makeup02_max.png',110,69,10000,10,0,'','',1,'1',NOW(),NOW(),'上架','普通'),
('丸美巧克力青春丝洁面水水乳','5','../backStage/view/images/makeup04_max.png',476,308,1000,10,'1','2018-01-31','2018-02-28',8,'保湿','',NOW(),'未上架','秒杀'),
('丸美雪绒花纯净补水套装','5','../backStage/view/images/makeup03_max.png',999,678,100,10,'1','2018-01-31','2018-02-28',6,'洁面型','',NOW(),'未上架','秒杀'),
('甘肃红苹果12个装','6','../backStage/view/images/food04_max.png',80,39,10000,10,'1','2018-01-31','2018-02-28',4,'礼县产','',NOW(),'上架','秒杀'),
('法国波尔多红酒6支装','6','../backStage/view/images/food02_max.png',330,286,1000,10,0,'','',1,'买一送十',NOW(),NOW(),'上架','普通'),
('大连即食海参60只','6','../backStage/view/images/food05_max.png',3200,699,1000,10,'1','2018-01-31','2018-02-28',3,'4斤4两','',NOW(),'上架','秒杀'),
('格力取暖器','7','../backStage/view/images/appliance04_max.png',110,98,1000,10,0,'','',1,'家用节能型',NOW(),NOW(),'上架','普通'),
('小米小寻儿童电话手表','7','../backStage/view/images/appliance03_max.png',220,159,1000,10,0,'','',1,'GPS导航',NOW(),NOW(),'上架','普通'),
('格力电冰箱','7','../backStage/view/images/appliance02_max.png',1009,699,100,10,'1','2018-01-31','2018-02-28',6,'小型家用版','',NOW(),'未上架','秒杀'),
('超款8KG滚筒洗衣机','7','../backStage/view/images/appliance01_max.png',3330,2599,100,10,0,'','',1,'3000+好评','',NOW(),'下架','普通'),
('电暖桌家用多功能取暖烤火炉','7','../backStage/view/images/appliance05_max.png',3000,799,100,10,'1','2018-01-31','2018-02-28',7,'多功能','',NOW(),'未上架','秒杀'),
('男女瘦身升级版减值机','8','../backStage/view/images/sports04_max.png',110,58,1000,10,0,'','',1,'升级版',NOW(),NOW(),'上架','普通'),
('优步跑步机 自动降调','8','../backStage/view/images/sports05_max.png',5008,1998,100,10,'1','2018-01-31','2018-02-28',8,'免安装','',NOW(),'上架','秒杀'),
('儿童/成人智能平衡车','8','../backStage/view/images/sports01_maxa.png',3000,998,1000,10,'1','2018-01-31','2018-02-28',8,'儿童/成人款课选','',NOW(),'未上架','秒杀'),
('凤凰自行车20寸变速折叠','8','../backStage/view/images/sports03_max.png',880,738,1000,10,0,'','',1,'折叠版',NOW(),NOW(),'上架','普通'),
('TATA木门 简约油漆室内门','9','../backStage/view/images/furnishings01_max.png',3330,2299,100,10,0,'','',1,'静音版',NOW(),NOW(),'上架','普通'),
('智能全自动抽水马桶','9','../backStage/view/images/furnishings03_max.png',3330,2588,1000,10,0,'','',1,'3L超省水',NOW(),NOW(),'上架','普通'),
('别郎格指纹锁','9','../backStage/view/images/furnishings04_max.png',3060,1668,1000,10,'1','2018-01-31','2018-02-28',10,'防盗锁','',NOW(),'上架','秒杀'),
('ARIS 爱依瑞斯软床','9','../backStage/view/images/furnishings02_max.png',4430,3599,100,10,0,'','',1,'简约风',NOW(),NOW(),'上架','普通'),
('美国蕾丝羊毛独立床店','9','../backStage/view/images/furnishings05_max.png',5500,4550,100,10,'1','2018-01-31','2018-02-28',8,'羊毛乳胶','',NOW(),'未上架','秒杀'),
('鱼跃品牌雾化器','10','../backStage/view/images/care04_max.png',330,279,1000,10,0,'','',1,'雾大细腻',NOW(),NOW(),'上架','普通'),
('补碘维尔口嚼片','10','../backStage/view/images/care03_max.png',338,238,1000,10,'1','2018-01-31','2018-02-28',10,'保健品','',NOW(),'上架','秒杀'),
('灵芝孢子粉','10','../backStage/view/images/care02_max.png',330,239,1000,10,0,'','',1,'提高免疫力',NOW(),NOW(),'上架','普通'),
('冠琴商务全自动机械表','11','../backStage/view/images/watch03_max.png',330,258,1000,10,0,'','',1,'全自动',NOW(),NOW(),'上架','普通'),
('子非鱼3D硬金手链','11','../backStage/view/images/watch04_max.png',1089,699,1000,10,'1','2018-01-31','2018-02-28',10,'凯蒂猫黄金','',NOW(),'上架','秒杀'),
('多功能全自动机械表','11','../backStage/view/images/watch02_max.png',1080,468,1000,10,'1','2018-01-31','2018-02-28',10,'全自动','',NOW(),'上架','秒杀');

-- 用户表
CREATE TABLE IF NOT EXISTS t_user
( 
	 userid VARCHAR(12) NOT NULL PRIMARY KEY,    -- 用户ID   
	 userpsd VARCHAR(32),       -- 密码
	 headimg text,        -- 头像
	 nickname VARCHAR(6),       -- 昵称
	 registime DATETIME,      -- 注册时间
	 balance INT,       -- 余额
	 payPsd VARCHAR(32),      -- 支付密码
	 state	text			-- 使用状态
);
INSERT INTO t_user(userid,userpsd,headimg,nickname,registime,balance,payPsd,state)
VALUES('10001',MD5('123'),'./view/images/headImg1.jpg','用户一',NOW(),0,MD5('123'),'使用'),
			('10002',MD5('123'),'./view/images/headImg2.jpg','用户二',NOW(),0,MD5('123'),'使用'),
			('10003',MD5('123'),'./view/images/headImg3.jpg','用户三',NOW(),0,MD5('123'),'使用'),
			('10004',MD5('123'),'./view/images/headImg4.jpg','用户四',NOW(),0,MD5('123'),'使用'),
			('10005',MD5('123'),'./view/images/headImg5.jpg','用户五',NOW(),0,MD5('123'),'使用'),
			('10006',MD5('123'),'./view/images/headImg6.jpg','用户六',NOW(),0,MD5('123'),'使用');
-- 购物车表
CREATE TABLE IF NOT EXISTS shopcart (
		shopid INT NOT NULL PRIMARY KEY auto_increment, -- 购物车id
		u_id VARCHAR(8) NOT NULL, -- 用户id
		m_id INT NOT NULL, -- 商品id
		mcsimg text, -- 商品图片
		mcsname text,  -- 商品名称
		price INT NOT NULL, -- 商品价格
		status VARCHAR(6),  -- 状态 
		shoptime DATETIME, -- 购买时间
		FOREIGN KEY(u_id) REFERENCES t_user(userid),
		FOREIGN KEY(m_id) REFERENCES s_merchandise(s_mcsid)
);

-- 订单表
CREATE TABLE IF NOT EXISTS t_order(
		orderid INT NOT NULL PRIMARY KEY auto_increment,
		u_id VARCHAR(8) NOT NULL,      
		m_id INT NOT NULL, 
		mcsimg text,
		mcsname text,      
		price INT NOT NULL,
		status VARCHAR(6),      
		ordertime DATETIME
);
INSERT INTO t_order(u_id,m_id,mcsimg,mcsname,price,status,ordertime) VALUES
('10001',1,'view/images/mz1.jpg','屈臣氏买断货保湿补水面膜',168,'已支付',NOW()),
('10002',2,'view/images/mz2.jpg','英伦潮流马丁靴',358,'已支付',NOW()),
('10003',3,'view/images/mz3.jpg','多功能全自动机械表',1688,'已支付',NOW()),
('10004',4,'view/images/mz4.jpg','灵芝孢子粉',68,'已支付',NOW()),
('10005',5,'view/images/mz5.jpg','凤凰自行车20寸变速折叠',368,'已支付',NOW()),
('10006',6,'view/images/mz6.jpg','丸美弹力白眼霜',238,'已支付',NOW()),
('10001',1,'view/images/mz1.jpg','屈臣氏买断货保湿补水面膜',168,'未支付',NOW()),
('10002',2,'view/images/mz2.jpg','英伦潮流马丁靴',358,'未支付',NOW()),
('10003',3,'view/images/mz3.jpg','多功能全自动机械表',1688,'未支付',NOW()),
('10004',4,'view/images/mz4.jpg','灵芝孢子粉',68,'未支付',NOW()),
('10005',5,'view/images/mz5.jpg','凤凰自行车20寸变速折叠',368,'未支付',NOW()),
('10006',6,'view/images/mz6.jpg','丸美弹力白眼霜',238,'未支付',NOW());
