<?php
$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));

$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);
$hassidetop = $PAGE->blocks->region_has_content('side-top', $OUTPUT);

$showsidepre = ($hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT));
$showsidepost = ($hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT));
$showsidetop = ($hassidetop && !$PAGE->blocks->region_completely_docked('side-top', $OUTPUT));

$bodycolumnclass = '';
if($showsidepre && $showsidepost){
    $bodycolumnclass = 'col2-4l';
} else if ($showsidepre || $showsidepost){
    $bodycolumnclass = 'col3-4';
} else {
    $bodycolumnclass = 'col4-4';
}

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$bodyclasses = array();
if ($showsidepre && $showsidepost != 1) {
    $bodyclasses[] = 'side-pre-only';
} else if ($showsidepost && $showsidepre != 1) {
    $bodyclasses[] = 'side-post-only';
} else if ($showsidepost != 1 && $showsidepre != 1) {
    $bodyclasses[] = 'content-only';
}

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

    <div class="content-wrap" id="region-main">
        <?php echo $OUTPUT->main_content() ?>
    </div>
</section>

<div id="region-top" class="block-region">
    <div class="region-content">
        <?php echo $OUTPUT->blocks_for_region('side-top') ?>
    </div>
</div>

<?php if ($hassidepost) { ?>
<div id="region-post" class="block-region">
    <div class="region-content">
        <?php echo $OUTPUT->blocks_for_region('side-post') ?>
    </div>
</div>
<?php } ?>

<?php if ($hassidepre) { ?>
<div id="region-pre" class="block-region">
    <div class="region-content">
        <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
    </div>
</div>
<?php } ?>

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