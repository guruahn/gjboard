-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 14-09-17 10:58
-- 서버 버전: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gjboard`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `attachment`
--

CREATE TABLE IF NOT EXISTS `attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `name` varchar(120) NOT NULL,
  `original_name` varchar(120) NOT NULL,
  `url` varchar(255) NOT NULL,
  `mime` varchar(50) NOT NULL,
  `size` int(11) NOT NULL,
  `is_thumbnail` enum('Y','N') NOT NULL DEFAULT 'N',
  `register_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 테이블의 덤프 데이터 `attachment`
--

INSERT INTO `attachment` (`id`, `post_id`, `user_id`, `name`, `original_name`, `url`, `mime`, `size`, `is_thumbnail`, `register_date`) VALUES
(9, 1, 'guruahn', 'board_201409170922147936.jpg', 'profile.jpg', '/public/upload/2014/09/board_201409170922147936.jpg', 'image/jpeg', 207114, 'N', '2014-09-17 09:22:14');

-- --------------------------------------------------------

--
-- 테이블 구조 `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `website` varchar(100) DEFAULT NULL,
  `content` text NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `is_approved` enum('Y','N') NOT NULL DEFAULT 'N',
  `register-date` datetime NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '제목',
  `user_id` varchar(10) NOT NULL COMMENT '사용자 아이디',
  `category_id` int(10) NOT NULL COMMENT '카테고리 아이디',
  `content` text NOT NULL COMMENT '내용',
  `tags` varchar(250) NOT NULL COMMENT '태그들(쉼표구분)',
  `is_notice` varchar(2) NOT NULL DEFAULT 'N' COMMENT '공지인지 여부',
  `is_secret` varchar(2) NOT NULL DEFAULT 'N' COMMENT '비밀글인지 여부',
  `ip` varchar(20) NOT NULL COMMENT 'ip',
  `publish_date` datetime NOT NULL COMMENT '발행일시',
  `modify_date` datetime NOT NULL COMMENT '수정일시',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 테이블의 덤프 데이터 `post`
--

INSERT INTO `post` (`id`, `title`, `user_id`, `category_id`, `content`, `tags`, `is_notice`, `is_secret`, `ip`, `publish_date`, `modify_date`) VALUES
(1, 'Lorem ipsum dolor sit amet.', 'guruahn', 1, '<p><img alt="Image title" src="/public/upload/2014/09/board_201409170922147936.jpg" width="300" style="min-width: 16px; min-height: 16px; margin-bottom: 10px; margin-left: auto; margin-right: auto; margin-top: 10px"></p><p><br></p><h2>What is Lorem Ipsum?</h2><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br></p><p><span style="line-height: 19.2000007629395px;">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</span></p><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.<br></p>', 'Lorem,ipsum,dolor,sit,amet.', 'N', 'N', '127.0.0.1', '0000-00-00 00:00:00', '2014-09-17 09:22:07'),
(2, 'Lorem ipsum dolor sit amet.', 'guruahn', 0, '<h2><span>Lorem ipsum dolor sit amet.</span><br></h2><p><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam consectetur quam sit amet sapien volutpat accumsan ac quis ipsum. Curabitur finibus, lectus eget viverra iaculis, enim turpis tincidunt ante, id sagittis nisi felis non quam. Integer commodo, enim nec congue semper, mi ligula tempor ipsum, non varius est augue sit amet tortor. Ut mi ipsum, hendrerit sed molestie id, imperdiet pulvinar quam. Nullam tincidunt egestas lacus, nec hendrerit magna hendrerit nec. Aliquam faucibus porta justo, nec lobortis mauris volutpat et. Sed nec mauris eu velit auctor aliquam at ac ex. Etiam urna lorem, egestas nec commodo sed, bibendum et erat. Curabitur eget nisl at enim viverra tincidunt. Curabitur vitae bibendum augue. Pellentesque viverra augue et cursus laoreet. Mauris eget ipsum sed erat lobortis viverra vel vitae ex. Etiam tincidunt fermentum sapien at sollicitudin. Nullam sit amet mattis ipsum. Mauris nec nisl mauris. Vestibulum tempus enim varius quam tincidunt, quis ullamcorper lacus tristique.</span><br></p><h3><span><span>dolor sit amet.</span><br></span></h3><p><span><span>Fusce id velit ut orci blandit aliquet quis vitae massa. Pellentesque mollis ante eget volutpat pellentesque. Donec ipsum lectus, varius eget accumsan dapibus, dictum ac massa. Phasellus vel varius libero. Mauris est elit, luctus ut massa vel, iaculis rhoncus nulla. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc purus sapien, molestie in libero ornare, ultrices tincidunt dui.</span><br></span></p><p><br></p><ul><li>Integer vulputate massa ac venenatis facilisis.</li><li>Vestibulum lobortis lectus vitae tellus rutrum ultricies.</li></ul><p><br></p><blockquote>Ut sit amet nulla sit amet ligula convallis aliquet.<span style="line-height: 19.2000007629395px;">Duis bibendum at neque quis auctor. Donec non tincidunt magna. Sed tincidunt tempor odio, ac blandit lorem venenatis at. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam egestas dapibus ex, et efficitur lorem imperdiet a. Nam tristique, tellus eu faucibus aliquet, eros tortor iaculis diam, porta varius eros nulla id ante. Nulla id erat facilisis magna fermentum posuere eu a diam. Pellentesque sed semper tortor.&nbsp;</span></blockquote><p><span>Sed molestie enim nibh, ac volutpat odio suscipit pretium. Nam ultricies sapien non mauris iaculis, ut ornare nunc euismod. Phasellus at justo eros. Morbi ut suscipit purus. Praesent vitae justo feugiat, imperdiet ipsum sodales, faucibus magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Proin ut aliquet dolor.</span><br></p>', 'Lorem,ipsum,dolor,sit,amet.', 'N', 'N', '127.0.0.1', '0000-00-00 00:00:00', '2014-09-05 05:22:11'),
(3, 'heading', 'guruahn', 0, '<p><span>Quisque mi quam, semper sit amet massa sit amet, congue varius urna. Sed non sagittis felis, id tempus ipsum. Curabitur ut nibh sem. Nullam eu bibendum tortor. Vivamus porttitor tortor sapien. Nunc posuere sem id facilisis auctor. Aliquam tincidunt ac felis vitae accumsan. Aliquam erat volutpat.</span></p><p><strong>strong</strong></p><p><span>Sed maximus dolor consequat, semper lorem at, egestas purus. Aenean sagittis risus libero, ac lobortis nisl aliquam maximus. Curabitur gravida euismod massa nec aliquam. Integer id pretium ex. Nulla dolor sapien, eleifend non purus vel, vestibulum porta massa.</span><br></p><p><span><span>Pellentesque pretium dictum urna, id imperdiet ante porta eu. Suspendisse id ipsum nisl. Donec rhoncus odio eu pretium elementum. Ut non magna efficitur, tincidunt risus id, ultrices diam. Duis non lorem vel mauris rhoncus ullamcorper. Nam consectetur metus ac pellentesque mollis. Sed consectetur ipsum et diam congue, vitae luctus neque laoreet. Nam vel maximus mi, in convallis nisl. Morbi quis mollis felis. Nulla id enim lectus.</span><br></span></p><h1><span><span>heading1</span></span></h1><h2><span><span>heading2</span></span></h2><h3><span><span>heading3</span></span></h3><h4><span><span>heading4</span></span></h4><h5><span><span>heading5</span></span></h5><h6><span><span>heading6</span></span></h6><p><span><span><br></span></span></p>', 'consectetur,adipiscing,elit', 'N', 'N', '127.0.0.1', '0000-00-00 00:00:00', '2014-09-05 05:47:42'),
(4, 'itelic underline stripe link', 'guruahn', 3, '<p>Lorem ipsum <strong>dolor sit amet</strong>, consectetur adipiscing elit. Donec quis metus leo. Fusce semper justo risus, in euismod ante vehicula et. Nulla facilisi. Aenean placerat eget turpis nec egestas. <u>Aliquam porttitor</u> metus sit amet nibh viverra scelerisque. Curabitur id vehicula lorem. Quisque varius lorem ipsum, sed fermentum tortor venenatis sed. Integer interdum nibh quis mi fringilla elementum. Donec faucibus diam quis finibus accumsan. Nullam eget diam a tortor malesuada <strike>convallis in sit amet</strike> diam. Vestibulum sed dui at <a href="http://naver.com" target="_blank" rel="nofollow" class="f-link">nulla consectetur efficitur</a>. Pellentesque laoreet arcu eget lectus tristique fringilla. Fusce feugiat dolor at nisi dignissim egestas. Fusce tempor sagittis porta.<br></p><p>itelic</p><p>underline</p><p>stripe</p>', 'itelic,underline,stripe,link', 'N', 'N', '127.0.0.1', '0000-00-00 00:00:00', '2014-09-05 05:49:41'),
(5, 'code table', 'guruahn', 0, '<p>code</p><p></p><pre><div>&lt;a href="/posts/viewall/"&gt;</div><div>&nbsp; &nbsp; &lt;span&gt;</div><div>&nbsp; &nbsp; list post</div><div>&nbsp; &nbsp; &lt;/span&gt;</div><div>&lt;/a&gt;</div><p></p></pre><p></p><p>table</p><p>	</p><table class="" width="100%"><tbody><tr><td>cell1</td><td>cell2</td></tr></tbody></table><p></p>', 'code,table', 'N', 'N', '127.0.0.1', '0000-00-00 00:00:00', '2014-09-05 05:51:56'),
(6, 'Marcus Mumford & Oscar Isaac', 'guruahn', 0, '<p><iframe width="640" height="360" src="//www.youtube.com/embed/SQyPVBtLXk0?list=RDSQyPVBtLXk0" frameborder="0" allowfullscreen=""></iframe><br></p>', 'video', 'N', 'N', '127.0.0.1', '0000-00-00 00:00:00', '2014-09-05 05:55:12');

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '아이디',
  `user_id` varchar(10) NOT NULL COMMENT '사용자 아이디',
  `name` varchar(20) NOT NULL COMMENT '이름',
  `level` int(2) NOT NULL DEFAULT '0' COMMENT '레벨',
  `password` varchar(50) NOT NULL COMMENT '비밀번호',
  `email` varchar(40) NOT NULL COMMENT '이메일',
  `profile` varchar(50) NOT NULL COMMENT '프로필',
  `register_date` datetime NOT NULL COMMENT '등록일',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 테이블의 덤프 데이터 `user`
--

INSERT INTO `user` (`id`, `user_id`, `name`, `level`, `password`, `email`, `profile`, `register_date`) VALUES
(1, 'guruahn', 'guruahn', 0, '9c4d61ec636053f7c6d32cd5f71f537178571c8a', 'guruahn@gmail.com', 'guruahn', '2014-09-05 14:45:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
