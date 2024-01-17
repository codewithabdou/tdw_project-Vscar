-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3310
-- Generation Time: Jan 17, 2024 at 01:43 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tdw_project_model`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `external_link` varchar(255) NOT NULL,
  `show_in_home` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `image`, `title`, `text`, `external_link`, `show_in_home`) VALUES
(2, 'news1.webp', '1973 AMC Hornet X Gucci Sportabout Is Today\'s Find on Bring a Trailer', 'Plucky little American Motors Corporation never had the R&D money of the big three domestic automakers, so it was forced to be innovative. One avenue it explored was fashion-themed cars, such as the Pierre Cardin Javelin and the Levi\'s Gremlin. For its thrifty compact Hornet, there was a tie-up with one of the most noble Italian design houses, the pride of Florence: Gucci.', 'https://www.caranddriver.com/news/a46343044/1973-amc-hornet-sportabout-wagon-bring-a-trailer-auction/', 1);

-- --------------------------------------------------------

--
-- Table structure for table `avis_marques`
--

CREATE TABLE `avis_marques` (
  `ID_Avis` int(11) NOT NULL,
  `ID_Utilisateur` int(11) DEFAULT NULL,
  `ID_Marque` int(11) DEFAULT NULL,
  `Note` int(11) DEFAULT NULL,
  `Commentaire` text DEFAULT NULL,
  `Statut` enum('Pending','Validated') NOT NULL DEFAULT 'Pending',
  `Liked` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avis_marques`
--

INSERT INTO `avis_marques` (`ID_Avis`, `ID_Utilisateur`, `ID_Marque`, `Note`, `Commentaire`, `Statut`, `Liked`) VALUES
(23, 12, 3, 4, 'i will check you cars soon', 'Validated', 1),
(24, 16, 4, 4, 'wallah ghir hayla', 'Validated', 1),
(46, 12, 1, 4, 'Absolutely love my new car, it\'s incredibly comfortable!', 'Validated', 0),
(47, 13, 3, 3, 'The car has good fuel economy, but the design could be improved.', 'Validated', 1),
(48, 14, 4, 5, 'Incredible performance and smooth driving. Highly recommend.', 'Validated', 1),
(49, 15, 6, 2, 'Frequent issues with the transmission, disappointed with the quality.', 'Validated', 0),
(50, 16, 7, 4, 'Excellent value for money. Enjoyable drive and modern features.', 'Validated', 0),
(51, 12, 8, 3, 'Great handling and responsive steering. Interior design is lacking.', 'Validated', 0),
(52, 13, 9, 4, 'Reliable car with advanced safety features. Decent fuel efficiency.', 'Validated', 0),
(53, 14, 10, 2, 'Poor build quality, experiencing problems with electronics.', 'Validated', 0),
(54, 15, 11, 5, 'Luxurious interior and powerful engine. A joy to drive.', 'Validated', 0),
(55, 16, 1, 1, 'Constant breakdowns, regret buying this car.', 'Validated', 0),
(56, 12, 3, 4, 'Impressive off-road capabilities. Comfortable for long journeys.', 'Validated', 1),
(57, 13, 5, 3, 'Sleek design and good performance, but fuel efficiency could be better.', 'Validated', 0),
(58, 14, 7, 5, 'Top-notch safety features. Smooth and quiet ride.', 'Validated', 0),
(59, 15, 9, 2, 'Unreliable engine performance. Spent too much on repairs.', 'Validated', 0),
(60, 16, 11, 4, 'High-end features but lacks durability. Disappointed overall.', 'Validated', 0),
(61, 12, 3, 1, 'Constant engine trouble, regret my choice.', 'Validated', 0),
(62, 13, 4, 4, 'Excellent fuel efficiency and spacious interior. Highly satisfied.', 'Validated', 1),
(63, 14, 6, 3, 'Decent car for daily commuting. Nothing extraordinary.', 'Validated', 0),
(64, 15, 8, 2, 'Uncomfortable seats and poor visibility. Not recommended.', 'Validated', 0),
(65, 16, 10, 5, 'Thrilling driving experience. Worth the investment.', 'Validated', 0);

-- --------------------------------------------------------

--
-- Table structure for table `avis_marques_aimer`
--

CREATE TABLE `avis_marques_aimer` (
  `ID_Utilisateur` int(11) NOT NULL,
  `ID_Avis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avis_marques_aimer`
--

INSERT INTO `avis_marques_aimer` (`ID_Utilisateur`, `ID_Avis`) VALUES
(12, 23),
(12, 24),
(12, 47),
(12, 48),
(12, 56),
(12, 62);

-- --------------------------------------------------------

--
-- Table structure for table `avis_véhicules`
--

CREATE TABLE `avis_véhicules` (
  `ID_Avis` int(11) NOT NULL,
  `ID_Utilisateur` int(11) DEFAULT NULL,
  `ID_Véhicule` int(11) DEFAULT NULL,
  `Note` int(11) DEFAULT NULL,
  `Commentaire` text DEFAULT NULL,
  `Statut` enum('Pending','Validated') NOT NULL DEFAULT 'Pending',
  `Liked` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avis_véhicules`
--

INSERT INTO `avis_véhicules` (`ID_Avis`, `ID_Utilisateur`, `ID_Véhicule`, `Note`, `Commentaire`, `Statut`, `Liked`) VALUES
(24, 12, 12, 5, 'this car is amazing', 'Validated', 0),
(25, 16, 16, 5, 'khawti achriwha', 'Validated', 0),
(26, 16, 16, 4, '3ajbtni bzzf ana', 'Validated', 0),
(27, 16, 16, 5, 'zidolna wahda kifha fel 7mar', 'Validated', 0),
(49, 12, 1, 4, 'Absolutely love my new vehicle, it\'s incredibly comfortable!', 'Validated', 0),
(50, 13, 5, 3, 'The vehicle has good fuel economy, but the design could be improved.', 'Validated', 0),
(51, 14, 6, 5, 'Incredible performance and smooth driving. Highly recommend.', 'Validated', 0),
(52, 15, 7, 2, 'Frequent issues with the transmission, disappointed with the quality.', 'Validated', 0),
(53, 16, 8, 4, 'Excellent value for money. Enjoyable drive and modern features.', 'Validated', 0),
(54, 12, 9, 3, 'Great handling and responsive steering. Interior design is lacking.', 'Validated', 0),
(55, 13, 10, 4, 'Reliable vehicle with advanced safety features. Decent fuel efficiency.', 'Validated', 0),
(56, 14, 12, 2, 'Poor build quality, experiencing problems with electronics.', 'Validated', 0),
(57, 15, 15, 5, 'Luxurious interior and powerful engine. A joy to drive.', 'Validated', 1),
(58, 16, 16, 1, 'Constant breakdowns, regret buying this vehicle.', 'Validated', 0),
(59, 12, 17, 4, 'Impressive off-road capabilities. Comfortable for long journeys.', 'Validated', 1),
(60, 13, 18, 3, 'Sleek design and good performance, but fuel efficiency could be better.', 'Validated', 0),
(61, 14, 19, 5, 'Top-notch safety features. Smooth and quiet ride.', 'Validated', 0),
(62, 15, 1, 2, 'Unreliable engine performance. Spent too much on repairs.', 'Validated', 0),
(63, 16, 5, 4, 'High-end features but lacks durability. Disappointed overall.', 'Validated', 0),
(64, 12, 6, 1, 'Constant engine trouble, regret my choice.', 'Validated', 0),
(65, 13, 19, 4, 'Excellent fuel efficiency and spacious interior. Highly satisfied.', 'Validated', 0),
(66, 14, 9, 3, 'Decent vehicle for daily commuting. Nothing extraordinary.', 'Validated', 0),
(67, 15, 10, 2, 'Uncomfortable seats and poor visibility. Not recommended.', 'Validated', 0),
(68, 16, 12, 5, 'Thrilling driving experience. Worth the investment.', 'Validated', 0);

-- --------------------------------------------------------

--
-- Table structure for table `avis_véhicules_aimer`
--

CREATE TABLE `avis_véhicules_aimer` (
  `ID_Utilisateur` int(11) NOT NULL,
  `ID_Avis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avis_véhicules_aimer`
--

INSERT INTO `avis_véhicules_aimer` (`ID_Utilisateur`, `ID_Avis`) VALUES
(12, 57),
(12, 59);

-- --------------------------------------------------------

--
-- Table structure for table `comparaisons`
--

CREATE TABLE `comparaisons` (
  `ID_Comparaison` int(11) NOT NULL,
  `ID_Véhicule1` int(11) DEFAULT NULL,
  `ID_Véhicule2` int(11) DEFAULT NULL,
  `ID_Véhicule3` int(11) DEFAULT NULL,
  `ID_Véhicule4` int(11) DEFAULT NULL,
  `Times` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comparaisons`
--

INSERT INTO `comparaisons` (`ID_Comparaison`, `ID_Véhicule1`, `ID_Véhicule2`, `ID_Véhicule3`, `ID_Véhicule4`, `Times`) VALUES
(73, 1, 10, NULL, NULL, 11),
(75, 10, 12, NULL, NULL, 2),
(76, 1, 10, 7, NULL, 2),
(77, 1, 10, 8, NULL, 2),
(78, 1, 7, 8, NULL, 2),
(79, 10, 7, 8, NULL, 2),
(80, 1, 7, NULL, NULL, 2),
(81, 1, 8, NULL, NULL, 2),
(82, 10, 7, NULL, NULL, 2),
(83, 10, 8, NULL, NULL, 2),
(84, 7, 8, NULL, NULL, 2),
(85, 1, 10, 7, 8, 8),
(86, 1, 5, 6, NULL, 1),
(87, 1, 5, NULL, NULL, 2),
(88, 1, 6, NULL, NULL, 1),
(89, 5, 6, NULL, NULL, 1),
(90, 5, 12, NULL, NULL, 1),
(91, 1, 10, 5, NULL, 1),
(92, 10, 5, NULL, NULL, 1),
(93, 1, 10, 12, 16, 1),
(94, 1, 10, 12, NULL, 1),
(95, 1, 10, 16, NULL, 1),
(96, 1, 12, 16, NULL, 1),
(97, 10, 12, 16, NULL, 1),
(98, 1, 12, NULL, NULL, 1),
(99, 1, 16, NULL, NULL, 1),
(100, 10, 16, NULL, NULL, 1),
(101, 12, 16, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `sender`, `email`, `subject`, `message`) VALUES
(2, 'Habouche khaled', 'kk_habouche@esi.dz', 'Test contact', 'teeeeeeeeeeeeeeeeeeeeeeeeeeeest cooooooooooooontaaaaaaaaact'),
(3, 'habouche khaled', 'kk_habouche@esi.dz', '3awnouni', 'contact rah yakhdam');

-- --------------------------------------------------------

--
-- Table structure for table `contact_infos`
--

CREATE TABLE `contact_infos` (
  `id` int(11) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `numéro` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_infos`
--

INSERT INTO `contact_infos` (`id`, `adresse`, `email`, `numéro`) VALUES
(1, 'ElHarrach, Algiers, Algeria', 'contact@vscar.com', '+213 776493221');

-- --------------------------------------------------------

--
-- Table structure for table `guide_achat`
--

CREATE TABLE `guide_achat` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `stepTitle1` varchar(255) DEFAULT NULL,
  `stepParagraph1` text DEFAULT NULL,
  `stepTitle2` varchar(255) DEFAULT NULL,
  `stepParagraph2` text DEFAULT NULL,
  `stepTitle3` varchar(255) DEFAULT NULL,
  `stepParagraph3` text DEFAULT NULL,
  `stepTitle4` varchar(255) DEFAULT NULL,
  `stepParagraph4` text DEFAULT NULL,
  `stepTitle5` varchar(255) DEFAULT NULL,
  `stepParagraph5` text DEFAULT NULL,
  `stepTitle6` varchar(255) DEFAULT NULL,
  `stepParagraph6` text DEFAULT NULL,
  `stepTitle7` varchar(255) DEFAULT NULL,
  `stepParagraph7` text DEFAULT NULL,
  `stepTitle8` varchar(255) DEFAULT NULL,
  `stepParagraph8` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guide_achat`
--

INSERT INTO `guide_achat` (`id`, `title`, `stepTitle1`, `stepParagraph1`, `stepTitle2`, `stepParagraph2`, `stepTitle3`, `stepParagraph3`, `stepTitle4`, `stepParagraph4`, `stepTitle5`, `stepParagraph5`, `stepTitle6`, `stepParagraph6`, `stepTitle7`, `stepParagraph7`, `stepTitle8`, `stepParagraph8`, `image`) VALUES
(1, 'Finding the Perfect Car ', 'Research Vehicles and Features', 'Explore Vscar website for reviews, prices, and deals.', 'Get Preapproved for a Loan', 'Start with a preapproved auto loan for a better idea of affordability.', 'Plan Your Trade-In', 'Determine the trade-in value of your current car.', 'Locate and Test-Drive the Car', 'Visit dealerships, schedule test drives, and evaluate different models.', 'Check Sale Price and Warranties', 'Get price quotes, check Edmunds TMV, and review financing options.', 'Review the Deal and Dealer Financing', 'Finalize pricing, financing, and additional products.', 'Close the Deal', 'Complete paperwork at the dealership or arrange home delivery.', 'Take Delivery', 'Inspect the car, receive a demonstration, and enjoy your new car.', 'news1.webp');

-- --------------------------------------------------------

--
-- Table structure for table `marques`
--

CREATE TABLE `marques` (
  `ID_Marque` int(11) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Pays_d_origine` varchar(50) DEFAULT NULL,
  `Siège_social` varchar(100) DEFAULT NULL,
  `Année_de_création` year(4) DEFAULT NULL,
  `Photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marques`
--

INSERT INTO `marques` (`ID_Marque`, `Nom`, `Pays_d_origine`, `Siège_social`, `Année_de_création`, `Photo`) VALUES
(1, 'Toyota', 'Japan', 'Tokyo', '1937', 'toyota-logo.webp'),
(3, 'Chevrolet', 'USA', 'Detroit', '1911', 'Chevrolet-logo.webp'),
(4, 'Dodge', 'USA', 'Auburn Hills', '1901', 'dodge-logo.webp'),
(5, 'Ford', 'USA', 'Dearborn', '1903', 'ford-logo.webp'),
(6, 'Honda', 'Japan', 'Tokyo', '1948', 'honda-logo.webp\r\n '),
(7, 'Jeep', 'USA', 'Toledo', '1941', 'jeep-logo.webp'),
(8, 'Lexus', 'Japan', 'Nagoya', '1989', 'Lexus-logo.webp'),
(9, 'Nissan', 'Japan', 'Yokohama', '1933', 'nissan-logo.webp'),
(10, 'Tesla', 'USA', 'Palo Alto', '2003', 'tesla-logo.webp'),
(11, 'Acura', 'Japan', 'Tokyo', '1986', 'Acura-logo.webp');

-- --------------------------------------------------------

--
-- Table structure for table `marques_aimer`
--

CREATE TABLE `marques_aimer` (
  `ID_Utilisateur` int(255) NOT NULL,
  `ID_Marque` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marques_aimer`
--

INSERT INTO `marques_aimer` (`ID_Utilisateur`, `ID_Marque`) VALUES
(12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `ID_News` int(11) NOT NULL,
  `Titre` varchar(100) DEFAULT NULL,
  `Image` varchar(100) DEFAULT NULL,
  `Texte` text DEFAULT NULL,
  `lien` text NOT NULL DEFAULT '',
  `ShowInHome` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`ID_News`, `Titre`, `Image`, `Texte`, `lien`, `ShowInHome`) VALUES
(3, 'Car and Driver\'s 200-MPH Club Just Got Bigger', 'news1.jpg', 'As far back as I can remember, I always wanted to go 200 mph. I recall my younger years when I\'d peer through the windows of sports cars to get a glimpse of the highest number on the speedometer. My first exposure to 200 mph came at Michigan International Speedway with 40 of the premier class NASCAR machines racing through Turn 1 as I stood on the fence, just feet away from the pack. Talk about a rush. I needed 200 mph in my life.\r\n\r\nPlay Iconpreview for Porsche 911 Turbo S 200 mph Acceleration\r\nI\'ve performance tested over 800 cars since 2016. Some really, really fast and some painfully slow. By now, I figured I would\'ve earned my 200-mph patch. But arriving at two-hundo requires adequate space. Quiroga and VanderWerp took the cheater routes, as a Bugatti with 1000-plus horsepower will do the deed in no time.\r\n\r\nGoing into the the 0-150-0 event, I knew the 911 Turbo S had a chance. \"As long as there\'s room.\" I told myself. During my last 150-mph pull, I made the decision to stay in the throttle as I blew past our timing tent. Around 170 mph, the Turbo S sways a bit in the breeze. I remember thinking, \"What the heck am I doing? Why am I the guinea pig? I\'ve got a two-month-old at home.\" But the fear is part of the thrill. It\'s why we do what we do. I think I touched 197 mph on the sighting run. With the tire pressure adjusted for maximum velocity, 200 mph is easily achieved on Oscoda\'s taxiway.\r\n\r\nWhat does 200 mph feel like in a wide-open space? To me, not much. I\'ve gone nearly 120 mph down a retired railroad bed on a snowmobile. Traveling 180 mph on the tree-lined, two-lane road at the proving grounds, knowing there\'s big and heavy wildlife lurking in the woods, gets the adrenaline pumping. Without many reference points in the airfield, there\'s not much sense of speed.\r\n\r\nThis was more about a milestone for me. I\'ve tested two 911 Turbo S models, and it briefly tied the record as the quickest to 60 mph. I drove it at Lighting Lap. I\'ve been up and down Angeles Crest Highway in it. I\'ve gone north of Ojai on State Route 33—arguably one of the best roads in the world—when we compared the Turbo S to the Maserati MC20. For me, this was full circle with one of the most epic sports cars Porsche will ever make. 200 mph? Check. 250 mph? Here we come. —David Beard\r\n\r\nMike Sutton Joins the 200-MPH Club\r\nThe 200-mph barrier has always had a special aura about it for me, a lofty threshold demanding determination and some serious machinery to breach, not to mention a lot of road.\r\n\r\nI\'ve gotten close several times over the years, both on the test track and the German autobahn. But when the time finally came, the quickness with which the 640-hp 911 Turbo S made it happen left me with little time to process it—an almost anticlimactic passing of a momentous occasion.\r\n\r\n', 'link', 1),
(23, 'Toyota Dresses Up the GR Corolla as the Lexus LBX Morizo RR', 'news2.jpg', 'The engine is unchanged from the version in the Corolla, with the three-pot pumping out 300 ponies and 295 pound-feet of torque. The electronically controlled all-wheel-drive system also carries over, but unlike the manual-only GR Corolla, the fancier LBX is fitted with an eight-speed automatic transmission. This gearbox is now going to be offered on the overseas-only GR Yaris, which also shares the same powertrain, so it\'s possible that the GR Corolla could gain an automatic option in the near future.\r\n\r\n\r\nToyota didn\'t publish any performance statistics for the angry-looking little crossover, but at 165.0 inches long, the LBX Morizo RR should keep up with the GR Corolla, which measures over eight inches longer and weighs roughly the same as a stock LBX. This would suggest a zero-to-60-mph time of less than 5.0 seconds and a quarter-mile sprint in the low 13-second range. Those numbers might also improve since the LBX doesn\'t need to be shifted by a human like the GR Corolla.\r\n\r\nCompared with the standard LBX, the Morizo RR wears a redesigned bumper with a larger grille and sizable lower intakes. There\'s also a yellow accent trim piece linking the headlights and echoing the color of the brake calipers, which clamp 18.0-inch rotors up front and 16.0-inchers in the rear—a fair bit larger than the rotors on the GR Corolla. The rear bumper has also been restyled and houses a small diffuser and two large exhaust pipes. Other upgrades include the tires, which go from 215-section-width rubber (paired with 17- or 18-inch wheels on the normal LBX) to 235/45R-19 tires.\r\n\r\n\r\nWhile the LBX Morizo RR is still just a concept, we wouldn\'t be surprised if Toyota is testing the waters for a production version. Morizo is, after all, an alias used by former CEO and current chairman Akio Toyoda for his racing exploits. Still, even if the Morizo RR were to escape concept-car purgatory, the LBX likely won\'t come to the United States.', 'link', 1),
(24, 'Hyundai Ioniq 5 N NPX1 Concept Sports a Big Wing and a Beefy Body Kit', 'news3.jpg', 'The Ioniq 5 N NPX1 looks truly sinister with its blacked-out appearance and aggressive aerodynamics. The concept is a glimpse into the catalog of accessories that Hyundai plans to offer for the sporty electric crossover from its N Performance Parts division, which started in 2019 and has supplied extras for the company\'s gas-powered N vehicles like the Elantra N.\r\n\r\nThe NPX1 is fitted with an host of upgrades. The entire front bumper is redesigned with unique air intakes and a mean-looking carbon-fiber front splitter with vanes that extend further up the front wheel arches than on the standard car. The side skirts have also been restyled while the grippy Pirelli P Zero tires now wrap around lightweight hybrid carbon wheels. The NPX1 is also said to be fitted with high-performance brake pads and lowering springs for a more assertive stance.\r\n\r\nMoving around back, your eyes are immediately drawn to the tremendous rear wing sprouting from the roof. Combined with the large and boxy rear diffuser, the Ioniq 5 N NPX1 looks ready for the track. While no photos of the cabin were published, Hyundai says there are racing bucket seats and plenty of Alcantara upholstery.\r\n\r\nThe prototype parts seen here will continue to be honed before they go on sale this year as the automaker looks to make N Performance Parts available on all N-badged vehicles. Hyundai also plans on offering software customizations that include \"sound and vehicle calibration\" via over-the-air updates. Hyundai has yet to reveal what these parts may cost and how many of them will be available to U.S. customers when the Ioniq 5 N goes on sale this spring.', 'link', 1),
(25, 'BMW\'s iDrive 9 Lets You Play Video Games with a PlayStation Controller', 'news4.jpg', 'It\'s currently possible to play video games in several new BMW models with the AirConsole app that was introduced earlier this year. It lets people download games and use their smartphone as a controller—only when the car isn\'t moving, of course. Before the end of 2024, BMWs with iDrive 9 will be able to play other video games with full-size controllers, including Bluetooth-enabled PlayStation and Xbox gamepads.\r\n\r\nWe had the chance to play Beach Buggy Racing 2 using a PlayStation 5 controller. While we only spent a few minutes playing during the demo, it was immediately clear that it was just as fun factor as playing on a normal device. The new BMW X1 we were in also had the benefit of an excellent audio system that made the sound experience extra enjoyable. The game can even be played in split-screen mode with a second controller.\r\n\r\nBMW says the in-car gaming will be available through its ConnectedDrive Store along with a slew of other new third-party apps that are made possible by the Android-based software that\'s baked into iDrive 9. Access requires paying for the BMW Digital Premium option, though. New models that aren\'t initially available with the controller connection will be able to add it via an over-the-air update.\r\n\r\nRemote-Controlled Valet Parking\r\nMuch stranger than playing a video game in a car is remotely controlling a real-life car using a driving simulator. That\'s what we did at BMW\'s outdoor exhibit at CES where we piloted an electric iX SUV through a parking lot course while seated about 100 feet away.\r\n\r\nFacing a multiplex of screens and seated in a racing chair, we grabbed the steering wheel and placed our feet on the pedals. A video feed from the forward-facing camera was our primary view, but it didn\'t provide a sense of spatial awareness. A secondary screen to our right showed an overhead view that helped us navigate between the cones and the gates that served as checkpoints.\r\n\r\nWe\'re not strangers to driving simulators, but remotely driving the iX with one was a much different experience due to the delays between our inputs and the actual acceleration and braking. Getting the EV SUV to go required flattening the accelerator pedal and waiting a few seconds before the vehicle started to move. Even then, its top speed was limited to 15 mph, which is also the posted speed limit for most parking lots and parking garages.', 'link', 1);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `ID_Utilisateur` int(11) NOT NULL,
  `Nom` varchar(100) DEFAULT NULL,
  `Prénom` varchar(100) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Mot_de_passe` varchar(100) DEFAULT NULL,
  `Photo` varchar(100) DEFAULT NULL,
  `Type` enum('Utilisateur','Admin') DEFAULT NULL,
  `Sexe` enum('Male','Female') DEFAULT NULL,
  `Date_de_naissance` date DEFAULT NULL,
  `Statut` enum('Pending','Blocked','Actif') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`ID_Utilisateur`, `Nom`, `Prénom`, `Username`, `Mot_de_passe`, `Photo`, `Type`, `Sexe`, `Date_de_naissance`, `Statut`) VALUES
(4, 'admin', 'admin', 'admin', 'admin', 'imgCV.jpg', 'Admin', 'Male', '2023-12-08', 'Actif'),
(12, 'Abdou', 'Dzz', 'Abdou_DZZZ', '12345678', 'imgCV.jpg', 'Utilisateur', 'Male', '2002-01-05', 'Actif'),
(13, 'Abdou', 'Habouche', 'Abdou_hbch', '12345678', 'IMG_20210330_235555_527.jpg', 'Utilisateur', 'Male', '2002-01-05', 'Actif'),
(14, 'khaled', 'Habouche', 'khaled_hbch', '12345678', 'PXL_20230320_130604121.jpg', 'Utilisateur', 'Male', '2002-01-05', 'Actif'),
(15, 'khaled', 'Habouche', 'khaled_hbchh', '12345678', '669ea56a88625559b50d28334edb9dd7.0.jpg', 'Utilisateur', 'Male', '2002-01-05', 'Actif'),
(16, 'Abdou', 'wad souf', 'Abdoubelrose', '12345678', 'cdc3998819bf275275068a382157bcf1.0.jpg', 'Utilisateur', 'Male', '2002-01-05', 'Actif'),
(17, 'Abdou', 'wad souf', 'Abdoubelkhdar', '12345678', 'IMG_20210108_160622.jpg', 'Utilisateur', 'Male', '2002-01-05', 'Actif');

-- --------------------------------------------------------

--
-- Table structure for table `véhicules`
--

CREATE TABLE `véhicules` (
  `ID_Véhicule` int(11) NOT NULL,
  `ID_Marque` int(11) DEFAULT NULL,
  `Modèle` varchar(50) DEFAULT NULL,
  `Version` varchar(50) DEFAULT NULL,
  `Année` year(4) DEFAULT NULL,
  `Prix` decimal(10,2) DEFAULT NULL,
  `type_carburant` varchar(50) DEFAULT NULL,
  `puissance` int(11) DEFAULT NULL,
  `acceleration` float DEFAULT NULL,
  `conso_carburant` int(11) DEFAULT NULL,
  `longueur` int(11) DEFAULT NULL,
  `largeur` int(11) DEFAULT NULL,
  `hauteur` int(11) DEFAULT NULL,
  `nb_places` int(11) DEFAULT NULL,
  `volume_coffre` int(11) DEFAULT NULL,
  `moteur` varchar(50) DEFAULT NULL,
  `Nom` varchar(255) NOT NULL DEFAULT 'Nom voiture',
  `Photo` varchar(255) NOT NULL DEFAULT 'ford-mustang.webp'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `véhicules`
--

INSERT INTO `véhicules` (`ID_Véhicule`, `ID_Marque`, `Modèle`, `Version`, `Année`, `Prix`, `type_carburant`, `puissance`, `acceleration`, `conso_carburant`, `longueur`, `largeur`, `hauteur`, `nb_places`, `volume_coffre`, `moteur`, `Nom`, `Photo`) VALUES
(1, 1, 'Camry', 'LE', '2022', 25000.00, 'Diesel', 21, 2, 20, 400, 200, 150, 5, 100, 'Flat Engine Layout', 'Toyota Camry ', 'toyota-camry.webp'),
(5, 1, 'RAV4', 'Competition', '2022', 80000.00, 'Diesel', 21, 3, 18, 350, 200, 200, 8, 100, 'V-Engine Layout', 'Toyota Rav4', 'toyota-rav4.webp'),
(6, 1, 'GR', 'Corolla', '2022', 75000.00, 'Gasoline', 21, 2, 36, 390, 200, 180, 5, 120, 'Twin Cylinder', 'Toyota GR', 'toyota-grcorolla.webp'),
(7, 5, 'Mustang', 'Sport', '2022', 350000.00, 'Hydrolique', 21, 5, 26, 400, 180, 160, 5, 176, 'Five Cylinder', 'Ford mustang', 'ford-mustang.webp'),
(8, 5, 'F-250', 'Casual', '2022', 8000000.00, 'Natural gas', 21, 3, 24, 360, 180, 150, 2, 800, 'Five Cylinder', 'Ford f-250', 'ford-f250.webp'),
(9, 5, 'Bronco', '4x4', '2022', 55000.00, 'Hydrolique', 21, 3, 18, 420, 180, 200, 6, 300, 'Flat cylindre', 'Ford bronco', 'ford-bronco.webp'),
(10, 3, 'Tahoe', '4x4', '2022', 38000.00, 'Hydrolique', 21, 3, 25, 370, 200, 100, 8, 200, 'Three Cylinder', 'Chevrolet tahoe', 'chevrolet-tahoe.webp'),
(12, 3, 'Camaro', 'Sport', '2005', 8000000.00, 'Gasoline', 21, 4, 28, 200, 150, 150, 5, 120, 'Four Cylinder', 'Chevrolet Camaro', 'chevrolet-camaro.webp'),
(15, 4, 'Challenger', 'Blit', '2021', 5000000.00, 'Hydrolique', 59, 3, 25, 400, 200, 150, 6, 230, 'Five Cylinder', 'Dodge challenger', 'dodge-challenger.webp'),
(16, 4, 'Hornet', 'Classic', '2020', 300000.00, 'Diesel', 19, 3, 52, 400, 320, 147, 5, 230, 'Five Cylinder', 'Dodge hornet', 'dodge-hornet.webp'),
(17, 6, 'Civic', 'Classic', '2024', 500000.00, 'Hydrolique', 25, 6, 24, 400, 210, 180, 5, 5, 'Three Cylinder', 'Honda Civic', 'honda-civic.webp'),
(18, 6, 'CRV', '4x4', '2020', 1800000.00, 'Diesel', 50, 23, 14, 360, 200, 150, 6, 200, 'Twin Cylinder', 'Honda CRV', 'honda-crv.webp'),
(19, 7, 'Wrangler', '4x4', '2023', 5000000.00, 'Gasoline', 52, 2, 24, 360, 200, 170, 6, 240, 'Three Cylinder', 'Jeep wrangler', 'jeep-wrangler.webp'),
(20, 4, 'Charger', 'Groove', '2002', 54888888.00, 'Hydrolique', 58, 2, 24, 400, 200, 150, 6, 180, 'Four cylindre', 'Dodge Charger', 'dodge-charger.webp'),
(21, 3, 'Express', 'Transport', '2001', 4000000.00, 'Gasolique', 57, 6, 54, 360, 180, 250, 8, 500, 'Groove engine', 'Chevrolet Express', 'chevrolet-express.webp'),
(22, 6, 'Pilot', '4x4', '2019', 5000000.00, 'Diesel', 47, 5, 54, 200, 240, 180, 6, 240, 'Five cylindre', 'Honda pilot', 'honda-pilot.webp');

-- --------------------------------------------------------

--
-- Table structure for table `véhicules_aimer`
--

CREATE TABLE `véhicules_aimer` (
  `ID_Véhicule` int(255) NOT NULL,
  `ID_Utilisateur` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `véhicules_aimer`
--

INSERT INTO `véhicules_aimer` (`ID_Véhicule`, `ID_Utilisateur`) VALUES
(10, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `avis_marques`
--
ALTER TABLE `avis_marques`
  ADD PRIMARY KEY (`ID_Avis`),
  ADD KEY `ID_Utilisateur` (`ID_Utilisateur`),
  ADD KEY `ID_Marque` (`ID_Marque`);

--
-- Indexes for table `avis_marques_aimer`
--
ALTER TABLE `avis_marques_aimer`
  ADD PRIMARY KEY (`ID_Utilisateur`,`ID_Avis`);

--
-- Indexes for table `avis_véhicules`
--
ALTER TABLE `avis_véhicules`
  ADD PRIMARY KEY (`ID_Avis`),
  ADD KEY `ID_Utilisateur` (`ID_Utilisateur`),
  ADD KEY `ID_Véhicule` (`ID_Véhicule`);

--
-- Indexes for table `avis_véhicules_aimer`
--
ALTER TABLE `avis_véhicules_aimer`
  ADD PRIMARY KEY (`ID_Utilisateur`,`ID_Avis`);

--
-- Indexes for table `comparaisons`
--
ALTER TABLE `comparaisons`
  ADD PRIMARY KEY (`ID_Comparaison`),
  ADD KEY `ID_Véhicule1` (`ID_Véhicule1`),
  ADD KEY `ID_Véhicule2` (`ID_Véhicule2`),
  ADD KEY `ID_Véhicule3` (`ID_Véhicule3`),
  ADD KEY `ID_Véhicule4` (`ID_Véhicule4`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_infos`
--
ALTER TABLE `contact_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guide_achat`
--
ALTER TABLE `guide_achat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marques`
--
ALTER TABLE `marques`
  ADD PRIMARY KEY (`ID_Marque`);

--
-- Indexes for table `marques_aimer`
--
ALTER TABLE `marques_aimer`
  ADD PRIMARY KEY (`ID_Utilisateur`,`ID_Marque`) USING BTREE;

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`ID_News`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`ID_Utilisateur`);

--
-- Indexes for table `véhicules`
--
ALTER TABLE `véhicules`
  ADD PRIMARY KEY (`ID_Véhicule`),
  ADD KEY `ID_Marque` (`ID_Marque`),
  ADD KEY `ID_Marque_2` (`ID_Marque`);

--
-- Indexes for table `véhicules_aimer`
--
ALTER TABLE `véhicules_aimer`
  ADD PRIMARY KEY (`ID_Utilisateur`,`ID_Véhicule`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `avis_marques`
--
ALTER TABLE `avis_marques`
  MODIFY `ID_Avis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `avis_véhicules`
--
ALTER TABLE `avis_véhicules`
  MODIFY `ID_Avis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `comparaisons`
--
ALTER TABLE `comparaisons`
  MODIFY `ID_Comparaison` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_infos`
--
ALTER TABLE `contact_infos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guide_achat`
--
ALTER TABLE `guide_achat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `marques`
--
ALTER TABLE `marques`
  MODIFY `ID_Marque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `ID_News` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `ID_Utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `véhicules`
--
ALTER TABLE `véhicules`
  MODIFY `ID_Véhicule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avis_marques`
--
ALTER TABLE `avis_marques`
  ADD CONSTRAINT `avis_marques_ibfk_1` FOREIGN KEY (`ID_Utilisateur`) REFERENCES `utilisateurs` (`ID_Utilisateur`),
  ADD CONSTRAINT `avis_marques_ibfk_2` FOREIGN KEY (`ID_Marque`) REFERENCES `marques` (`ID_Marque`);

--
-- Constraints for table `avis_véhicules`
--
ALTER TABLE `avis_véhicules`
  ADD CONSTRAINT `avis_véhicules_ibfk_1` FOREIGN KEY (`ID_Utilisateur`) REFERENCES `utilisateurs` (`ID_Utilisateur`),
  ADD CONSTRAINT `avis_véhicules_ibfk_2` FOREIGN KEY (`ID_Véhicule`) REFERENCES `véhicules` (`ID_Véhicule`);

--
-- Constraints for table `comparaisons`
--
ALTER TABLE `comparaisons`
  ADD CONSTRAINT `comparaisons_ibfk_2` FOREIGN KEY (`ID_Véhicule1`) REFERENCES `véhicules` (`ID_Véhicule`),
  ADD CONSTRAINT `comparaisons_ibfk_3` FOREIGN KEY (`ID_Véhicule2`) REFERENCES `véhicules` (`ID_Véhicule`),
  ADD CONSTRAINT `comparaisons_ibfk_4` FOREIGN KEY (`ID_Véhicule3`) REFERENCES `véhicules` (`ID_Véhicule`),
  ADD CONSTRAINT `comparaisons_ibfk_5` FOREIGN KEY (`ID_Véhicule4`) REFERENCES `véhicules` (`ID_Véhicule`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
