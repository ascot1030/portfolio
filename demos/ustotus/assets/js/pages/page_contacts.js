var ContactPage = function() {

	return {

		//Basic Map
		initMap : function() {
			var map;
			$(document).ready(function() {
				map = new GMaps({
					div : '#map',
					scrollwheel : false,
					lat : 34.050914,
					lng : -118.263368
				});

				var marker = map.addMarker({
					lat : 34.050914,
					lng : -118.263368,
					title : 'TOTUS Inverstements'
				});
			});
		},

		//Panorama Map
		initPanorama : function() {
			var panorama;
			$(document).ready(function() {
				panorama = GMaps.createPanorama({
					el : '#panorama',
					lat : 34.050914,
					lng : -118.263368,
				});
			});
		}
	};
}(); 