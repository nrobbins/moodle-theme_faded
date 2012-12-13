<?php
$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));


$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$bodyclasses = array();
$bodyclasses[] = 'content-only';

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <title><?php echo $PAGE->title ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
    <meta name="description" content="<?php p(strip_tags(format_text($SITE->summary, FORMAT_HTML))) ?>" />
    <!--[if lt IE 9]><script src="<?php echo $CFG->wwwroot.'/theme/faded/js/html5shiv.js'; ?>"></script><![endif]-->
    <?php echo $OUTPUT->standard_head_html() ?>
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>
<div id="page-wrap">

<?php if ($hasheading) { ?>
    <header>
        <h1 class="headermain"><?php echo $PAGE->heading ?></h1>
        <div class="headermenu"><?php
            echo $OUTPUT->login_info();
                if (!empty($PAGE->layout_options['langmenu'])) {
                    echo $OUTPUT->lang_menu();
                }
            echo $PAGE->headingmenu ?>
        </div>
    </header>
<?php } ?>

<?php if ($hascustommenu || $PAGE->button) { ?>
    <nav class="custommenu">
        <?php echo $custommenu; ?>
        <div class="pagebutton">
            <?php echo $PAGE->button; ?>
        </div>
    </nav>
<?php } ?>

<div id="page-content">

<section class="main-content <?php echo $bodycolumnclass ?>">

<?php if ($hasnavbar) { ?>
    <nav class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></nav>
<?php } ?>
    <div class="content-wrap" id="region-main">
        <?php echo $OUTPUT->main_content() ?>
    </div>
</section>

</div>

<?php if ($hasfooter) { ?>
<footer>
    <div class="foot-wrap">
        <p class="helplink"><?php echo page_doc_link(get_string('moodledocslink')) ?></p>
        <?php
        echo $OUTPUT->login_info();
        echo $OUTPUT->home_link();
        echo $OUTPUT->standard_footer_html();
        ?>
    </div>
</footer>
<?php } ?>
</div>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>