;(function() {
    Preloader = {
        show: function() {
  			$("[data-sel-preloader ]").show();
  			$("[data-sel-preloader-content]").addClass("blur-bg");
		},
		hide : function () {
			$("[data-sel-preloader ]").hide();
			$("[data-sel-preloader-content]").removeClass("blur-bg");
		},
	}
}).call(this);
