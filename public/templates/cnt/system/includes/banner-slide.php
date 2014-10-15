<?php 
	$dir = new DirectoryIterator(FILES_PATH . '/templates/banner-slide/');
	$arrBannerImages = array();
	foreach ($dir as $fileInfo) {
		if (!$fileInfo->isDot()) {
			$arrBannerImages[] = $fileInfo->getFilename();
		}
	}
?>
<div class="row banner-slide">
	<div class="col-md-12">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner">
			<?php 
        		if (count($arrBannerImages) > 0) {
        			sort($arrBannerImages);
        		
        			foreach ($arrBannerImages as $key=>$value) {
        				$banner_image_name = $value;
        				$banner_image_url = FILES_URL . '/templates/banner-slide/' . $banner_image_name;
        				if ($key == 0) {
        	?>	
				<div class="item active">
			<?php 
        				} else {
			?>
				<div class="item">
			<?php 
        				}
			?>
					<img src="<?php echo $banner_image_url; ?>" alt="cnt banner slide">
					<!--
					<div class="container">
						<div class="carousel-caption">
							<h1>Dự án số 1</h1>
							<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>
							<p><a class="btn btn-lg btn-primary cnt-detail-button" href="#" role="button">Chi tiết</a></p>
						</div>
					</div> -->
				</div>
			<?php 
        			}
        		}
			?>
			</div>
			<a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
			<a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
		</div>
	</div>
</div>