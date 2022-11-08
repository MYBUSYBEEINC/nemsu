<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

		</div><!-- #main -->
		<div class="clear"></div>

        <div class="site-content">
        
        
        </div>

    <div class="standardfooter-wrapper">
        <div class="standardfooter-container">

            <div class="footerfl">
                <div>
                    <img class="imgleft" src="<?php echo get_stylesheet_directory_uri(); ?>/images/rp.webp">
                    <div class="title">Republic of the Philippines</div>
                    All content is in the public domain unless otherwise stated.
                </div>
                <div class="clear" style="margin-bottom: 20px;"></div>
                <div>
                    <img class="imgleft" src="<?php echo get_stylesheet_directory_uri(); ?>/images/foi.png"><div class="title">FREEDOM OF INFORMATION</div>
                    <a href="https://www.foi.gov.ph/" onclick="javascript:window.open('https://www.foi.gov.ph/'); return false;">Learn more about the Executive Order No. 2 - The order implementing Freedom of Information in the Philippines.</a>
                </div>
                <div class="clear"></div>
                </div>

            <div class="footermid">
                <div class="title">ABOUT GOVPH</div>
                Learn more about the Philippine government, its structure, how government works and the people behind it.
                <ul class="gov-links" style="margin-top: 20px;">
                    <li><a href="http://www.gov.ph/" onclick="javascript:window.open('http://www.gov.ph/'); return false;">GOV.PH</a></li>
                    <li><a href="http://www.gov.ph/data" onclick="javascript:window.open('http://www.gov.ph/data'); return false;">Open Data Portal</a></li>
                    <li><a href="http://www.officialgazette.gov.ph/" onclick="javascript:window.open('http://www.officialgazette.gov.ph/'); return false;">Official Gazette</a></li>
                </ul>
            </div>

            <div class="footerfr">
                <div class="title">GOVERNMENT LINKS</div>
                <ul class="gov-links">
                    <li><a href="http://president.gov.ph/" onclick="javascript:window.open('http://president.gov.ph/'); return false;">Office of the President</a></li>
                    <li><a href="http://ovp.gov.ph/" onclick="javascript:window.open('http://ovp.gov.ph/'); return false;">Office of the Vice President</a></li>
                    <li><a href="https://www.senate.gov.ph/" onclick="javascript:window.open('https://www.senate.gov.ph/'); return false;">Senate of the Philippines</a></li>
                    <li><a href="http://www.congress.gov.ph/" onclick="javascript:window.open('http://www.congress.gov.ph/'); return false;">House of Representatives</a></li>
                    <li><a href="http://sc.judiciary.gov.ph/" onclick="javascript:window.open('http://sc.judiciary.gov.ph/'); return false;">Supreme Court</a></li>
                    <li><a href="http://ca.judiciary.gov.ph/" onclick="javascript:window.open('http://ca.judiciary.gov.ph/'); return false;">Court of Appeals</a></li>
                    <li><a href="http://sb.judiciary.gov.ph/" onclick="javascript:window.open('http://sb.judiciary.gov.ph/'); return false;">Sandiganbayan</a></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="copyright-wrapper">
        <div class="copyright-container">
            Copyright © 2021  DENR BMB
        </div>
    </div>
	</div><!-- #page -->
	

	<?php wp_footer(); ?>

    


</body>
</html>
