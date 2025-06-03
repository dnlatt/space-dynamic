/**
 * Customizer Live Preview JavaScript
 * This file handles real-time preview updates in the WordPress Customizer
 */

(function($) {
    'use strict';

    // Hero Section Live Preview
    wp.customize('hero_subtitle', function(value) {
        value.bind(function(newval) {
            $('.hero-subtitle').html(newval);
        });
    });

    wp.customize('hero_title', function(value) {
        value.bind(function(newval) {
            $('.hero-title').html(newval);
        });
    });

    wp.customize('hero_description', function(value) {
        value.bind(function(newval) {
            $('.hero-description').html(newval);
        });
    });

    // Banner Image Live Preview
    wp.customize('banner_right_image', function(value) {
        value.bind(function(newval) {
            $('.banner-image img, [data-customize-setting-link="banner_right_image"]').attr('src', newval);
        });
    });

    // Banner Image Alt Text Live Preview
    wp.customize('banner_image_alt', function(value) {
        value.bind(function(newval) {
            $('.banner-image img, [data-customize-setting-link="banner_right_image"]').attr('alt', newval);
        });
    });

    // Show/Hide Banner Image
    wp.customize('show_banner_image', function(value) {
        value.bind(function(newval) {
            if (newval) {
                $('.banner-image').show();
            } else {
                $('.banner-image').hide();
            }
        });
    });

    // Banner Image Animation
    wp.customize('banner_image_animation', function(value) {
        value.bind(function(newval) {
            var $bannerImage = $('.banner-image');
            
            // Remove existing animation classes
            $bannerImage.removeClass('fadeInRight fadeInLeft fadeInUp fadeInDown fadeIn bounceInRight slideInRight');
            
            // Add new animation class
            $bannerImage.addClass(newval);
        });
    });

    // Project Section Live Preview
    wp.customize('project_section_image', function(value) {
        value.bind(function(newval) {
            $('[data-customize-setting-link="project_section_image"]').attr('src', newval);
        });
    });

    wp.customize('project_section_heading', function(value) {
        value.bind(function(newval) {
            $('[data-customize-setting-link="project_section_heading"]').html(newval);
        });
    });

    wp.customize('project_section_paragraph', function(value) {
        value.bind(function(newval) {
            $('[data-customize-setting-link="project_section_paragraph"]').html(newval);
        });
    });

    wp.customize('project_image_alt', function(value) {
        value.bind(function(newval) {
            $('[data-customize-setting-link="project_section_image"]').attr('alt', newval);
        });
    });

    // Project Heading Tag Change
    wp.customize('project_heading_tag', function(value) {
        value.bind(function(newval) {
            var $heading = $('[data-customize-setting-link="project_section_heading"]');
            var headingText = $heading.html();
            var newHeading = '<' + newval + ' data-customize-setting-link="project_section_heading">' + headingText + '</' + newval + '>';
            $heading.replaceWith(newHeading);
        });
    });

    // Show/Hide Project Section
    wp.customize('show_project_section', function(value) {
        value.bind(function(newval) {
            if (newval) {
                $('#services.our-services').show();
            } else {
                $('#services.our-services').hide();
            }
        });
    });

    // Agency Heading Live Preview
    wp.customize('agency_heading_text', function(value) {
        value.bind(function(newval) {
            $('.agency-heading').html(newval);
        });
    });

    // Blog Heading Live Preview
    wp.customize('blog_heading_text', function(value) {
        value.bind(function(newval) {
            $('.blog-heading').html(newval);
        });
    });

    // Helper function to update CSS classes
    function updateElementClass($element, newClass, classesToRemove) {
        if (classesToRemove) {
            $element.removeClass(classesToRemove);
        }
        $element.addClass(newClass);
    }

    // Helper function to safely update HTML content
    function updateElementContent(selector, content) {
        var $element = $(selector);
        if ($element.length) {
            $element.html(content);
        }
    }

    // Helper function to safely update attributes
    function updateElementAttribute(selector, attribute, value) {
        var $element = $(selector);
        if ($element.length) {
            $element.attr(attribute, value);
        }
    }

    // Enhanced image preview with loading states
    function updateImagePreview(selector, newSrc) {
        var $img = $(selector);
        if ($img.length && newSrc !== $img.attr('src')) {
            // Add loading class
            $img.addClass('loading');
            
            // Create new image to preload
            var newImg = new Image();
            newImg.onload = function() {
                $img.attr('src', newSrc);
                $img.removeClass('loading');
            };
            newImg.onerror = function() {
                $img.removeClass('loading');
                console.warn('Failed to load image: ' + newSrc);
            };
            newImg.src = newSrc;
        }
    }

    // Advanced animation handling
    function handleAnimationChange(selector, newAnimation, allAnimations) {
        var $element = $(selector);
        if ($element.length) {
            // Remove all animation classes
            $element.removeClass(allAnimations.join(' '));
            
            // Add new animation class
            if (newAnimation) {
                $element.addClass(newAnimation);
                
                // Trigger animation by temporarily removing and re-adding the class
                setTimeout(function() {
                    $element.removeClass(newAnimation);
                    setTimeout(function() {
                        $element.addClass(newAnimation);
                    }, 50);
                }, 50);
            }
        }
    }

    // Initialize live preview on document ready
    $(document).ready(function() {
        // Add any initialization code here
        console.log('Customizer live preview initialized');
        
        // Add loading styles for images
        $('<style>')
            .prop('type', 'text/css')
            .html(`
                .loading {
                    opacity: 0.5;
                    transition: opacity 0.3s ease;
                }
                .loading::after {
                    content: '';
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    width: 20px;
                    height: 20px;
                    margin: -10px 0 0 -10px;
                    border: 2px solid #ccc;
                    border-top-color: #333;
                    border-radius: 50%;
                    animation: spin 1s linear infinite;
                }
                @keyframes spin {
                    to { transform: rotate(360deg); }
                }
            `)
            .appendTo('head');
    });

    // Handle selective refresh fallback
    if (typeof wp.customize.selectiveRefresh !== 'undefined') {
        wp.customize.selectiveRefresh.bind('partial-content-rendered', function(placement) {
            // Re-initialize any JavaScript that might be needed after partial refresh
            console.log('Partial content rendered for:', placement.partial.id);
        });
    }

})(jQuery);