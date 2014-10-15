<ul class="nav nav-justified main-nav">
	<li class="logo-container">
		<?php echo $this->blkLogoImage(); ?>
	</li>
	<li <?php if($active==1){ ?> class="active" <?php } ?>><a href="/"><?php echo $this->translateFront('menu-homepage'); ?></a></li>
	<li <?php if($active==2){ ?> class="active" <?php } ?>><a href="/default/index/gioi-thieu"><?php echo $this->translateFront('menu-introduce'); ?></a></li>
	<li <?php if($active==3){ ?> class="active" <?php } ?>><a href="/default/dich-vu"><?php echo $this->translateFront('menu-service'); ?></a></li>
	<li <?php if($active==4){ ?> class="active" <?php } ?>><a href="/default/san-pham"><?php echo $this->translateFront('menu-product'); ?></a></li>
	<li <?php if($active==5){ ?> class="active" <?php } ?>><a href="/default/tin-tuc"><?php echo $this->translateFront('menu-news'); ?></a></li>
	<li <?php if($active==6){ ?> class="active" <?php } ?>><a href="/default/index/lien-he"><?php echo $this->translateFront('menu-contact'); ?></a></li>
	<li class="language">
		<a href="/default/index/change-language/lang_front/en" class="language-link">
			<img src="<?php echo $this->imgUrl; ?>/english.png" alt="ngon ngu tieng anh" class="language-image" />
		</a>
	</li>
	<li class="language">
		<a href="default/index/change-language/lang_front/vi" class="language-link">
			<img src="<?php echo $this->imgUrl; ?>/vietnam.png" alt="ngon ngu tieng viet" class="language-image" />
		</a>
	</li>
</ul>