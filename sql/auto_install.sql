
-- Drop table if it exists
DROP TABLE IF EXISTS `civicrm_membership_terms`;

-- /*******************************************************
-- *
-- * civicrm_membership_terms
-- *
-- * Record a membership terms
-- *
-- *******************************************************/
CREATE TABLE `civicrm_membership_terms` (
   `id` int unsigned NOT NULL AUTO_INCREMENT  COMMENT 'Unique MembershipTerms ID',
   `nth_term` int unsigned NOT NULL  DEFAULT 1 COMMENT 'Number of Term',
   `start_date` datetime NOT NULL   COMMENT 'Term Start Date',
   `end_date` datetime NOT NULL   COMMENT 'Term End Date',
   `membership_id` int unsigned    COMMENT 'Foreign Key to Membership',
    PRIMARY KEY (`id`),
    CONSTRAINT FK_civicrm_membership_terms_membership_id
        FOREIGN KEY (`membership_id`) REFERENCES `civicrm_membership`(`id`) ON DELETE CASCADE
)  ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci  ;
