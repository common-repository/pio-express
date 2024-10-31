<?php

function pio_express_faqScreen()
{
?>
    <div class="wrap" style="width: 50%">
        <div class="acc-panel active">
            <label class="collapse" for="_1">Manage Login Page:</label>
            <div class="contentdiv">
                <h2>1. How does it work?</h2>
                <ul>
                    <li>Click on the <strong>PIO &ndash; Express </strong>from the WP Admin Menu and then select the <strong>Manage Login Page.</strong></li>
                    <li>Under Logo Settings, Click the upload logo button and select your desired logo.</li>
                    <li>Click on the save button. That&rsquo;s it. The selected logo will be visible on WP-Login Page</li>
                </ul>
                <h2>2. How to change the logo size?</h2>
                <ul>
                    <li>You just need to enter the desired height and width in the given fields to change the logo size.</li>
                </ul>
                <h2>3. What is the recommended logo size?</h2>
                <ul>
                    <li>The recommended logo max-width is 320px and max-height is 150px.</li>
                </ul>
                <h2>4. Setting Background Image</h2>
                <ul>
                    <li>Under Background Settings, Select Background-Image option.</li>
                    <li>Click the Upload Image button and select your desired Image.</li>
                    <li>Click on the save button. That&rsquo;s it. The selected image will be visible on WP-Login Page.</li>
                </ul>
                <h2>5. Setting Background Color</h2>
                <ul>
                    <li>Under Background Settings, Select Background-Color option.</li>
                    <li>Select the color-picker adjacent to Custom Background Color menu, select your desired color, you can also fill hex value in given box.</li>
                    <li>Click on the save button. That&rsquo;s it. The selected color will be visible on WP-Login Page.</li>
                </ul>
                <h2>6. Setting/Removing Custom Logo Link</h2>
                <ul>
                    <li>Under Link Settings</li>
                    <li>(a)Enter your desired URL, Click on the save button. That&rsquo;s it. The Logo URL is set.</li>
                    <li>(b)If you want to remove the Logo URL, just keep the text-field empty, click on the save button. That&rsquo;s it. The Logo URL has been removed.</li>
                </ul>
                <h2>7. Setting Login Navigation Links Color</h2>
                <ul>
                    <li>Under Link Settings</li>
                    <li>Select the color using the color-picker adjacent to Login Form Navigation Links Color menu, select your desired color, you can also fill hex value in given box.</li>
                    <li>Click on the save button. That&rsquo;s it. The selected color will be visible on WP-Login Page.</li>
                </ul>
                <h2>8. Restore Defaults</h2>
                <ul>
                    <li>Click on Restore Defaults button, the plugin will set to its default state.</li>
                    <li><strong>Note: </strong>This will remove logo, background-image/background-color, navigation links color, set the logo url to your site URL.</li>
                </ul>
            </div>
        </div>
        <div class="acc-panel">

            <label class="collapse" for="_2">Manage Admin Bar:</label>
            <div class="contentdiv">
                <h2>1. How does it work?</h2>
                <ul>
                    <li>Click on the <strong>PIO &ndash; Express </strong>from the WP Admin Menu and then select the <strong>Manage Admin Bar.</strong></p>
                    <li>Turn "ON" the option <b>"All (Excluding Administrator)"</b> to hide the WP Admin Bar for the all roles except Administrator.</li>
                    <li>Turn "ON" the option <b>"For All Roles"</b> to hide the WP Admin Bar for all roles including administrator.</li>
                    <li>Then click on the save button.</li>
                </ul>
            </div>
        </div>
        <div class="acc-panel">

            <label class="collapse" for="_3">Manage API:</label>
            <div class="contentdiv">
                <h2>1. How does it work?</h2>
                <ul>
                    <li>Click on the <strong>PIO &ndash; Express </strong>from the WP Admin Menu and then select the <strong>Manage API.</strong></p>
                    <li>Turn "ON" the option <b>"XML-RPC"</b> to disable XML-RPC.</li>
                    <li>Turn "ON" the option <b>"REST API"</b> to disable REST API.</li>
                    <li>Turn "ON" the option <b>"RSS"</b> to disable RSS.</li>
                    <li>Then click on the save button</li>
                </ul>
            </div>
        </div>

    </div>


<?php
} ?>