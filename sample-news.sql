-- Demo seed data for the existing WordPress categories:
-- National (national), Story (stories), and Uncategorized (uncategorized).
-- Safe to run again: posts with these demo slugs are not duplicated.
-- Run the complete file in one phpMyAdmin SQL session.

DROP TEMPORARY TABLE IF EXISTS `tmp_news_seed`;
CREATE TEMPORARY TABLE `tmp_news_seed` (
	`slug` varchar(200) NOT NULL,
	`category_slug` varchar(200) NOT NULL,
	`title` varchar(255) NOT NULL,
	`content` longtext NOT NULL,
	PRIMARY KEY (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tmp_news_seed` (`slug`, `category_slug`, `title`, `content`) VALUES
('demo-news-20261024-01', 'national', 'নমুনা সংবাদ: জনসেবার তথ্য আরও সহজে পৌঁছানোর উদ্যোগ', 'এটি ওয়েবসাইট পরীক্ষার জন্য তৈরি একটি নমুনা সংবাদ। প্রকাশের আগে বাস্তব তথ্য, সূত্র ও প্রতিবেদকের বিবরণ দিয়ে লেখাটি সম্পাদনা করুন।'),
('demo-news-20261024-02', 'stories', 'নমুনা ফিচার: বই পড়ার অভ্যাসে নতুন প্রজন্ম', 'এটি ওয়েবসাইট পরীক্ষার জন্য তৈরি একটি নমুনা ফিচার। প্রকাশের আগে বাস্তব তথ্য, সূত্র ও প্রতিবেদকের বিবরণ দিয়ে লেখাটি সম্পাদনা করুন।'),
('demo-news-20261024-03', 'uncategorized', 'নমুনা সংবাদ: স্থানীয় উদ্যোগে পরিচ্ছন্নতা কার্যক্রম', 'এটি ওয়েবসাইট পরীক্ষার জন্য তৈরি একটি নমুনা সংবাদ। প্রকাশের আগে বাস্তব তথ্য, সূত্র ও প্রতিবেদকের বিবরণ দিয়ে লেখাটি সম্পাদনা করুন।'),
('demo-news-20261024-04', 'national', 'নমুনা সংবাদ: নাগরিক সেবা নিয়ে নতুন তথ্য নির্দেশিকা', 'এটি ওয়েবসাইট পরীক্ষার জন্য তৈরি একটি নমুনা সংবাদ। প্রকাশের আগে বাস্তব তথ্য, সূত্র ও প্রতিবেদকের বিবরণ দিয়ে লেখাটি সম্পাদনা করুন।'),
('demo-news-20261024-05', 'stories', 'নমুনা ফিচার: শহরের ব্যস্ততায় সবুজের খোঁজ', 'এটি ওয়েবসাইট পরীক্ষার জন্য তৈরি একটি নমুনা ফিচার। প্রকাশের আগে বাস্তব তথ্য, সূত্র ও প্রতিবেদকের বিবরণ দিয়ে লেখাটি সম্পাদনা করুন।'),
('demo-news-20261024-06', 'uncategorized', 'নমুনা সংবাদ: পাঠাগারকেন্দ্রিক কমিউনিটি আয়োজন', 'এটি ওয়েবসাইট পরীক্ষার জন্য তৈরি একটি নমুনা সংবাদ। প্রকাশের আগে বাস্তব তথ্য, সূত্র ও প্রতিবেদকের বিবরণ দিয়ে লেখাটি সম্পাদনা করুন।'),
('demo-news-20261024-07', 'national', 'নমুনা সংবাদ: শিক্ষা কার্যক্রমে ডিজিটাল সহায়তা', 'এটি ওয়েবসাইট পরীক্ষার জন্য তৈরি একটি নমুনা সংবাদ। প্রকাশের আগে বাস্তব তথ্য, সূত্র ও প্রতিবেদকের বিবরণ দিয়ে লেখাটি সম্পাদনা করুন।'),
('demo-news-20261024-08', 'stories', 'নমুনা ফিচার: তরুণদের সৃজনশীল কাজের গল্প', 'এটি ওয়েবসাইট পরীক্ষার জন্য তৈরি একটি নমুনা ফিচার। প্রকাশের আগে বাস্তব তথ্য, সূত্র ও প্রতিবেদকের বিবরণ দিয়ে লেখাটি সম্পাদনা করুন।'),
('demo-news-20261024-09', 'uncategorized', 'নমুনা সংবাদ: পাড়া-মহল্লায় ক্রীড়া আয়োজন', 'এটি ওয়েবসাইট পরীক্ষার জন্য তৈরি একটি নমুনা সংবাদ। প্রকাশের আগে বাস্তব তথ্য, সূত্র ও প্রতিবেদকের বিবরণ দিয়ে লেখাটি সম্পাদনা করুন।'),
('demo-news-20261024-10', 'national', 'নমুনা সংবাদ: পরিবেশবান্ধব অভ্যাস নিয়ে সচেতনতা', 'এটি ওয়েবসাইট পরীক্ষার জন্য তৈরি একটি নমুনা সংবাদ। প্রকাশের আগে বাস্তব তথ্য, সূত্র ও প্রতিবেদকের বিবরণ দিয়ে লেখাটি সম্পাদনা করুন।'),
('demo-news-20261024-11', 'stories', 'নমুনা ফিচার: ঐতিহ্যবাহী খাবারের স্বাদের গল্প', 'এটি ওয়েবসাইট পরীক্ষার জন্য তৈরি একটি নমুনা ফিচার। প্রকাশের আগে বাস্তব তথ্য, সূত্র ও প্রতিবেদকের বিবরণ দিয়ে লেখাটি সম্পাদনা করুন।'),
('demo-news-20261024-12', 'uncategorized', 'নমুনা সংবাদ: স্বাস্থ্যকর জীবনযাপনে দৈনন্দিন অভ্যাস', 'এটি ওয়েবসাইট পরীক্ষার জন্য তৈরি একটি নমুনা সংবাদ। প্রকাশের আগে বাস্তব তথ্য, সূত্র ও প্রতিবেদকের বিবরণ দিয়ে লেখাটি সম্পাদনা করুন।'),
('demo-news-20261024-13', 'national', 'নমুনা সংবাদ: কৃষি তথ্যসেবা নিয়ে সচেতনতামূলক আয়োজন', 'এটি ওয়েবসাইট পরীক্ষার জন্য তৈরি একটি নমুনা সংবাদ। প্রকাশের আগে বাস্তব তথ্য, সূত্র ও প্রতিবেদকের বিবরণ দিয়ে লেখাটি সম্পাদনা করুন।'),
('demo-news-20261024-14', 'stories', 'নমুনা ফিচার: নদীঘেরা জনপদের মানুষের জীবন', 'এটি ওয়েবসাইট পরীক্ষার জন্য তৈরি একটি নমুনা ফিচার। প্রকাশের আগে বাস্তব তথ্য, সূত্র ও প্রতিবেদকের বিবরণ দিয়ে লেখাটি সম্পাদনা করুন।'),
('demo-news-20261024-15', 'uncategorized', 'নমুনা সংবাদ: তরুণ উদ্যোক্তাদের অভিজ্ঞতা বিনিময়', 'এটি ওয়েবসাইট পরীক্ষার জন্য তৈরি একটি নমুনা সংবাদ। প্রকাশের আগে বাস্তব তথ্য, সূত্র ও প্রতিবেদকের বিবরণ দিয়ে লেখাটি সম্পাদনা করুন।'),
('demo-news-20261024-16', 'national', 'নমুনা সংবাদ: সড়ক নিরাপত্তায় নাগরিক সচেতনতা', 'এটি ওয়েবসাইট পরীক্ষার জন্য তৈরি একটি নমুনা সংবাদ। প্রকাশের আগে বাস্তব তথ্য, সূত্র ও প্রতিবেদকের বিবরণ দিয়ে লেখাটি সম্পাদনা করুন।'),
('demo-news-20261024-17', 'stories', 'নমুনা ফিচার: আলোকচিত্রে বাংলাদেশের প্রকৃতি', 'এটি ওয়েবসাইট পরীক্ষার জন্য তৈরি একটি নমুনা ফিচার। প্রকাশের আগে বাস্তব তথ্য, সূত্র ও প্রতিবেদকের বিবরণ দিয়ে লেখাটি সম্পাদনা করুন।'),
('demo-news-20261024-18', 'uncategorized', 'নমুনা সংবাদ: স্বেচ্ছাসেবীদের উদ্যোগে সহায়তা কার্যক্রম', 'এটি ওয়েবসাইট পরীক্ষার জন্য তৈরি একটি নমুনা সংবাদ। প্রকাশের আগে বাস্তব তথ্য, সূত্র ও প্রতিবেদকের বিবরণ দিয়ে লেখাটি সম্পাদনা করুন।'),
('demo-news-20261024-19', 'national', 'নমুনা সংবাদ: সরকারি তথ্য অনলাইনে খুঁজে পাওয়ার উপায়', 'এটি ওয়েবসাইট পরীক্ষার জন্য তৈরি একটি নমুনা সংবাদ। প্রকাশের আগে বাস্তব তথ্য, সূত্র ও প্রতিবেদকের বিবরণ দিয়ে লেখাটি সম্পাদনা করুন।'),
('demo-news-20261024-20', 'stories', 'নমুনা ফিচার: সংগীতচর্চায় তরুণদের পথচলা', 'এটি ওয়েবসাইট পরীক্ষার জন্য তৈরি একটি নমুনা ফিচার। প্রকাশের আগে বাস্তব তথ্য, সূত্র ও প্রতিবেদকের বিবরণ দিয়ে লেখাটি সম্পাদনা করুন।');

START TRANSACTION;

INSERT INTO `wp_posts` (
	`post_author`,
	`post_date`,
	`post_date_gmt`,
	`post_content`,
	`post_title`,
	`post_excerpt`,
	`post_status`,
	`comment_status`,
	`ping_status`,
	`post_name`,
	`to_ping`,
	`pinged`,
	`post_modified`,
	`post_modified_gmt`,
	`post_content_filtered`,
	`post_parent`,
	`guid`,
	`menu_order`,
	`post_type`,
	`post_mime_type`,
	`comment_count`
)
SELECT
	1,
	NOW(),
	UTC_TIMESTAMP(),
	news.`content`,
	news.`title`,
	'',
	'publish',
	'closed',
	'closed',
	news.`slug`,
	'',
	'',
	NOW(),
	UTC_TIMESTAMP(),
	'',
	0,
	'',
	0,
	'post',
	'',
	0
FROM `tmp_news_seed` AS news
LEFT JOIN `wp_posts` AS existing_post
	ON existing_post.`post_name` = news.`slug`
	AND existing_post.`post_type` = 'post'
WHERE existing_post.`ID` IS NULL;

UPDATE `wp_posts` AS seeded_post
JOIN `tmp_news_seed` AS news
	ON news.`slug` = seeded_post.`post_name`
SET `guid` = CONCAT(
	(SELECT `option_value` FROM `wp_options` WHERE `option_name` = 'siteurl' LIMIT 1),
	'/?p=',
	seeded_post.`ID`
)
WHERE seeded_post.`post_type` = 'post'
	AND seeded_post.`guid` = '';

INSERT IGNORE INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`)
SELECT seeded_post.`ID`, taxonomy.`term_taxonomy_id`, 0
FROM `tmp_news_seed` AS news
JOIN `wp_posts` AS seeded_post
	ON seeded_post.`post_name` = news.`slug`
	AND seeded_post.`post_type` = 'post'
JOIN `wp_terms` AS term
	ON term.`slug` = news.`category_slug`
JOIN `wp_term_taxonomy` AS taxonomy
	ON taxonomy.`term_id` = term.`term_id`
	AND taxonomy.`taxonomy` = 'category';

UPDATE `wp_term_taxonomy` AS taxonomy
SET `count` = (
	SELECT COUNT(*)
	FROM `wp_term_relationships` AS relationship
	JOIN `wp_posts` AS published_post
		ON published_post.`ID` = relationship.`object_id`
	WHERE relationship.`term_taxonomy_id` = taxonomy.`term_taxonomy_id`
		AND published_post.`post_status` = 'publish'
		AND published_post.`post_type` = 'post'
)
WHERE taxonomy.`taxonomy` = 'category';

COMMIT;
