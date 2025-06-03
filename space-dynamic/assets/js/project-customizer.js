(function($) {
    // Live preview for image
    wp.customize('project_section_image', function(value) {
        value.bind(function(newval) {
            $('.left-image img').attr('src', newval);
        });
    });

    // Live preview for image alt text
    wp.customize('project_image_alt', function(value) {
        value.bind(function(newval) {
            $('.left-image img').attr('alt', newval);
        });
    });

    // Live preview for heading
    wp.customize('project_section_heading', function(value) {
        value.bind(function(newval) {
            $('.section-heading h1, .section-heading h2, .section-heading h3, .section-heading h4, .section-heading h5, .section-heading h6').html(newval);
        });
    });

    // Live preview for paragraph
    wp.customize('project_section_paragraph', function(value) {
        value.bind(function(newval) {
            $('.section-heading p').html(newval);
        });
    });

    // Live preview for heading tag
    wp.customize('project_heading_tag', function(value) {
        value.bind(function(newval) {
            var currentHeading = $('.section-heading h1, .section-heading h2, .section-heading h3, .section-heading h4, .section-heading h5, .section-heading h6');
            var headingText = currentHeading.html();
            currentHeading.replaceWith('<' + newval + '>' + headingText + '</' + newval + '>');
        });
    });

    // Live preview for section visibility
    wp.customize('show_project_section', function(value) {
        value.bind(function(newval) {
            if (newval) {
                $('#services').show();
            } else {
                $('#services').hide();
            }
        });
    });

})(jQuery);