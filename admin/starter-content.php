<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class P4_Ramadan_Porch_Starter_Content {
    public static $target_year = '2021'; // @todo update to 2022 for release

    public static function load_content() {
        $days = [
            'sample_fuel',
            'april_2',
            'april_3',
            'april_4',
            'april_5',
            'april_6',
            'april_7',
            'april_8',
            'april_9',
            'april_10',
            'april_11',
            'april_12',
            'april_13',
            'april_14',
            'april_15',
            'april_16',
            'april_17',
            'april_18',
            'april_19',
            'april_20',
            'april_21',
            'april_22',
            'april_23',
            'april_24',
            'april_25',
            'april_26',
            'april_27',
            'april_28',
            'april_29',
            'april_30',
        ];

        $installed = [];
        foreach ( $days as $day ) {
            // get content

            $post = self::$day();

            $content = implode( "", wp_unslash( $post['content'] ) );

            // build args
            $args = [
                'post_title'    => $post['title'],
                'post_date'    => $post['date'],
                'post_content'  => $content,
                'post_excerpt'  => $post['excerpt'] ,
                'post_type'  => PORCH_LANDING_POST_TYPE,
                'post_status'   => 'publish',
                'post_author'   => get_current_user_id(),
                'meta_input' => [
                    PORCH_LANDING_META_KEY => $post['slug'],
                    'starter_1_2022' => true
                ]
            ];

            $installed[] = wp_insert_post( $args );
        }

        dt_write_log( $installed );

        return $installed;
    }

    public static function sample_fuel(){
        return [
            'title' => 'Sample Prayer Fuel',
            'slug' => 'sample-prayer-fuel',
            'date' => gmdate( "Y-m-d" ),
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>SAMPLE OF THE DAILY PRAYER FUEL</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:separator {"className":"is-style-wide"} -->',
                '<hr class="wp-block-separator is-style-wide"/>',
                '<!-- /wp:separator -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>Thank You, Lord, for the Amazigh of Zaghouan! We praise You that they were made in Your image. We pray in faith that this month of Ramadan would be used to awaken them to eternity and prepare their hearts for the Gospel.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>My husband and I have been Christians for many years and we seek to serve Him faithfully. Please pray for the spiritual children God has given us. Pray they would take the things they’ve learned from us and teach others (2 Timothy 2:2). Pray that we would have many generations of spiritual grandchildren and great-great-grandchildren.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p><em>“And all these, though commended through their faith, did not receive what was promised, since God had provided something better for us, that apart from us they should not be made perfect.” (Hebrews 11:39-40)&nbsp;</em>Thank You, Lord, for the beautiful tapestry of faith you are weaving through believers across the centuries. We pray for many Tunisians to be brought into this promise, even during this month of Ramadan. Amen!</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>Tunisians have been raised to memorize and recite the Koran, but not necessarily to apply it to their lives. When new believers begin reading the Bible, sometimes they find it hard to understand that God desires that His children not only read His Word but obey it. Pray that new Christians will be a light to the world around them by the way they obey the scriptures. James 2:17 says, “.<em>.. faith by itself if it is not accompanied by action, is dead</em>.”</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>The LORD alone is worthy of all praise. All the heavens, earth, and nations will bless Your name. (Psalm 145:21) “<em>My mouth will speak the praise of the Lord,&nbsp;and let all flesh bless his holy name forever and ever.</em>“</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_2(){
        return [
            'title' => 'April 2',
            'slug' => 'april-2',
            'date' => self::$target_year . '-04-02',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>We pray for the man in Ariana who is reading the Bible because he wants to know more about Christ. Hear our prayers, Lord.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>I am O., a young woman from Zahrouni. I became a Christian in the last year. Please pray that I will have wisdom and boldness to share with my family.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>"Now faith is the assurance of things hoped for, the conviction of things not seen. For by it the people of old received their commendation." (Hebrews 11:1-2) Give every believer in Tunisia courage to live by faith instead of by sight."</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>Each morning, many Tunisians wake up and read their horoscopes in order to know how to live each day.  They want to know their destinies, but don\'t entrust their futures to God.  Isaiah 47:13 warns that astrologists cannot save us, but God wants us to trust in Him alone to plan our futures. Pray that Tunisians would trust God with their lives.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>"The LORD alone is Creator. You made the heavens, the earth, and all the nations. (Psalm 33:6-9) ""By the word of the Lord the heavens were made,
                        and by the breath of his mouth all their host.
                    He gathers the waters of the sea as a heap;
                        he puts the deeps in storehouses.
                    Let all the earth fear the Lord;
                        let all the inhabitants of the world stand in awe of him!
                    For he spoke, and it came to be;
                        he commanded, and it stood firm."</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_3(){
        return [
            'title' => 'April 3',
            'slug' => 'april-3',
            'date' => self::$target_year . '-04-03',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>Thank You for the man in Beja who said he is reading slowly through the Bible. Please open the eyes of his heart to the truth of Your word.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>I am H. from Tunis. I have been a believer for 4 years. I shared with my sister and her daughters, and they also believed! However, my husband and my own daughter have refused to believe. My daughter suffers from the results of witchcraft and is possessed by evil spirits. Please pray for her. She sometimes tries to take her own life.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>"By faith we understand that the universe was created by the word of God, so that what is seen was not made out of things that are visible." (Hebrews 11:3) As Tunisians encounter the beauty of your creation through Mediterranean beaches, Saharan desert dunes, and luscious green hills may they be drawn to the Word through whom You created the world.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>When Tunisians decide to follow Christ, they often find it hard to read the Bible.  There may be several reasons.  In the Tunisian culture people don`t tend to enjoy reading because it is rare to find books in the heart language. As Muslims, the Koran is difficult to understand so they leave the reading to the religious leaders.  Many Tunisians now prefer to watch YouTube videos rather than read. When Tunisians become Christians, if they don\'t immerse themselves in the Word, they find that they can\'t defend their faith when opposition comes. New believers don\'t continue in maturity when they don\'t read the Bible.  Recently, a few groups have begun, focusing on reading the Bible in a short period of time in order to understand God\'s big picture plan.  Pray for these groups to grow and continue.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>The LORD alone is Owner. The heavens, the earth, and all the nations belong to You. (Psalm 24:1). "The earth is the Lord\'s and the fullness thereof, the world and those who dwell therein..."</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_4(){
        return [
            'title' => 'April 4',
            'slug' => 'april-4',
            'date' => self::$target_year . '-04-04',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>We pray for the man in Ben Arous who has been on a journey towards Christ for quite a while. He has been reading the Bible and seems to be more open than ever. </p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>I am S. from Bizerte. I am a Christian. I would like for you to pray for me. I suffer from severe back pain. Also pray that I will be able to share my faith with those I love.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>"By faith Abel offered to God a more acceptable sacrifice than Cain, through which he was commended as righteous..." (Hebrews 11:4a) Convict Tunisians this Ramadan, Lord, that we can only be made right before you on your terms through faith, not ours.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>For many Tunisians, money is their god.  Many are poor and believe the value of a person lies in how much money he has.  People marry based on the amount of money someone has.  Friendships are based on money.  Even in Christian families, couples find themselves still struggling to agree on how to view money.  Christians sometimes struggle to break away from money as a motivator in their lives.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>"The LORD alone is Ruler. You govern the heavens, the earth, and all the nations. (Psalm 33:10-11) ""The Lord brings the counsel of the nations to nothing;
    he frustrates the plans of the peoples.
The counsel of the Lord stands forever,
    the plans of his heart to all generations."</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_5(){
        return [
            'title' => 'April 5',
            'slug' => 'april-5',
            'date' => self::$target_year . '-04-05',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>We pray for the man in Binzerte who started reading the Bible after his wife left him and their children. Draw his heart to you and may he bring Good News to his whole family. </p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>I am S. from just outside Tunis. I am learning about the Christian faith. I was severely abused as a child. I have friends like me who are now confused about the trauma of the past and about gender. Please pray for us. I want the Lord to forgive me, and I want to know His will for my life.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>"...Now before he [Enoch] was taken he was commended as having pleased God." (Hebrews 11:5b) May believers in Tunisia, through faith, seek commendation from You more than man. May they live their lives in pursuit of Your approval alone.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>Many young people today say that all religions are the same.  When they reject Islam because of its violence or lack of love, they reject all religions as man-made.  They claim to be atheists.  Pray for those who reject Islam, that they would search for a true relationship with God. </p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>"The LORD alone is Judge. You call the heavens, the earth, and all the nations to account. (Psalm 33:13-15) ""The Lord looks down from heaven;
    he sees all the children of man;
from where he sits enthroned he looks out
    on all the inhabitants of the earth,
he who fashions the hearts of them all
    and observes all their deeds."""</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_6(){
        return [
            'title' => 'April 6',
            'slug' => 'april-6',
            'date' => self::$target_year . '-04-06',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>Thank You for the man In Gabes who is reading the Bible every night. We pray for him to courageously obey Your Word and to find others who are open to reading the Bible, too.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>I am N. My three daughters and I are Christians. We want to share our faith with others. My husband passed away this year and left us with many debts. Pray that I will be able to pay for my daughters’ education expenses and at the same time pay off our debts.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>"And without faith it is impossible to please him, for whoever would draw near to God must believe that he exists and that he rewards those who seek him." (Hebrews 11:6) Lord, please cause multitudes of Tunisians to seek You and experience the greatest reward -- Yourself! </p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>Sometimes Tunisian Christians find it hard to have strong relationships with other Tunisians.  Satan divides.  Pray that God would unify believers in One Spirit and One Truth.  </p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>"The LORD alone is Revealer. In relation to the heavens, the earth, and all the nations, You speak the truth. (Psalm 33:4) ""For the word of the Lord is upright,
    and all his work is done in faithfulness."""</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_7(){
        return [
            'title' => 'April 7',
            'slug' => 'april-7',
            'date' => self::$target_year . '-04-07',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>Thank You for the woman in Gafsa who is hungry to read the Bible. May she voraciously read it and share it with others.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>I am from Ben Arous. I chose to follow Jesus this year. I love reading the Bible and learning more about God. Two years ago my father died. Please pray for my mother and sister. I have been sharing the gospel with them.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>"By faith Noah, being warned by God concerning events as yet unseen, in reverent fear constructed an ark for the saving of his household..." (Hebrews 11:7a) We pray for many heads of household, who like Noah, would take outrageous risks for the sake of saving their families.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>Distractions can be a major obstacle to spiritual growth.  Tunisians who begin a relationship with Jesus, sometimes find themselves distracted by jobs, relationships, health, and the worries of this world.  Even when Christians pray, sometimes they find it hard to pray without distraction.  Pray that Tunisian Christians will have clarity as they pray and grow in the Word.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>"The LORD alone is Lover. You love all that You made -- the heavens, the earth, and all the nations. (Psalm 145:9) ""The Lord is good to all,
    and his mercy is over all that he has made."</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_8(){
        return [
            'title' => 'April 8',
            'slug' => 'april-8',
            'date' => self::$target_year . '-04-08',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>Thank you for the man in Jendouba who is reading the Bible for the first time. Lead him to faith in You and to share Your word with others. </p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>I am S. from Tunis. I am a Christian. My husband and daughters are Christians as well. We face persecution from our extended family. Please pray for our relatives and that we will know how to love them and be a light to them.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>"By faith Abraham obeyed when he was called to go out to a place that he was to receive as an inheritance. And he went out, not knowing where he was going." (Hebrews 11:8) May both seekers and believers in Tunisia be willing to start on a journey of obedience to You despite not knowing how it may turn out in this life. </p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>There is long held belief that treasures are hidden in the earth and that spirits protect them.  If one will give sacrifices to the spirits, they will reveal the treasure.  Some have even offered their babies with a special mark as a sacrifice.  Pray that this evil practice would stop.  Pray that people would no longer be drawn to these earthly treasures but to God\'s heavenly treasure.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>"The LORD alone is Savior. You save all who turn to You in all the earth and among the nations. (Psalm 36:6) "" Your righteousness is like the mountains of God;
    your judgments are like the great deep;
    man and beast you save, O Lord."</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_9(){
        return [
            'title' => 'April 9',
            'slug' => 'april-9',
            'date' => self::$target_year . '-04-09',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>We praise you for the man in Kairouan who is reading the Bible and has questions. May he find that all of his questions are answered in Christ\'s life, death, burial, and resurrection. </p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>I am I. I have been a believer for 15 years. My wife and daughters are also believers. I have a dream to see all of Tunisia reached for Christ. I travel the country sharing my faith. Pray that our family will be able to minister together. Pray that we will be able to help others start house churches.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>"By faith he went to live in the land of promise as in a foreign land, living in tents with Isaac and Jacob, heirs with him of the same promise. For he was looking forward to the city that has foundations, whose designer and builder is God." (Hebrews 11:9-10) May Tunisian believers embrace their heavenly citizenship and being confirmed into heaven\'s customs, language, priorities, and values in ever-increasing measures.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>Every small town has its own saint and shrines dedicated to these saints.  These shrines are often found outside the town in a high place, just as the high places in the Old Testament, so that the saint can protect the area.  Tunisians go to these shrines and offer animal sacrifices and vows in order to receive help in their studies, finding a mate, fertility, and money.  These covenants tie them spiritually to spirits that keep them in bondage.  Pray for freedom from those who have previously made covenants with these spirits.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>"The LORD alone is Leader. You guide all the nations. (Psalm 67:4) ""Let the nations be glad and sing for joy,
    for you judge the peoples with equity
    and guide the nations upon earth."""</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_10(){
        return [
            'title' => 'April 10',
            'slug' => 'april-10',
            'date' => self::$target_year . '-04-10',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>Thank you for the man in Kasserine who is reading the Bible and has put his trust in Jesus. May he be soil that goes on to reproduce 30, 60, and 100 fold throughout this region. </p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>I am R and am from a traditional family in the countryside. I have been a believer for 2 months. I was disillusioned with Islam and found much hope and love in Christ. I ask that you pray that I can share the gospel of Christ with my family. Pray that God will begin to work on opening their hearts.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>"By faith Sarah herself received power to conceive, even when she was past the age, since she considered him faithful who had promised." (Hebrews 11:11) Please give every believer in Tunisia spiritual children no matter how long they have in the faith. Let each one trust Your faithfulness that You will give them spiritual children as they obey You. </p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>Before they became Christans, some Tunisians were possessed by spirits who enabled them to prophesy or speak in other languages.  In Acts 16:16-24 we read the story of Paul delivering a slave girl from an evil spirit that allowed her to prophesy.  In the same way, pray that seekers and Christians would be delivered from these spirits.</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>"The LORD alone is Creator. You made the heavens, the earth, and all the nations. (Jeremiah 10:10-12) ""But the Lord is the true God;
    he is the living God and the everlasting King.
At his wrath the earth quakes,
    and the nations cannot endure his indignation.
Thus shall you say to them: “The gods who did not make the heavens and the earth shall perish from the earth and from under the heavens.”

It is he who made the earth by his power,
    who established the world by his wisdom,
    and by his understanding stretched out the heavens."""</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_11(){
        return [
            'title' => 'April 11',
            'slug' => 'april-11',
            'date' => self::$target_year . '-04-11',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_12(){
        return [
            'title' => 'April 12',
            'slug' => 'april-12',
            'date' => self::$target_year . '-04-12',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_13(){
        return [
            'title' => 'April 13',
            'slug' => 'april-13',
            'date' => self::$target_year . '-04-13',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_14(){
        return [
            'title' => 'April 14',
            'slug' => 'april-14',
            'date' => self::$target_year . '-04-14',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_15(){
        return [
            'title' => 'April 15',
            'slug' => 'april-15',
            'date' => self::$target_year . '-04-15',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_16(){
        return [
            'title' => 'April 16',
            'slug' => 'april-16',
            'date' => self::$target_year . '-04-16',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_17(){
        return [
            'title' => 'April 17',
            'slug' => 'april-17',
            'date' => self::$target_year . '-04-17',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_18(){
        return [
            'title' => 'April 18',
            'slug' => 'april-18',
            'date' => self::$target_year . '-04-18',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_19(){
        return [
            'title' => 'April 19',
            'slug' => 'april-19',
            'date' => self::$target_year . '-04-19',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_20(){
        return [
            'title' => 'April 20',
            'slug' => 'april-20',
            'date' => self::$target_year . '-04-20',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_21(){
        return [
            'title' => 'April 21',
            'slug' => 'april-21',
            'date' => self::$target_year . '-04-21',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_22(){
        return [
            'title' => 'April 22',
            'slug' => 'april-22',
            'date' => self::$target_year . '-04-22',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_23(){
        return [
            'title' => 'April 23',
            'slug' => 'april-23',
            'date' => self::$target_year . '-04-23',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_24(){
        return [
            'title' => 'April 24',
            'slug' => 'april-24',
            'date' => self::$target_year . '-04-24',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_25(){
        return [
            'title' => 'April 25',
            'slug' => 'april-25',
            'date' => self::$target_year . '-04-25',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_26(){
        return [
            'title' => 'April 26',
            'slug' => 'april-26',
            'date' => self::$target_year . '-04-26',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_27(){
        return [
            'title' => 'April 27',
            'slug' => 'april-27',
            'date' => self::$target_year . '-04-27',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_28(){
        return [
            'title' => 'April 28',
            'slug' => 'april-28',
            'date' => self::$target_year . '-04-28',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_29(){
        return [
            'title' => 'April 29',
            'slug' => 'april-29',
            'date' => self::$target_year . '-04-29',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

    public static function april_30(){
        return [
            'title' => 'April 30',
            'slug' => 'april-30',
            'date' => self::$target_year . '-04-30',
            'excerpt' => 'Focus prayer on the Amazigh in Zaghouan, the southern region of Tunisia.',
            'content' => [
                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Regions/UUPGs:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition from a Tunisian Believer:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Pray Hebrews 11 for Tunisia:&nbsp;</strong></h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Petition Against Spiritual Barriers:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',

                '<!-- wp:heading {"level":3} -->',
                '<h3><strong>Praise the One True God:</strong>&nbsp;</h3>',
                '<!-- /wp:heading -->',

                '<!-- wp:paragraph -->',
                '<p>replace</p>',
                '<!-- /wp:paragraph -->',
            ]
        ];
    }

}
