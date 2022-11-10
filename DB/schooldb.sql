-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2022 at 08:15 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schooldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `school_deitails`
--

CREATE TABLE `school_deitails` (
  `id` int(11) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `school_city` varchar(255) DEFAULT NULL,
  `school_address` varchar(255) DEFAULT NULL,
  `school_email` varchar(255) NOT NULL,
  `school_mobile_number` int(11) NOT NULL,
  `school_tel_number` int(11) NOT NULL,
  `school_logo` varchar(255) NOT NULL,
  `school_website` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school_deitails`
--

INSERT INTO `school_deitails` (`id`, `school_name`, `school_city`, `school_address`, `school_email`, `school_mobile_number`, `school_tel_number`, `school_logo`, `school_website`) VALUES
(1, 'tvtc', 'بريدة', 'النهضة', 'tvtc@g.com', 9876678, 11232211, 'student-image-489.png', 'tvtc.com');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `student_father_name` varchar(255) NOT NULL,
  `student_grade` int(11) NOT NULL,
  `student_image` varchar(255) DEFAULT NULL,
  `student_birth` varchar(255) NOT NULL,
  `student_email` varchar(255) NOT NULL,
  `student_number` int(11) NOT NULL,
  `student_parent_number` int(11) NOT NULL,
  `student_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `student_name`, `student_father_name`, `student_grade`, `student_image`, `student_birth`, `student_email`, `student_number`, `student_parent_number`, `student_address`) VALUES
(44, 109503, 'عماد باسلوم', 'محمد ', 123, 'student-image-625.jpg', '2022-10-01', 'emadbasloom1@gmail.com', 5035502, 508575, 'الليث'),
(45, 112233, 'ياسر الجدعامي', 'ساعد', 543, 'student-image-133.jpg', '2022-10-05', 'yaseer090909@gmail.com', 5432, 5432, '543');

-- --------------------------------------------------------

--
-- Table structure for table `student_violations`
--

CREATE TABLE `student_violations` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `violation_id` int(11) NOT NULL,
  `note` varchar(1000) NOT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `school_email` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `is_admin`, `school_email`) VALUES
(1, 'administrator', 'admin@mail.com', '$2y$10$ROrvrZxyPe0lkREdFaxfFeSYmyqM9/PFq2HOuSeqVaiq476JlwZqS', 1, ''),
(5, 'normal user', 'user@mail.com', '$2y$10$ZbsOShqRV4yGq5degKIYAOxPSmAVDOpJfqKc2BTLTuaX/E04FXrhO', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `violations`
--

CREATE TABLE `violations` (
  `id` int(11) NOT NULL,
  `violation_name` varchar(255) NOT NULL,
  `violation_level_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `violations`
--

INSERT INTO `violations` (`id`, `violation_name`, `violation_level_number`) VALUES
(12, 'عدم التقيد باللباس الرسمي الخاص بالمدرسة أو الظهور بهيئة مخالفة للنظام المدرسي.', 1),
(13, 'العبث أثناء االصطفاف الصباحي أو ضعف المشاركة فيه.', 1),
(14, 'تعطيل سير الحصص الدراسية، مثل: الحديث الجانبي، و النوم داخل الفصل ،والمقاطعة المستمرة غير الهادفة لشرح\r\n المعلم، و تناول األطعمة أو المشروبات أثناء الدرس، ودخول الطالب فصله أو فصل آخر دون استئذان أو التأخر\r\n بالدخول', 1),
(15, 'تكرار خروج الطلبة ودخولهم ظهرا ً من البوابة قبل حضور سياراتهم، أو التجمهر حولها.\r\n', 1),
(16, 'الغش في أداء الواجبات أو االختبارات غير الفصلية', 2),
(17, 'إثارة الفوضى داخل الفصل، أو داخل المدرسة، أو في وسائل النقل المدرسي، مثل: العبث بالماء، و البخاخات، والصوت\r\n العالي ، والكتابة على الجدران.', 2),
(18, 'امتهان الكتب الدراسية.', 2),
(19, 'الهروب من الفصل، أو الخروج منه دون استئذان، أو عدم حضور الحصة الدراسية', 2),
(20, '.التهاون في أداء الصالة داخل المدرسة أو العبث خاللها.', 3),
(21, 'اإلشارة بحركات مخلة باألدب تجاه الزمالء، مثل: الحركة باألصبع، أو اليد، أو الجسم.', 3),
(22, '.الشجار أو االشتراك في مضاربة، أو مهاجمة الزمالء وتهديدهم، والتلفظ عليهم بألفاظ غير الئقة', 3),
(23, '.إلحاق الضرر المتعمد بممتلكات الزمالء، أو سرقة شيء منها، أو تخويفهم و إثارة الرعب بينهم', 3),
(24, 'احضار المواد أو األلعاب الخطرة إلى المدرسة دون استخدامها، وذلك مثل: األلعاب النارية، والبخاخات الغازية الملونة.', 3),
(25, 'حيازة المواد اإلعالمية الممنوعة المقروءة، أو المسموعة، أو المرئية، أو إحضار مجسمات تعد ممنوعه أخالقياً', 3),
(26, 'حيازة السجائر', 3),
(27, 'التوقيع عن ولي األمر من غير علمه على المكاتبات المتبادلة بين المدرسة وولي األمر', 3),
(28, ' إحضار أجهزة االتصال الشخصية يا كان نوعها إلى المدرسة (خالية من المخالفات)\r\n ', 3),
(29, 'اإلصرار على ترك أداء الصالة مع الطالب والمعلمين دون عذر شرعي', 4),
(30, 'العبث بالمواد أو األدوات أو األلعاب الخطرة في المدرسة، مثل: المفرقعات، والمواد الحارقة، واأللعاب الحارقة', 4),
(31, 'تعمد إصابة أحد الطالب عن طريق الضرب باليد أو استخدام أدوات غير حادة تحدث إصابة ( جرحاً أو نزفاً أو كسرا )', 4),
(32, 'التدخين داخل المدرسة', 4),
(34, 'الهروب من المدرسة', 4),
(35, 'التنمر', 4),
(36, 'عرض أو توزيع المواد اإلعالمية الممنوعة المقروءة، أو المسموعة، أو المرئية', 4),
(37, 'شبهة تزوير الوثائق أو تقليد األختام الرسمية', 4),
(38, 'السلوك الخاطئ والغريب، مثل: اإليمو، أو التشبه بالجنس اآلخر', 4),
(39, 'إحضار شخص آخر لتأدية االختبار نيابة عنه أو تأدية االختبار عن الغير', 4),
(40, 'احضار أجهزة االتصال الشخصية  يا كان نوعها إلى المدرسة والتي تحتوي على صور أو مقاطع غير الئقة', 4),
(41, ' العبث بتجهيزات المدرسة أو مبانيها، مثل: أجهزة الحاسب اآللي، وآالت التشغيل، والمعامل ، وحافلة المدرسة،\r\n واألدوات الكهربائية، و معدات الامن والسلامة في المدرسة', 4),
(42, 'تصوير الطلاب أو التسجيل الصوتي لهم بالاجهزة الالكترونية ', 4),
(43, 'تعمد إتالف أو تخريب شيء من تجهيزات المدرسة أو مبانيها، مثل: الادوات الكهربائية، وأجهزة الحاسب الالي،\r\n وآلات التشغيل، والمعامل، وحافلة المدرسة، ومعدات الامن والسلامة', 5),
(44, ' .استخدام والستفادة من الوثائق أو األختام المزورة أو الرسمية بطريقه غير مشروعة نظاماً', 5),
(45, 'التحرشات الجنسية', 5),
(46, 'تصوير الطلاب أو التسجيل الصوتي لهم بالاجهزة الاكترونية \r\n', 5),
(47, 'إشعال النار داخل المدرسة', 5),
(48, 'حيازة األسلحة النارية أو ما في حكمها، مثل: السكاكين، واألدوات الحادة، والرصاص بدون مسدس', 5),
(49, 'الاستهزاء بشيء من شعائر الاسلام', 6),
(50, 'اعتناق الافكار أو المعتقدات الهدامة أو ممارسة طقوس دينية محرمه', 6),
(51, 'حيازة أو تعاطي أو ترويج المخدرات أو المسكرات', 6),
(52, 'الشروع في الممارسات الجنسية المحرمة او مقدماتها', 6),
(53, 'القيادة الى أفعال الرذيلة', 6),
(54, 'الخروج من المدرسة للذهاب مع الجنس الاخر', 6),
(55, 'ممارسة أعمال السحر', 6),
(56, 'الجرائم المعلوماتية', 6);

-- --------------------------------------------------------

--
-- Table structure for table `violation_levels`
--

CREATE TABLE `violation_levels` (
  `id` int(11) NOT NULL,
  `level_name` varchar(50) NOT NULL,
  `level_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `violation_levels`
--

INSERT INTO `violation_levels` (`id`, `level_name`, `level_number`) VALUES
(1, 'مستوى أول', 1),
(2, 'مستوى ثاني', 2),
(3, 'مستوى ثالث', 3),
(4, 'مستوى رابع', 4),
(5, 'مستوى خامس', 5),
(6, 'مستوى سادس', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `school_deitails`
--
ALTER TABLE `school_deitails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `student_violations`
--
ALTER TABLE `student_violations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `violation_id` (`violation_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `violations`
--
ALTER TABLE `violations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `violations_levels` (`violation_level_number`);

--
-- Indexes for table `violation_levels`
--
ALTER TABLE `violation_levels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `level_number` (`level_number`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `student_violations`
--
ALTER TABLE `student_violations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `violations`
--
ALTER TABLE `violations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `violation_levels`
--
ALTER TABLE `violation_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_violations`
--
ALTER TABLE `student_violations`
  ADD CONSTRAINT `student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `violation_id` FOREIGN KEY (`violation_id`) REFERENCES `violations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `violations`
--
ALTER TABLE `violations`
  ADD CONSTRAINT `violations_levels` FOREIGN KEY (`violation_level_number`) REFERENCES `violation_levels` (`level_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
