<?php
use AddonsKit\Elementor\Addons_Manager;
?>

    <div id="widgets" class="ake-dashboard-tab">
        <div class="ake-element-filter">
            <div class="ake-element-filter-btn">
                <ul>
                    <li>
                        <a href="" class="ake-elements-enable"><?php echo __('Enable All', 'addons-kit-elementor') ?></a>
                    </li>
                    <li>
                        <a href="" class="ake-elements-disable"><?php echo __('Disable All', 'addons-kit-elementor') ?></a>
                    </li>
                </ul>
            </div>
            <div class="ake-element-filter-text">
                <div class="ake-element-filter-search">
                    <input id="ake-element-filter-search-input" type="text" placeholder="<?php echo __('Search Widget', 'addons-kit-elementor') ?>">
                </div>
            </div>
        </div>
        <div class="ake-dashboard-checkbox-container">
            <?php ksort( Addons_Manager::$default_addons ); ?>
            <?php foreach ( Addons_Manager::$default_addons as $key => $widget ) : ?>
            <?php if (isset($key)) : ?>
                <div class="ake-dashboard-checkbox-wrapper" data-tag="<?php echo esc_attr($widget['tags']); ?>">
                    <div class="ake-dashboard-checkbox <?php echo esc_attr($widget['tags']); ?> active" data-tag="<?php echo esc_attr($widget['tags']); ?>">
                        <?php if (true === $widget['is_pro']) { ?>
                            <div class="ake-dashboard-item-label">
                                <span class="ake-el-label"><?php echo esc_html($widget['tags']); ?></span>
                            </div>
                        <?php } ?>
                        <div class="ake-dashboard-checkbox-text">
                            <p class="exad-el-title"><?php echo esc_html($widget['title']); ?></p>
                        </div>
                        <div class="ake-dashboard-checkbox-label">
                            <input class="ake-dashboard-input" type="checkbox"
                                id="<?php echo esc_attr($key); ?>" name="<?php echo esc_attr($key); ?>" 
                                <?php echo checked(1, $this->get_dashboard_settings[$key], true); ?>>
                            <label for="<?php echo esc_attr($key); ?>"></label>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var checkboxWrappers = document.querySelectorAll('.ake-dashboard-checkbox-wrapper');

        checkboxWrappers.forEach(function (wrapper) {
            wrapper.addEventListener('click', function () {
                var checkbox = wrapper.querySelector('.ake-dashboard-input');
                if (!checkbox.disabled) {
                    checkbox.checked = !checkbox.checked;
                }
            });
        });
    });
</script>