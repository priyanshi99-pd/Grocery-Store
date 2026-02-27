
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `typroject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `uid` int NOT NULL,
  `uname` varchar(30) DEFAULT NULL,
  `upass` varchar(50) DEFAULT NULL
);

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`uid`, `uname`, `upass`) VALUES
(0, 'admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
CREATE TABLE IF NOT EXISTS `bill` (
  `bill_no` int NOT NULL AUTO_INCREMENT,
  `subtotal` varchar(10) DEFAULT NULL,
  `gst` varchar(10) DEFAULT NULL,
  `grandtotal` varchar(10) DEFAULT NULL,
  `billdate` date DEFAULT NULL,
  `cuname` varchar(30) DEFAULT NULL,
  `ostatus` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`bill_no`)
);

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`bill_no`, `subtotal`, `gst`, `grandtotal`, `billdate`, `cuname`, `ostatus`) VALUES
(1, '806', '145.08', '951.08', '0000-00-00', 'mohan123', 'In Transit'),
(2, '256', '46.08', '302.08', '2022-05-24', 'rohan123', 'In Transit'),
(3, '200', '36', '236', '2022-05-24', 'mohan123', 'Ordered'),
(4, '100', '18', '118', '2022-05-24', 'mohan123', 'Ordered'),
(5, '280', '50.4', '330.4', '2022-05-24', 'mohan123', 'Ordered'),
(6, '150', '27', '177', '2022-05-24', 'mohan123', 'Ordered');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `cuname` varchar(30) NOT NULL,
  `cpass` varchar(50) DEFAULT NULL,
  `cname` varchar(50) DEFAULT NULL,
  `cmob` varchar(15) DEFAULT NULL,
  `cadd` varchar(100) DEFAULT NULL,
  `pincode` varchar(6) DEFAULT NULL,
  `cemail` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cuname`)
); 

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cuname`, `cpass`, `cname`, `cmob`, `cadd`, `pincode`, `cemail`) VALUES
('mohan123', 'e2fc714c4727ee9395f324cd2e7f331f', 'Mohan Pal', '9874563215', 'Pune', '411030', 'mohan@gmail.com'),
('rohan123', 'e2fc714c4727ee9395f324cd2e7f331f', 'rohan pattar', '9758475874', 'Pune', '411045', 'rohan@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table various category
--

CREATE TABLE vegetables (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    price INT,
    img VARCHAR(255)
);

INSERT INTO vegetables (id, name, price, img) VALUES
(1, 'Tomato', 30, '../images/vegetables/tomato.png'),
(2, 'Brinjal', 40, '../images/vegetables/brinjal.png'),
(3, 'Brocoly', 50, '../images/vegetables/brocoly.png'),
(4, 'Cabbage', 30, '../images/vegetables/cabbage.png'),
(5, 'Capsicum', 60, '../images/vegetables/capsicum.png'),
(6, 'Drumstick', 80, '../images/vegetables/drumstick.png'),
(7, 'Ladiesfinger', 100, '../images/vegetables/ladiesfinger.png'),
(8, 'Peas', 50, '../images/vegetables/peas.png'),
(9, 'Potato', 30, '../images/vegetables/potato.png'),
(10, 'Corn', 70, '../images/vegetables/corn.png'),
(11, 'Onion', 60, '../images/vegetables/onion.png'),
(12, 'Cauliflower', 20, '../images/vegetables/cauliflower.png');



CREATE TABLE fruits (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    price INT,
    img VARCHAR(255)
);

INSERT INTO fruits (id, name, price, img) VALUES
(1, 'Apple', 180, '../images/fruits/apple.png'),
(2, 'Custard_apple', 100, '../images/fruits/custard_apple.png'),
(3, 'Dragon fruit', 150, '../images/fruits/dragon_fruit.png'),
(4, 'Grapes', 120, '../images/fruits/grapes.png'),
(5, 'Guava', 90, '../images/fruits/guava.png'),
(6, 'Kiwi', 250, '../images/fruits/kiwi.png'),
(7, 'Mango', 120, '../images/fruits/mango.png'),
(8, 'Orange', 60, '../images/fruits/orange.png'),
(9, 'Pineapple', 70, '../images/fruits/pineapple.png'),
(10, 'Pomogranade', 120, '../images/fruits/pomogranade.png'),
(11, 'starfruit', 150, '../images/fruits/starfruit.png'),
(12, 'Watermelon', 40, '../images/fruits/watermelon.png');



CREATE TABLE dairy (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    price INT,
    img VARCHAR(255)
);

INSERT INTO dairy (id, name, price, img) VALUES
(1, 'Butter', 40, '../images/dairy/butter.png'),
(2, 'Buttermilk', 30, '../images/dairy/buttermilk.png'),
(3, 'Cheese', 50, '../images/dairy/cheese.png'),
(4, 'Cream', 20, '../images/dairy/cream.png'),
(5, 'Curd', 25, '../images/dairy/curd.png'),
(6, 'Ghee', 250, '../images/dairy/ghee.png'),
(7, 'Lassi', 20, '../images/dairy/lassi.png'),
(8, 'Milk', 30, '../images/dairy/milk.png'),
(9, 'Milkshake', 35, '../images/dairy/milkshake.png'),
(10, 'Paneer', 50, '../images/dairy/paneer.png'),
(11, 'Rabri', 60, '../images/dairy/rabri.png'),
(12, 'Yogurt', 45, '../images/dairy/yogurt.png');


CREATE TABLE snacks (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    price INT,
    img VARCHAR(255)
);

INSERT INTO snacks (id, name, price, img) VALUES
(1, 'Bhel', 20, '../images/snacks/bhel.png'),
(2, 'Bhujia', 15, '../images/snacks/bhujia.png'),
(3, 'Cheeslings', 25, '../images/snacks/cheeslings.png'),
(4, 'Hearts', 20, '../images/snacks/hearts.png'),
(5, 'Krack jack', 20, '../images/snacks/krackjack.png'),
(6, 'Kurkure', 20, '../images/snacks/kurkure.png'),
(7, 'Lays', 20, '../images/snacks/lays.png'),
(8, 'Monaco', 15, '../images/snacks/monaco.png'),
(9, 'Namakpara', 25, '../images/snacks/np.png'),
(10, 'Peanuts', 20, '../images/snacks/peanuts.png'),
(11, 'Popcorn', 20, '../images/snacks/popcorn.png'),
(12, 'Snappers', 25, '../images/snacks/snappers.png');


CREATE TABLE care (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    price INT,
    img VARCHAR(255)
);

INSERT INTO care (id, name, price, img) VALUES
(1, 'Bodywash', 450, '../images/care/bodywash.png'),
(2, 'Hair Conditioner', 210, '../images/care/conditioner.png'),
(3, 'Moisturising cream', 220, '../images/care/cream.png'),
(4, 'Facewash', 150, '../images/care/facewash.png'),
(5, 'Hairmask', 250, '../images/care/hairmask.png'),
(6, 'Perfume', 4500, '../images/care/perfume.png'),
(7, 'Body Powder', 100, '../images/care/powder.png'),
(8, 'Sanitizer', 120, '../images/care/sanitizer.png'),
(9, 'Hair Serum', 600, '../images/care/serum.png'),
(10, 'Shampoo', 250, '../images/care/shampoo.png'),
(11, 'Body Soap', 100, '../images/care/soap.png'),
(12, 'Sunscreen', 300, '../images/care/sunscreen.png');



CREATE TABLE beverages (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    price INT,
    img VARCHAR(255)
);

INSERT INTO beverages (id, name, price, img) VALUES
(1, 'Buttermilk', 30, '../images/beverages/buttermilk.png'),
(2, 'Coconut water', 35, '../images/beverages/coconut_water.png'),
(3, 'Coca cola', 45, '../images/beverages/coke.png'),
(4, 'Ice tea', 50, '../images/beverages/icetea.png'),
(5, 'KOOL coffee', 30, '../images/beverages/kool_cafe.png'),
(6, 'Lassi', 35, '../images/beverages/lassi.png'),
(7, 'Mango Shake', 35, '../images/beverages/mangoshake.png'),
(8, 'Amul KOOL(Badam)', 40, '../images/beverages/milk_shake.png'),
(9, 'Milk Shake', 25, '../images/beverages/milk.png'),
(10, 'Mocktail', 30, '../images/beverages/mocktail.png'),
(11, 'Orange Juice', 30, '../images/beverages/orange_juice.png'),
(12, 'Sprite', 20, '../images/beverages/sprite.png');


CREATE TABLE spices (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    price INT,
    img VARCHAR(255)
);

INSERT INTO spices (id, name, price, img) VALUES
(1, 'Achar Masala', 30, '../images/spices/aachar.png'),
(2, 'Black Papper', 40, '../images/spices/black_pepper.png'),
(3, 'Chhole masala', 30, '../images/spices/chhole.png'),
(4, 'Red Chilly Powder', 40, '../images/spices/chilly.png'),
(5, 'Garam Masala', 35, '../images/spices/garam_masala.png'),
(6, 'Kitchen king masala', 40, '../images/spices/kitchen_king.png'),
(7, 'PauBhaji Masala', 30, '../images/spices/pau_bhaji.png'),
(8, 'Turmeric Powder', 20, '../images/spices/turmeric.png'),
(9, 'Rajwadi Masala', 30, '../images/spices/rajwadi.png'),
(10, 'Rasam Masala', 35, '../images/spices/rasam.png'),
(11, 'Sambhar Masala', 25, '../images/spices/sambar.png'),
(12, 'Shahi Paneer Masala', 40, '../images/spices/shahi_paneer.png');


CREATE TABLE dryfruit (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    price INT,
    img VARCHAR(255)
);

INSERT INTO dryfruit (id, name, price, img) VALUES
(1, 'Almonds', 400, '../images/dryfruit/almonds.png'),
(2, 'Apricots', 350, '../images/dryfruit/apricots.png'),
(3, 'Cashew', 500, '../images/dryfruit/cashew.png'),
(4, 'Cranberry', 250, '../images/dryfruit/cranberry.png'),
(5, 'Dates', 200, '../images/dryfruit/dates.png'),
(6, 'Fig', 700, '../images/dryfruit/figs.png'),
(7, 'Hazelnuts', 900, '../images/dryfruit/hazelnuts.png'),
(8, 'Mixed dryfruit', 450, '../images/dryfruit/mixed.png'),
(9, 'Nutmix', 750, '../images/dryfruit/nutmix.png'),
(10, 'Pistachio', 600, '../images/dryfruit/pistachio.png'),
(11, 'Raisins', 250, '../images/dryfruit/raisins.png'),
(12, 'Walnut', 550, '../images/dryfruit/walnut.png');

CREATE TABLE frozen (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    price INT,
    img VARCHAR(255)
);

INSERT INTO frozen (id, name, price, img) VALUES
(1, 'Berries', 60, '../images/frozen/berries.png'),
(2, 'Burger', 45, '../images/frozen/burger.png'),
(3, 'French fries', 55, '../images/frozen/french_fries.png'),
(4, 'Mango chunks', 70, '../images/frozen/mango.png'),
(5, 'Momos', 100, '../images/frozen/momos.png'),
(6, 'Peas', 50, '../images/frozen/peas.png'),
(7, 'Pizza', 120, '../images/frozen/pizza.png'),
(8, 'Samosa', 80, '../images/frozen/samosa.png'),
(9, 'Smiles', 90, '../images/frozen/smiles.png'),
(10, 'Spring roll', 90, '../images/frozen/spring_roll.png'),
(11, 'Sweet corn', 70, '../images/frozen/sweet_corn.png'),
(12, 'Mixed Vegetables', 130, '../images/frozen/veggies.png');

CREATE TABLE health (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    price INT,
    img VARCHAR(255)
);

INSERT INTO health (id, name, price, img) VALUES
(1, 'Chia Seed', 120, '../images/health/chia.png'),
(2, 'Coconut water', 115, '../images/health/coconut_eater.png'),
(3, 'Flax Seeds', 130, '../images/health/flex.png'),
(4, 'Honey minis', 150, '../images/health/honey.png'),
(5, 'Moringa Powder', 115, '../images/health/moringa.png'),
(6, 'Rosted Mixed nuts', 155, '../images/health/nuts.png'),
(7, 'Oats', 120, '../images/health/oats.png'),
(8, 'Peanut Butter', 115, '../images/health/peanut_butter.png'),
(9, 'Pumpkin Seeds', 125, '../images/health/pumpkin_seed.png'),
(10, 'Quinoa', 140, '../images/health/quinoa.png'),
(11, 'Apple Cider Vinegar', 115, '../images/health/vinegar.png'),
(12, 'Greek Yogurt', 125, '../images/health/yogurt.png');


CREATE TABLE sauces (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    price INT,
    img VARCHAR(255)
);

INSERT INTO sauces (id, name, price, img) VALUES
(1, 'Butter', 80, '../images/sauces/butter.png'),
(2, 'Cream cheese', 90, '../images/sauces/cream_cheese.png'),
(3, 'Garlic butter', 100, '../images/sauces/garlic_butter.png'),
(4, 'Jam', 50, '../images/sauces/jam.png'),
(5, 'Ketchup', 80, '../images/sauces/ketchup.png'),
(6, 'Mayonnaise', 130, '../images/sauces/mayonnaise.png'),
(7, 'Mustard Sauce', 70, '../images/sauces/mustard_sauce.png'),
(8, 'Nutella', 150, '../images/sauces/nutella.png'),
(9, 'Peanut butter', 140, '../images/sauces/peanut_butter.png'),
(10, 'Pizza Sauce', 90, '../images/sauces/pizza_sauce.png'),
(11, 'Schezwan Sauce', 80, '../images/sauces/schezwan.png'),
(12, 'Tandoori Mayonaise', 150, '../images/sauces/tandoori_mayo.png');


CREATE TABLE icecream (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    price INT,
    img VARCHAR(255)
);

INSERT INTO icecream (id, name, price, img) VALUES
(1, 'Black Current', 200, '../images/icecream/black_current.png'),
(2, 'Butterscotch', 150, '../images/icecream/butterscotch.png'),
(3, 'Chocochips', 250, '../images/icecream/chocochips.png'),
(4, 'Coffee', 200, '../images/icecream/coffee.png'),
(5, 'Cookie & Cream', 150, '../images/icecream/cookies.png'),
(6, 'Fruit & Nut Fantasy', 250, '../images/icecream/fruit.png'),
(7, 'Silk Chocolate', 200, '../images/icecream/gourmet.png'),
(8, 'Mango', 150, '../images/icecream/mango.png'),
(9, 'Mint Chocolate chip', 250, '../images/icecream/mint.png'),
(10, 'Pistachio Almond', 200, '../images/icecream/pistachio.png'),
(11, 'Berry Strawberry', 150, '../images/icecream/strawberry.png'),
(12, 'Venilla Royale', 250, '../images/icecream/vanilla.png');

CREATE TABLE bakery (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    price INT,
    img VARCHAR(255)
);

INSERT INTO bakery (id, name, price, img) VALUES
(1, 'Bread', 60, '../images/bakery/bread.png'),
(2, 'Brownie', 80, '../images/bakery/brownie.png'),
(3, 'Cake', 350, '../images/bakery/cake.png'),
(4, 'Cheese Cake', 420, '../images/bakery/cheese_cake.png'),
(5, 'Cookies', 90, '../images/bakery/cookies.png'),
(6, 'Cream Roll', 70, '../images/bakery/creamroll.png'),
(7, 'Cupcake', 50, '../images/bakery/cupcake.png'),
(8, 'Donut', 65, '../images/bakery/donut.png'),
(9, 'Macrons', 150, '../images/bakery/macrons.png'),
(10, 'Muffins', 55, '../images/bakery/muffins.png'),
(11, 'Pastries', 95, '../images/bakery/pastries.png'),
(12, 'Tarts', 110, '../images/bakery/tarts.png');


CREATE TABLE sweet (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    price INT,
    img VARCHAR(255)
);

INSERT INTO sweet (id, name, price, img) VALUES
(1, 'Burfee', 210, '../images/sweet/burfee.png'),
(2, 'Gulab Jamun', 115, '../images/sweet/gulabjamun.png'),
(3, 'Bombay Halwa', 215, '../images/sweet/halwa.png'),
(4, 'Jalebi', 230, '../images/sweet/jalebi.png'),
(5, 'Kaju katli', 150, '../images/sweet/kaju_katli.png'),
(6, 'Motichoor Laddu', 320, '../images/sweet/laddu.png'),
(7, 'Mathura Peda', 200, '../images/sweet/mathura_peda.png'),
(8, 'Misti doi', 150, '../images/sweet/mishti_doi.png'),
(9, 'Patisa', 250, '../images/sweet/patisa.png'),
(10, 'Rajbhog', 205, '../images/sweet/rajbhog.png'),
(11, 'Rasgulla', 150, '../images/sweet/rasgulla.png'),
(12, 'Shrikhand', 125, '../images/sweet/shrikhand.png');


CREATE TABLE instant (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    price INT,
    img VARCHAR(255)
);

INSERT INTO instant (id, name, price, img) VALUES
(1, 'Biryani', 70, '../images/instant/biriyani.png'),
(2, 'Chhole', 100, '../images/instant/chhole.png'),
(3, 'Panjabi Khichdi', 50, '../images/instant/khichdi.png'),
(4, 'Masala noodles', 60, '../images/instant/noodles.png'),
(5, 'Masala Oats', 55, '../images/instant/oats.png'),
(6, 'Paratha', 80, '../images/instant/paratha.png'),
(7, 'Pasta', 70, '../images/instant/pasta.png'),
(8, 'Pau Bhaji', 90, '../images/instant/pau.png'),
(9, 'Poha', 40, '../images/instant/poha.png'),
(10, 'Pulao', 30, '../images/instant/pulao.png'),
(11, 'Rajma', 80, '../images/instant/rajma.png'),
(12, 'Upma mix', 20, '../images/instant/upma.png');

-- --------------------------------------------------------

--
-- Table structure for table `short_bill`
--

DROP TABLE IF EXISTS `short_bill`;
CREATE TABLE IF NOT EXISTS `short_bill` (
  `billno` int DEFAULT NULL,
  `pid` int DEFAULT NULL
);

--
-- Dumping data for table `short_bill`
--

INSERT INTO `short_bill` (`billno`, `pid`) VALUES
(1, 6),
(1, 5),
(2, 5),
(2, 1),
(2, 1),
(3, 2),
(3, 1),
(4, 1),
(5, 7),
(5, 3),
(5, 2),
(6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `sid` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `pqty` int DEFAULT NULL,
  `sdate` date DEFAULT NULL,
  PRIMARY KEY (`sid`)
); 

-- --------------------------------------------------------

--
-- Table structure for table `temp_cart`
--

DROP TABLE IF EXISTS `temp_cart`;
CREATE TABLE IF NOT EXISTS `temp_cart` (
  `cuname` varchar(30) DEFAULT NULL,
  `pid` int DEFAULT NULL,
  `ostatus` varchar(20) DEFAULT NULL,
  `cr_date` date DEFAULT NULL
); 
COMMIT;
