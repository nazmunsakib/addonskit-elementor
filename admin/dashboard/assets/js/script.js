jQuery(function($) {
    'use strict';

    // Dashboard Tabs
$('.ake-dashboard-tabs li.ake-tab-btn a').on('click', function(e) {
    e.preventDefault();
    let $this = $(this);

    // Remove "active" class from all tab buttons
    $('.ake-dashboard-tabs li.ake-tab-btn a').removeClass('active');

    // Add "active" class to the clicked tab button
    $this.addClass('active');

    // Remove "active" class from all tabs
    $('.ake-dashboard-tabs-box > div').removeClass('active');

    // Add "active" class to the corresponding tab
    let tab = $this.attr('href');
    $(`.ake-dashboard-tabs-box ${tab}`).addClass('active');
});

function updateActiveSwitcherPosition(tab) {
    $('.ake-dashboard-tab, .ake-dashboard-tabs li.ake-tab-btn a').removeClass('active');
    $(`.ake-dashboard-tabs-box ${tab}`).addClass('active');
}


    // Save Button reacting on any changes
    let saveHeaderAction = $('.ake-dashboard-header-right .ake-btn');
    $('.ake-dashboard-tab input, .ake-dashboard-tab button').on('click', () => handleSaveButtonState());

    function handleSaveButtonState() {
        saveHeaderAction.addClass('ake-save-now').removeAttr('disabled').css('cursor', 'pointer');
    }

    // Saving Data With Ajax Request
    $('.ake-save-setting').on('click', function(e) {
        e.preventDefault();
        let $this = $(this);
        if ($this.hasClass('ake-save-now')) {
            $.ajax({
                url: ake_admin.ajaxurl,
                type: 'post',
                data: {
                    action: 'ake_save_widgets_setting',
                    security: ake_admin.ajax_nonce,
                    fields: $('#ake-elements-settings').serialize(),
                },
                beforeSend: function() {
                    $this.html('<svg id="ake-spinner" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><circle cx="24" cy="4" r="4" fill="#fff"/><circle cx="12.19" cy="7.86" r="3.7" fill="#fffbf2"/><circle cx="5.02" cy="17.68" r="3.4" fill="#fef7e4"/><circle cx="5.02" cy="30.32" r="3.1" fill="#fef3d7"/><circle cx="12.19" cy="40.14" r="2.8" fill="#feefc9"/><circle cx="24" cy="44" r="2.5" fill="#feebbc"/><circle cx="35.81" cy="40.14" r="2.2" fill="#fde7af"/><circle cx="42.98" cy="30.32" r="1.9" fill="#fde3a1"/><circle cx="42.98" cy="17.68" r="1.6" fill="#fddf94"/><circle cx="35.81" cy="7.86" r="1.3" fill="#fcdb86"/></svg><span>Saving Data..</span>');
                },
                success: function(response) {
                    $this.html('Save Settings');
                    $('.ake-dashboard-header-right').prepend('<span class="ake-settings-saved">Settings Saved</span>').fadeIn('slow');
                    saveHeaderAction.removeClass('ake-save-now');
                    setTimeout(function() {
                        $('.ake-settings-saved').fadeOut('slow');
                    }, 2000);
                },
                error: function() {}
            });
        } else {
            $this.attr('disabled', 'true').css('cursor', 'not-allowed');
        }
    });

    // Checkbox handling
    let inputCheck = $('.ake-dashboard-checkbox.active .ake-dashboard-checkbox-label input');
    inputCheck.each(function() {
        if ($(this).prop("checked")) {
            $(this).closest(".ake-dashboard-checkbox.active").addClass("selected");
        }
    });

    inputCheck.change(function() {
        if ($(this).is(":checked")) {
            $(this).closest(".ake-dashboard-checkbox.active").addClass("selected");
        } else {
            $(this).closest(".ake-dashboard-checkbox.active").removeClass("selected");
        }
    });

    // Enable All and Disable All functionality
    $('.ake-elements-enable, .ake-elements-disable').click(function(e) {
        e.preventDefault();
        let selected = $(this).hasClass('ake-elements-enable');
        inputCheck.each(function() {
            let checkBoxActive = $(this).closest(".ake-dashboard-checkbox.active");
            if (checkBoxActive.css('display') === 'flex') {
                checkBoxActive.toggleClass("selected", selected);
                $(this).prop('checked', selected).change();
            }
        });
        saveHeaderAction.addClass('ake-save-now');
    });

    // Search Filter
    let inputSearch = $('#ake-element-filter-search-input');
    let searchResult = $('.ake-dashboard-checkbox-container .ake-dashboard-checkbox');
    inputSearch.on("keyup", function() {
        let value = $(this).val().toLowerCase();
        searchResult.filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

});
